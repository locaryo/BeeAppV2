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

        <form class="needs-validation" novalidate action="<?= constant('__baseurl__') ?>home/insert_responsable" method="post">

          <div class="card mb-4">

            <div class="card-header pb-0 bg-primary opacity-8 mb-2">
              <h6 class="text-white">Nuevo Representante</h6>
            </div>

            <!-- desktop -->
            <div class="row mx-1">
              <div class="form-group col-12 col-sm-6 col-md-3 px-2">
                <label for="example-text-input" class="form-label required">Primer Nombre</label>
                <input class="form-control" type="text" id="example-text-input" name="p_nombre" required>
              </div>
              <div class="form-group col-12 col-sm-6 col-md-3 px-2">
                <label for="example-text-input" class="form-label">Segundo Nombre</label>
                <input class="form-control" type="text" id="example-text-input" name="s_nombre">
              </div>
              <div class="form-group col-12 col-sm-6 col-md-3 px-2">
                <label for="example-text-input" class="form-label required">Primer Apellido</label>
                <input class="form-control" type="text" id="example-text-input" name="p_apellido" required>
              </div>
              <div class="form-group col-12 col-sm-6 col-md-3 px-2">
                <label for="example-text-input" class="form-label">Segundo Apellido</label>
                <input class="form-control" type="text" id="example-text-input" name="s_apellido">
              </div>
              <div class="form-group col-12 col-sm-6 col-md-3 px-2">
                <label for="example-text-input" class="form-label required">Cedula</label>
                <input class="form-control" type="number" id="example-text-input" name="cedula" required>
              </div>
              <div class="form-group col-12 col-sm-6 col-md-3 px-2">
                <label for="example-text-input" class="form-label required">Telefono</label>
                <input class="form-control" type="number" id="example-text-input" placeholder="04121234567" name="telefono" required>
              </div>
              <div class="form-group col-12 col-sm-6 col-md-3 px-2">
                <label for="example-text-input" class="form-label">Correo</label>
                <input class="form-control" type="email" id="example-text-input" placeholder="name@example.com" name="correo">
              </div>
              <div class="form-group col-12 col-sm-6 col-md-3 px-2">
                <label for="example-text-input" class="form-label required">Fecha Nacimiento</label>
                <input class="form-control" type="date" id="example-text-input" name="fecha" required>
              </div>
              <div class="form-group col-12 col-sm-6 col-md-3 px-2">
                <label for="example-text-input" class="form-label required">Direccion</label>
                <input class="form-control" type="text" id="example-text-input" placeholder="comunidad, calle, casa, referencia" name="direccion" required>
              </div>
            </div>
            <div class="row mx-1 justify-content-center">
              <div class="col-12 col-sm-4 d-grid px-2">
                <button class="btn btn-primary" type="send">Registrar</button>
              </div>
              <div class="col-12 col-sm-4 d-grid px-2">
                <button class="btn btn-secondary go-back" type="button">Regresar</button>
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