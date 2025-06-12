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

    <div class="container-fluid py-7" style="overflow-x: hidden;" data-vista="consultingUsers">
      <div class="row">
        <form class="needs-validation" action="<?= constant('__baseurl__') ?>home/consulting_cedula" method="post" novalidate>
          <div class="card mb-4">
            <div class="card-header pb-0 bg-primary opacity-8 mb-2 text-center">
              <h6 class="text-white">Consultar Datos</h6>
            </div>
            <!-- desktop -->
            <div class="row mx-1">
              <div class="form-group col-12 px-2">
                <label for="example-text-input" class="form-label required">Cedula</label>
                <input class="form-control text-center" name="cedula" type="text" id="example-text-input" required>
                <div class="invalid-feedback">
                  Ingrese un numero de cédula.
                </div>
              </div>
              <div class="form-group col-12 px-2">
                <label for="example-text-input" class="form-label required">Opción</label>
                <select class="form-control" id="example-text-input" name="opcion" required>
                  <option value="" selected disabled>Seleccionar</option>
                  <option value="alumnos">Alumnos</option>
                  <option value="docentes">Docentes</option>
                  <option value="representante">Representante</option>
                </select>
                <div class="invalid-feedback">
                  Seleccione una opción.
                </div>
              </div>
            </div>
            <div class="col-auto">
              <p class="card-text px-3 mb-3"><span class="text-danger">(*)</span> Indica que el campo es obligatorio.</p>
            </div>
            <!-- desktop -->
            <div class="d-flex justify-content-center">
              <button class="btn btn-primary" type="send">Consultar</button>
            </div>
          </div>
        </form>
      </div>
    </div>