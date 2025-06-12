<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4" id="sidenav-main">
  <div class="sidenav-header">
    <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
    <a class="navbar-brand m-0" href="#">
      <!-- <img src="../assets/img/logo-ct-dark.png" class="navbar-brand-img h-100" alt="main_logo"> -->
      <span class="ms-1 font-weight-bold"><?= $_SESSION['rol'] == 1 ? 'Admin' : 'Docente'; ?></span>
    </a>
  </div>
  <hr class="horizontal dark mt-0">
  <div class="collapse navbar-collapse  w-auto h-auto" id="sidenav-collapse-main">
    <ul class="navbar-nav">
      <!-- boton dashboard -->
      <li class="nav-item">
        <a class="nav-link active" href="<?= constant('__baseurl__') . ($_SESSION['rol'] == 1 ? 'home/dashboard' : 'teacher/dashboard') ?>" data-link>
          <div class="border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <span class="material-icons text-primary" style="font-size: 17px; padding:10px;">dashboard</span>
          </div>
          <span class="nav-link-text ms-1">Dashboard</span>
        </a>
      </li>

      <!-- botones para administrador -->
      <?php if ($_SESSION['rol'] == 1): ?>
        <!-- boton registros-->
        <li class="nav-item">
          <a data-link class="nav-link dropdown-toggle" href="#nuevo_registro" data-bs-toggle="collapse">
            <div class="border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <span class="material-icons text-primary" style="font-size: 17px; padding:10px;">add</span>
            </div>
            <span class="nav-link-text ms-1">Nuevo Registro</span>
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
              <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z" />
            </svg>
          </a>
          <div class="collapse" id="nuevo_registro">
            <ul class="navbar-nav ps-3">
              <li class="nav-item">
                <a class="nav-link " href="<?= constant('__baseurl__') ?>home/register_responsable_view" data-link>

                  <div class="border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                    <span class="material-icons text-success" style="font-size: 17px;">person_add</span>
                  </div>

                  <span class="nav-link-text ms-1">Registrar Representante</span>
                </a>

              </li>
              <li class="nav-item">
                <a class="nav-link" data-link href="<?= constant('__baseurl__') ?>home/register_student_view">

                  <div class="border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                    <span class="material-icons text-success" style="font-size: 17px;">person_add</span>
                  </div>

                  <span class="nav-link-text ms-1">Registrar Estudiante</span>


                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-link href="<?= constant('__baseurl__') ?>home/register_teacher_view">

                  <div class="border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                    <span class="material-icons text-success" style="font-size: 17px;">person_add</span>
                  </div>

                  <span class="nav-link-text ms-1">Registrar Docente</span>


                </a>
              </li>
            </ul>
          </div>
        </li>
        <!-- boton consulta individual -->

        <li class="nav-item">
          <a class="nav-link" href="<?= constant('__baseurl__') ?>home/consulting_view" data-link="true">
            <div class="border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <span class="material-icons text-info" style="font-size: 17px; padding:10px;">person_search</span>
            </div>
            <span class="nav-link-text ms-1">Consulta Individual</span>
          </a>
        </li>
        <!-- boton aulas -->
        <li class="nav-item">
          <a class="nav-link dropdown-toggle" href="#aulas" data-bs-toggle="collapse" data-no-ajax="true">
            <div class="border-radius-md text-center me-2 d-flex align-items-center">
              <span class="material-icons text-primary" style="font-size: 17px; padding:10px;">school</span>
            </div>
            <span class="nav-link-text ms-1">Aulas</span>
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
              <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z" />
            </svg>
          </a>
          <div class="collapse" id="aulas">
            <ul class="navbar-nav ps-3">
              <li class="nav-item">
                <a data-link class="nav-link " href="<?= constant('__baseurl__') ?>home/view_create_sections">

                  <div class="border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                    <span class="material-icons text-primary" style="font-size: 17px;">format_list_bulleted_add</span>
                  </div>

                  <span class="nav-link-text ms-1">Asignar Aula</span>
                </a>

              </li>
              <li class="nav-item">
                <a class="nav-link" data-link href="<?= constant('__baseurl__') ?>home/view_consulting_sections">

                  <div class="border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                    <span class="material-icons text-info" style="font-size: 17px;">search</span>
                  </div>

                  <span class="nav-link-text ms-1">Consultar Aula</span>

                </a>
              </li>

            </ul>
          </div>
        </li>
        <!-- boton horarios -->
        <li class="nav-item">
          <a class="nav-link " href="<?= constant('__baseurl__') ?>home/schedule_view">
            <div class="border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <span class="material-icons text-primary" style="font-size: 17px; padding:10px;">calendar_month</span>
            </div>
            <span class="nav-link-text ms-1">Asignar Horarios</span>
          </a>
        </li>
        <!-- boton lista -->
        <li class="nav-item">
          <a data-link class="nav-link " href="<?= constant('__baseurl__') ?>home/tables">
            <div class="border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <span class="material-icons text-primary" style="font-size: 17px; padding:10px;">table_view</span>
            </div>
            <span class="nav-link-text ms-1">Lista Estudiantes</span>
          </a>
        </li>
        <!-- boton consultar notas -->
        <li class="nav-item">
          <a data-link class="nav-link " href="<?= constant('__baseurl__') ?>home/view_consulting_notes">
            <div class="border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <span class="material-icons text-primary" style="font-size: 17px; padding:10px;">manage_search</span>
            </div>
            <span class="nav-link-text ms-1">Consultar Notas</span>
          </a>
        </li>
        <!-- boton documentos -->
        <li class="nav-item">
          <a class="nav-link " href="<?= constant('__baseurl__') ?>home/documents" data-link >
            <div class="border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <span class="material-icons text-primary" style="font-size: 17px; padding:10px;">description</span>
            </div>
            <span class="nav-link-text ms-1">Documentos</span>
          </a>
        </li>
      <?php endif; ?>

      <!-- botones para docentes -->
      <?php if ($_SESSION['rol'] == 2): ?>
        <!-- boton consulta de horario-->
        <li class="nav-item">
          <a class="nav-link" href="<?= constant('__baseurl__') ?>teacher/schedule_view" data-link>
            <div class="border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <span class="material-icons text-primary" style="font-size: 17px; padding:10px;">calendar_today</span>
            </div>
            <span class="nav-link-text ms-1">Consultar Horario</span>
          </a>
        </li>
        <!-- boton asignar notas a secciones-->
        <li class="nav-item">
          <a class="nav-link" href="<?= constant('__baseurl__') ?>teacher/asign_ratings_view" data-link>
            <div class="border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <span class="material-icons text-primary" style="font-size: 17px; padding:10px;">stars</span>
            </div>
            <span class="nav-link-text ms-1">Asignar Calificacion</span>
          </a>
        </li>
        <!-- boton ver notas a secciones-->
        <li class="nav-item">
          <a class="nav-link" href="<?= constant('__baseurl__') ?>teacher/list_ratings_view" data-link>
            <div class="border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <span class="material-icons text-primary" style="font-size: 17px; padding:10px;">saved_search</span>
            </div>
            <span class="nav-link-text ms-1">Mostrar Calificacion</span>
          </a>
        </li>

      <?php endif; ?>

      <li class="nav-item mt-3">
        <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Opciones</h6>
      </li>

      <!-- botones para administrador -->
      <?php if ($_SESSION['rol'] == 1): ?>

        <!-- boton contabilidad -->
        <li class="nav-item">
          <a class="nav-link dropdown-toggle" href="#submenu2" data-bs-toggle="collapse">
            <div class="border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <span class="material-icons text-primary" style="font-size: 17px; padding:10px;">bar_chart</span>
            </div>
            <span class="nav-link-text ms-1">Facturas</span>
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
              <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z" />
            </svg>
          </a>
          <div class="collapse" id="submenu2">
            <ul class="navbar-nav ps-3">
              <li class="nav-item">
                <a data-link class="nav-link " href="<?= constant('__baseurl__') ?>home/view_register_receive_payment">
                  <div class="border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                    <span class="material-icons text-success" style="font-size: 17px;">add_card</span>
                  </div>
                  <span class="nav-link-text ms-1">Pago Recibido</span>
                </a>
              </li>
              <li class="nav-item">
                <a data-link class="nav-link " href="<?= constant('__baseurl__') ?>home/view_register_service_payment">
                  <div class="border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                    <span class="material-icons text-warning" style="font-size: 17px;">payments</span>
                  </div>
                  <span class="nav-link-text ms-1">Pago de Servicio</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="<?= constant('__baseurl__') ?>home/accountingDashboard" data-link>
                  <div class="border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                    <span class="material-icons text-primary" style="font-size: 17px;">business_center</span>
                  </div>
                  <span class="nav-link-text ms-1">Contabilidad</span>
                </a>
              </li>
            </ul>
          </div>
        </li>
        <!-- boton institucion -->
        <li class="nav-item">
          <a data-link class="nav-link " href="<?= constant('__baseurl__') ?>home/view_institution">
            <div class="border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <span class="material-icons text-primary" style="font-size: 17px; padding:10px;">domain</span>
            </div>
            <span class="nav-link-text ms-1">Institución</span>
          </a>
        </li>
      <?php endif; ?>

      <!-- botones para docentes -->
      <?php if ($_SESSION['rol'] == 2): ?>
        <!-- boton institucion -->
        <li class="nav-item">
          <a data-link class="nav-link " href="<?= constant('__baseurl__') ?>teacher/profile_view">
            <div class="border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <span class="material-icons text-primary" style="font-size: 17px; padding:10px;">account_box</span>
            </div>
            <span class="nav-link-text ms-1">Perfil</span>
          </a>
        </li>
      <?php endif; ?>
      <!-- boton salir -->
      <li class="nav-item">
        <a class="nav-link" href="<?= $_SESSION['rol'] == 1 ? constant('__baseurl__') . 'home/logout' : constant('__baseurl__') . 'teacher/logout' ?>" data-no-ajax="true">
          <div class="border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <span class="material-icons text-danger" style="font-size: 17px; padding:10px;">exit_to_app</span>
          </div>
          <span class="nav-link-text ms-1">Salir</span>
        </a>
      </li>
    </ul>
  </div>

</aside>