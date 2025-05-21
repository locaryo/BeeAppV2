<?php require constant("__layout__") . "header.php"; ?>

<body class="g-sidenav-show   bg-gray-100">
  <div class="min-height-300 bg-primary position-absolute w-100"></div>

  <?php require constant("__layout__") . "nav.php"; ?>
  <?php require constant("__layout__") . "aside.php"; ?>
  <main class="main-content position-relative border-radius-lg ">

    <div class="container-fluid pt-5">
      <?php if (isset($_GET['existe'])): ?>
        <div class="d-flex justify-content-center">
          <div class="alert alert-info text-center text-white" role="alert">
            <strong>Este docente ya esta registrado en el sistema</strong>
          </div>
        </div>
      <?php elseif (isset($_GET['registrado'])): ?>
        <div class="d-flex justify-content-center">
          <div class="alert alert-primary text-center text-white" role="alert">
            <strong>Docente registrado exitosamente</strong>
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

        <form class="needs-validation px-2" action="<?= constant('__baseurl__') ?>home/edit_teacher" method="post" novalidate enctype="multipart/form-data">
          <div class="col-12">

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
              <div class="d-flex justify-content-center align-items-center mx-1 desktop-to-mobile">
                <div class="col-md-3">
                  <div class="form-group mx-2">
                    <label for="example-text-input" class="form-control-label">Primer Nombre</label>
                    <input value="<?= $this->data['p_nombre'] ?>" class="form-control" type="text" id="example-text-input" name="p_nombre" required>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group mx-2">
                    <label for="example-text-input" class="form-control-label">Segundo Nombre(opcional)</label>
                    <input value="<?= $this->data['s_nombre'] ?>" class="form-control" type="text" id="example-text-input" name="s_nombre">
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group mx-2">
                    <label for="example-text-input" class="form-control-label">Primer Apellido</label>
                    <input value="<?= $this->data['p_apellido'] ?>" class="form-control" type="text" id="example-text-input" name="p_apellido" required>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group mx-2">
                    <label for="example-text-input" class="form-control-label">Segundo Apellido(opcional)</label>
                    <input value="<?= $this->data['s_apellido'] ?>" class="form-control" type="text" id="example-text-input" name="s_apellido">
                  </div>
                </div>
              </div>

              <!-- desktop -->
              <div class="d-flex justify-content-center align-items-center mx-1 desktop-to-mobile">
                <div class="col-md-3">
                  <div class="form-group mx-2">
                    <label for="example-text-input" class="form-control-label">Cedula</label>
                    <input value="<?= $this->data['cedula'] ?>" class="form-control" type="number" id="example-text-input" name="cedula" required>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group mx-2">
                    <label for="example-text-input" class="form-control-label">Telefono</label>
                    <input value="<?= $this->data['telefono'] ?>" class="form-control" type="number" id="example-text-input" placeholder="04121234567" name="telefono" required>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group mx-2">
                    <label for="example-text-input" class="form-control-label">Correo</label>
                    <input value="<?= $this->data['correo'] ?>" class="form-control" type="email" id="example-text-input" placeholder="name@example.com" name="correo">
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group mx-2">
                    <label for="example-text-input" class="form-control-label">Areas de Formación</label>
                    <input value="<?= $this->data['areas_formacion'] ?>" class="form-control" type="text" id="example-text-input" placeholder="quimica,ciencias" name="areas_formacion" required>
                  </div>
                </div>
              </div>

              <!-- desktop -->
              <div class="d-flex justify-content-center align-items-center mx-1 desktop-to-mobile">
                <div class="col-md-3">
                  <div class="form-group mx-2">
                    <label for="example-text-input" class="form-control-label">Fecha Nacimineto</label>
                    <input value="<?= $this->data['fecha'] ?>" class="form-control" type="date" id="example-text-input" name="fecha" required>
                  </div>
                </div>
                <div class="col-md-9">
                  <div class="form-group mx-2">
                    <label for="example-text-input" class="form-control-label">Direccion</label>
                    <input value="<?= $this->data['direccion'] ?>" class="form-control" type="text" id="example-text-input" placeholder="comunidad, calle, casa" name="direccion" required>
                  </div>
                </div>

              </div>

              <div class="d-flex align-items-center mx-3">
                <h6>Modifique las casillas necesarias !</h6>
              </div>

              <!-- desktop -->
              <div class="d-flex justify-content-center align-items-center mx-1 my-3 desktop-to-mobile">
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

              <input type="text" name="id" value="<?= $this->data['id'] ?>" hidden>
              <input type="text" name="opcion" value="docentes" hidden>
              <div class="d-flex justify-content-center align-items-center desktop-to-mobile">
                <button class="btn btn-primary mx-2" name="action" value="update" type="submit">Actualizar</button>
                <button class="btn btn-danger mx-2" name="action" value="delete" type="submit">Eliminar</button>
              </div>

            </div>

          </div>

        </form>

        <div class="row">
          <div class="card">
            <div class="d-flex table-responsive p-0 desktop-to-mobile">
              <table class="table align-items-center" id="results">
                <thead>
                  <tr>
                    <th style="width:150px;" class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Mes</th>
                    <th style="width:100px;" class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Estado</th>
                    <th style="width:400px;" class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Detalles de pagos</th>
                  </tr>
                </thead>
                <?php
                // Nombres de meses en español
                $mesesEs = [
                  1 => 'Enero',
                  2 => 'Febrero',
                  3 => 'Marzo',
                  4 => 'Abril',
                  5 => 'Mayo',
                  6 => 'Junio',
                  7 => 'Julio',
                  8 => 'Agosto',
                  9 => 'Septiembre',
                  10 => 'Octubre',
                  11 => 'Noviembre',
                  12 => 'Diciembre'
                ];

                // Agrupamos los pagos por año-mes
                $paymentsByMonth = [];
                if (!empty($this->payments)) {
                  foreach ($this->payments as $pago) {
                    if (!empty($pago['date_payment']) && $pago['date_payment'] !== '0000-00-00') {
                      $key = date('Y-m', strtotime($pago['date_payment']));
                      $paymentsByMonth[$key][] = $pago;
                    }
                  }
                }

                // Lista de meses que tienen al menos un pago
                $allMonths = array_keys($paymentsByMonth);
                sort($allMonths);  // orden ascendente: primero más antiguo
                ?>
                <tbody id="results-body-desktop">
                  <?php if (!empty($allMonths)): ?>
                    <?php foreach ($allMonths as $ym):
                      list($yy, $mm) = explode('-', $ym);
                      $displayMonth = $mesesEs[(int)$mm] . ' ' . $yy;
                      $pagosMes = $paymentsByMonth[$ym];
                      $safeId = 'm_' . str_replace('-', '_', $ym);
                    ?>
                      <tr>
                        <td>
                          <h6 class="mb-0 text-sm"><?= $displayMonth ?></h6>
                        </td>
                        <td>
                          <?php if (count($pagosMes) > 0): ?>
                            <span class="badge badge-sm bg-gradient-success">Pagado</span>
                          <?php else: ?>
                            <span class="badge badge-sm bg-gradient-warning">Sin pagos</span>
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
                                  Ver detalles (<?= count($pagosMes) ?>)
                                </button>
                              </h2>
                              <div id="collapse-<?= $safeId ?>"
                                class="accordion-collapse collapse"
                                aria-labelledby="heading-<?= $safeId ?>"
                                data-bs-parent="#accordion-<?= $safeId ?>">
                                <div class="accordion-body p-3">
                                  <?php if (count($pagosMes)): ?>
                                    <ul class="list-group">
                                      <?php foreach ($pagosMes as $p): ?>
                                        <li class="list-group-item d-flex justify-content-between align-items-center" style="font-size:13px;color:#000">
                                          <div>
                                            <strong>Monto:</strong> <?= number_format($p['amount'], 2) ?><br>
                                            <strong>Fecha:</strong> <?= date('d/m/Y', strtotime($p['date_payment'])) ?><br>
                                            <?php if (!empty($p['description'])): ?>
                                              <strong>Detalle:</strong> <?= htmlentities($p['description']) ?><br>
                                            <?php endif; ?>
                                            <!-- aquí puedes agregar más campos del pago al docente -->
                                          </div>
                                        </li>
                                      <?php endforeach; ?>
                                    </ul>
                                  <?php else: ?>
                                    <p class="text-muted mb-0">—</p>
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
                      <td colspan="3">No hay pagos registrados para este docente.</td>
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
    <?php require constant("__layout__") . "scripts.php"; ?>
    <script>
      var accordion = document.querySelectorAll('.accordion-collapse')
      accordion.forEach(function(element) {
        var collapse = new bootstrap.Collapse(element, {
          toggle: false
        })
      });
    </script>
  </main>



</body>

</html>