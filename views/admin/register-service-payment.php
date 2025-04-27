<?php require constant("__layout__") . "header.php"; ?>

<body class="g-sidenav-show   bg-gray-100">
  <div class="min-height-300 bg-primary position-absolute w-100"></div>

  <?php require constant("__layout__") . "nav.php"; ?>
  <?php require constant("__layout__") . "aside.php"; ?>
  <main class="main-content position-relative border-radius-lg ">

    <div class="container-fluid pt-5">
      <?php if (isset($_GET['existe'])): ?>
        <div class="d-flex justify-content-center position-absolute" style="left: 0;right: 0;top: 20px;">
          <div class="alert alert-info text-center text-white" role="alert">
            <strong>Este representante ya esta registrado en el sistema</strong>
          </div>
        </div>
      <?php elseif (isset($_GET['registrado'])): ?>
        <div class="d-flex justify-content-center position-absolute" style="left: 0;right: 0;top: 20px;">
          <div class="alert alert-primary text-center text-white" role="alert">
            <strong>Respresentante registrado exitosamente</strong>
          </div>
        </div>
      <?php elseif (isset($_GET['error'])): ?>
        <div class="d-flex justify-content-center position-absolute" style="left: 0;right: 0;top: 20px;">
          <div class="alert alert-danger text-center text-white" role="alert">
            <strong>Ocurrio un error al registrar los datos</strong>
          </div>
        </div>
      <?php elseif (isset($_GET['datos'])): ?>
        <div class="d-flex justify-content-center position-absolute" style="left: 0;right: 0;top: 20px;">
          <div class="alert alert-danger text-center text-white" role="alert">
            <strong>Inserte los datos requeridos</strong>
          </div>
        </div>
      <?php endif ?>
      <div class="row">

        <form class="d-none d-md-flex d-lg-flex d-xl-flex" action="<?= constant('__baseurl__') ?>home/register_service_payment" method="post">
          <div class="col-12">

            <div class="card mb-4">

              <div class="card-header pb-0">
                <h6>Nueva Factura: Servicio</h6>
              </div>

              <!-- desktop -->
              <div class="d-flex justify-content-center align-items-center flex-column mx-1">
                <div class="col-md-3">
                  <div class="form-group mx-2">
                    <label for="example-text-input" class="form-control-label">Tipo de Servicio</label>
                    <select class="form-control" id="example-text-input" name="servicio">
                      <?php foreach ($this->income_source as $value): ?>
                        <option value="<?= $value['id'] ?>" title="<?= $value['description'] ?>"><?= $value['expenses'] ?></option>
                      <?php endforeach ?>
                    </select>
                  </div>
                </div>

                <div class="col-md-3">
                  <div class="form-group mx-2">
                    <label for="example-text-input" class="form-control-label">Monto</label>
                    <input class="form-control" type="text" id="example-text-input" name="monto" required>
                  </div>
                </div>

                <div class="col-md-3">
                  <div class="form-group mx-2">
                    <label for="example-text-input" class="form-control-label">Metodo de Pago</label>
                    <select class="form-control" id="example-text-input" name="metodo_pago">
                      <?php foreach ($this->payment_mehtod as $value): ?>
                        <option value="<?= $value['id'] ?>"><?= $value['payment_method'] ?></option>
                      <?php endforeach ?>
                    </select>
                  </div>
                </div>

                <div class="col-md-3">
                  <div class="form-group mx-2">
                    <label for="example-text-input" class="form-control-label">Referencia</label>
                    <input class="form-control" type="text" id="example-text-input" name="referencia" required>
                  </div>
                </div>

                <div class="col-md-3">
                  <div class="form-group mx-2">
                    <label for="example-text-input" class="form-control-label">Fecha de Pago</label>
                    <input class="form-control" type="date" id="example-text-input" name="fecha" required>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group mx-2">
                    <label for="example-text-input" class="form-control-label">Nota</label>
                    <input class="form-control" type="text" id="example-text-input" name="nota">
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

        <!-- form mobile -->
        <form class="d-block d-md-none" action="<?= constant('__baseurl__') ?>home/register_service_payment" method="post">
          <div class="col-12">

            <div class="card mb-4">

              <div class="card-header pb-0">
                <h6>Nueva Factura</h6>
              </div>

              <!-- mobile -->
              <div class="d-block flex-column justify-content-center align-items-center mx-1">
                <div class="col-md-3">
                  <div class="form-group mx-2">
                    <label for="example-text-input" class="form-control-label">Producto</label>
                    <select class="form-control" id="example-text-input" name="servicio">

                      <option class="text-success" value='null'>Seleccione la Ganancia</option>
                      <option value='uniformes'>Pago de Uniforme</option>
                      <option class="text-danger" value='null'>Seleccione el Egresos(Servicios)</option>
                      <option value='electricidad'>Pago de Electricidad</option>
                      <option value='agua'>Pago de Agua</option>
                      <option value='alquiler'>Pago de Alquiler</option>
                      <option value='docentes'> Pago a Docente</option>
                      <option value='internet'>Pago de Internet</option>

                    </select>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group mx-2">
                    <label for="example-text-input" class="form-control-label">Monto</label>
                    <input class="form-control" type="number" id="example-text-input" name="monto" required>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group mx-2">
                    <label for="example-text-input" class="form-control-label">Fecha de Ingreso</label>
                    <input class="form-control" type="date" id="example-text-input" name="fecha" required>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group mx-2">
                    <label for="example-text-input" class="form-control-label">Nota</label>
                    <input class="form-control" type="text" id="example-text-input" name="nota">
                  </div>
                </div>
              </div>

              <!-- mobile -->
              <div class="d-flex justify-content-center align-items-center">
                <button class="btn btn-success mx-2" name="action" value="ingreso" type="submit">Ingresos</button>
                <button class="btn btn-danger mx-2" name="action" value="egreso" type="submit">Pagos</button>
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