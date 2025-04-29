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

        <!-- fomr escritorio -->
        <form action="<?= constant('__baseurl__') ?>home/register_receive_payment" method="post">
          <div class="col-12">

            <div class="card mb-4">

              <div class="card-header pb-0">
                <h6>Nueva Factura: Pago Recibido</h6>
              </div>

              <!-- desktop -->
              <div class="d-flex justify-content-center align-items-center flex-column mx-1 desktop-to-mobile">
                <div class="col-md-3">
                  <div class="form-group mx-2">
                    <label for="example-text-input" class="form-control-label">Tipo de Ingreso</label>
                    <select class="form-control" id="ingreso-tipo" name="servicio">
                      <option value="0">Seleccionar</option>
                      <?php foreach ($this->income_source as $value): ?>
                        <option nameValue="<?= $value['income_name'] ?>" value="<?= $value['id'] ?>" title="<?= $value['description'] ?>"><?= $value['income_name'] ?></option>
                      <?php endforeach ?>
                    </select>
                  </div>
                </div>

                <div class="col-md-3 d-filtro d-none">
                  <div class="form-group mx-2">
                    <label for="example-text-input" class="form-control-label">Filtrar Estudiante</label>
                    <input class="form-control" type="text" id="filtrar-estudiante" name="filtro-estudiante">
                    <input type="text" class="d-none" id="student-id" name="id-estudiante">
                  </div>
                </div>
                <div class="col-md-3 rounded" id="contenedor-resultados-estudiantes">
                  
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
                    <input class="form-control" type="text" id="amount-usd-bcv" required>
                  </div>
                </div>

                <div class="col-md-3">
                  <div class="form-group mx-2">
                    <label for="example-text-input" class="form-control-label">Metodo de Pago</label>
                    <select class="form-control" name="metodo_pago">
                      <?php foreach ($this->payment_mehtod as $value): ?>
                        <option value="<?= $value['id'] ?>"><?= $value['payment_method'] ?></option>
                      <?php endforeach ?>
                    </select>
                  </div>
                </div>

                <div class="col-md-3">
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

                <div class="col-md-3 d-fecha d-none">
                  <div class="form-group mx-2">
                    <label for="example-text-input" class="form-control-label">Mes a Pagar</label>
                    <input class="form-control" type="date" name="start_monthly_payment">
                    <input class="form-control d-none" id="end_monthly_payment" type="date" name="end_monthly_payment">
                  </div>
                </div>

                <div class="col-md-3">
                  <div class="form-group mx-2">
                    <label for="example-text-input" class="form-control-label">Nota</label>
                    <input class="form-control" type="text" name="nota">
                  </div>
                </div>
              </div>

              <!-- desktop -->
              <div class="d-flex justify-content-center align-items-center">
                <button class="btn btn-success mx-2" name="action" type="submit">Registrar</button>
              </div>

            </div>

          </div>

        </form>

        <!-- form mobile -->


      </div>

      <?php require constant("__layout__") . "footer.php"; ?>

    </div>
  </main>

  <?php require constant("__layout__") . "scripts.php"; ?>

</body>

</html>