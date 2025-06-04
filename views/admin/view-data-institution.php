<?php require constant("__layout__") . "header.php"; ?>

<body class="g-sidenav-show   bg-gray-100">
  <div class="min-height-300 bg-primary position-absolute w-100"></div>

  <?php require constant("__layout__") . "nav.php"; ?>
  <?php require constant("__layout__") . "aside.php"; ?>
  <main class="main-content position-relative border-radius-lg ">

    <div class="container-fluid">
      <?php if (isset($_SESSION['message'])): ?>
        <div class="d-flex justify-content-center" style="position: relative;z-index: 1;width: 100%;">
          <div class="alert alert-primary text-center text-white" role="alert">
            <strong><?php echo $_SESSION['message']; ?></strong>
          </div>
        </div>
        <?php unset($_SESSION['message']); ?>

      <?php endif; ?>

      <div class="row">

        <form class="needs-validation" novalidate action="<?= constant('__baseurl__') ?>home/edit_institution" method="post" enctype="multipart/form-data">

          <div class="card mb-4">

            <div class="card-header pb-0 bg-primary opacity-8 mb-2">
              <div class="form-group col-12 col-sm-6 col-md-4 px-2">
                <div class="avatar-upload">
                  <div class="avatar-edit">
                    <input value="<?= $this->institution['logo'] ?>" type='file' id="imageUpload" accept=".png, .jpg, .jpeg .svg" name="logo"/>
                    <label for="imageUpload"></label>
                  </div>
                  <div class="avatar-preview">
                    <div id="imagePreview" style="background-image: url(<?= constant('__baseurl__').$this->institution['logo'] ?>);">
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- desktop -->
            <div class="row mx-1">
              <div class="form-group col-12 col-sm-6 col-md-4 px-2">
                <label class="form-label required">Nombre</label>
                <input value="<?= $this->institution['nombre_institucion'] ?>" class="form-control" type="text" name="nombre" required>
              </div>
              <div class="form-group col-12 col-sm-6 col-md-4 px-2">
                <label class="form-label required">Director(a)</label>
                <input value="<?= $this->institution['director'] ?>" class="form-control" type="text" name="director" required>
              </div>
              <div class="form-group col-12 col-sm-6 col-md-2 px-2">
                <label class="form-control-label">Monto Matricula</label>
                <input id="matricula_amount" value="<?= $this->institution['matricula_amount'] ?>" class="form-control" type="text" name="monto_matricula" required>
                <span class="matricula-dolar text-danger"></span>
              </div>
              <div class="form-group col-12 col-sm-6 col-md-2 px-2">
                <label class="form-label">Monto Mensualidad</label>
                <input id="mensualidad_amount" value="<?= $this->institution['mensualidad_amount'] ?>" class="form-control" type="text" name="monto_mensualidad" required>
                <span class="mensualidad-dolar text-danger"></span>
              </div>
              <div class="form-group col-12 col-sm-6 col-md-3 px-2">
                <label class="form-control-label">Ubicación</label>
                <input value="<?= $this->institution['direccion'] ?>" class="form-control" type="text" name="ubicacion" required>
              </div>
              <div class="form-group col-12 col-sm-6 col-md-3 px-2">
                <label class="form-control-label">Telefono</label>
                <input value="<?= $this->institution['telefono'] ?>" class="form-control" type="number" placeholder="04121234567" name="telefono" required>
              </div>
              <div class="form-group col-12 col-sm-6 col-md-3 px-2">
                <label class="form-control-label">Correo</label>
                <input value="<?= $this->institution['correo'] ?>" class="form-control" type="email" placeholder="name@example.com" name="correo">
              </div>
              <div class="form-group col-12 col-sm-6 col-md-3 px-2">
                <label class="form-control-label">Codigo / RIF</label>
                <input value="<?= $this->institution['codigo'] ?>" class="form-control" type="text" name="codigo" required>
              </div>
              <div class="form-group col-12 col-sm-6 col-md-3 px-2" style="width: 100%; overflow: auto;">
                <label class="form-control-label">Menciones</label>
                <div id="menciones-container">
                  <div id="lista-menciones" class="d-flex flex-wrap gap-2 mb-2">
                    <?php foreach ($this->mentions as $mencion): ?>
                      <span class="badge bg-primary text-white rounded-pill d-inline-flex align-items-center pe-2">
                        <?= $mencion['mentions'] ?>
                        <input type="hidden" name="menciones" id="menciones-oculto" value="<?= $mencion['id'] ?>">
                      </span>
                    <?php endforeach; ?>
                  </div>
                  <div class="input-group">
                    <input type="text" id="nueva-mencion" class="form-control" style="text-transform:capitalize;" placeholder="Nueva mención">
                    <div class="input-group-append">
                      <button id="agregar-mencion" class="btn btn-success" style="margin: 0;" type="button">Agregar</button>
                    </div>
                  </div>
                </div>
              </div>

              <div class="form-group col-12 col-sm-6 col-md-3 px-2" style="width: 100%; overflow: auto;">
                <label class="form-control-label">Categorias de Pagos</label>
                <div id="expenses-container">
                  <div id="lista-expenses" class="d-flex flex-wrap gap-2 mb-2">
                    <?php foreach ($this->expenses as $expense): ?>
                      <span class="badge bg-danger text-white rounded-pill d-inline-flex align-items-center pe-2">
                        <?= $expense['expenses'] ?>
                        <input type="hidden" name="expenses" id="expenses-oculto" value="<?= $expense['id'] ?>">
                      </span>
                    <?php endforeach; ?>
                  </div>
                  <div class="input-group">
                    <input type="text" id="nueva-expense" class="form-control" style="text-transform:capitalize;" placeholder="Nueva categoría de pago">
                    <div class="input-group-append">
                      <button id="agregar-expense" class="btn btn-success" style="margin: 0;" type="button">Agregar</button>
                    </div>
                  </div>
                </div>
              </div>

              <div class="form-group col-12 col-sm-6 col-md-3 px-2" style="width: 100%; overflow: auto;">
                <label class="form-control-label">Categorias de Ingresos</label>
                <div id="income-container">
                  <div id="lista-income" class="d-flex flex-wrap gap-2 mb-2">
                    <?php foreach ($this->income_source as $income): ?>
                      <span class="badge bg-success text-white rounded-pill d-inline-flex align-items-center pe-2">
                        <?= $income['income_name'] ?>
                        <input type="hidden" name="income" id="income-oculto" value="<?= $income['id'] ?>">
                      </span>
                    <?php endforeach; ?>
                  </div>
                  <div class="input-group">
                    <input type="text" id="nueva-income" class="form-control" style="text-transform:capitalize;" placeholder="Nueva categoría de ingreso">
                    <div class="input-group-append">
                      <button id="agregar-income" class="btn btn-success" style="margin: 0;" type="button">Agregar</button>
                    </div>
                  </div>
                </div>
              </div>

              <input type="text" name="id" value="<?= $this->institution['id'] ?>" hidden>
              <input type="text" name="opcion" value="institucion" hidden>

            </div>
            <div class="col-auto">
              <p class="card-text px-3 mb-3"><span class="text-danger">(*)</span> Indica que el campo es obligatorio.</p>
            </div>

            <div class="row mx-1 justify-content-center mt-2">
              <div class="col-12 col-sm-4 d-grid px-2">
                <button class="btn btn-primary" type="submit">Actualizar</button>
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