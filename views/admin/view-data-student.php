<?php require constant("__layout__")."header.php"; ?>

<body class="g-sidenav-show   bg-gray-100">
  <div class="min-height-300 bg-primary position-absolute w-100"></div>

  <?php require constant("__layout__")."nav.php"; ?>
  <?php require constant("__layout__")."aside.php"; ?>
  <main class="main-content position-relative border-radius-lg ">

    <div class="container-fluid pt-5">
      <?php if (isset($this->data['message'])): ?>
        <div class="d-flex justify-content-center">
          <div class="alert alert-primary text-center text-white" role="alert">
            <strong><?php echo $this->data['message']; ?></strong>
          </div>
        </div>
      <?php else: ?>

      <?php endif; ?>


      <?php if (isset($_GET['existe'])): ?>
        <div class="d-flex justify-content-center">
          <div class="alert alert-info text-center text-white" role="alert">
            <strong>Este alumno ya esta registrado en el sistema</strong>
          </div>
        </div>
      <?php elseif (isset($_GET['registrado'])): ?>
        <div class="d-flex justify-content-center">
          <div class="alert alert-primary text-center text-white" role="alert">
            <strong>Alumno registrado exitosamente</strong>
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
        <!-- *********** DESKTOP *********** -->
        <form class="d-none d-md-flex d-lg-flex d-xl-flex mb-8" action="<?= constant('__baseurl__') ?>home/edit_student" method="post">
          <div class="col-12">
            <div class="card mb-4">
              <div class="card-header pb-0">
                <h4>Estudiante</h4>
                <!-- <button class="btn btn-success mx-2" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">Pagar Matricula</button>
                <button id="consultarPagos" class="btn btn-primary mx-2" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal2">Consultar Pagos</button> -->
              </div>

              <!-- desktop -->
              <div class="d-flex justify-content-center align-items-center mx-1">
                <div class="col-md-3">
                  <div class="form-group mx-2">
                    <label for="example-text-input" class="form-control-label">Primer Nombre</label>
                    <input class="form-control" type="text" id="example-text-input" name="p_nombre" value="<?= $this->data['p_nombre'] ?>" required>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group mx-2">
                    <label for="example-text-input" class="form-control-label">Segundo Nombre(opcional)</label>
                    <input class="form-control" type="text" id="example-text-input" name="s_nombre" value="<?= $this->data['s_nombre'] ?>">
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group mx-2">
                    <label for="example-text-input" class="form-control-label">Primer Apellido</label>
                    <input class="form-control" type="text" id="example-text-input" name="p_apellido" value="<?= $this->data['p_apellido'] ?>" required>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group mx-2">
                    <label for="example-text-input" class="form-control-label">Segundo Apellido(opcional)</label>
                    <input class="form-control" type="text" id="example-text-input" name="s_apellido" value="<?= $this->data['s_apellido'] ?>">
                  </div>
                </div>
              </div>

              <!-- desktop -->
              <div class="d-flex justify-content-center align-items-center mx-1">
                <div class="col-md-3">
                  <div class="form-group mx-2">
                    <label for="example-text-input" class="form-control-label">Cedula</label>
                    <input class="form-control" type="number" id="example-text-input" name="cedula" value="<?= $this->data['cedula'] ?>" required>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group mx-2">
                    <label for="example-text-input" class="form-control-label">Telefono</label>
                    <input class="form-control" type="number" placeholder="04121234567" id="example-text-input" name="telefono" value="<?= $this->data['telefono'] ?>" required>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group mx-2">
                    <label for="example-text-input" class="form-control-label">Sexo</label>
                    <select class="form-control" id="example-text-input" name="sexo">
                      <option <?php if ($this->data['sexo'] == 0) echo "selected"; ?>>Masculino</option>
                      <option <?php if ($this->data['sexo'] == 1) echo "selected"; ?>>Femenino</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group mx-2">
                    <label for="example-text-input" class="form-control-label">Correo</label>
                    <input class="form-control" name="correo" type="text" id="example-text-input" placeholder="name@example.com" value="<?= $this->data['a_correo'] ?>">
                  </div>
                </div>
              </div>

              <!-- desktop -->
              <div class="d-flex justify-content-center align-items-center mx-1">
                <div class="col-md-2">
                  <div class="form-group mx-2">
                    <label for="example-text-input" class="form-control-label">Fecha Nacimiento</label>
                    <input id="fecha" class="form-control" type="date" name="fecha" value="<?= $this->data['fecha'] ?>" required>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group mx-2">
                    <label for="example-text-input" class="form-control-label">Edad</label>
                    <input id="edad" class="form-control" type="number" name="edad" value="<?= $this->data['edad'] ?>" required>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group mx-2">
                    <label for="example-text-input" class="form-control-label">Direccion</label>
                    <input class="form-control" type="text" placeholder="comunidad, calle, casa" id="example-text-input" name="direccion" value="<?= $this->data['direccion'] ?>" required>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group mx-2">
                    <label for="example-text-input" class="form-control-label">Documentos Entregados</label>
                    <input class="form-control" type="text" placeholder="partida de nacimiento, etc" id="example-text-input" name="documentos" value="<?= $this->data['documentos'] ?>" required>
                  </div>
                </div>

              </div>

              <div class="d-flex justify-content-center align-items-center mx-1">
                <div class="col-md-4">
                  <div class="form-group mx-2">
                    <label for="example-text-input" class="form-control-label">Año</label>
                    <select class="form-control" id="example-text-input" name="grado">

                      <option <?php if ($this->data['nivel'] == "1°ero") echo "selected" ?>>1°ero</option>
                      <option <?php if ($this->data['nivel'] == "2°do") echo "selected" ?>>2°do</option>
                      <option <?php if ($this->data['nivel'] == "3°ero") echo "selected" ?>>3°ero</option>
                      <option <?php if ($this->data['nivel'] == "4°to") echo "selected" ?>>4°to</option>
                      <option <?php if ($this->data['nivel'] == "5°to") echo "selected" ?>>5°to</option>
                      <option <?php if ($this->data['nivel'] == "6°to") echo "selected" ?>>6°to</option>

                    </select>
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="form-group mx-2">
                    <label for="example-text-input" class="form-control-label">Sección</label>
                    <select class="form-control" id="example-text-input" name="seccion">

                      <option <?php if ($this->data['seccion'] == "A") echo "selected"; ?>>A</option>
                      <option <?php if ($this->data['seccion'] == "B") echo "selected"; ?>>B</option>
                      <option <?php if ($this->data['seccion'] == "C") echo "selected"; ?>>C</option>
                      <option <?php if ($this->data['seccion'] == "D") echo "selected"; ?>>D</option>
                      <option <?php if ($this->data['seccion'] == "E") echo "selected"; ?>>E</option>

                    </select>
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="form-group mx-2">
                    <label for="example-text-input" class="form-control-label">Mención</label>
                    <select class="form-control" id="example-text-input" name="mencion">

                      <option <?php if ($this->data['mencion'] == "Petroquimica") echo "selected"; ?>>Petroquimica</option>
                      <option <?php if ($this->data['mencion'] == "Mecanica") echo "selected"; ?>>Mecanica</option>
                      <option <?php if ($this->data['mencion'] == "Electricidad") echo "selected"; ?>>Electricidad</option>

                    </select>
                  </div>
                </div>

              </div>
              <div class="card-header pb-0">
                <h6>Datos de Representante</h6>
              </div>
              <!-- desktop -->
              <div class="d-flex justify-content-left align-items-center mx-1">
                <div class="col-md-2">
                  <div class="form-group mx-2">
                    <label for="example-text-input" class="form-control-label">Nombre</label>
                    <input class="form-control" type="text" id="example-text-input" value="<?= $this->data['p_nombre_r'] ?>" required disabled>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group mx-2">
                    <label for="example-text-input" class="form-control-label">Apellido</label>
                    <input class="form-control" type="text" value="<?= $this->data['p_apellido_r'] ?>" required disabled>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group mx-2">
                    <label for="example-text-input" class="form-control-label">Cedula</label>
                    <?php if ($this->data['eliminado'] == 1) { ?>
                      <input class="form-control is-invalid" type="number" id="example-text-input" value="<?= $this->data['cedula_r'] ?>" name="cedula_r" require>
                    <?php  } else { ?>
                      <input class="form-control is-valid" type="number" id="example-text-input" value="<?= $this->data['cedula_r'] ?>" require name="cedula_r">
                    <?php } ?>
                  </div>
                </div>
                <p class="text-danger"><?= $this->data['eliminado'] = ($this->data['eliminado'] == 1) ? "Por Favor, modificar el numerdo de cedula del representante ya que este fue eliminado del sistema" : "" ?></p>
              </div>

              <input type="text" name="id" value="<?= $this->data['a_id'] ?>" hidden>
              <input type="text" name="opcion" value="alumnos" hidden>
              <div class="d-flex justify-content-center align-items-center">
                <button class="btn btn-primary mx-2" name="action" value="update" type="submit">Actualizar</button>
                <button class="btn btn-danger mx-2" name="action" value="delete" type="submit">Eliminar</button>
                <button class="btn btn-secondary mx-2 go-back" type="button">Regresar</button>
              </div>
            </div>
          </div>
        </form>

        <!-- *********** MOBIL ********** -->
        <form class="d-block mb-8" action="<?= constant('__baseurl__') ?>home/edit_student" method="post">
          <div class="col-12">
            <div class="card mb-4">
              <div class="card-header pb-0 ">
                <h6>Estudiante</h6>
                <button class="btn btn-success mx-2" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">Pagar Matricula</button>
                <button id="consultarPagosMobil" class="btn btn-primary mx-2" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal2">Consultar Pagos</button>
              </div>

              <!-- mobile -->
              <div class="d-block flex-column justify-content-center align-items-center mx-1">
                <div class="col-md-3">
                  <div class="form-group mx-2">
                    <label for="example-text-input" class="form-control-label">Primer Nombre</label>
                    <input class="form-control" type="text" id="example-text-input" name="p_nombre" value="<?= $this->data['p_nombre'] ?>" required>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group mx-2">
                    <label for="example-text-input" class="form-control-label">Segundo Nombre(opcional)</label>
                    <input class="form-control" type="text" id="example-text-input" name="s_nombre" value="<?= $this->data['s_nombre'] ?>">
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group mx-2">
                    <label for="example-text-input" class="form-control-label">Primer Apellido</label>
                    <input class="form-control" type="text" id="example-text-input" name="p_apellido" value="<?= $this->data['p_apellido'] ?>" required>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group mx-2">
                    <label for="example-text-input" class="form-control-label">Segundo Apellido(opcional)</label>
                    <input class="form-control" type="text" id="example-text-input" name="s_apellido" value="<?= $this->data['s_apellido'] ?>">
                  </div>
                </div>
              </div>

              <!-- mobile -->
              <div class="d-block flex-column justify-content-center align-items-center mx-1">
                <div class="col-md-3">
                  <div class="form-group mx-2">
                    <label for="example-text-input" class="form-control-label">Cedula</label>
                    <input class="form-control" type="number" id="example-text-input" name="cedula" value="<?= $this->data['cedula'] ?>" required>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group mx-2">
                    <label for="example-text-input" class="form-control-label">Telefono</label>
                    <input class="form-control" type="number" placeholder="04121234567" id="example-text-input" name="telefono" value="<?= $this->data['telefono'] ?>" required>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group mx-2">
                    <label for="example-text-input" class="form-control-label">Sexo</label>
                    <select class="form-control" id="example-text-input" name="sexo">
                      <option <?php if ($this->data['sexo'] == 0) echo "selected"; ?>>Masculino</option>
                      <option <?php if ($this->data['sexo'] == 1) echo "selected"; ?>>Femenino</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group mx-2">
                    <label for="example-text-input" class="form-control-label">Correo</label>
                    <input class="form-control" name="correo" type="email" id="example-text-input" placeholder="name@example.com" value="<?= $this->data['correo'] ?>">
                  </div>
                </div>
              </div>

              <!-- mobile -->
              <div class="d-block flex-column justify-content-center align-items-center mx-1">
                <div class="col-md-2">
                  <div class="form-group mx-2">
                    <label for="example-text-input" class="form-control-label">Fecha Nacimiento</label>
                    <input id="fecha" class="form-control" type="date" name="fecha" value="<?= $this->data['fecha'] ?>" required>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group mx-2">
                    <label for="example-text-input" class="form-control-label">Edad</label>
                    <input id="edad" class="form-control" type="number" name="edad" value="<?= $this->data['edad'] ?>" required>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group mx-2">
                    <label for="example-text-input" class="form-control-label">Direccion</label>
                    <input class="form-control" type="text" placeholder="comunidad, calle, casa" id="example-text-input" name="direccion" value="<?= $this->data['direccion'] ?>" required>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group mx-2">
                    <label for="example-text-input" class="form-control-label">Documentos Entregados</label>
                    <input class="form-control" type="text" placeholder="partida de nacimiento, etc" id="example-text-input" name="documentos" value="<?= $this->data['documentos'] ?>" required>
                  </div>
                </div>
              </div>

              <div class="d-block flex-column justify-content-center align-items-center mx-1">
                <div class="col-md-4">
                  <div class="form-group mx-2">
                    <label for="example-text-input" class="form-control-label">Año</label>
                    <select class="form-control" id="example-text-input" name="grado">

                      <option <?php if ($this->data['nivel'] == "1°ero") echo "selected" ?>>1°ero</option>
                      <option <?php if ($this->data['nivel'] == "2°do") echo "selected" ?>>2°do</option>
                      <option <?php if ($this->data['nivel'] == "3°ero") echo "selected" ?>>3°ero</option>
                      <option <?php if ($this->data['nivel'] == "4°to") echo "selected" ?>>4°to</option>
                      <option <?php if ($this->data['nivel'] == "5°to") echo "selected" ?>>5°to</option>
                      <option <?php if ($this->data['nivel'] == "6°to") echo "selected" ?>>6°to</option>

                    </select>
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="form-group mx-2">
                    <label for="example-text-input" class="form-control-label">Sección</label>
                    <select class="form-control" id="example-text-input" name="seccion">

                      <option <?php if ($this->data['seccion'] == "A") echo "selected"; ?>>A</option>
                      <option <?php if ($this->data['seccion'] == "B") echo "selected"; ?>>B</option>
                      <option <?php if ($this->data['seccion'] == "C") echo "selected"; ?>>C</option>
                      <option <?php if ($this->data['seccion'] == "D") echo "selected"; ?>>D</option>
                      <option <?php if ($this->data['seccion'] == "E") echo "selected"; ?>>E</option>

                    </select>
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="form-group mx-2">
                    <label for="example-text-input" class="form-control-label">Mención</label>
                    <select class="form-control" id="example-text-input" name="mencion">

                      <option <?php if ($this->data['mencion'] == "Petroquimica") echo "selected"; ?>>Petroquimica</option>
                      <option <?php if ($this->data['mencion'] == "Mecanica") echo "selected"; ?>>Mecanica</option>
                      <option <?php if ($this->data['mencion'] == "Electricidad") echo "selected"; ?>>Electricidad</option>

                    </select>
                  </div>
                </div>

              </div>

              <div class="card-header pb-0">
                <h6>Datos de Representante</h6>
              </div>
              <!-- desktop -->
              <div class="d-block flex-column justify-content-center align-items-center mx-1">
                <div class="col-md-2">
                  <div class="form-group mx-2">
                    <label for="example-text-input" class="form-control-label">Nombre</label>
                    <input class="form-control" type="text" id="example-text-input" value="<?= $this->data['p_nombre_r'] ?>" required disabled>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group mx-2">
                    <label for="example-text-input" class="form-control-label">Apellido</label>
                    <input class="form-control" type="text" value="<?= $this->data['p_apellido_r'] ?>" required disabled>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group mx-2">
                    <label for="example-text-input" class="form-control-label">Cedula</label>
                    <?php if ($this->data['eliminado'] == 1) { ?>
                      <input class="form-control is-invalid" type="number" id="example-text-input" value="<?= $this->data['cedula_r'] ?>" name="cedula_r" require>
                    <?php  } else { ?>
                      <input class="form-control is-valid" type="number" id="example-text-input" value="<?= $this->data['cedula_r'] ?>" require name="cedula_r">
                    <?php } ?>
                  </div>
                </div>
                <p class="text-danger"><?= $this->data['eliminado'] = ($this->data['eliminado'] == 1) ? "Por Favor, modificar el numerdo de cedula del representante ya que este fue eliminado del sistema" : "" ?></p>

              </div>
              <input type="text" id="idStudent" name="id" value="<?= $this->data['id'] ?>" hidden>
              <input type="text" name="opcion" value="alumnos" hidden>
              <div class="d-flex justify-content-center align-items-center">
                <button class="btn btn-primary mx-2" name="action" value="update" type="submit">Actualizar</button>
                <button class="btn btn-danger mx-2" name="action" value="delete" type="submit">Eliminar</button>
                <button class="btn btn-secondary mx-2 go-back" type="button">Regresar</button>
              </div>
            </div>
          </div>
        </form>

      </div>

      <?php require constant("__layout__")."footer.php"; ?>

    </div>
  </main>

  <?php require constant("__layout__")."scripts.php"; ?>

  <!-- Modal -->
  <!-- <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
      <div class="modal-content">
        <div class="modal-body p-0">
          <div class="card card-plain">
            <div class="card-header pb-0 text-left">
              <h3 class="font-weight-bolder text-success text-gradient">Registrar Pago</h3>
              <p class="mb-0">Registre el pago de la Matricula</p>
            </div>
            <div class="card-body">
              <form role="form text-left" action="<?= constant('__baseurl__') ?>home/register_payment" method="post">

                <label>Fecha de matricula</label>
                <div class="input-group mb-3">
                  <select class="form-control" name="fecha_matricula">
                    <option value="null">Seleccionar Matricula</option>
                    <option value="enero">Enero</option>
                    <option value="febrero">Febrero</option>
                    <option value="marzo">Marzo</option>
                    <option value="abril">Abril</option>
                    <option value="mayo">Mayo</option>
                    <option value="junio">Junio</option>
                    <option value="julio">Julio</option>
                    <option value="agosto">Agosto</option>
                    <option value="septiembre">Septiembre</option>
                    <option value="octubre">Octubre</option>
                    <option value="noviembre">Noviembre</option>
                    <option value="diciembre">Diciembre</option>
                  </select>
                </div>

                <label>Forma de Pago</label>
                <div class="input-group mb-3">
                  <select class="form-control" name="instrumento_pago" id="instrumento_pago">
                    <option value="null">Seleccionar Forma de Pago</option>
                    <option value="pago-movil">Pago Movil</option>
                    <option value="bolivar-efectivo">Bolivar Efectivo</option>
                    <option value="dolar-efectivo">Dolar Efectivo</option>
                  </select>
                </div>

                <label>Tipo de Pago</label>
                <div class="input-group mb-3">
                  <select class="form-control" name="tipo_pago">
                    <option value="null">Seleccionar</option>
                    <option value="pago-completo">Pago Completo</option>
                    <option value="abono">Abono</option>
                  </select>
                </div>

                <div class="input-group mb-3 d-none" id="monto_bs_caja">
                  <input class="form-control" type="number" placeholder="Ingresar Monto en Bs" id="monto_bs">
                </div>
                <div class="input-group mb-3 d-none" id="monto_usd_caja">
                  <input class="form-control" type="number" placeholder="Ingresar Monto en Usd" id="monto_usd">
                </div>
                <label>Fecha de Pago</label>
                <div class="input-group mb-3">
                  <input class="form-control text-success" type="date" name="fecha_pago" required>
                </div>
                <label>Total</label>
                <div class="input-group mb-3">
                  <input class="form-control text-success" type="text" id="monto_total" name="monto_total" readonly>
                </div>
                <label>Dolar BCV</label>
                <div class="input-group mb-3">
                  <input class="form-control text-success" id="dolar_bcv" value="<?= $this->moneda['USD'] ?>" readonly>
                </div>

                <label>Nota</label>
                <div class="input-group mb-3">
                  <input class="form-control" type="text" placeholder="referencia, cantidad pagada, cantidad abonada" id="example-text-input" name="nota" required>
                </div>

                <div class="text-center">
                  <input type="text" name="id_alumno" value="<?= $this->data['id'] ?>" hidden>
                  <input type="text" name="cedula" value="<?= $this->data['cedula'] ?>" hidden>
                  <button type="submit" class="btn btn-round bg-gradient-success btn-lg w-100 mt-4 mb-0">Registrar Pago</button>
                  <button type="button" class="btn btn-round bg-gradient-secondary btn-lg w-100 mt-4 mb-0" data-bs-dismiss="modal">Cerrar</button>
                </div>
              </form>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModal2Label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title font-weight-bolder text-info text-gradient" id="exampleModalLabel">Pagos Registrados</h5>
          <button type="button" class="btn-close btn-danger bg-danger" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="card">
            <div class="table-responsive">
              <table class="table align-items-center mb-0">
                <thead>
                  <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Fecha de Pago</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Matricula</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tipo</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Monto</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nota</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody id="results-body">

                </tbody>
              </table>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          ...
        </div>
      </div>
    </div>
  </div> -->

</body>

</html>