<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Sala de Servidores UNAB</title>
  <link rel="icon" href="logo-unab2.png" type="image/png" />
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background: linear-gradient(135deg, #e6f2ff, #ffffff) !important;
      margin: 0;
      padding: 0;
    }

    header {
      display: flex;
      align-items: center;
      padding: 1rem 2rem;
      background-color: #003366;
      color: white;
    }

    header img {
      height: 60px;
      margin-right: 1rem;
    }

    h1 {
      font-size: 1.8rem;
      margin: 0;
    }

    main {
      display: flex;
      flex-direction: column;
      align-items: center;
      padding: 2rem;
    }

    .panel {
      background-color: white;
      border-radius: 1rem;
      box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
      padding: 2rem;
      width: 100%;
      max-width: 600px;
      margin-bottom: 2rem;
      text-align: center;
    }

    .valor {
      font-size: 3rem;
      font-weight: bold;
    }

    .estado {
      font-size: 1rem;
      margin-top: 0.5rem;
    }

    .optimo {
      color: green;
    }

    .critico {
      color: red;
    }

    .subiendo {
      color: #e6a800;
    }

    button {
      background-color: #003366;
      color: white;
      border: none;
      padding: 0.7rem 1.5rem;
      font-size: 1rem;
      border-radius: 0.5rem;
      cursor: pointer;
      margin-top: 1rem;
    }

    canvas {
      max-width: 100%;
      margin-top: 1rem;
    }

    footer {
      text-align: center;
      padding: 1rem;
      background-color: #f0f0f0;
      font-size: 0.9rem;
    }
  </style>
</head>
<body>
  <header>
    <img src="logo-unab2.png" alt="Logo UNAB" />
    <h1>Sala de Servidores</h1>
  </header>

  <main>
    <div class="panel" id="panel-dht">
      <div class="valor" id="temp-actual">-- °C</div>
      <div class="estado" id="estado-temp">Esperando datos...</div>

      <div class="valor" id="humedad-actual">-- %</div>
      <div class="estado" id="estado-humedad">Esperando datos...</div>

      <button onclick="toggleGraficos()">Mostrar variaciones</button>

      <div id="graficos" style="display:none;">
        <canvas id="grafico-temp"></canvas>
        <canvas id="grafico-humedad"></canvas>
      </div>
    </div>
  </main>

  <footer>
    Desarrollado por la Facultad de Ingeniería - Universidad Andrés Bello
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>
    let mostrar = false;
    function toggleGraficos() {
      mostrar = !mostrar;
      document.getElementById("graficos").style.display = mostrar ? "block" : "none";
    }

    // Función para enviar la alerta con la temperatura
    async function enviarAlerta(temp) {
      const response = await fetch(`alerta.php?temperatura=${temp}`);
      const result = await response.text();
      console.log(result);  // Mostrar el mensaje de respuesta (puedes manejarlo más si quieres)
    }

    async function obtenerDatos() {
      const res = await fetch('datos.php');
      const data = await res.json();

      const dht = data.dht;
      if (dht.length === 0) return;

      const ultima = dht[dht.length - 1];
      const temp = parseFloat(ultima.temperatura);
      const humedad = parseFloat(ultima.humedad);

      document.getElementById("temp-actual").innerText = temp + " °C";
      document.getElementById("humedad-actual").innerText = humedad + " %";

      // Estado temperatura
      let estadoTemp = "Óptimo";
      let claseTemp = "optimo";
      if (temp > 30) {
        estadoTemp = "Crítico";
        claseTemp = "critico";
        enviarAlerta(temp);  // Enviar la temperatura actual en la alerta
      } else if (temp > dht[dht.length - 2]?.temperatura) {
        estadoTemp = "En aumento";
        claseTemp = "subiendo";
      }
      document.getElementById("estado-temp").innerText = "Temperatura: " + estadoTemp;
      document.getElementById("estado-temp").className = "estado " + claseTemp;

      // Estado humedad
      let estadoHum = "Óptimo";
      let claseHum = "optimo";
      if (humedad > 80) {
        estadoHum = "Crítico";
        claseHum = "critico";
      } else if (humedad > dht[dht.length - 2]?.humedad) {
        estadoHum = "En aumento";
        claseHum = "subiendo";
      }
      document.getElementById("estado-humedad").innerText = "Humedad: " + estadoHum;
      document.getElementById("estado-humedad").className = "estado " + claseHum;

      // Graficos
      if (mostrar) {
        mostrarGraficos(dht);
      }
    }

    let chartTemp, chartHum;
    function mostrarGraficos(datos) {
      const labels = datos.map(d => d.fecha);
      const temps = datos.map(d => d.temperatura);
      const hums = datos.map(d => d.humedad);

      if (!chartTemp) {
        chartTemp = new Chart(document.getElementById('grafico-temp').getContext('2d'), {
          type: 'line',
          data: {
            labels,
            datasets: [{
              label: 'Temperatura (°C)',
              data: temps,
              borderColor: '#003366',
              backgroundColor: 'rgba(0,51,102,0.1)',
              tension: 0.3
            }]
          }
        });
      } else {
        chartTemp.data.labels = labels;
        chartTemp.data.datasets[0].data = temps;
        chartTemp.update();
      }

      if (!chartHum) {
        chartHum = new Chart(document.getElementById('grafico-humedad').getContext('2d'), {
          type: 'line',
          data: {
            labels,
            datasets: [{
              label: 'Humedad (%)',
              data: hums,
              borderColor: '#006699',
              backgroundColor: 'rgba(0,102,153,0.1)',
              tension: 0.3
            }]
          }
        });
      } else {
        chartHum.data.labels = labels;
        chartHum.data.datasets[0].data = hums;
        chartHum.update();
      }
    }

    obtenerDatos();
    setInterval(obtenerDatos, 10000); // Cada 10 segundos
  </script>
</body>
</html>