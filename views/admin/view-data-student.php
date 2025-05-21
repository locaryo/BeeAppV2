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
        <form class="needs-validation px-2" action="<?= constant('__baseurl__') ?>home/edit_student" method="post" novalidate enctype="multipart/form-data">
          <div class="card mb-4">
            <div class="card-header pb-0 bg-primary opacity-8 mb-2">
              <div class="form-group col-12 col-sm-6 col-md-4 px-2">
                <div class="avatar-upload">
                  <div class="avatar-edit">
                    <input value="<?= $this->data['logo'] ?>" type='file' id="imageUpload" accept=".png, .jpg, .jpeg .svg" name="logo" />
                    <label for="imageUpload"></label>
                  </div>
                  <div class="avatar-preview">
                    <div id="imagePreview" style="background-image: url(<?= constant('__baseurl__').$this->data['logo'] ?>);">
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- desktop -->
            <div class="row mx-1">
              <div class="form-group col-12 col-sm-6 col-md-3 px-2">
                <label for="example-text-input" class="form-label required">Primer Nombre</label>
                <input class="form-control" type="text" id="example-text-input" name="p_nombre" value="<?= $this->data['p_nombre'] ?>" required>
              </div>
              <div class="form-group col-12 col-sm-6 col-md-3 px-2">
                <label for="example-text-input" class="form-label">Segundo Nombre</label>
                <input class="form-control" type="text" id="example-text-input" name="s_nombre" value="<?= $this->data['s_nombre'] ?>">
              </div>
              <div class="form-group col-12 col-sm-6 col-md-3 px-2">
                <label for="example-text-input" class="form-label required">Primer Apellido</label>
                <input class="form-control" type="text" id="example-text-input" name="p_apellido" value="<?= $this->data['p_apellido'] ?>" required>
              </div>
              <div class="form-group col-12 col-sm-6 col-md-3 px-2">
                <label for="example-text-input" class="form-label">Segundo Apellido</label>
                <input class="form-control" type="text" id="example-text-input" name="s_apellido" value="<?= $this->data['s_apellido'] ?>">
              </div>
              <div class="form-group col-12 col-sm-6 col-md-3 px-2">
                <label for="example-text-input" class="form-label required">Cedula</label>
                <input class="form-control" type="number" id="example-text-input" name="cedula" value="<?= $this->data['cedula'] ?>" required>
              </div>
              <div class="form-group col-12 col-sm-6 col-md-3 px-2">
                <label for="example-text-input" class="form-label">Telefono</label>
                <input class="form-control" type="number" placeholder="04121234567" id="example-text-input" name="telefono" value="<?= $this->data['telefono'] ?>" required>
              </div>
              <div class="form-group col-12 col-sm-6 col-md-3 px-2">
                <label for="example-text-input" class="form-label required">Sexo</label>
                <select class="form-control" id="example-text-input" name="sexo" required>
                  <option <?php if ($this->data['sexo'] == 0) echo "selected"; ?>>Masculino</option>
                  <option <?php if ($this->data['sexo'] == 1) echo "selected"; ?>>Femenino</option>
                </select>
              </div>
              <div class="form-group col-12 col-sm-6 col-md-3 px-2">
                <label for="example-text-input" class="form-label">Correo</label>
                <input class="form-control" name="correo" type="text" id="example-text-input" placeholder="name@example.com" value="<?= $this->data['a_correo'] ?>">
              </div>
              <div class="form-group col-12 col-sm-6 col-md-3 px-2">
                <label for="example-text-input" class="form-label required">Fecha Nacimiento</label>
                <input id="fecha" class="form-control" type="date" name="fecha" value="<?= $this->data['fecha'] ?>" required>
              </div>
              <div class="form-group col-12 col-sm-6 col-md-3 px-2">
                <label for="example-text-input" class="form-label required">Edad</label>
                <input id="edad" class="form-control" type="number" name="edad" value="<?= $this->data['edad'] ?>" required>
              </div>
              <div class="form-group col-12 col-sm-6 col-md-3 px-2">
                <label for="example-text-input" class="form-label required">Direccion</label>
                <input class="form-control" type="text" placeholder="comunidad, calle, casa" id="example-text-input" name="direccion" value="<?= $this->data['direccion'] ?>" required>
              </div>
              <div class="form-group col-12 col-sm-6 col-md-3 px-2">
                <label for="example-text-input" class="form-label required">Documentos Entregados</label>
                <input class="form-control" type="text" placeholder="partida de nacimiento, etc" id="example-text-input" name="documentos" value="<?= $this->data['documentos'] ?>" required>
              </div>
              <div class="form-group col-12 col-sm-6 col-md-4 px-2">
                <label for="example-text-input" class="form-label required">Año</label>
                <select class="form-control" id="example-text-input" name="grado" required readonly>
                  <option value="<?= $this->data['nivel'] ?>" <?php if ($this->data['nivel']) echo "selected" ?>><?= $this->data['grades'] ?></option>

                </select>
              </div>
              <div class="form-group col-12 col-sm-6 col-md-4 px-2">
                <label for="example-text-input" class="form-label required">Sección</label>
                <select class="form-control" id="example-text-input" name="seccion" required readonly>
                  <option value="<?= $this->data['seccion'] ?>" <?php if ($this->data['seccion']) echo "selected" ?>><?= $this->data['sections'] ?></option>
                </select>
              </div>
              <div class="form-group col-12 col-sm-6 col-md-4 px-2">
                <label for="example-text-input" class="form-label required">Mención</label>
                <select class="form-control" id="example-text-input" name="mencion" required readonly>
                  <option value="<?= $this->data['mencion'] ?>" <?php if ($this->data['mencion']) echo "selected" ?>><?= $this->data['mentions'] ?></option>
                </select>
              </div>
            </div>
            <div class="card-header pb-0">
              <h4>Datos de Representante</h4>
            </div>
            <!-- desktop -->
            <div class="row mx-1">
              <div class="form-group col-12 col-sm-6 col-md-4 px-2">
                <label for="example-text-input" class="form-label ">Nombre</label>
                <input class="form-control" type="text" id="example-text-input" value="<?= $this->data['p_nombre_r'] ?>" required disabled>
              </div>
              <div class="form-group col-12 col-sm-6 col-md-4 px-2">
                <label for="example-text-input" class="form-label">Apellido</label>
                <input class="form-control" type="text" value="<?= $this->data['p_apellido_r'] ?>" required disabled>
              </div>
              <div class="form-group col-12 col-sm-6 col-md-4 px-2">
                <label for="example-text-input" class="form-label">Cedula</label>
                <?php if ($this->data['eliminado'] == 1) { ?>
                  <input class="form-control is-invalid" type="number" id="example-text-input" value="<?= $this->data['cedula_r'] ?>" name="cedula_r" require>
                <?php  } else { ?>
                  <input class="form-control is-valid" type="number" id="example-text-input" value="<?= $this->data['cedula_r'] ?>" require name="cedula_r">
                <?php } ?>
              </div>
              <p class="text-danger"><?= $this->data['eliminado'] = ($this->data['eliminado'] == 1) ? "Por Favor, modificar el numerdo de cedula del representante ya que este fue eliminado del sistema" : "" ?></p>
            </div>

            <input type="text" name="id" value="<?= $this->data['a_id'] ?>" hidden>
            <input type="text" name="opcion" value="alumnos" hidden>
            <div class="row mx-1">
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
        </form>

      </div>
      <div class="row px-2">
        <div class="card">
          <div class="d-md-flex d-lg-flex d-xl-flex table-responsive p-0">
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