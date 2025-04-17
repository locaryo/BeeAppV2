<?php require "layouts/header.php"; ?>

<body style="overflow: hidden;">
 
  <main class="main-content  mt-0" style="height: 100vh;">
    <div class="page-header align-items-start min-vh-50 pt-5 pb-11 m-3 border-radius-lg" style="background-image: url('https://raw.githubusercontent.com/creativetimofficial/public-assets/master/argon-dashboard-pro/assets/img/signup-cover.jpg'); background-position: top;">
      <span class="mask bg-gradient-dark opacity-6"></span>
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-5 text-center mx-auto">
            <h1 class="text-white mb-2 mt-5">Crear un usuario</h1>
            <p class="text-lead text-white">Este apartado solo se usa para crear usuarios para Docentes!</p>
          </div>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="row mt-lg-n10 mt-md-n11 mt-n10 justify-content-center">
        <div class="col-xl-4 col-lg-5 col-md-7 mx-auto">
          <div class="card z-index-0">
            <div class="card-header text-center pt-4">
              <h5>Registro</h5>
            </div>
            
            <div class="card-body">
              <form role="form">
                <div class="mb-3">
                  <input name="user" type="text" class="form-control" placeholder="Usuario" aria-label="Usuario">
                </div>
                <div class="mb-3">
                  <input name="password" type="password" class="form-control" placeholder="Contraseña" aria-label="Contraseña">
                </div>
                
                <div class="text-center">
                  <button type="button" class="btn bg-gradient-primary w-100 my-4 mb-2">Registrar</button>
                </div>
                <p class="text-sm mt-3 mb-0">Regresar al <a href="<?=constant('__baseurl__')?>home/dashboard" class="text-dark font-weight-bolder">Inicio</a></p>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
  <?php require "layouts/scripts.php"; ?>
</body>
</html>