<?php require constant("__layout__") . "header.php"; ?>

<body class="g-sidenav-show   bg-gray-100">
  <div class="min-height-300 bg-primary position-absolute w-100"></div>

  <?php require constant("__layout__") . "nav.php"; ?>
  <?php require constant("__layout__") . "aside.php"; ?>

  <main class="main-content position-relative border-radius-lg ">
    <?php if (isset($_SESSION['message'])): ?>
      <div class="d-flex justify-content-center" style="position: absolute;z-index: 1;width: 100%;">
        <div class="alert alert-primary text-center text-white" role="alert">
          <strong><?php echo $_SESSION['message']; ?></strong>
        </div>
      </div>
      <?php unset($_SESSION['message']); ?>
    <?php else: ?>

    <?php endif; ?>

    <?php if (isset($_GET['delete'])): ?>
      <div class="d-flex justify-content-center position-absolute" style="left: 0;right: 0;top: 40px;">
        <div class="alert alert-primary text-center text-white" role="alert">
          <strong>Eliminado</strong>
        </div>
      </div>
    <?php endif ?>

    <div class="container-fluid py-4">

      <div class="row">

        <div class="container bento-container py-4">
          <div class="bento-grid py-4">

            <div class="bento-col3-row2 row m-0 py-2 gap-2">
              <!-- count teacher -->
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Total Docentes</p>
                    <h5 class="font-weight-bolder">
                      <?= $this->count_teacher ?>
                    </h5>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                    <i class="ni ni-single-02 text-lg opacity-10" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
              <!-- count student -->
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Total Alumnos</p>
                    <h5 class="font-weight-bolder">
                      <?= $this->count_student ?>
                    </h5>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-danger shadow-primary text-center rounded-circle">
                    <i class="ni ni-single-02 text-lg opacity-10" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>

            <div class="bento-col3-row2 row gap-2 m-0 py-2">
              <!-- count student-m -->
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Masculinos</p>
                    <h5 class="font-weight-bolder">
                      <?= $this->count_student_m ?>
                    </h5>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-success shadow-primary text-center rounded-circle">
                    <i class="ni ni-single-02 text-lg opacity-10" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
              <!-- count student-f -->
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Femeninos</p>
                    <h5 class="font-weight-bolder">
                      <?= $this->count_student_f ?>
                    </h5>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-warning shadow-primary text-center rounded-circle">
                    <i class="ni ni-single-02 text-lg opacity-10" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>

            <div class="bento-col2-row2 row m-0">
              <div class="row">
                <div class="card-header bg-transparent">
                  <h6 class="text-capitalize text-center py-2">Ingresos</h6>

                </div>
                <div class="card-body p-3">
                  <div class="chart">
                    <canvas id="ingresos-salidas" class="chart-canvas" height="300"></canvas>
                  </div>
                </div>
              </div>
            </div>

            <div class="bento-col2-row2 row m-0">
              <div class="row">
                <div class="card-header bg-transparent">
                  <h6 class="text-capitalize text-center py-2">Ingresos</h6>

                </div>
                <div class="card-body p-3">
                  <div class="chart">
                    <canvas id="ingresos-matricula" class="chart-canvas" height="300"></canvas>
                  </div>
                </div>
              </div>
            </div>

            <div class="bento-col2-row1 row m-0">
              <!-- count teacher -->
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Total Docentes</p>
                    <h5 class="font-weight-bolder">
                      <?= $this->count_teacher ?>
                    </h5>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                    <i class="ni ni-single-02 text-lg opacity-10" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>

            <div class="bento-col2-row1 row m-0">
              <!-- count teacher -->
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Total Docentes</p>
                    <h5 class="font-weight-bolder">
                      <?= $this->count_teacher ?>
                    </h5>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                    <i class="ni ni-single-02 text-lg opacity-10" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>

            <div class="bento-col2-row1 row m-0">
              <div class="row">
                <div class="card-header pb-0 pt-3 bg-transparent">
                  <h6 class="text-capitalize text-center py-2">Petroquimica</h6>

                </div>
                <div class="card-body p-3">
                  <div class="chart">
                    <canvas id="chart-line-a" class="chart-canvas" height="300"></canvas>
                  </div>
                </div>
              </div>
            </div>

            <div class="bento-col2-row1 row m-0">
              <div class="row">
                <div class="card-header pb-0 pt-3 bg-transparent">
                  <h6 class="text-capitalize text-center py-2">Mecanica</h6>

                </div>
                <div class="card-body p-3">
                  <div class="chart">
                    <canvas id="chart-line-b" class="chart-canvas" height="300"></canvas>
                  </div>
                </div>
              </div>
            </div>

            <div class="bento-col2-row1 row m-0">
              <div class="row">
                <div class="card-header pb-0 pt-3 bg-transparent">
                  <h6 class="text-capitalize text-center py-2">Electricidad</h6>

                </div>
                <div class="card-body p-3">
                  <div class="chart">
                    <canvas id="chart-line-c" class="chart-canvas" height="300"></canvas>
                  </div>
                </div>
              </div>
            </div>

          </div>
        </div>

        <?php require constant("__layout__") . "footer.php"; ?>

      </div>

  </main>

  <?php require constant("__layout__") . "scripts.php"; ?>
</body>

<script type="text/javascript">
  // Obtener los montos desde PHP
  let ingresos = 0;
  let egresos = 0;
  let diferencia = 0;
  let montos = JSON.parse('<?= $this->ingresoEgreso ?>');
  let montoMatricula = JSON.parse('<?= $this->montoPagosMatriculaStudent ?>');

  // Comprobar si los datos se están recibiendo correctamente
  console.log('Montos:', montos);
  console.log('Monto Matricula:', montoMatricula);

  // Extraer ingresos y egresos de los índices correspondientes, validando por si hay null o undefined
  ingresos = parseFloat(montos[0][0]?.total_monto_ingresos || 0) + parseFloat(montoMatricula[0]?.total_monto || 0); // Primer resultado, primer elemento
  egresos = parseFloat(montos[1][0]?.total_monto_egresos || 0); // Segundo resultado, primer elemento

  diferencia = parseFloat(ingresos) - parseFloat(egresos);

  // Configurar el contexto del gráfico
  var ingresosTotales = document.getElementById("ingresos-salidas").getContext("2d");

  // Crear el gráfico
  new Chart(ingresosTotales, {
    type: "doughnut",
    data: {
      labels: ['Ingresos Totales en $', 'Egresos Totales en $', 'Diferencia en $'], // Cambia las etiquetas según tus datos
      datasets: [{
        data: [ingresos, egresos, diferencia],
        backgroundColor: [
          'rgb(11, 218, 95)', // Color para ingresos
          'rgb(255, 99, 132)', // Color para egresos
          'rgb(11, 134, 218)' // Color para diferencia
        ],
        hoverOffset: 3
      }],
    },
    options: {
      responsive: true,
      maintainAspectRatio: true,
      plugins: {
        legend: {
          display: false, // Muestra la leyenda en el gráfico
        }
      },
      interaction: {
        intersect: true,
        mode: 'index',
      },
      scales: {
        y: {
          grid: {
            drawBorder: false,
            display: false,
          },
          ticks: {
            display: false,
          }
        },
        x: {
          grid: {
            drawBorder: false,
            display: false,
          },
          ticks: {
            display: false,
          }
        },
      },
    },
  });
</script>


<script type="text/javascript">
  // Obtener los montos desde PHP
  let montoMatriculaIngreso = JSON.parse('<?= $this->montoPagosMatriculaStudent ?>');

  let matriculaIngresoFecha = montoMatriculaIngreso.map(item => {
    let fecha = new Date(item.fecha_pago);

    // Asegurar que el desfase no afecte la fecha, añadiendo un ajuste si es necesario
    fecha.setMinutes(fecha.getMinutes() + fecha.getTimezoneOffset());

    // Formatear a DD/MM/YYYY
    return fecha.toLocaleDateString('es-ES');
  });

  let matriculaIngreso = montoMatriculaIngreso.map(item => parseFloat(item.total_monto)); // Monto correspondiente a cada fecha

  // Configurar el contexto del gráfico
  var ingresosTotales = document.getElementById("ingresos-matricula").getContext("2d");

  var gradientStroke1 = ingresosTotales.createLinearGradient(0, 230, 0, 50);
  // Crear el gráfico
  gradientStroke1.addColorStop(1, 'rgba(94, 114, 228, 0.2)');
  gradientStroke1.addColorStop(0.2, 'rgba(94, 114, 228, 0.0)');
  gradientStroke1.addColorStop(0, 'rgba(94, 114, 228, 0)');
  new Chart(ingresosTotales, {
    type: "line",
    data: {
      labels: matriculaIngresoFecha,
      datasets: [{
        label: 'Monto $',
        tension: 0.4,
        borderWidth: 0,
        pointRadius: 0,
        borderColor: "#5e72e4",
        backgroundColor: gradientStroke1,
        borderWidth: 3,
        fill: true,
        data: matriculaIngreso,
        maxBarThickness: 6

      }],
    },
    options: {
      responsive: true,
      maintainAspectRatio: true,
      plugins: {
        legend: {
          display: false,
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
</script>

</html>