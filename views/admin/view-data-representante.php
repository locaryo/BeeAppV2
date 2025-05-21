<?php require constant("__layout__") . "header.php"; ?>

<body class="g-sidenav-show   bg-gray-100">
  <div class="min-height-300 bg-primary position-absolute w-100"></div>

  <?php require constant("__layout__") . "nav.php"; ?>
  <?php require constant("__layout__") . "aside.php"; ?>
  <main class="main-content position-relative border-radius-lg ">

    <div class="container-fluid pt-5">
      <?php if (isset($_GET['existe'])): ?>
        <div class="d-flex justify-content-center">
          <div class="alert alert-info text-center text-white" role="alert">
            <strong>Este representatne ya esta registrado en el sistema</strong>
          </div>
        </div>
      <?php elseif (isset($_GET['registrado'])): ?>
        <div class="d-flex justify-content-center">
          <div class="alert alert-primary text-center text-white" role="alert">
            <strong>Represnetante registrado exitosamente</strong>
          </div>
        </div>
      <?php elseif (isset($_GET['error'])): ?>
        <div class="d-flex justify-content-center">
          <div class="alert alert-danger text-center text-white" role="alert">
            <strong>Ocurrio un error al registrar los datos</strong>
          </div>
        </div>
      <?php elseif (isset($_GET['datos'])): ?>
        <div class="d-flex justify-content-center">
          <div class="alert alert-danger text-center text-white" role="alert">
            <strong>Inserte los datos requeridos</strong>
          </div>
        </div>
      <?php endif ?>
      <div class="row">

        <form class="needs-validation" novalidate action="<?= constant('__baseurl__') ?>home/edit_representante" method="post">

          <div class="card mb-4">

            <div class="card-header pb-0 bg-primary opacity-8 mb-2">
              <h6 class="text-white">Representante</h6>
            </div>

            <!-- desktop -->
            <div class="row mx-1">
              <div class="form-group col-12 col-sm-6 col-md-3 px-2">
                <label for="example-text-input" class="form-label required">Primer Nombre</label>
                <input value="<?= $this->data['p_nombre_r'] ?>" class="form-control" type="text" id="example-text-input" name="p_nombre" required>
              </div>
              <div class="form-group col-12 col-sm-6 col-md-3 px-2">
                <label for="example-text-input" class="form-label">Segundo Nombre</label>
                <input value="<?= $this->data['s_nombre_r'] ?>" class="form-control" type="text" id="example-text-input" name="s_nombre">
              </div>
              <div class="form-group col-12 col-sm-6 col-md-3 px-2">
                <label for="example-text-input" class="form-label required">Primer Apellido</label>
                <input value="<?= $this->data['p_apellido_r'] ?>" class="form-control" type="text" id="example-text-input" name="p_apellido" required>
              </div>
              <div class="form-group col-12 col-sm-6 col-md-3 px-2">
                <label for="example-text-input" class="form-label">Segundo Apellido</label>
                <input value="<?= $this->data['s_apellido_r'] ?>" class="form-control" type="text" id="example-text-input" name="s_apellido">
              </div>
              <div class="form-group col-12 col-sm-6 col-md-3 px-2">
                <label for="example-text-input" class="form-label required">Cedula</label>
                <input value="<?= $this->data['cedula_r'] ?>" class="form-control" type="number" id="example-text-input" name="cedula" required>
              </div>
              <div class="form-group col-12 col-sm-6 col-md-3 px-2">
                <label for="example-text-input" class="form-label required">Telefono</label>
                <input value="<?= $this->data['telefono'] ?>" class="form-control" type="number" id="example-text-input" placeholder="04121234567" name="telefono" required>
              </div>
              <div class="form-group col-12 col-sm-6 col-md-3 px-2">
                <label for="example-text-input" class="form-label">Correo</label>
                <input value="<?= $this->data['correo'] ?>" class="form-control" type="email" id="example-text-input" placeholder="name@example.com" name="correo">
              </div>
              <div class="form-group col-12 col-sm-6 col-md-3 px-2">
                <label for="example-text-input" class="form-label required">Fecha Nacimineto</label>
                <input value="<?= $this->data['fecha_r'] ?>" class="form-control" type="date" id="example-text-input" name="fecha" required>
              </div>
              <div class="form-group col-12 col-sm-6 col-md-3 px-2">
                <label for="example-text-input" class="form-label required">Direccion</label>
                <input value="<?= $this->data['direccion'] ?>" class="form-control" type="text" id="example-text-input" placeholder="comunidad, calle, casa, referencia" name="direccion" required>
              </div>
            </div>
            <div class="col-auto">
              <p class="card-text px-3 mb-3"><span class="text-danger">(*)</span> Indica que el campo es obligatorio.</p>
            </div>
            <div class="row mx-1 justify-content-center mt-2">
              <div class="col-12 col-sm-4 d-grid px-2">
                <button class="btn btn-primary" name="action" value="update" type="submit">Actualizar</button>
              </div>
              <div class="col-12 col-sm-4 d-grid px-2">
                <button class="btn btn-danger" name="action" value="delete" type="submit">Eliminar</button>
              </div>
              <div class="col-12 col-sm-4 d-grid px-2">
                <button class="btn btn-secondary go-back" type="button">Regresar</button>
              </div>
            </div>
          </div>
          <!-- desktop -->
          <input type="text" name="id" value="<?= $this->data['id'] ?>" hidden>
          <input type="text" name="opcion" value="representante" hidden>
          <div class="d-flex justify-content-center align-items-center desktop-to-mobile">


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