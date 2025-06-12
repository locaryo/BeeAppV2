window.Custom = window.Custom || {};

function toArray(data) {
  if (Array.isArray(data)) return data;
  if (data == null) return [];
  return [data];
}

function parseMaybeDoubleSerialized(jsonString) {
  let parsed = JSON.parse(jsonString || "[]");
  if (
    Array.isArray(parsed) &&
    parsed.length === 1 &&
    typeof parsed[0] === "string"
  ) {
    parsed = JSON.parse(parsed[0]);
  }
  return parsed;
}

Custom.accountingDashboard = function () {
  const canva = document.getElementById("ingresos-matricula-contabilidad");
  // 1. Parsear los datos que envía PHP (asegúrate de usar json_encode)
  let datos = JSON.parse(canva.dataset.mensualidades);
  let matricula = JSON.parse(canva.dataset.matricula);

  // 2. Crear un array de 12 ceros (uno por cada mes)
  let ingresosPorMes = new Array(12).fill(0);
  let ingresosPorMatricula = new Array(12).fill(0);

  // 3. Rellenar el array según los datos recibidos
  datos.forEach((item) => {
    // Obtener el mes (0 = enero, …, 11 = diciembre)
    let mes = new Date(item.start_monthly_payment).getMonth();
    // Convertir el monto a número y asignarlo
    ingresosPorMes[mes] = parseFloat(item.total_monto_ingresos) || 0;
  });

  // 3. Rellenar el array según los datos recibidos
  matricula.forEach((item) => {
    // Obtener el mes (0 = enero, …, 11 = diciembre)
    let mess = new Date(item.date_payment).getMonth();
    // Convertir el monto a número y asignarlo
    ingresosPorMatricula[mess] = parseFloat(item.total_monto_ingresos) || 0;
  });

  // 4. Configurar y dibujar el gráfico con Chart.js
  const ctx = document.getElementById("ingresos-matricula-contabilidad").getContext("2d");

  // degradado para el fondo
  const gradient = ctx.createLinearGradient(0, 200, 0, 50);
  gradient.addColorStop(1, "rgba(94, 114, 228, 0.2)");
  gradient.addColorStop(0.2, "rgba(94, 114, 228, 0.0)");
  gradient.addColorStop(0, "rgba(94, 114, 228, 0)");

  new Chart(ctx, {
    type: "line",
    data: {
      labels: [
        "Ene",
        "Feb",
        "Mar",
        "Abr",
        "May",
        "Jun",
        "Jul",
        "Ago",
        "Sep",
        "Oct",
        "Nov",
        "Dic",
      ],
      datasets: [
        {
          label: "Mensualidades ($)",
          data: ingresosPorMes,
          tension: 0.4,
          pointRadius: 0,
          borderColor: "#5e72e4",
          backgroundColor: gradient,
          borderWidth: 2,
          fill: true,
          maxBarThickness: 6,
        },
        {
          label: "Matricula ($)",
          data: ingresosPorMatricula,
          tension: 0.4,
          pointRadius: 0,
          borderColor: "#fb6340",
          backgroundColor: gradient,
          borderWidth: 2,
          fill: true,
          maxBarThickness: 6,
        },
      ],
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
        legend: {
          display: false,
        },
      },
      interaction: {
        intersect: false,
        mode: "index",
      },
      scales: {
        y: {
          grid: {
            drawBorder: true,
            display: true,
            drawOnChartArea: true,
            drawTicks: false,
            borderDash: [5, 5],
          },
          ticks: {
            padding: 10,
            font: {
              size: 11,
              family: "Open Sans",
            },
          },
        },
        x: {
          grid: {
            display: false,
          },
          ticks: {
            padding: 10,
            font: {
              size: 11,
              family: "Open Sans",
            },
          },
        },
      },
    },
  });
};
