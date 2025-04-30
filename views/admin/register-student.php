<?php require constant("__layout__")."header.php"; ?>
<body class="g-sidenav-show   bg-gray-100">
  <div class="min-height-300 bg-primary position-absolute w-100"></div>
  
  <?php require constant("__layout__")."nav.php"; ?>
  <?php require constant("__layout__")."aside.php"; ?>
  <main class="main-content position-relative border-radius-lg ">
    
    <div class="container-fluid pt-5">
      <?php if(isset($_GET['existe'])): ?>
        <div class="d-flex justify-content-center position-absolute" style="left: 0;right: 0;top: 20px;">
          <div class="alert alert-info text-center text-white" role="alert">
            <strong>Este alumno ya esta registrado en el sistema</strong> 
          </div>
        </div>
      <?php elseif(isset($_GET['registrado'])): ?>
        <div class="d-flex justify-content-center position-absolute" style="left: 0;right: 0;top: 20px;">
          <div class="alert alert-primary text-center text-white" role="alert">
            <strong>Alumno registrado exitosamente</strong> 
          </div>
        </div>
      <?php elseif(isset($_GET['error'])): ?>
        <div class="d-flex justify-content-center position-absolute" style="left: 0;right: 0;top: 20px;">
          <div class="alert alert-danger text-center text-white" role="alert">
            <strong>Ocurrio un error al registrar los datos</strong> 
          </div>
        </div>
      <?php elseif(isset($_GET['datos'])): ?> 
        <div class="d-flex justify-content-center position-absolute" style="left: 0;right: 0;top: 20px;">
          <div class="alert alert-danger text-center text-white" role="alert">
            <strong>Inserte los datos requeridos</strong> 
          </div>
        </div>
      <?php elseif(isset($_GET['no_representante'])): ?> 
        <div class="d-flex justify-content-center position-absolute" style="left: 0;right: 0;top: 20px;">
          <div class="alert alert-danger text-center text-white" role="alert">
            <strong>El representante que intenta enlazar al estudiante no esta registrado en el sistema</strong> 
          </div>
        </div>
      <?php endif ?>
      <div class="row">
        
        <form action="<?=constant('__baseurl__')?>home/insert_student" method="post">
          <div class="col-12">
            <div class="card mb-4">
              <div class="card-header pb-0">
                <h6>Nuevo Estudiante</h6>
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
                    <input class="form-control" type="number" placeholder="04121234567" id="example-text-input" name="telefono">
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group mx-2">
                    <label for="example-text-input" class="form-control-label">Sexo</label>
                    <select class="form-control" id="example-text-input" name="sexo">
                      <option>Masculino</option>
                      <option>Femenino</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group mx-2">
                    <label for="example-text-input" class="form-control-label">Correo</label>
                    <input class="form-control" name="correo" type="email" id="example-text-input" placeholder="name@example.com">
                  </div>
                </div>
              </div>

              <!-- desktop -->
              <div class="d-flex justify-content-center align-items-center mx-1 desktop-to-mobile">
                <div class="col-md-2">
                  <div class="form-group mx-2">
                    <label for="example-text-input" class="form-control-label">Fecha Nacimiento</label>
                    <input id="fecha" class="form-control" type="date" name="fecha" required>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group mx-2">
                    <label for="example-text-input" class="form-control-label">Edad</label>
                    <input id="edad" class="form-control" type="number" name="edad" required>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group mx-2">
                    <label for="example-text-input" class="form-control-label">Cedula del Representante</label>
                    <input class="form-control" type="number" id="example-text-input" name="ci_representante">
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group mx-2">
                    <label for="example-text-input" class="form-control-label">Direccion</label>
                    <input class="form-control" type="text" placeholder="comunidad, calle, casa" id="example-text-input" name="direccion" required>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group mx-2">
                    <label for="example-text-input" class="form-control-label">Documentos Entregados</label>
                    <input class="form-control" type="text" placeholder="partida de nacimiento, etc" id="example-text-input" name="documentos" required>
                  </div>
                </div>
              </div>

              <div class="d-flex justify-content-center align-items-center mx-1 desktop-to-mobile">
                <div class="col-md-4">
                  <div class="form-group mx-2">
                    <label for="example-text-input" class="form-control-label">Año</label>
                    <select class="form-control" id="example-text-input" name="grado">
                      <option>1°ero</option>
                      <option>2°do</option>
                      <option>3°ero</option>
                      <option>4°to</option>
                      <option>5°to</option>
                      <option>6°to</option>
                    </select>
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="form-group mx-2">
                    <label for="example-text-input" class="form-control-label">Sección</label>
                    <select class="form-control" id="example-text-input" name="seccion">
                      <option>A</option>
                      <option>B</option>
                      <option>C</option>
                      <option>D</option>
                      <option>E</option>
                    </select>
                  </div>
                </div>
                
                <div class="col-md-4">
                  <div class="form-group mx-2">
                    <label for="example-text-input" class="form-control-label">Mención</label>
                    <select class="form-control" id="example-text-input" name="mencion">
                      <option>Petroquimica</option>
                      <option>Mecanica</option>
                      <option>Electricidad</option>
                    </select>
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
        
      <?php require constant("__layout__")."footer.php"; ?>

    </div>
  </main>
    
  <?php require constant("__layout__")."scripts.php"; ?>
    
  </body>
</html>