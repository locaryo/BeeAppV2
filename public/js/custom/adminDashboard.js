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

Custom.ingresoEgreso = function () {
  // Obtener los montos desde PHP
  const canva = document.getElementById("ingresos-salidas");
  let ingresos = 0;
  let egresos = 0;
  let diferencia = 0;
  let montos = JSON.parse(canva.dataset.comparativa);

  // Extraer ingresos y egresos de los índices correspondientes, validando por si hay null o undefined
  ingresos = parseFloat(montos[0][0]?.total_monto_ingresos || 0); // Primer resultado, primer elemento
  egresos = parseFloat(montos[1][0]?.total_monto_egresos || 0); // Segundo resultado, primer elemento
  diferencia = parseFloat(ingresos) - parseFloat(egresos);

  // Configurar el contexto del gráfico
  var ingresosTotales = document
    .getElementById("ingresos-salidas")
    .getContext("2d");

  // Crear el gráfico
  new Chart(ingresosTotales, {
    type: "doughnut",
    data: {
      labels: [
        "Ingresos Totales en $",
        "Egresos Totales en $",
        "Diferencia en $",
      ], // Cambia las etiquetas según tus datos
      datasets: [
        {
          data: [ingresos, egresos, diferencia],
          backgroundColor: [
            "rgb(11, 218, 95)", // Color para ingresos
            "rgb(255, 99, 132)", // Color para egresos
            "rgb(11, 134, 218)", // Color para diferencia
          ],
          hoverOffset: 3,
        },
      ],
    },
    options: {
      responsive: true,
      maintainAspectRatio: true,
      plugins: {
        legend: {
          display: false, // Muestra la leyenda en el gráfico
        },
      },
      interaction: {
        intersect: true,
        mode: "index",
      },
      scales: {
        y: {
          grid: {
            drawBorder: false,
            display: false,
          },
          ticks: {
            display: false,
          },
        },
        x: {
          grid: {
            drawBorder: false,
            display: false,
          },
          ticks: {
            display: false,
          },
        },
      },
    },
  });
};

Custom.ingresosRelevantes = function () {
  const canva = document.getElementById("ingresos-matricula");
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
  const ctx = document.getElementById("ingresos-matricula").getContext("2d");

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

Custom.menciones = function () {
  const canva = document.getElementById("chart-line-a");
  let datos_menciones = []; // Inicializa como un array vacío por defecto

  datos_menciones = JSON.parse(canva.dataset.menciones);

  // Crear estructura por mención
  let menciones = {};
  let niveles = ["1°", "2°", "3°", "4°", "5°", "6°"];

  datos_menciones.forEach((item) => {
    let mencion = item.mencion_nombre;
    let nivel = item.nivel_nombre;
    let cantidad = parseInt(item.cantidad);

    if (!menciones[mencion]) {
      menciones[mencion] = {
        name: mencion,
        data: Array(6).fill(0),
      };
    }

    // Suponiendo que los niveles son '1ero', '2do', ..., '6to'
    let index = niveles.indexOf(nivel);
    if (index !== -1) {
      menciones[mencion].data[index] = cantidad;
    }
  });

  // Función para generar un color hexadecimal aleatorio
  function generarColorAleatorio() {
    const letras = "0123456789ABCDEF";
    let color = "#";
    for (let i = 0; i < 6; i++) {
      color += letras[Math.floor(Math.random() * 16)];
    }
    return color;
  }

  // Asignar un color aleatorio a cada mención y guardarlo para consistencia
  let colores = {};
  Object.values(menciones).forEach((m) => {
    colores[m.name] = generarColorAleatorio();
  });

  // Generar datasets dinámicos
  let datasets = Object.values(menciones).map((m) => {
    let color = colores[m.name];
    return {
      label: m.name,
      tension: 0.5,
      pointRadius: 0,
      borderColor: color,
      backgroundColor: hexToRgba(color, 0.2), // opacidad con RGBA
      borderWidth: 1,
      fill: true,
      data: m.data,
      maxBarThickness: 6,
    };
  });

  // Función para convertir un hex a rgba con opacidad
  function hexToRgba(hex, alpha) {
    hex = hex.replace("#", "");
    const r = parseInt(hex.substring(0, 2), 16);
    const g = parseInt(hex.substring(2, 4), 16);
    const b = parseInt(hex.substring(4, 6), 16);
    return `rgba(${r}, ${g}, ${b}, ${alpha})`;
  }

  // Crear gráfico
  const ctx1 = document.getElementById("chart-line-a");
  if (ctx1) {
    const context = ctx1.getContext("2d");
    new Chart(context, {
      type: "line",
      data: {
        labels: niveles,
        datasets: datasets,
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            display: true,
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
              display: true,
              padding: 10,
              color: "#fbfbfb",
              font: {
                size: 11,
                family: "Open Sans",
                style: "normal",
                lineHeight: 2,
              },
            },
          },
          x: {
            grid: {
              drawBorder: false,
              display: false,
              drawOnChartArea: false,
              drawTicks: true,
              borderDash: [5, 5],
            },
            ticks: {
              display: true,
              color: "#ccc",
              padding: 10,
              font: {
                size: 11,
                family: "Open Sans",
                style: "normal",
                lineHeight: 2,
              },
            },
          },
        },
      },
    });
  }
};
