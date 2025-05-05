<!--   Core JS Files   -->
<script src="<?= constant('__baseurl__') ?>public/js/core/popper.min.js"></script>
<script src="<?= constant('__baseurl__') ?>public/js/core/bootstrap.min.js"></script>
<script src="<?= constant('__baseurl__') ?>public/js/plugins/perfect-scrollbar.min.js"></script>
<script src="<?= constant('__baseurl__') ?>public/js/plugins/smooth-scrollbar.min.js"></script>
<script src="<?= constant('__baseurl__') ?>public/js/plugins/chartjs.min.js"></script>
<script src="<?= constant('__baseurl__') ?>public/js/custom/custom.js"></script>
<script src="<?= constant('__baseurl__') ?>public/js/custom/schedule.js"></script>

<script>
  let datos_menciones = <?= $this->count_student_petro ? $this->count_student_petro : [] ?>;
  
  // Crear estructura por mención
  let menciones = {};
  let niveles = ['1°', '2°', '3°', '4°', '5°', '6°'];

  datos_menciones.forEach(item => {
    let mencion = item.mencion_nombre;
    let nivel = item.nivel_nombre;
    let cantidad = parseInt(item.cantidad);

    if (!menciones[mencion]) {
      menciones[mencion] = {
        name: mencion,
        data: Array(6).fill(0)
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
    const letras = '0123456789ABCDEF';
    let color = '#';
    for (let i = 0; i < 6; i++) {
      color += letras[Math.floor(Math.random() * 16)];
    }
    return color;
  }

  // Asignar un color aleatorio a cada mención y guardarlo para consistencia
  let colores = {};
  Object.values(menciones).forEach(m => {
    colores[m.name] = generarColorAleatorio();
  });

  // Generar datasets dinámicos
  let datasets = Object.values(menciones).map(m => {
    let color = colores[m.name];
    return {
      label: m.name,
      tension: .5,
      pointRadius: 0,
      borderColor: color,
      backgroundColor: hexToRgba(color, 0.2), // opacidad con RGBA
      borderWidth: 1,
      fill: true,
      data: m.data,
      maxBarThickness: 6
    };
  });

  // Función para convertir un hex a rgba con opacidad
  function hexToRgba(hex, alpha) {
    hex = hex.replace('#', '');
    const r = parseInt(hex.substring(0, 2), 16);
    const g = parseInt(hex.substring(2, 4), 16);
    const b = parseInt(hex.substring(4, 6), 16);
    return `rgba(${r}, ${g}, ${b}, ${alpha})`;
  }

  // Crear gráfico
  const ctx1 = document.getElementById("chart-line-a").getContext("2d");
  new Chart(ctx1, {
    type: "line",
    data: {
      labels: niveles,
      datasets: datasets
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
        legend: {
          display: true
        }
      },
      interaction: {
        intersect: false,
        mode: 'index'
      },
      scales: {
        y: {
          grid: {
            drawBorder: true,
            display: true,
            drawOnChartArea: true,
            drawTicks: false,
            borderDash: [5, 5]
          },
          ticks: {
            display: true,
            padding: 10,
            color: '#fbfbfb',
            font: {
              size: 11,
              family: "Open Sans",
              style: 'normal',
              lineHeight: 2
            },
          }
        },
        x: {
          grid: {
            drawBorder: false,
            display: false,
            drawOnChartArea: false,
            drawTicks: true,
            borderDash: [5, 5]
          },
          ticks: {
            display: true,
            color: '#ccc',
            padding: 10,
            font: {
              size: 11,
              family: "Open Sans",
              style: 'normal',
              lineHeight: 2
            },
          }
        },
      },
    },
  });
</script>


<script>
  var win = navigator.platform.indexOf('Win') > -1;
  if (win && document.querySelector('#sidenav-scrollbar')) {
    var options = {
      damping: '0.5'
    }
    Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
  }
</script>

<!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
<script src="<?= constant('__baseurl__') ?>public/js/argon-dashboard.min.js?v=2.0.4"></script>