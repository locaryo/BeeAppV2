<?php require constant("__layout__") . "header.php"; ?>

<body class="g-sidenav-show   bg-gray-100">
  <div class="min-height-300 bg-primary position-absolute w-100"></div>

  <?php require constant("__layout__") . "nav.php"; ?>

  <?php require constant("__layout__") . "aside.php"; ?>
  <main class="main-content position-relative border-radius-lg ">

    <div class="container-fluid py-4">
      <div class="row mx-5 my-3">
        <div class="col-md-4">
          <div class="form-group">
            <label for="example-text-input" class="form-control-label">Año</label>
            <select class="form-control" id="nivel">
              <option>Seleccionar</option>
              <option>1°ero</option>
              <option>2°do</option>
              <option>3°ero</option>
              <option>4°to</option>
              <option>5°to</option>
            </select>
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
            <label for="example-text-input" class="form-control-label">Sección</label>
            <select class="form-control" id="seccion">
              <option>Seleccionar</option>
              <option>A</option>
              <option>B</option>
              <option>C</option>
              <option>D</option>
              <option>E</option>
            </select>
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
            <label for="example-text-input" class="form-control-label">Mención</label>
            <select class="form-control" id="mencion">
              <option>Seleccionar</option>
              <option>Petroquimica</option>
              <option>Mecanica</option>
              <option>Electricidad</option>
            </select>
          </div>
        </div>

      </div>

      
      <div class="row pb-8">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <h6>Tabla de Alumnos</h6>
            </div>
            <div class="card-body px-0 pt-0 pb-2">

              <div class="d-none d-md-flex d-lg-flex d-xl-flex table-responsive p-0 desktop-to-mobile">
                <table class="table align-items-center" id="results">
                  <thead>
                    <tr>
                      <th style="width: 400px;" class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nombre</th>
                      <th style="width: 300px;" class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Cedula</th>
                      <th class="text-secondary opacity-7"></th>
                    </tr>
                  </thead>
                  <tbody id="results-body-desktop">
                    <?php foreach ($this->array as $value) { ?>
                      <tr>
                        <form action="<?= constant('__baseurl__') ?>home/consulting_cedula" method="post">
                          <td>
                            <div class="d-flex py-1">
                              <div>
                                <?php if ($value['sexo'] == 1) { ?>
                                  <img src="<?= constant('__baseurl__') ?>public/img/1.png" class="avatar avatar-sm me-3">
                                <?php } else { ?>
                                  <img src="<?= constant('__baseurl__') ?>public/img/0.png" class="avatar avatar-sm me-3">
                                <?php } ?>
                              </div>
                              <div class="d-flex flex-column justify-content-center">
                                <h6 class="mb-0 text-sm"><?= $value['p_nombre'] . ' ' . $value['p_apellido'] ?></h6>
                                <p class="text-xs text-secondary mb-0"><?= $value['s_nombre'] . ' ' . $value['s_apellido'] ?></p>
                              </div>
                            </div>
                          </td>
                          <td>
                            <p class="text-xs font-weight-bold mb-0"><?= $value['cedula'] ?></p>
                            <input value="<?= $value['cedula'] ?>" type="number" name="cedula" hidden>
                            <input value="alumnos" type="text" name="opcion" hidden>
                          </td>



                          <td class="align-middle text-center">

                            <button class="btn btn-primary" type="submit">Editar</button>
                          </td>
                        </form>
                      </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>

            </div>
          </div>
        </div>
      </div>

      <?php require constant("__layout__") . "footer.php"; ?>
    </div>
  </main>

  <?php require constant("__layout__") . "scripts.php"; ?>

</body>

</html>