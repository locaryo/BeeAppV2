<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4" id="sidenav-main">
  <div class="sidenav-header">
    <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
    <a class="navbar-brand m-0" href=" https://demos.creative-tim.com/argon-dashboard/pages/dashboard.html " target="_blank">
      <!-- <img src="../assets/img/logo-ct-dark.png" class="navbar-brand-img h-100" alt="main_logo"> -->
      <span class="ms-1 font-weight-bold"><?= $_SESSION['rol'] == 1 ? 'Admin' : 'Docente'; ?></span>
    </a>
  </div>
  <hr class="horizontal dark mt-0">
  <div class="collapse navbar-collapse  w-auto h-auto" id="sidenav-collapse-main">
    <ul class="navbar-nav">
      <!-- boton dashboard -->
      <li class="nav-item">
        <a class="nav-link active" href="<?= constant('__baseurl__') ?>home/dashboard">
          <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="ni ni-tv-2 text-primary text-sm opacity-10"></i>
          </div>
          <span class="nav-link-text ms-1">Dashboard</span>
        </a>
      </li>
      <!-- boton registros-->
      <li class="nav-item">
        <a class="nav-link dropdown-toggle" href="#submenu1" data-bs-toggle="collapse">
          <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="ni ni-fat-add text-success text-sm opacity-10"></i>
          </div>
          <span class="nav-link-text ms-1">Nuevo Registro</span>
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z" />
          </svg>
        </a>
        <div class="collapse" id="submenu1">
          <ul class="navbar-nav ps-3">
            <li class="nav-item">
              <a class="nav-link " href="<?= constant('__baseurl__') ?>home/register_responsable_view">

                <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                  <i class="ni ni-single-02 text-success text-sm opacity-10"></i>
                  <i class="ni ni-fat-add text-success text-sm opacity-10"></i>
                </div>

                <span class="nav-link-text ms-1">Registrar Representante</span>
              </a>

            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?= constant('__baseurl__') ?>home/register_student_view">

                <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                  <i class="ni ni-single-02 text-success text-sm opacity-10"></i>
                  <i class="ni ni-fat-add text-success text-sm opacity-10"></i>
                </div>

                <span class="nav-link-text ms-1">Registrar Estudiante</span>


              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?= constant('__baseurl__') ?>home/register_teacher_view">

                <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                  <i class="ni ni-single-02 text-success text-sm opacity-10"></i>
                  <i class="ni ni-fat-add text-success text-sm opacity-10"></i>
                </div>

                <span class="nav-link-text ms-1">Registrar Docente</span>


              </a>
            </li>
          </ul>
        </div>
      </li>
      <!-- boton consulta individual -->
      <li class="nav-item">
        <a class="nav-link " href="<?= constant('__baseurl__') ?>home/consulting_view">
          <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="ni ni-single-02 text-primary text-sm opacity-10"></i>
          </div>
          <span class="nav-link-text ms-1">Consulta Individual</span>
        </a>
      </li>
      <!-- boton horarios -->
      <li class="nav-item">
        <a class="nav-link " href="<?= constant('__baseurl__') ?>home/schedule_view">
          <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="ni ni-single-02 text-primary text-sm opacity-10"></i>
          </div>
          <span class="nav-link-text ms-1">Asignar Horarios</span>
        </a>
      </li>
      <!-- boton lista -->
      <li class="nav-item">
        <a class="nav-link " href="<?= constant('__baseurl__') ?>home/tables">
          <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="ni ni-bullet-list-67 text-info text-sm opacity-10"></i>
          </div>
          <span class="nav-link-text ms-1">Lista Estudiantes</span>
        </a>
      </li>
      <!-- boton documentos -->
      <li class="nav-item">
        <a class="nav-link " href="<?= constant('__baseurl__') ?>home/documents">
          <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="ni ni-books text-info text-sm opacity-10"></i>
          </div>
          <span class="nav-link-text ms-1">Documentos</span>
        </a>
      </li>

      <li class="nav-item mt-3">
        <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Opciones</h6>
      </li>

      <!-- boton contabilidad -->
      <li class="nav-item">
        <a class="nav-link dropdown-toggle" href="#submenu2" data-bs-toggle="collapse">
          <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="ni ni-money-coins text-success text-sm opacity-10"></i>
          </div>
          <span class="nav-link-text ms-1">Contabilidad</span>
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z" />
          </svg>
        </a>
        <div class="collapse" id="submenu2">
          <ul class="navbar-nav ps-3">
            <li class="nav-item">
              <a class="nav-link " href="<?= constant('__baseurl__') ?>home/view_register_receive_payment">
                <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                  <i class="ni ni-collection text-success text-sm opacity-10"></i>
                </div>
                <span class="nav-link-text ms-1">Pago Recibido</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link " href="<?= constant('__baseurl__') ?>home/view_register_service_payment">
                <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                  <i class="ni ni-collection text-success text-sm opacity-10"></i>
                </div>
                <span class="nav-link-text ms-1">Pago de Servicio</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?= constant('__baseurl__') ?>home/accountingDashboard">
                <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                  <i class="ni ni-chart-pie-35 text-success text-sm opacity-10"></i>
                </div>
                <span class="nav-link-text ms-1">Tabla de Contabilidad</span>
              </a>
            </li>
          </ul>
        </div>
      </li>
      <!-- boton reportes -->
      <li class="nav-item">
        <a class="nav-link " href="<?= constant('__baseurl__') ?>home/view_institution">
          <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="ni ni-settings text-primary text-sm opacity-10"></i>
          </div>
          <span class="nav-link-text ms-1">Institución</span>
        </a>
      </li>
      <!-- boton salir -->
      <li class="nav-item">
        <a class="nav-link " href="<?= constant('__baseurl__') ?>home/logout">
          <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="ni ni-button-power text-warning text-sm opacity-10"></i>
          </div>
          <span class="nav-link-text ms-1">Salir</span>
        </a>
      </li>
    </ul>
  </div>

</aside>