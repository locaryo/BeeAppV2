<?php require constant("__layout__")."header.php"; ?>

<body class="g-sidenav-show   bg-gray-100">
  <div class="min-height-300 bg-primary position-absolute w-100"></div>

  <?php require constant("__layout__")."nav.php"; ?>
  <?php require constant("__layout__")."aside.php"; ?>
  <main class="main-content position-relative border-radius-lg ">
    <?php if (isset($_SESSION['message'])): ?>
      <div class="d-flex justify-content-center">
        <div class="alert alert-primary text-center text-white" role="alert">
          <strong><?php echo $_SESSION['message']; ?></strong>
        </div>
      </div>
      <?php unset($_SESSION['message']); ?>
    <?php else: ?>

    <?php endif; ?>
    <?php if (isset($_GET['datos'])): ?>
      <div class="d-flex justify-content-center">
        <div class="alert alert-danger text-center text-white" role="alert">
          <strong>Faltan Datos</strong>
        </div>
      </div>
    <?php elseif (isset($_GET['errorCedula'])): ?>
      <div class="d-flex justify-content-center">
        <div class="alert alert-danger text-center text-white" role="alert">
          <strong>Esta persona no se encuentra en la opcion seleccionada o no esta registrada en el sistema</strong>
        </div>
      </div>
    <?php elseif (isset($_GET['errorCedulaRepresentante'])): ?>
      <div class="d-flex justify-content-center">
        <div class="alert alert-danger text-center text-white" role="alert">
          <strong>El representante que intenta enlazar no esta esta registrado en el sistema</strong>
        </div>
      </div>
    <?php endif ?>
    <div class="container-fluid py-7" style="overflow-x: hidden;">
      <div class="row">

        <form class="d-none d-md-flex d-lg-flex d-xl-flex mb-8" action="<?= constant('__baseurl__') ?>home/consulting_cedula" method="post">

          <div class="col-12">
            <div class="card mb-4">
              <div class="card-header pb-0 text-center">
                <h5>Consultar Datos</h5>
              </div>

              <!-- desktop -->
              <div class="d-flex justify-content-center">
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Cedula</label>
                    <input class="form-control text-center" name="cedula" type="text" id="example-text-input">
                  </div>
                </div>
              </div>

              <!-- desktop -->
              <div class="d-flex justify-content-center">
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Opción</label>
                    <select class="form-control" id="example-text-input" name="opcion">
                      <option>Seleccionar</option>
                      <option>alumnos</option>
                      <option>docentes</option>
                      <option>representante</option>
                    </select>
                  </div>
                </div>
              </div>

              <div class="d-flex justify-content-center">
                <button class="btn btn-primary" type="send">Consultar</button>
              </div>
            </div>
          </div>
        </form>

        <form class="d-block d-md-none flex-column mb-8" action="<?= constant('__baseurl__') ?>home/consulting_cedula" method="post">
          <div class="col-12">
            <div class="card mb-4">
              <div class="card-header pb-0 text-center">
                <h5>Consultar Datos</h5>
              </div>

              <!-- mobile -->
              <div class="d-block flex-column justify-content-center mx-5">
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Cedula</label>
                    <input class="form-control text-center" name="cedula" type="text" id="example-text-input">
                  </div>
                </div>
              </div>

              <!-- mobile -->
              <div class="d-block flex-column justify-content-center mx-5">
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Opción</label>
                    <select class="form-control" id="example-text-input" name="opcion">
                      <option>Seleccionar</option>
                      <option>alumnos</option>
                      <option>docentes</option>
                      <option>representante</option>
                    </select>
                  </div>
                </div>
              </div>

              <div class="d-flex justify-content-center">
                <button class="btn btn-primary" type="send">Consultar</button>
              </div>
            </div>
          </div>
        </form>

      </div>

      <?php require constant("__layout__")."footer.php"; ?>

    </div>
  </main>

  <?php require constant("__layout__")."scripts.php"; ?>

</body>

</html>