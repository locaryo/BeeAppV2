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


<div class="container-fluid pb-4" data-vista="dashboardAdmin">

  <div class="row">

    <div class="container bento-container">
      <div class="bento-grid">

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
                <i class="material-icons text-white opacity-10" style="font-size: 25px;">group</i>
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
                <i class="material-icons text-white opacity-10" style="font-size: 25px;">group</i>
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
                <i class="material-icons text-white opacity-10" style="font-size: 25px;">face</i>
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
                <i class="material-icons text-white opacity-10" style="font-size: 25px;">face_3</i>
              </div>
            </div>
          </div>
        </div>

        <div class="bento-col4-row1 row m-0">
          <div class="row">
            <div class="card-header bg-transparent">
              <h6 class="text-capitalize text-center">Ingresos Relevantes</h6>

            </div>
            <div class="card-body">
              <div class="chart">
                <canvas id="ingresos-matricula"
                  data-mensualidades='<?= $this->montoMensualidad ?>'
                  data-matricula='<?=$this->montoPagosMatriculaDashboard?>'
                  class="chart-canvas"
                  height="300">
                </canvas>
              </div>
            </div>
          </div>
        </div>

        <div class="bento-col2-row1 row m-0">
          <div class="row">
            <div class="card-header bg-transparent">
              <h6 class="text-capitalize text-center">Tabla Comparativa</h6>

            </div>
            <div class="card-body">
              <div class="chart">
                <canvas id="ingresos-salidas" data-comparativa='<?= $this->ingresoEgreso ?>' class="chart-canvas" height="200"></canvas>
              </div>
            </div>
          </div>
        </div>

        <div class="bento-col6-row1 row m-0">
          <div class="row">
            <div class="card-header bg-transparent">
              <h6 class="text-capitalize text-center">Menciones</h6>

            </div>
            <div class="card-body">
              <div class="chart">
                <canvas id="chart-line-a" data-menciones='<?=$this->count_student_petro?>' class="chart-canvas" height="300"></canvas>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>


  </div>
</div>