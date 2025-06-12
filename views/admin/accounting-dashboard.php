<?php if (isset($_SESSION['message'])): ?>
  <div class="d-flex justify-content-center" style="position: absolute;z-index: 1;width: 100%;">
    <div class="alert alert-primary text-center text-white" role="alert">
      <strong><?php echo $_SESSION['message']; ?></strong>
    </div>
  </div>
  <?php unset($_SESSION['message']); ?>

<?php endif; ?>

<div class="container-fluid pb-4" data-vista="accountingDashboard">

  <div class="row">

    <div class="container bento-container">
      <div class="bento-grid">

        <div class="bento-col6-row1 justify-content-around py-2 px-3 desktop-to-mobile">
          <!-- count teacher -->
          <div class="row">
            <div class="col-8">
              <div class="numbers">
                <p class="text-sm mb-0 text-uppercase font-weight-bold">Ingresos</p>
                <h5 class="font-weight-bolder acounting-dashboard-receive">
                  <?= $this->receivePayment[0]['total_amount'] ?>
                </h5>
                <span class="text-success acounting-dashboard-receive-usd"></span>
              </div>
            </div>
            <div class="col-4 text-end">
              <div class="icon icon-shape bg-gradient-success shadow-primary text-center rounded-circle">
                <i class="material-icons text-white opacity-10" style="font-size: 25px;">attach_money</i>
              </div>
            </div>
          </div>
          <!-- count student -->
          <div class="row">
            <div class="col-8">
              <div class="numbers">
                <p class="text-sm mb-0 text-uppercase font-weight-bold">Egresos</p>
                <h5 class="font-weight-bolder acounting-dashboard-send">
                  <?= $this->sendPayment[0]['total_amount'] ?>
                </h5>
                <span class="text-danger acounting-dashboard-send-usd"></span>
              </div>
            </div>
            <div class="col-4 text-end">
              <div class="icon icon-shape bg-gradient-danger shadow-primary text-center rounded-circle">
                <i class="material-icons text-white opacity-10" style="font-size: 25px;">request_quote</i>
              </div>
            </div>
          </div>
          <!-- count student -->
          <div class="row">
            <div class="col-8">
              <div class="numbers">
                <p class="text-sm mb-0 text-uppercase font-weight-bold">Benficio</p>
                <h5 class="font-weight-bolder acounting-dashboard-benefit">
                  <?= $this->profit ?>
                </h5>
                <span class="text-success acounting-dashboard-benefit-usd"></span>
              </div>
            </div>
            <div class="col-4 text-end">
              <div class="icon icon-shape bg-gradient-success shadow-primary text-center rounded-circle">
                <i class="material-icons text-white opacity-10" style="font-size: 25px;">savings</i>
              </div>
            </div>
          </div>
          <!-- count student -->
          <div class="row">
            <div class="col-8">
              <div class="numbers">
                <p class="text-sm mb-0 text-uppercase font-weight-bold">Margen</p>
                <h5 class="font-weight-bolder">
                  <?= $this->benefit . "%" ?>
                </h5>
              </div>
            </div>
            <div class="col-4 text-end">
              <div class="icon icon-shape bg-gradient-success shadow-primary text-center rounded-circle">
                <i class="material-icons text-white opacity-10" style="font-size: 25px;">trending_up</i>
              </div>
            </div>
          </div>
        </div>

        <div class="bento-col6-row1 row m-0">
          <div class="row">
            <div class="card-header pb-0 pt-3 bg-transparent">
              <h6 class="text-capitalize text-center py-2">Filtrar</h6>
            </div>

            <div class="card-body">
              <div class="d-flex justify-content-evenly flex-wrap desktop-to-mobile">
                <div class="">
                  <label for="tipo" class="form-label">Tipo</label>
                  <select id="tipo" class="form-control">
                    <option value="0">Seleccionar</option>
                    <option value="ingresos">Ingresos</option>
                    <option value="gastos">Gastos</option>
                  </select>
                </div>

                <div class="d-none d-category">
                  <label class="form-label">Categoría</label>
                  <select id="expenses_category" class="form-control">
                    <option value="0">Seleccionar</option>
                    <?php foreach ($this->expenses_category as $value): ?>
                      <option value="<?= $value['id'] ?>"><?= $value['expenses'] ?></option>
                    <?php endforeach; ?>
                  </select>

                  <select id="income_source" class="form-control">
                    <option value="0">Seleccionar</option>
                    <?php foreach ($this->income_source as $value): ?>
                      <option value="<?= $value['id'] ?>"><?= $value['income_name'] ?></option>
                    <?php endforeach; ?>
                  </select>

                </div>

                <div class="">
                  <label for="fecha_inicio" class="form-label">Desde</label>
                  <input type="date" id="fecha_inicio" class="form-control">
                </div>

                <div class="">
                  <label for="fecha_fin" class="form-label">Hasta</label>
                  <input type="date" id="fecha_fin" class="form-control">
                </div>
              </div>

              <div class="chart mt-4">
                <canvas id="dinamic-chart" class="chart-canvas" height="auto"></canvas>
              </div>
            </div>

          </div>
        </div>

        <div class="bento-col6-row1 row m-0">
          <div class="row">
            <div class="card-header pb-0 pt-3 bg-transparent">
              <h6 class="text-capitalize text-center py-2">Matriculas y Mensualidades</h6>

            </div>
            <div class="card-body p-3">
              <div class="chart">
                <canvas
                  id="ingresos-matricula-contabilidad"
                  class="chart-canvas"
                  data-mensualidades='<?= $this->montoMensualidad ?>'
                  data-matricula='<?= $this->montoPagosMatriculaDashboard ?>'
                  height="auto">
                </canvas>

              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>