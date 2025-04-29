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
            <strong>Este docente ya esta registrado en el sistema</strong>
          </div>
        </div>
      <?php elseif (isset($_GET['registrado'])): ?>
        <div class="d-flex justify-content-center position-absolute" style="left: 0;right: 0;top: 20px;">
          <div class="alert alert-primary text-center text-white" role="alert">
            <strong>Docente registrado exitosamente</strong>
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

        <form action="<?= constant('__baseurl__') ?>home/insert_teacher" method="post">
          <div class="col-12">

            <div class="card mb-4">

              <div class="card-header pb-0">
                <h6>Nuevo Docente</h6>
              </div>

              <!-- desktop -->
              <div class="d-flex justify-content-center align-items-center mx-1 desktop-to-mobile">
                <div class="col-md-3">
                  <div class="form-group mx-2">
                    <label for="example-text-input" class="form-control-label">Primer Nombre</label>
                    <input class="form-control" type="text" id="example-text-input" name="p_nombre" required>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group mx-2">
                    <label for="example-text-input" class="form-control-label">Segundo Nombre(opcional)</label>
                    <input class="form-control" type="text" id="example-text-input" name="s_nombre">
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group mx-2">
                    <label for="example-text-input" class="form-control-label">Primer Apellido</label>
                    <input class="form-control" type="text" id="example-text-input" name="p_apellido" required>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group mx-2">
                    <label for="example-text-input" class="form-control-label">Segundo Apellido(opcional)</label>
                    <input class="form-control" type="text" id="example-text-input" name="s_apellido">
                  </div>
                </div>
              </div>

              <!-- desktop -->
              <div class="d-flex justify-content-center align-items-center mx-1 desktop-to-mobile">
                <div class="col-md-3">
                  <div class="form-group mx-2">
                    <label for="example-text-input" class="form-control-label">Cedula</label>
                    <input class="form-control" type="number" id="example-text-input" name="cedula" required>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group mx-2">
                    <label for="example-text-input" class="form-control-label">Telefono</label>
                    <input class="form-control" type="number" id="example-text-input" placeholder="04121234567" name="telefono" required>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group mx-2">
                    <label for="example-text-input" class="form-control-label">Correo</label>
                    <input class="form-control" type="email" id="example-text-input" placeholder="name@example.com" name="correo">
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group mx-2">
                    <label for="example-text-input" class="form-control-label">Areas de Formación</label>
                    <input class="form-control" type="text" id="example-text-input" placeholder="quimica,ciencias" name="areas_formacion" required>
                  </div>
                </div>
              </div>

              <!-- desktop -->
              <div class="d-flex justify-content-center align-items-center mx-1 desktop-to-mobile">
                <div class="col-md-3">
                  <div class="form-group mx-2">
                    <label for="example-text-input" class="form-control-label">Fecha Nacimiento</label>
                    <input class="form-control" type="date" id="example-text-input" name="fecha" required>
                  </div>
                </div>
                <div class="col-md-9">
                  <div class="form-group mx-2">
                    <label for="example-text-input" class="form-control-label">Direccion</label>
                    <input class="form-control" type="text" id="example-text-input" placeholder="comunidad, calle, casa" name="direccion" required>
                  </div>
                </div>

              </div>

              <div class="d-flex align-items-center mx-3 desktop-to-mobile">
                <h6>Niveles que atiende !</h6>
              </div>

              <!-- desktop -->
              <div class="d-flex justify-content-center align-items-center mx-1 my-3 desktop-to-mobile">
                <div class="col-md-2">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="primero">
                    <label class="custom-control-label">Primer Año</label>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="segundo">
                    <label class="custom-control-label">Segundo Año</label>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="tercero">
                    <label class="custom-control-label">Tercer Año</label>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="cuarto">
                    <label class="custom-control-label">Cuarto Año</label>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="quinto">
                    <label class="custom-control-label">Quinto Año</label>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="sexto">
                    <label class="custom-control-label">Sexto Año</label>
                  </div>
                </div>
              </div>

              <div class="d-flex justify-content-center align-items-center desktop-to-mobile">
                <button class="btn btn-primary" type="send">Registrar</button>
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