<?php require constant("__layout__")."header.php"; ?>

<body class="g-sidenav-show   bg-gray-100">
  <div class="min-height-300 bg-primary position-absolute w-100"></div>

  <?php require constant("__layout__")."nav.php"; ?>
  <?php require constant("__layout__")."aside.php"; ?>
  <main class="main-content position-relative border-radius-lg" style="overflow-x: hidden !important;">
    <?php if (isset($_SESSION['message'])): ?>
      <div class="d-flex justify-content-center" style="position: relative;z-index: 1;width: 100%;">
        <div class="alert alert-primary text-center text-white" role="alert">
          <strong><?php echo $_SESSION['message']; ?></strong>
        </div>
      </div>
      <?php unset($_SESSION['message']); ?>
    <?php else: ?>

    <?php endif; ?>

    <div class="container-fluid py-7">
      <div class="row">

        <form class="d-none d-md-flex d-lg-flex d-xl-flex mb-8" action="<?= constant('__baseurl__') ?>home/constancy" method="post">

          <div class="col-12">
            <div class="card mb-4">
              <div class="card-header pb-0 text-center">
                <h5>Ingrese la cedula del Estudiante</h5>
              </div>

              <!-- desktop -->
              <div class="d-flex justify-content-center flex-column align-items-center">
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Cedula</label>
                    <input class="form-control text-center" name="cedula" type="text" id="example-text-input">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Motivo</label>
                    <input class="form-control text-center" placeholder="llenar para Constancia de retiro" name="motivo" type="text" id="example-text-input">
                  </div>
                </div>
              </div>
              <input type="text" name="movil" value="desktop" hidden>

              <div class="d-flex justify-content-center">
                <button class="btn btn-primary mx-2" name="action" value="estudio" type="submit" target="_blank">Constancia de Estudio</button>
                <button class="btn btn-danger mx-2" name="action" value="retiro" type="submit">Constancia de Retiro</button>
              </div>
            </div>
          </div>
        </form>

        <form class="d-block d-sm-none flex-column mb-8" action="<?= constant('__baseurl__') ?>home/constancy" method="post">
          <div class="col-12">
            <div class="card mb-4">
              <div class="card-header pb-0 text-center">
                <h5>Ingrese la cedula del Estudiante</h5>
              </div>

              <!-- mobile -->
              <div class="d-block flex-column justify-content-center mx-5">
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Cedula</label>
                    <input class="form-control text-center" name="cedula" type="text" id="example-text-input">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Motivo</label>
                    <input class="form-control text-center" placeholder="llenar para Constancia de retiro" name="motivo" type="text" id="example-text-input">
                  </div>
                </div>
              </div>
              <input type="text" name="movil" value="movil" hidden>
              <div class="d-flex flex-column justify-content-center">
                <button class="btn btn-primary mx-2" name="action" value="estudio" type="submit">Constancia de Estudio</button>
                <button class="btn btn-danger mx-2" name="action" value="retiro" type="submit">Constancia de Retiro</button>
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