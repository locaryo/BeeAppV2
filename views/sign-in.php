<?php require "layouts/header.php"; ?>

<body style="overflow: hidden;">

  <main class="main-content  mt-0">
    <?php if (isset($_SESSION['message'])): ?>
      <div class="d-flex justify-content-center" style="position: absolute;z-index: 1;width: 100vw;">
        <div class="alert alert-primary text-center text-white" role="alert">
          <strong><?php echo $_SESSION['message']; ?></strong>
        </div>
      </div>
      <?php unset($_SESSION['message']); ?>
    <?php endif; ?>

    <section style="position: relative;z-index: 0;">

      <div class="page-header min-vh-100">
        <div class="container">
          <div class="row">
            <div class="col-xl-4 col-lg-5 col-md-7 d-flex flex-column mx-lg-0 mx-auto">
              <div class="card">
                <div class="card-header pb-0 text-start">
                  <h4 class="font-weight-bolder">Inicie Sesion</h4>
                  <p class="mb-0">Ingrese su usuario y contraseña</p>
                </div>
                <div class="card-body">
                  <form class="d-none d-md-flex d-lg-flex d-xl-flex flex-column" role="form" action="<?= constant('__baseurl__') ?>home/login" method="post">
                    <div class="mb-3">
                      <input type="text" class="form-control form-control-lg" name="user" placeholder="Usuario" aria-label="Usuario" required>
                    </div>
                    <div class="mb-3">
                      <input type="password" class="form-control form-control-lg" name="password" placeholder="Contraseña" aria-label="Contraseña" required>
                    </div>
                    <div class="mb-3">
                      <select name="rol" class="form-control form-control-lg" required>
                        <option value="0">Seleccione un Rol</option>
                        <option value="1">Administrador</option>
                        <option value="2">Docente</option>
                        <!-- <option value="3">Estudiante</option> -->
                      </select>
                    </div>

                    <div class="d-flex flex-column justify-content-center align-items-strech">
                      <button class="btn btn-primary" type="send">Entrar</button>
                    </div>
                  </form>

                  <form class="d-block d-md-none" role="form" action="<?= constant('__baseurl__') ?>home/login" method="post">
                    <div class="mb-3">
                      <input type="text" class="form-control form-control-lg" name="user" placeholder="Usuario" aria-label="Usuario" required>
                    </div>
                    <div class="mb-3">
                      <input type="password" class="form-control form-control-lg" name="password" placeholder="Contraseña" aria-label="Contraseña" required>
                    </div>
                    <div class="mb-3">
                      <select name="rol" class="form-control form-control-lg" required>
                        <option value="0">Seleccione un Rol</option>
                        <option value="1">Administrador</option>
                        <option value="2">Docente</option>
                        <!-- <option value="3">Estudiante</option> -->
                      </select>
                    </div>

                    <div class="d-flex flex-column justify-content-center align-items-strech">
                      <button class="btn btn-primary" type="send">Entrar</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <div class="col-6 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 end-0 text-center justify-content-center flex-column"
              style="box-shadow: 1px 1px 10px 0 rgba(0, 0, 0, 0.5);">
              <div class="position-relative h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center overflow-hidden"
                style="background-image: url('<?= constant('__logo__') ?>');
                background-size: contain; background-repeat: no-repeat; background-position: center;
                border-radius: 10px; background-color: #fff;
                ">
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
  <?php require "layouts/scripts.php"; ?>
</body>

</html>