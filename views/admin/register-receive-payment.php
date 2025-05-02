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
    <?php endif ?>
    <div class="container-fluid pt-5">

      <div class="row">
        <!-- form escritorio -->
        <form class="needs-validation" novalidate action="<?= constant('__baseurl__') ?>home/register_receive_payment" method="post">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <h6>Nueva Factura: Pago Recibido</h6>
            </div>
            <!-- desktop -->
            <div class="row mx-1">
              <div class="form-group col-12 col-sm-6 col-md-4 px-2">
                <label for="example-text-input" class="form-label">Tipo de Ingreso</label>
                <select class="form-control" id="tipo-ingreso" name="servicio">
                  <option value="0">Seleccionar</option>
                  <?php foreach ($this->income_source as $value): ?>
                    <option nameValue="<?= $value['income_name'] ?>" value="<?= $value['id'] ?>" title="<?= $value['description'] ?>"><?= $value['income_name'] ?></option>
                  <?php endforeach ?>
                </select>
              </div>

              <div class="form-group col-12 col-sm-6 col-md-4 px-2 d-filtro d-none position-relative">
                <label for="example-text-input" class="form-label">Filtrar Estudiante</label>
                <input class="form-control" id="filtrar-estudiante" name="filtro-estudiante" list="" role="listbox" autocomplete="off">
                <datalist class="p-1 overflow-y-auto rounded-0 rounded-bottom position-absolute bg-white border-bottom border-end border-start border-primary" id="studentsList">
                </datalist>
                <input type="text" class="d-none" id="student-id" name="id-estudiante">
              </div>

              <div class="form-group col-12 col-sm-6 col-md-4 px-2">
                <label for="example-text-input" class="form-label required">Monto</label>
                <input class="form-control" type="text" id="amount-bs" name="monto" required>
              </div>

              <div class="col-md-3">
                <div class="form-group mx-2">
                  <label for="example-text-input" class="form-control-label">Monto</label>
                  <input class="form-control" type="text" id="amount-bs" name="monto" required>
                </div>
              </div>

              <div class="col-md-3 d-amount d-none">
                <div class="form-group mx-2">
                  <label for="example-text-input" class="form-control-label">Monto USD-BCV</label>
                  <input class="form-control" type="text" id="amount-usd-bcv">
                </div>
              </div>

              <div class="col-md-3">
                <div class="form-group mx-2">
                  <label for="example-text-input" class="form-control-label">Metodo de Pago</label>
                  <select class="form-control" id="pago-tipo" name="metodo_pago">
                    <?php foreach ($this->payment_mehtod as $value): ?>
                      <option nameValue="<?= $value['payment_method'] ?>" value="<?= $value['id'] ?>"><?= $value['payment_method'] ?></option>
                    <?php endforeach ?>
                  </select>
                </div>
              </div>
              <div class="col-md-3 d-reference d-none">
                <div class="form-group mx-2">
                  <label for="example-text-input" class="form-control-label">Referencia</label>
                  <input class="form-control" type="text" name="referencia">
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group mx-2">
                  <label for="example-text-input" class="form-control-label">Fecha</label>
                  <input class="form-control" type="date" name="fecha" required>
                </div>
              </div>
              <div class="form-group col-12 col-sm-6 col-md-4 px-2 d-amount d-none">
                <label for="example-text-input" class="form-label">Monto USD-BCV</label>
                <input class="form-control" type="text" id="amount-usd-bcv" required>
              </div>
              <div class="form-group col-12 col-sm-6 col-md-4 px-2">
                <label for="example-text-input" class="form-label">Metodo de Pago</label>
                <select class="form-control" name="metodo_pago">
                  <?php foreach ($this->payment_mehtod as $value): ?>
                    <option value="<?= $value['id'] ?>"><?= $value['payment_method'] ?></option>
                  <?php endforeach ?>
                </select>
              </div>
              <div class="form-group col-12 col-sm-6 col-md-4 px-2">
                <label for="example-text-input" class="form-label">Referencia</label>
                <input class="form-control" type="text" name="referencia">
              </div>
              <div class="form-group col-12 col-sm-6 col-md-4 px-2">
                <label for="example-text-input" class="form-label">Fecha</label>
                <input class="form-control" type="date" name="fecha" required>
              </div>

              <div class="form-group col-12 col-sm-6 col-md-4 px-2 d-fecha d-none">
                <label for="example-text-input" class="form-label">Mes a Pagar</label>
                <input class="form-control" type="date" name="start_monthly_payment">
                <input class="form-control d-none" id="end_monthly_payment" type="date" name="end_monthly_payment">
              </div>

              <div class="form-group col-12 col-sm-6 col-md-4 px-2">
                <label for="example-text-input" class="form-label">Nota</label>
                <input class="form-control" type="text" name="nota">
              </div>
            </div>

            <!-- desktop -->
            <div class="d-flex justify-content-center align-items-center">
              <button class="btn btn-success mx-2" name="action" type="submit">Registrar</button>
            </div>
          </div>
        </form>

      </div>

      <?php require constant("__layout__") . "footer.php"; ?>

    </div>
  </main>

  <?php require constant("__layout__") . "scripts.php"; ?>

</body>

</html>