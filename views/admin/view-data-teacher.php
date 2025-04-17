<?php require constant("__layout__")."header.php"; ?>
<body class="g-sidenav-show   bg-gray-100">
  <div class="min-height-300 bg-primary position-absolute w-100"></div>
  
  <?php require constant("__layout__")."nav.php"; ?>
  <?php require constant("__layout__")."aside.php"; ?>
  <main class="main-content position-relative border-radius-lg ">
    
    <div class="container-fluid pt-5">
      <?php if(isset($_GET['existe'])): ?>
        <div class="d-flex justify-content-center">
          <div class="alert alert-info text-center text-white" role="alert">
            <strong>Este docente ya esta registrado en el sistema</strong> 
          </div>
        </div>
      <?php elseif(isset($_GET['registrado'])): ?>
        <div class="d-flex justify-content-center">
          <div class="alert alert-primary text-center text-white" role="alert">
            <strong>Docente registrado exitosamente</strong> 
          </div>
        </div>
      <?php elseif(isset($_GET['error'])): ?>
        <div class="d-flex justify-content-center">
          <div class="alert alert-danger text-center text-white" role="alert">
            <strong>Ocurrio un error al registrar los datos</strong> 
          </div>
        </div>
      <?php elseif(isset($_GET['datos'])): ?>
        <div class="d-flex justify-content-center">
          <div class="alert alert-danger text-center text-white" role="alert">
            <strong>Inserte los datos requeridos</strong> 
          </div>
        </div>
      <?php endif ?>
      <div class="row">

        <form class="d-none d-md-flex d-lg-flex d-xl-flex" action="<?=constant('__baseurl__')?>home/edit_teacher" method="post">
          <div class="col-12">

            <div class="card mb-4">

              <div class="card-header pb-0">
                <h6>Docente</h6>
              </div>

              <!-- desktop -->
              <div class="d-flex justify-content-center align-items-center mx-1">
                <div class="col-md-3">
                  <div class="form-group mx-2">
                    <label for="example-text-input" class="form-control-label">Primer Nombre</label>
                    <input value="<?=$this->data['p_nombre']?>" class="form-control" type="text" id="example-text-input" name="p_nombre" required>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group mx-2">
                    <label for="example-text-input" class="form-control-label">Segundo Nombre(opcional)</label>
                    <input value="<?=$this->data['s_nombre']?>" class="form-control" type="text" id="example-text-input" name="s_nombre">
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group mx-2">
                    <label for="example-text-input" class="form-control-label">Primer Apellido</label>
                    <input value="<?=$this->data['p_apellido']?>" class="form-control" type="text" id="example-text-input" name="p_apellido" required>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group mx-2">
                    <label for="example-text-input" class="form-control-label">Segundo Apellido(opcional)</label>
                    <input value="<?=$this->data['s_apellido']?>" class="form-control" type="text" id="example-text-input" name="s_apellido">
                  </div>
                </div>
              </div>

              <!-- desktop -->
              <div class="d-flex justify-content-center align-items-center mx-1">
                <div class="col-md-3">
                  <div class="form-group mx-2">
                    <label for="example-text-input" class="form-control-label">Cedula</label>
                    <input value="<?=$this->data['cedula']?>" class="form-control" type="number" id="example-text-input" name="cedula" required>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group mx-2">
                    <label for="example-text-input" class="form-control-label">Telefono</label>
                    <input value="<?=$this->data['telefono']?>" class="form-control" type="number" id="example-text-input" placeholder="04121234567" name="telefono" required>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group mx-2">
                    <label for="example-text-input" class="form-control-label">Correo</label>
                    <input value="<?=$this->data['correo']?>" class="form-control" type="email" id="example-text-input" placeholder="name@example.com" name="correo">
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group mx-2">
                    <label for="example-text-input" class="form-control-label">Areas de Formación</label>
                    <input value="<?=$this->data['areas_formacion']?>" class="form-control" type="text" id="example-text-input" placeholder="quimica,ciencias" name="areas_formacion" required>
                  </div>
                </div>
              </div>

              <!-- desktop -->
              <div class="d-flex justify-content-center align-items-center mx-1">
                <div class="col-md-3">
                  <div class="form-group mx-2">
                    <label for="example-text-input" class="form-control-label">Fecha Nacimineto</label>
                    <input value="<?=$this->data['fecha']?>" class="form-control" type="date" id="example-text-input" name="fecha" required>
                  </div>
                </div>
                <div class="col-md-9">
                  <div class="form-group mx-2">
                    <label for="example-text-input" class="form-control-label">Direccion</label>
                    <input value="<?=$this->data['direccion']?>" class="form-control" type="text" id="example-text-input" placeholder="comunidad, calle, casa" name="direccion" required>
                  </div>
                </div>
                
              </div>

              <div class="d-flex align-items-center mx-3">
                <h6>Modifique las casillas necesarias !</h6>
              </div>

              <!-- desktop -->
              <div class="d-flex justify-content-center align-items-center mx-1 my-3">
                <div class="col-md-2">
                  <div class="form-check">
                    <input <?php if ($this->data['primero'] == 1) echo "checked"; ?> class="form-check-input" type="checkbox" name="primero">
                    <label class="custom-control-label">Primer Año</label>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-check">
                    <input <?php if ($this->data['segundo'] == 1) echo "checked"; ?> class="form-check-input" type="checkbox" name="segundo">
                    <label class="custom-control-label">Segundo Año</label>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-check">
                    <input <?php if ($this->data['tercero'] == 1) echo "checked"; ?> class="form-check-input" type="checkbox" name="tercero">
                    <label class="custom-control-label">Tercer Año</label>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-check">
                    <input <?php if ($this->data['cuarto'] == 1) echo "checked"; ?> class="form-check-input" type="checkbox" name="cuarto">
                    <label class="custom-control-label">Cuarto Año</label>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-check">
                    <input <?php if ($this->data['quinto'] == 1) echo "checked"; ?> class="form-check-input" type="checkbox" name="quinto">
                    <label class="custom-control-label">Quinto Año</label>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-check">
                    <input <?php if ($this->data['sexto'] == 1) echo "checked"; ?> class="form-check-input" type="checkbox" name="sexto">
                    <label class="custom-control-label">Sexto Año</label>
                  </div>
                </div>
              </div>

              <input type="text" name="id" value="<?=$this->data['id']?>" hidden>
              <input type="text" name="opcion" value="docentes" hidden>
              <div class="d-flex justify-content-center align-items-center">
                <button class="btn btn-primary mx-2" name="action" value="update" type="submit">Actualizar</button>
                <button class="btn btn-danger mx-2" name="action" value="delete" type="submit">Eliminar</button>
              </div>

            </div>
            
          </div>

        </form>

        <form class="d-block d-sm-none" action="<?=constant('__baseurl__')?>home/edit_teacher" method="post">
          <div class="col-12">

            <div class="card mb-4">

              <div class="card-header pb-0">
                <h6>Docente</h6>
              </div>

              <!-- mobile -->
              <div class="d-block flex-column justify-content-center align-items-center mx-1">
                <div class="col-md-3">
                  <div class="form-group mx-2">
                    <label for="example-text-input" class="form-control-label">Primer Nombre</label>
                    <input value="<?=$this->data['p_nombre']?>" class="form-control" type="text" id="example-text-input" name="p_nombre" required>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group mx-2">
                    <label for="example-text-input" class="form-control-label">Segundo Nombre(opcional)</label>
                    <input value="<?=$this->data['s_nombre']?>" class="form-control" type="text" id="example-text-input" name="s_nombre">
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group mx-2">
                    <label for="example-text-input" class="form-control-label">Primer Apellido</label>
                    <input value="<?=$this->data['p_apellido']?>" class="form-control" type="text" id="example-text-input" name="p_apellido" required>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group mx-2">
                    <label for="example-text-input" class="form-control-label">Segundo Apellido(opcional)</label>
                    <input value="<?=$this->data['s_apellido']?>" class="form-control" type="text" id="example-text-input" name="s_apellido">
                  </div>
                </div>
              </div>

              <!-- mobile -->
              <div class="d-block flex-column justify-content-center align-items-center mx-1">
                <div class="col-md-3">
                  <div class="form-group mx-2">
                    <label for="example-text-input" class="form-control-label">Cedula</label>
                    <input value="<?=$this->data['cedula']?>" class="form-control" type="number" id="example-text-input" name="cedula" required>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group mx-2">
                    <label for="example-text-input" class="form-control-label">Telefono</label>
                    <input value="<?=$this->data['telefono']?>" class="form-control" type="number" id="example-text-input" placeholder="04121234567" name="telefono" required>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group mx-2">
                    <label for="example-text-input" class="form-control-label">Correo</label>
                    <input value="<?=$this->data['correo']?>" class="form-control" type="email" id="example-text-input" placeholder="name@example.com" name="correo">
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group mx-2">
                    <label for="example-text-input" class="form-control-label">Areas de Formación</label>
                    <input value="<?=$this->data['areas_formacion']?>" class="form-control" type="text" id="example-text-input" placeholder="quimica,ciencias" name="areas_formacion" required>
                  </div>
                </div>
              </div>

              <!-- mobile -->
              <div class="d-block flex-column justify-content-center align-items-center mx-1">
                <div class="col-md-3">
                  <div class="form-group mx-2">
                    <label for="example-text-input" class="form-control-label">Fecha Nacimineto</label>
                    <input value="<?=$this->data['fecha']?>" class="form-control" type="date" id="example-text-input" name="fecha" required>
                  </div>
                </div>
                <div class="col-md-9">
                  <div class="form-group mx-2">
                    <label for="example-text-input" class="form-control-label">Direccion</label>
                    <input value="<?=$this->data['direccion']?>" class="form-control" type="text" id="example-text-input" placeholder="comunidad, calle, casa" name="direccion" required>
                  </div>
                </div>
                
              </div>

              <div class="d-flex align-items-center mx-3">
                <h6>Modifique las casillas necesarias !</h6>
              </div>

              <!-- mobile -->
              <div class="d-block flex-column justify-content-center align-items-center mx-1 my-3">
                <div class="col-md-2">
                  <div class="form-check">
                    <input <?php if ($this->data['primero'] == 1) echo "checked"; ?> class="form-check-input" type="checkbox" name="primero">
                    <label class="custom-control-label">Primer Año</label>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-check">
                    <input <?php if ($this->data['segundo'] == 1) echo "checked"; ?> class="form-check-input" type="checkbox" name="segundo">
                    <label class="custom-control-label">Segundo Año</label>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-check">
                    <input <?php if ($this->data['tercero'] == 1) echo "checked"; ?> class="form-check-input" type="checkbox" name="tercero">
                    <label class="custom-control-label">Tercer Año</label>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-check">
                    <input <?php if ($this->data['cuarto'] == 1) echo "checked"; ?> class="form-check-input" type="checkbox" name="cuarto">
                    <label class="custom-control-label">Cuarto Año</label>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-check">
                    <input <?php if ($this->data['quinto'] == 1) echo "checked"; ?> class="form-check-input" type="checkbox" name="quinto">
                    <label class="custom-control-label">Quinto Año</label>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-check">
                    <input <?php if ($this->data['sexto'] == 1) echo "checked"; ?> class="form-check-input" type="checkbox" name="sexto">
                    <label class="custom-control-label">Sexto Año</label>
                  </div>
                </div>
              </div>

              <input type="text" name="id" value="<?=$this->data['id']?>" hidden>
              <input type="text" name="opcion" value="docentes" hidden>
              <div class="d-flex justify-content-center align-items-center">
                <button class="btn btn-primary mx-2" name="action" value="update" type="submit">Actualizar</button>
                <button class="btn btn-danger mx-2" name="action" value="delete" type="submit">Eliminar</button>
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