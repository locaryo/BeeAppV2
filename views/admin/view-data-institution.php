<?php require constant("__layout__") . "header.php"; ?>

<body class="g-sidenav-show   bg-gray-100">
  <div class="min-height-300 bg-primary position-absolute w-100"></div>

  <?php require constant("__layout__") . "nav.php"; ?>
  <?php require constant("__layout__") . "aside.php"; ?>
  <main class="main-content position-relative border-radius-lg ">

    <div class="container-fluid pt-5">
      <?php if (isset($_SESSION['message'])): ?>
        <div class="d-flex justify-content-center" style="position: relative;z-index: 1;width: 100%;">
          <div class="alert alert-primary text-center text-white" role="alert">
            <strong><?php echo $_SESSION['message']; ?></strong>
          </div>
        </div>
        <?php unset($_SESSION['message']); ?>
      <?php else: ?>

      <?php endif; ?>

      <div class="row">

        <form class="needs-validation" novalidate action="<?= constant('__baseurl__') ?>home/edit_institution" method="post">

          <div class="card mb-4">

            <div class="card-header pb-0">
              <h4>Institución</h4>
            </div>

            <!-- desktop -->
            <div class="row mx-1">
              <div class="form-group col-12 col-sm-6 col-md-4 px-2">
                <label for="example-text-input" class="form-label required">Nombre</label>
                <input value="<?= $this->institution['nombre_institucion'] ?>" class="form-control" type="text" id="example-text-input" name="nombre" required>
              </div>
              <div class="form-group col-12 col-sm-6 col-md-4 px-2">
                <label for="example-text-input" class="form-label required">Director(a)</label>
                <input value="<?= $this->institution['director'] ?>" class="form-control" type="text" id="example-text-input" name="director" required>
              </div>
              <div class="form-group col-12 col-sm-6 col-md-2 px-2">
                <label for="example-text-input" class="form-control-label">Total Alumnos</label>
                <input value="<?= $this->institution['alumnos_matricula'] ?>" class="form-control" type="text" id="example-text-input" disabled>
              </div>
              <div class="form-group col-12 col-sm-6 col-md-2 px-2">
                <label for="example-text-input" class="form-label">Total Docentes</label>
                <input value="<?= $this->institution['docentes_matricula'] ?>" class="form-control" type="text" id="example-text-input" disabled>
              </div>
              <div class="form-group col-12 col-sm-6 col-md-3 px-2">
                <label for="example-text-input" class="form-control-label">Ubicación</label>
                <input value="<?= $this->institution['direccion'] ?>" class="form-control" type="text" id="example-text-input" name="ubicacion" required>
              </div>
              <div class="form-group col-12 col-sm-6 col-md-3 px-2">
                <label for="example-text-input" class="form-control-label">Telefono</label>
                <input value="<?= $this->institution['telefono'] ?>" class="form-control" type="number" id="example-text-input" placeholder="04121234567" name="telefono" required>
              </div>
              <div class="form-group col-12 col-sm-6 col-md-3 px-2">
                <label for="example-text-input" class="form-control-label">Correo</label>
                <input value="<?= $this->institution['correo'] ?>" class="form-control" type="email" id="example-text-input" placeholder="name@example.com" name="correo">
              </div>
              <div class="form-group col-12 col-sm-6 col-md-3 px-2">
                <label for="example-text-input" class="form-control-label">Codigo / RIF</label>
                <input value="<?= $this->institution['codigo'] ?>" class="form-control" type="text" id="example-text-input" name="codigo" required>
              </div>
              <input type="text" name="id" value="<?= $this->institution['id'] ?>" hidden>
              <input type="text" name="opcion" value="institucion" hidden>
            </div>
            <div class="col-auto">
              <p class="card-text px-3 mb-3"><span class="text-danger">(*)</span> Indica que el campo es obligatorio.</p>
            </div>

            <!-- desktop -->
            <div class="d-flex justify-content-center align-items-center desktop-to-mobile">

            </div>
            <div class="row mx-1 justify-content-center mt-2">
              <div class="col-12 col-sm-4 d-grid px-2">
                <button class="btn btn-primary" name="action" value="update" type="submit">Actualizar</button>
              </div>
              <!-- <div class="col-12 col-sm-4 d-grid px-2">
                <button class="btn btn-danger mx-2" name="action" value="delete" type="submit">Eliminar</button>
              </div> -->
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