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

        <form action="<?= constant('__baseurl__') ?>home/register_service_payment" method="post">
          <div class="col-12">

            <div class="card mb-4">

              <div class="card-header pb-0">
                <h6>Nueva Factura: Servicio</h6>
              </div>

              <!-- desktop -->
              <div class="d-flex justify-content-center align-items-center flex-column mx-1 desktop-to-mobile">
                <div class="col-md-3">
                  <div class="form-group mx-2">
                    <label for="example-text-input" class="form-label">Tipo de Servicio</label>
                    <select class="form-control" id="gasto-tipo" name="servicio">
                      <option value="0">Seleccionar</option>
                      <?php foreach ($this->income_source as $value): ?>
                        <option nameValue="<?= $value['expenses'] ?>" value="<?= $value['id'] ?>" title="<?= $value['description'] ?>"><?= $value['expenses'] ?></option>
                      <?php endforeach ?>
                    </select>
                  </div>
                </div>

                <div class="col-md-3 d-filtro d-none">
                  <div class="form-group mx-2">
                    <label for="example-text-input" class="form-control-label">Filtrar Docente</label>
                    <input class="form-control" type="text" id="filtrar-docente" name="filtro-docente">
                    <input type="text" class="d-none" id="teacher-id" name="id-docente">
                  </div>
                </div>
                <div class="col-md-3 rounded" id="contenedor-resultados-filtro">

                </div>

                <div class="col-md-3">
                  <div class="form-group mx-2">
                    <label for="example-text-input" class="form-label">Monto</label>
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
                    <label for="example-text-input" class="form-label">Metodo de Pago</label>
                    <select class="form-control" id="pago-tipo" name="metodo_pago">
                      <?php foreach ($this->payment_mehtod as $value): ?>
                        <option nameValue="<?= $value['payment_method'] ?>" value="<?= $value['id'] ?>"><?= $value['payment_method'] ?></option>
                      <?php endforeach ?>
                    </select>
                  </div>
                </div>

                <div class="col-md-3 d-reference d-none">
                  <div class="form-group mx-2">
                    <label for="example-text-input" class="form-label">Referencia</label>
                    <input class="form-control" type="text" name="referencia">
                  </div>
                </div>

                <div class="col-md-3">
                  <div class="form-group mx-2">
                    <label for="example-text-input" class="form-label">Fecha de Pago</label>
                    <input class="form-control" type="date" name="fecha" required>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group mx-2">
                    <label for="example-text-input" class="form-label">Nota</label>
                    <input class="form-control" type="text" name="nota">
                  </div>
                </div>
              </div>

              <!-- desktop -->
              <div class="d-flex justify-content-center align-items-center">
                <button class="btn btn-danger mx-2" name="action" type="submit">Registrar</button>
              </div>

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