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
            <strong>Este alumno ya esta registrado en el sistema</strong>
          </div>
        </div>
      <?php elseif (isset($_GET['registrado'])): ?>
        <div class="d-flex justify-content-center position-absolute" style="left: 0;right: 0;top: 20px;">
          <div class="alert alert-primary text-center text-white" role="alert">
            <strong>Alumno registrado exitosamente</strong>
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
      <?php elseif (isset($_GET['no_representante'])): ?>
        <div class="d-flex justify-content-center position-absolute" style="left: 0;right: 0;top: 20px;">
          <div class="alert alert-danger text-center text-white" role="alert">
            <strong>El representante que intenta enlazar al estudiante no esta registrado en el sistema</strong>
          </div>
        </div>
      <?php endif ?>
      <div class="row">
        <form class="needs-validation" action="<?= constant('__baseurl__') ?>home/insert_student" method="post" novalidate>
          <div class="card mb-4">
            <div class="card-header pb-0">
              <h6>Nuevo Estudiante</h6>
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
                <label for="example-text-input" class="form-label">Telefono</label>
                <input class="form-control" type="number" placeholder="04121234567" id="example-text-input" name="telefono">
              </div>
              <div class="form-group col-12 col-sm-6 col-md-3 px-2">
                <label for="example-text-input" class="form-label required">Sexo</label>
                <select class="form-control" id="example-text-input" name="sexo" required>
                  <option value="" disabled selected>Seleccionar sexo</option>
                  <option>Masculino</option>
                  <option>Femenino</option>
                </select>
              </div>
              <div class="form-group col-12 col-sm-6 col-md-3 px-2">
                <label for="example-text-input" class="form-label">Correo</label>
                <input class="form-control" name="correo" type="email" id="example-text-input" placeholder="name@example.com">
              </div>
              <div class="form-group col-12 col-sm-6 col-md-3 px-2">
                <label for="example-text-input" class="form-label required">Fecha de Nacimiento</label>
                <input id="fecha" class="form-control" type="date" name="fecha" required>
              </div>
              <div class="form-group col-12 col-sm-6 col-md-3 px-2">
                <label for="example-text-input" class="form-label required">Edad</label>
                <input id="edad" class="form-control" type="number" name="edad" required>
              </div>
              <div class="form-group col-12 col-sm-6 col-md-3 px-2">
                <label for="example-text-input" class="form-label required">C.I. del Representante</label>
                <input class="form-control" type="number" id="example-text-input" name="ci_representante" required>
              </div>
              <div class="form-group col-12 col-sm-6 col-md-3 px-2">
                <label for="example-text-input" class="form-label required">Direccion</label>
                <input class="form-control" type="text" placeholder="comunidad, calle, casa" id="example-text-input" name="direccion" required>
              </div>
              <div class="form-group col-12 col-sm-6 col-md-3 px-2">
                <label for="example-text-input" class="form-label">Documentos Entregados</label>
                <input class="form-control" type="text" placeholder="partida de nacimiento, etc" id="example-text-input" name="documentos" required>
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
        </form>
      </div>
      <?php require constant("__layout__") . "footer.php"; ?>
    </div>
  </main>
  <?php require constant("__layout__") . "scripts.php"; ?>
</body>

</html>