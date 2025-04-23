<!--   Core JS Files   -->
<script src="<?= constant('__baseurl__') ?>public/js/core/popper.min.js"></script>
<script src="<?= constant('__baseurl__') ?>public/js/core/bootstrap.min.js"></script>
<script src="<?= constant('__baseurl__') ?>public/js/plugins/perfect-scrollbar.min.js"></script>
<script src="<?= constant('__baseurl__') ?>public/js/plugins/smooth-scrollbar.min.js"></script>
<script src="<?= constant('__baseurl__') ?>public/js/plugins/chartjs.min.js"></script>
<script src="<?= constant('__baseurl__') ?>public/js/custom/custom.js"></script>
<script src="<?= constant('__baseurl__') ?>public/js/custom/schedule.js"></script>

<script>
  let datos_petro = <?= $this->count_student_petro ?: '[]' ?>;
  let datos_mecanica = <?= $this->count_student_meca ?: '[]' ?>;
  let datos_elec = <?= $this->count_student_elec ?: '[]' ?>;

  if (Array.isArray(datos_petro) && datos_petro.length > 0) {
    let counts_petro = datos_petro.map(item => item.cantidad);
    let counts_meca = datos_mecanica.map(item => item.cantidad);
    let counts_elec = datos_elec.map(item => item.cantidad);


    const ctx1 = document.getElementById("chart-line-a").getContext("2d");

    var gradientStroke1 = ctx1.createLinearGradient(0, 300, 0, 50);
    gradientStroke1.addColorStop(1, 'rgba(94, 114, 228, 0.2)');
    gradientStroke1.addColorStop(0.2, 'rgba(94, 114, 228, 0.0)');
    gradientStroke1.addColorStop(0, 'rgba(94, 114, 228, 0)');

    var gradientStroke2 = ctx1.createLinearGradient(0, 300, 0, 50);
    gradientStroke2.addColorStop(1, 'rgba(214, 21, 63, 0.2)');
    gradientStroke2.addColorStop(0.2, 'rgba(255, 99, 132, 0.0)');
    gradientStroke2.addColorStop(0, 'rgba(255, 99, 132, 0)');

    var gradientStroke3 = ctx1.createLinearGradient(0, 300, 0, 50);
    gradientStroke3.addColorStop(1, 'rgba(54, 162, 235, 0.2)');
    gradientStroke3.addColorStop(0.2, 'rgba(54, 162, 235, 0.0)');
    gradientStroke3.addColorStop(0, 'rgba(54, 162, 235, 0)');

    new Chart(ctx1, {
      type: "line",
      data: {
        labels: ['1ero', '2do', '3ro', '4to', '5to', '6to'],
        datasets: [{
          label: "Petroquimica",
          tension: .5,
          pointRadius: 0,
          borderColor: "#5e72e4",
          backgroundColor: gradientStroke1,
          borderWidth: 1,
          fill: true,
          data: counts_petro,
          maxBarThickness: 6
        }, {
          data: counts_meca,
          label: "Mecanica",
          backgroundColor: gradientStroke2,
          borderColor: "#fb6340",
          borderWidth: 1,
          fill: true,
          tension: .5,
          pointRadius: 0,
          maxBarThickness: 6,
        }, {
          data: counts_elec,
          label: "Electricidad",
          backgroundColor: gradientStroke3,
          borderColor: "#11cdef",
          borderWidth: 1,
          fill: true,
          tension: .5,
          pointRadius: 0,
          maxBarThickness: 6,
        }],
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
          mode: 'index',
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
  }
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