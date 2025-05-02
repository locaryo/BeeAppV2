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
                <label for="example-text-input" class="form-label required">Tipo de Ingreso</label>
                <select class="form-control" id="ingreso-tipo" name="servicio">
                  <option selected disabled value="">Seleccionar</option>
                  <?php foreach ($this->income_source as $value): ?>
                    <option nameValue="<?= $value['income_name'] ?>" value="<?= $value['id'] ?>" title="<?= $value['description'] ?>"><?= $value['income_name'] ?></option>
                  <?php endforeach ?>
                </select>
              </div>

              <div class="form-group col-12 col-sm-6 col-md-4 px-2 d-filtro d-none position-relative">
                <label for="example-text-input" class="form-label required">Filtrar Estudiante</label>
                <input class="form-control" id="filtrar-estudiante" name="filtro-estudiante" list="" role="listbox" autocomplete="off" required>
                <datalist class="filterable-list p-1 overflow-y-auto rounded-0 rounded-bottom position-absolute bg-white border-bottom border-end border-start border-primary" id="studentsList">
                </datalist>
                <input type="text" class="d-none" id="student-id" name="id-estudiante">
              </div>

              <div class="form-group col-12 col-sm-6 col-md-4 px-2">
                <label for="example-text-input" class="form-label required">Monto</label>
                <input class="form-control" type="text" id="amount-bs" name="monto" required>
              </div>

              <div class="form-group col-12 col-sm-6 col-md-4 px-2 d-amount d-none">
                <label for="example-text-input" class="form-label">Monto USD-BCV</label>
                <input class="form-control" type="text" id="amount-usd-bcv">
              </div>

              <div class="form-group col-12 col-sm-6 col-md-4 px-2">
                <label for="example-text-input" class="form-label">Metodo de Pago</label>
                <select class="form-control" id="pago-tipo" name="metodo_pago">
                  <?php foreach ($this->payment_mehtod as $value): ?>
                    <option nameValue="<?= $value['payment_method'] ?>" value="<?= $value['id'] ?>"><?= $value['payment_method'] ?></option>
                  <?php endforeach ?>
                </select>
              </div>
              <div class="form-group col-12 col-sm-6 col-md-4 px-2 d-reference d-none">
                <label for="example-text-input" class="form-label required">Referencia</label>
                <input class="form-control" type="text" name="referencia" required>
              </div>
              <div class="form-group col-12 col-sm-6 col-md-4 px-2">
                <label for="example-text-input" class="form-label required">Fecha</label>
                <input class="form-control" type="date" name="fecha" required>
              </div>
              <div class="form-group col-12 col-sm-6 col-md-4 px-2 d-fecha d-none">
                <label for="example-text-input" class="form-label required">Mes a Pagar</label>
                <input class="form-control" type="date" name="start_monthly_payment" required>
                <input class="form-control d-none" id="end_monthly_payment" type="date" name="end_monthly_payment">
              </div>
              <div class="form-group col-12 col-sm-6 col-md-4 px-2">
                <label for="example-text-input" class="form-label">Nota</label>
                <input class="form-control" type="text" name="nota">
              </div>
            </div>
            <div class="col-auto">
              <p class="card-text px-3 mb-3"><span class="text-danger">(*)</span> Indica que el campo es obligatorio.</p>
            </div>
            <div class="row mx-1 justify-content-center mt-2">
              <div class="col-12 col-sm-4 d-grid px-2">
                <button class="btn btn-primary" type="send">Registrar</button>
              </div>
              <div class="col-12 col-sm-4 d-grid px-2">
                <button class="btn btn-secondary go-back" type="button">Regresar</button>
              </div>
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