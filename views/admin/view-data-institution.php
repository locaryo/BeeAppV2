<?php require constant("__layout__")."header.php"; ?>

<body class="g-sidenav-show   bg-gray-100">
  <div class="min-height-300 bg-primary position-absolute w-100"></div>

  <?php require constant("__layout__")."nav.php"; ?>
  <?php require constant("__layout__")."aside.php"; ?>
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

        <form class="d-none d-md-flex d-lg-flex d-xl-flex" action="<?= constant('__baseurl__') ?>home/edit_institution" method="post">
          <div class="col-12">

            <div class="card mb-4">

              <div class="card-header pb-0">
                <h4>Institución</h4>
              </div>

              <!-- desktop -->
              <div class="d-flex justify-content-left align-items-center mx-1">
                <div class="col-md-3">
                  <div class="form-group mx-2">
                    <label for="example-text-input" class="form-control-label">Nombre</label>
                    <input value="<?= $this->institution['nombre_institucion'] ?>" class="form-control" type="text" id="example-text-input" name="nombre" required>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group mx-2">
                    <label for="example-text-input" class="form-control-label">Director(a)</label>
                    <input value="<?= $this->institution['director'] ?>" class="form-control" type="text" id="example-text-input" name="director" required>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group mx-2">
                    <label for="example-text-input" class="form-control-label">Total Alumnos</label>
                    <input value="<?= $this->institution['alumnos_matricula'] ?>" class="form-control" type="text" id="example-text-input" disabled>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group mx-2">
                    <label for="example-text-input" class="form-control-label">Total Docentes</label>
                    <input value="<?= $this->institution['docentes_matricula'] ?>" class="form-control" type="text" id="example-text-input" disabled>
                  </div>
                </div>
              </div>

              <!-- desktop -->
              <div class="d-flex justify-content-left align-items-center mx-1">
                <div class="col-md-3">
                  <div class="form-group mx-2">
                    <label for="example-text-input" class="form-control-label">Ubicación</label>
                    <input value="<?= $this->institution['direccion'] ?>" class="form-control" type="text" id="example-text-input" name="ubicacion" required>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group mx-2">
                    <label for="example-text-input" class="form-control-label">Telefono</label>
                    <input value="<?= $this->institution['telefono'] ?>" class="form-control" type="number" id="example-text-input" placeholder="04121234567" name="telefono" required>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group mx-2">
                    <label for="example-text-input" class="form-control-label">Correo</label>
                    <input value="<?= $this->institution['correo'] ?>" class="form-control" type="email" id="example-text-input" placeholder="name@example.com" name="correo">
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group mx-2">
                    <label for="example-text-input" class="form-control-label">Codigo / RIF</label>
                    <input value="<?= $this->institution['codigo'] ?>" class="form-control" type="text" id="example-text-input" name="codigo" required>
                  </div>
                </div>
              </div>

              <!-- desktop -->
              <input type="text" name="id" value="<?= $this->institution['id'] ?>" hidden>
              <input type="text" name="opcion" value="institucion" hidden>
              <div class="d-flex justify-content-center align-items-center">
                <button class="btn btn-primary mx-2" name="action" value="update" type="submit">Actualizar</button>
                <!-- <button class="btn btn-danger mx-2" name="action" value="delete" type="submit">Eliminar</button> -->
              </div>

            </div>

          </div>

        </form>

        <form class="d-block d-sm-none" action="<?= constant('__baseurl__') ?>home/edit_institution" method="post">
          <div class="col-12">

            <div class="card mb-4">

              <div class="card-header pb-0">
                <h4>Institución</h4>
              </div>

              <!-- mobile -->
              <div class="d-block flex-column justify-content-center align-items-center mx-1">
                <div class="col-md-3">
                  <div class="form-group mx-2">
                    <label for="example-text-input" class="form-control-label">Nombre</label>
                    <input value="<?= $this->institution['nombre_institucion'] ?>" class="form-control" type="text" id="example-text-input" name="nombre" required>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group mx-2">
                    <label for="example-text-input" class="form-control-label">Director(a)</label>
                    <input value="<?= $this->institution['director'] ?>" class="form-control" type="text" id="example-text-input" name="director" required>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group mx-2">
                    <label for="example-text-input" class="form-control-label">Total Alumnos</label>
                    <input value="<?= $this->institution['alumnos_matricula'] ?>" class="form-control" type="text" id="example-text-input" disabled>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group mx-2">
                    <label for="example-text-input" class="form-control-label">Total Docentes</label>
                    <input value="<?= $this->institution['docentes_matricula'] ?>" class="form-control" type="text" id="example-text-input" disabled>
                  </div>
                </div>
              </div>

              <!-- mobile -->
              <div class="d-block flex-column justify-content-center align-items-center mx-1">
                <div class="col-md-3">
                  <div class="form-group mx-2">
                    <label for="example-text-input" class="form-control-label">Ubicación</label>
                    <input value="<?= $this->institution['direccion'] ?>" class="form-control" type="text" id="example-text-input" name="ubicacion" required>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group mx-2">
                    <label for="example-text-input" class="form-control-label">Telefono</label>
                    <input value="<?= $this->institution['telefono'] ?>" class="form-control" type="number" id="example-text-input" placeholder="04121234567" name="telefono" required>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group mx-2">
                    <label for="example-text-input" class="form-control-label">Correo</label>
                    <input value="<?= $this->institution['correo'] ?>" class="form-control" type="email" id="example-text-input" placeholder="name@example.com" name="correo">
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group mx-2">
                    <label for="example-text-input" class="form-control-label">Codigo / RIF</label>
                    <input value="<?= $this->institution['codigo'] ?>" class="form-control" type="text" id="example-text-input" name="codigo" required>
                  </div>
                </div>
              </div>

              <!-- mobile -->
              <input type="text" name="id" value="<?= $this->institution['id'] ?>" hidden>
              <input type="text" name="opcion" value="institucion" hidden>
              <div class="d-flex justify-content-center align-items-center">
                <button class="btn btn-primary mx-2" name="action" value="update" type="submit">Actualizar</button>
                <!-- <button class="btn btn-danger mx-2" name="action" value="delete" type="submit">Eliminar</button> -->
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