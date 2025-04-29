<?php require constant("__layout__") . "header.php"; ?>

<body class="g-sidenav-show   bg-gray-100">
  <div class="min-height-300 bg-primary position-absolute w-100"></div>

  <?php require constant("__layout__") . "nav.php"; ?>
  <?php require constant("__layout__") . "aside.php"; ?>
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
        <form class="d-none d-md-flex d-lg-flex d-xl-flex" action="<?= constant('__baseurl__') ?>home/edit_student" method="post">
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

        <div class="row">
          <div class="card">
            <div class="d-none d-md-flex d-lg-flex d-xl-flex table-responsive p-0">
              <table class="table align-items-center" id="results">
                <thead>
                  <tr>
                    <th style="width: 150px;" class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Mes</th>
                    <th style="width: 100px;" class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Estado Mensualidad</th>
                    <th style="width: 400px;" class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Detalles de Pagos</th>
                  </tr>
                </thead>
                <?php
                $mesesEs = [
                  1  => 'Enero',
                  2  => 'Febrero',
                  3  => 'Marzo',
                  4  => 'Abril',
                  5  => 'Mayo',
                  6  => 'Junio',
                  7  => 'Julio',
                  8  => 'Agosto',
                  9  => 'Septiembre',
                  10 => 'Octubre',
                  11 => 'Noviembre',
                  12 => 'Diciembre'
                ];
                $monthlyPayments = [];
                $prepaidMonths   = []; // aquí guardaremos los meses adelantados

                if (!empty($this->payments)) {
                  foreach ($this->payments as $payment) {
                    // — pagos reales agrupados por fecha de pago
                    if (
                      !empty($payment['date_payment'])
                      && $payment['date_payment'] !== '0000-00-00'
                    ) {
                      $m = date('Y-m', strtotime($payment['date_payment']));
                      $monthlyPayments[$m][] = $payment;
                    }

                    // — si este registro cubre una mensualidad (avance),
                    //   agregamos todos los meses que abarca en $prepaidMonths
                    if (
                      !empty($payment['start_monthly_payment'])
                      && !empty($payment['end_monthly_payment'])
                      && $payment['start_monthly_payment'] !== '0000-00-00'
                      && $payment['end_monthly_payment']   !== '0000-00-00'
                    ) {

                      $start = new DateTime($payment['start_monthly_payment']);
                      $end   = new DateTime($payment['end_monthly_payment']);
                      // iteramos mes a mes, inclusivo
                      $period = new DatePeriod(
                        $start,
                        new DateInterval('P1M'),
                        $end->modify('+1 day')
                      );
                      foreach ($period as $dt) {
                        $prepaidMonths[$dt->format('Y-m')] = true;
                      }
                    }
                  }
                }

                // construimos el listado definitivo de meses (uniendo pagos reales + adelantados)
                $allMonths = array_unique(
                  array_merge(
                    array_keys($monthlyPayments),
                    array_keys($prepaidMonths)
                  )
                );
                // los ordenas cómo prefieras; ejemplo descendente:
                // rsort($allMonths);
                // o ascendente:
                sort($allMonths);
                ?>

                <tbody id="results-body-desktop">
                  <?php if (!empty($allMonths)): ?>
                    <?php foreach ($allMonths as $monthYear): ?>
                      <?php
                      list($year, $month) = explode('-', $monthYear);
                      // nombre amigable (ej “March 2025”)
                      $displayMonth = $mesesEs[(int)$month] . ' ' . $year;
                      // pagos “reales” de este mes (quizá vacío si es todo adelantado)
                      $payments = $monthlyPayments[$monthYear] ?? [];
                      // ¿está pagada la mensualidad? true si hubo un pago real con start+end ESTE mes,
                      // o si el mes está en prepaidMonths
                      $monthlyPaid = isset($prepaidMonths[$monthYear]);
                      // id seguro para bootstrap
                      $safeId = 'm_' . str_replace('-', '_', $monthYear);
                      ?>
                      <tr>
                        <td>
                          <h6 class="mb-0 text-sm"><?= $displayMonth ?></h6>
                        </td>
                        <td>
                          <?php if ($monthlyPaid): ?>
                            <span class="badge badge-sm bg-gradient-success">Pagado</span>
                          <?php else: ?>
                            <span class="badge badge-sm bg-gradient-warning">Pendiente</span>
                          <?php endif; ?>
                        </td>
                        <td>
                          <div class="accordion accordion-flush" id="accordion-<?= $safeId ?>">
                            <div class="accordion-item">
                              <h2 class="accordion-header" id="heading-<?= $safeId ?>">
                                <button class="accordion-button collapsed"
                                  type="button"
                                  data-bs-toggle="collapse"
                                  data-bs-target="#collapse-<?= $safeId ?>"
                                  aria-expanded="false"
                                  aria-controls="collapse-<?= $safeId ?>">
                                  Ver detalles (<?= count($payments) ?> pagos)
                                </button>
                              </h2>
                              <div id="collapse-<?= $safeId ?>"
                                class="accordion-collapse collapse"
                                aria-labelledby="heading-<?= $safeId ?>"
                                data-bs-parent="#accordion-<?= $safeId ?>">
                                <div class="accordion-body p-3">
                                  <?php if (count($payments)): ?>
                                    <ul class="list-group">
                                      <?php foreach ($payments as $p): ?>
                                        <li style="color: black; font-size:13px;" class="list-group-item d-flex justify-content-between align-items-center">
                                          <div>
                                            <strong>Monto:</strong> <?= $p['amount'] ?><br>
                                            <strong>Fecha pago:</strong> <?= $p['date_payment'] ?><br>
                                            <strong>Tipo:</strong> <?= $p['income_name'] ?>
                                            <?php if ($p['income_name'] === "Mensualidades"): ?>
                                              <br><strong>Inicio:</strong> <?= $p['start_monthly_payment'] ?><br>
                                              <strong>Fin:</strong> <?= $p['end_monthly_payment'] ?>
                                            <?php else: ?>
                                            <?php endif ?>
                                          </div>
                                        </li>
                                      <?php endforeach; ?>
                                    </ul>
                                  <?php else: ?>
                                    <!-- aquí podrías personalizar el mensaje si quieres -->
                                    <p class="text-muted mb-0">Mensualidad adelantada, sin detalles aún.</p>
                                  <?php endif; ?>
                                </div>
                              </div>
                            </div>
                          </div>
                        </td>
                      </tr>
                    <?php endforeach; ?>
                  <?php else: ?>
                    <tr>
                      <td colspan="3">No hay pagos registrados para este alumno.</td>
                    </tr>
                  <?php endif; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>



        <!-- *********** MOBIL ********** -->
        <form class="d-block mb-8" action="<?= constant('__baseurl__') ?>home/edit_student" method="post">
          <div class="col-12">
            <div class="card mb-4">
              <div class="card-header pb-0 ">
                <h6>Estudiante</h6>
                <!-- <button class="btn btn-success mx-2" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">Pagar Matricula</button>
                <button id="consultarPagosMobil" class="btn btn-primary mx-2" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal2">Consultar Pagos</button> -->
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

        <div class="row">
          <div class="card">
            <div class="d-block d-sm-none table-responsive p-0">
              <table class="table align-items-center" id="results">
                <thead>
                  <tr>
                    <th style="width: 150px;" class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Mes</th>
                    <th style="width: 100px;" class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Estado Mensualidad</th>
                    <th style="width: 400px;" class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Detalles de Pagos</th>
                  </tr>
                </thead>
                <?php
                $mesesEs = [
                  1  => 'Enero',
                  2  => 'Febrero',
                  3  => 'Marzo',
                  4  => 'Abril',
                  5  => 'Mayo',
                  6  => 'Junio',
                  7  => 'Julio',
                  8  => 'Agosto',
                  9  => 'Septiembre',
                  10 => 'Octubre',
                  11 => 'Noviembre',
                  12 => 'Diciembre'
                ];
                $monthlyPayments = [];
                $prepaidMonths   = []; // aquí guardaremos los meses adelantados

                if (!empty($this->payments)) {
                  foreach ($this->payments as $payment) {
                    // — pagos reales agrupados por fecha de pago
                    if (
                      !empty($payment['date_payment'])
                      && $payment['date_payment'] !== '0000-00-00'
                    ) {
                      $m = date('Y-m', strtotime($payment['date_payment']));
                      $monthlyPayments[$m][] = $payment;
                    }

                    // — si este registro cubre una mensualidad (avance),
                    //   agregamos todos los meses que abarca en $prepaidMonths
                    if (
                      !empty($payment['start_monthly_payment'])
                      && !empty($payment['end_monthly_payment'])
                      && $payment['start_monthly_payment'] !== '0000-00-00'
                      && $payment['end_monthly_payment']   !== '0000-00-00'
                    ) {

                      $start = new DateTime($payment['start_monthly_payment']);
                      $end   = new DateTime($payment['end_monthly_payment']);
                      // iteramos mes a mes, inclusivo
                      $period = new DatePeriod(
                        $start,
                        new DateInterval('P1M'),
                        $end->modify('+1 day')
                      );
                      foreach ($period as $dt) {
                        $prepaidMonths[$dt->format('Y-m')] = true;
                      }
                    }
                  }
                }

                // construimos el listado definitivo de meses (uniendo pagos reales + adelantados)
                $allMonths = array_unique(
                  array_merge(
                    array_keys($monthlyPayments),
                    array_keys($prepaidMonths)
                  )
                );
                // los ordenas cómo prefieras; ejemplo descendente:
                // rsort($allMonths);
                // o ascendente:
                sort($allMonths);
                ?>

                <tbody id="results-body-desktop">
                  <?php if (!empty($allMonths)): ?>
                    <?php foreach ($allMonths as $monthYear): ?>
                      <?php
                      list($year, $month) = explode('-', $monthYear);
                      // nombre amigable (ej “March 2025”)
                      $displayMonth = $mesesEs[(int)$month] . ' ' . $year;
                      // pagos “reales” de este mes (quizá vacío si es todo adelantado)
                      $payments = $monthlyPayments[$monthYear] ?? [];
                      // ¿está pagada la mensualidad? true si hubo un pago real con start+end ESTE mes,
                      // o si el mes está en prepaidMonths
                      $monthlyPaid = isset($prepaidMonths[$monthYear]);
                      // id seguro para bootstrap
                      $safeId = 'm_' . str_replace('-', '_', $monthYear);
                      ?>
                      <tr>
                        <td>
                          <h6 class="mb-0 text-sm"><?= $displayMonth ?></h6>
                        </td>
                        <td>
                          <?php if ($monthlyPaid): ?>
                            <span class="badge badge-sm bg-gradient-success">Pagado</span>
                          <?php else: ?>
                            <span class="badge badge-sm bg-gradient-warning">Pendiente</span>
                          <?php endif; ?>
                        </td>
                        <td>
                          <div class="accordion accordion-flush" id="accordion-<?= $safeId ?>">
                            <div class="accordion-item">
                              <h2 class="accordion-header" id="heading-<?= $safeId ?>">
                                <button class="accordion-button collapsed"
                                  type="button"
                                  data-bs-toggle="collapse"
                                  data-bs-target="#collapse-<?= $safeId ?>"
                                  aria-expanded="false"
                                  aria-controls="collapse-<?= $safeId ?>">
                                  Ver detalles (<?= count($payments) ?> pagos)
                                </button>
                              </h2>
                              <div id="collapse-<?= $safeId ?>"
                                class="accordion-collapse collapse"
                                aria-labelledby="heading-<?= $safeId ?>"
                                data-bs-parent="#accordion-<?= $safeId ?>">
                                <div class="accordion-body p-3">
                                  <?php if (count($payments)): ?>
                                    <ul class="list-group">
                                      <?php foreach ($payments as $p): ?>
                                        <li style="color: black; font-size:13px;" class="list-group-item d-flex justify-content-between align-items-center">
                                          <div>
                                            <strong>Monto:</strong> <?= $p['amount'] ?><br>
                                            <strong>Fecha pago:</strong> <?= $p['date_payment'] ?><br>
                                            <strong>Tipo:</strong> <?= $p['income_name'] ?>
                                            <?php if ($p['income_name'] === "Mensualidades"): ?>
                                              <br><strong>Inicio:</strong> <?= $p['start_monthly_payment'] ?><br>
                                              <strong>Fin:</strong> <?= $p['end_monthly_payment'] ?>
                                            <?php else: ?>
                                            <?php endif ?>
                                          </div>
                                        </li>
                                      <?php endforeach; ?>
                                    </ul>
                                  <?php else: ?>
                                    <!-- aquí podrías personalizar el mensaje si quieres -->
                                    <p class="text-muted mb-0">Mensualidad adelantada, sin detalles aún.</p>
                                  <?php endif; ?>
                                </div>
                              </div>
                            </div>
                          </div>
                        </td>
                      </tr>
                    <?php endforeach; ?>
                  <?php else: ?>
                    <tr>
                      <td colspan="3">No hay pagos registrados para este alumno.</td>
                    </tr>
                  <?php endif; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>

      </div>

      <?php require constant("__layout__") . "footer.php"; ?>

    </div>

  </main>

  <?php require constant("__layout__") . "scripts.php"; ?>
  <script>
    var accordion = document.querySelectorAll('.accordion-collapse')
    accordion.forEach(function(element) {
      var collapse = new bootstrap.Collapse(element, {
        toggle: false
      })
    });
  </script>

</body>

</html>