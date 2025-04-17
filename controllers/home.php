<?php

// error_reporting(0);
// ini_set('display_errors', 0);

class Home extends Controller
{
    public $view;

    // constructor
    public function __construct()
    {
        session_start();
        parent::__construct();
        $this->view->data                = "";
        $this->view->moneda              = "";
        $this->view->msj                 = "";
        $this->view->institution         = "";
        $this->view->count_teacher       = 0;
        $this->view->count_student       = 0;
        $this->view->count_student_m     = 0;
        $this->view->count_student_f     = 0;
        $this->view->count_student_petro = [];
        $this->view->count_student_meca  = [];
        $this->view->count_student_elec  = [];
        $this->view->array               = [];
        $this->view->montoPagosMatriculaStudent = "";
        $this->view->ingresoEgreso = 0;
        $this->view->montoPagosMatriculaDashboard = 0;
        $this->view->montoUniformes = 0;
    }

    // index
    public function index()
    {
        $this->view->render('sign-in');
    }

    // index
    public function signUp()
    {

        if ($_SESSION['access'] === true && $_SESSION['rol'] === 1) {
            $this->view->render('sign-up');
        } else {
            $_SESSION['message'] = "Debe iniciar sesion para visualizar este contenido";  // Guardamos el mensaje en la sesión
            header("Location: " . __baseurl__);  // Redirigimos a login en caso de error
            exit;
        }
    }

    // iniciar sesion
    public function registerUser()
    {
        $user     = $this->validarEntrada($_POST['user']);
        $password = $this->validarEntrada($_POST['password']);

        if ($user != "" && $password != "") {
            $datos = $this->model->login($user, $password);
            if ($datos == true) {
                $_SESSION['message'] = "Ingreso exitosamente al sistema";  // Guardamos el mensaje en la sesión
                header("Location: " . __baseurl__ . "home/dashboard");  // Redirigimos al dashboard sin pasar parámetros en la URL
                exit;
            } else {
                $_SESSION['message'] = "No se encontró a este usuario en el sistema";  // Guardamos el mensaje en la sesión
                header("Location: " . __baseurl__);  // Redirigimos a login en caso de error
                exit;
            }
        } else {
            $_SESSION['message'] = "Ingrese todos los datos";
            header("Location: " . __baseurl__ . "home/login");  // Guardamos el mensaje en la sesión
            exit;
        }
    }

    // iniciar sesion
    public function login()
    {
        $user     = $this->validarEntrada($_POST['user']);
        $password = $this->validarEntrada($_POST['password']);
        $rol = $this->validarEntrada($_POST['rol']);

        if ($user != "" && $password != "" && $rol != "") {
            $datos = $this->model->login($user, $password, $rol);
            if ($datos === true) {
                $_SESSION['message'] = "Ingreso exitosamente al sistema";  // Guardamos el mensaje en la sesión
                header("Location: " . __baseurl__ . "home/dashboard");  // Redirigimos al dashboard sin pasar parámetros en la URL
                exit;
            } else {
                $_SESSION['message'] = "No se encontró a este usuario en el sistema";  // Guardamos el mensaje en la sesión
                header("Location: " . __baseurl__);  // Redirigimos a login en caso de error
                exit;
            }
        } else {
            $_SESSION['message'] = "Ingrese todos los datos";
            header("Location: " . __baseurl__);  // Guardamos el mensaje en la sesión
            exit;
        }
    }



    // dashboard
    public function dashboard()
    {
        if ($_SESSION['access'] === true && $_SESSION['rol'] === 1) {
            $count_teacher       = $this->model->count_teacher();
            $count_student       = $this->model->count_student();
            $count_student_m     = $this->model->count_student_m();
            $count_student_f     = $this->model->count_student_f();
            $count_student_petro = $this->model->count_student_petro();
            $count_student_meca  = $this->model->count_student_meca();
            $count_student_elec  = $this->model->count_student_elec();

            $montoMatriculaStudent  = $this->model->select_payment_student_count();
            $this->view->montoPagosMatriculaStudent = json_encode($montoMatriculaStudent);

            $ingresoEgreso  = $this->model->product_billing_count();
            $this->view->ingresoEgreso = json_encode($ingresoEgreso);

            $montoPagosMatriculaDashboard  = $this->model->select_payment_student_count_total_dasboard();
            $this->view->montoPagosMatriculaDashboard = $montoPagosMatriculaDashboard;

            $montoUniformes  = $this->model->select_payment_student_uniformes_total_dasboard();
            $this->view->montoUniformes = json_encode($montoUniformes);

            
            $this->view->count_teacher       = $count_teacher;
            $this->view->count_student       = $count_student;
            $this->view->count_student_m     = $count_student_m;
            $this->view->count_student_f     = $count_student_f;
            $this->view->count_student_petro = json_encode($count_student_petro);
            $this->view->count_student_meca  = json_encode($count_student_meca);
            $this->view->count_student_elec  = json_encode($count_student_elec);
            $this->view->render('admin/dashboard');
        } else {
            $_SESSION['message'] = "Debe iniciar sesion para ingresar al sistema";  // Guardamos el mensaje en la sesión
            header("Location: " . __baseurl__);  // Redirigimos a login en caso de error
            exit;
        }
    }

    // dashboard
    public function accountingDashboard()
    {
        if ($_SESSION['access'] === true && $_SESSION['rol'] === 1) {

            $montoMatriculaStudent  = $this->model->select_payment_student_count();
            $this->view->montoPagosMatriculaStudent = json_encode($montoMatriculaStudent);

            $ingresoEgreso  = $this->model->product_billing_count();
            $this->view->ingresoEgreso = json_encode($ingresoEgreso);

            $montoPagosMatriculaDashboard  = $this->model->select_payment_student_count_total_dasboard();
            $this->view->montoPagosMatriculaDashboard = $montoPagosMatriculaDashboard;

            $montoUniformes  = $this->model->select_payment_student_uniformes_total_dasboard();
            $this->view->montoUniformes = json_encode($montoUniformes);

            $this->view->render('admin/accounting-dashboard');
        } else {
            $_SESSION['message'] = "Debe iniciar sesion para ingresar al sistema";  // Guardamos el mensaje en la sesión
            header("Location: " . __baseurl__);
            exit;
        }
    }

    // vista registrar servicio
    public function view_register_service_payment()
    {
        if ($_SESSION['access'] === true && $_SESSION['rol'] === 1) {
            $this->view->render('admin/register-service-payment');
        } else {
            $_SESSION['message'] = "Debe iniciar sesion para ingresar al sistema";  // Guardamos el mensaje en la sesión
            header("Location: " . __baseurl__);
            exit;
        }
    }

    public function register_service_payment()
    {
        $servicio        = $this->validarEntrada($_POST['servicio']);
        $tipo      = $this->validarEntrada($_POST['tipo']);
        $monto        = $this->validarEntrada($_POST['monto']);
        $fecha      = $this->validarEntrada($_POST['fecha']);
        $nota      = $this->validarEntrada($_POST['nota']);


        if ($servicio != "" && $tipo != "" && $monto != "" && $fecha != "") {
            $this->model->model_register_service_payment($servicio, $tipo, $monto, $fecha, $nota);
        } else {
            header("Location: " . __baseurl__ . "home/register_entry?datos");
        }
    }

    // vista registrar pago recibido
    public function view_register_receive_payment()
    {
        if (isset($_SESSION['access'])) {
            $this->view->render('admin/register-receive-payment');
        } else {
            $_SESSION['message'] = "Debe iniciar sesion para ingresar al sistema";  // Guardamos el mensaje en la sesión
            header("Location: " . __baseurl__);
            exit;
        }
    }

    public function register_receive_payment()
    {
        $servicio        = $this->validarEntrada($_POST['servicio']);
        $tipo      = $this->validarEntrada($_POST['tipo']);
        $monto        = $this->validarEntrada($_POST['monto']);
        $fecha      = $this->validarEntrada($_POST['fecha']);
        $nota      = $this->validarEntrada($_POST['nota']);


        if ($servicio != "" && $tipo != "" && $monto != "" && $fecha != "") {
            $this->model->model_register_receive_payment($servicio, $tipo, $monto, $fecha, $nota);
        } else {
            header("Location: " . __baseurl__ . "home/view_register_receive_payment?datos");
        }
    }

    // registrar-estudiantes
    public function register_student_view()
    {
        if (isset($_SESSION['access'])) {
            $this->view->render('admin/register-student');
        } else {
            $_SESSION['message'] = "Debe iniciar sesion para ingresar al sistema";  // Guardamos el mensaje en la sesión
            header("Location: " . __baseurl__);
            exit;
        }
    }

    // proceso para registrar estudiante
    public function insert_student()
    {
        $p_nombre         = $this->validarEntrada($_POST['p_nombre']);
        $s_nombre         = $this->validarEntrada($_POST['s_nombre']);
        $p_apellido       = $this->validarEntrada($_POST['p_apellido']);
        $s_apellido       = $this->validarEntrada($_POST['s_apellido']);
        $cedula           = $this->validarEntrada($_POST['cedula']);
        $telefono         = $this->validarEntrada($_POST['telefono']);
        $sexo             = $this->validarEntrada($_POST['sexo']);
        $correo           = $this->validarEntrada($_POST['correo']);
        $fecha            = $this->validarEntrada($_POST['fecha']);
        $edad             = $this->validarEntrada($_POST['edad']);
        $ci_representante = $this->validarEntrada($_POST['ci_representante']);
        $direccion        = $this->validarEntrada($_POST['direccion']);
        $documentos       = $this->validarEntrada($_POST['documentos']);
        $grado            = $this->validarEntrada($_POST['grado']);
        $seccion          = $this->validarEntrada($_POST['seccion']);
        $mencion          = $this->validarEntrada($_POST['mencion']);

        $sexo = ($sexo == "Femenino") ? 1 : 0;

        if (
            $p_nombre         != "" &&
            $p_apellido       != "" &&
            $cedula           != "" &&
            $telefono         != "" &&
            $fecha            != "" &&
            $edad             != "" &&
            $ci_representante != ""
        ) {
            $this->model->insert_student(
                $p_nombre,
                $s_nombre,
                $p_apellido,
                $s_apellido,
                $cedula,
                $telefono,
                $sexo,
                $correo,
                $fecha,
                $edad,
                $ci_representante,
                $direccion,
                $documentos,
                $grado,
                $seccion,
                $mencion
            );
        } else {
            header("Location: " . __baseurl__ . "home/register_student_view?datos");
        }
    }

    // registrar-docente
    public function register_teacher_view()
    {
        if (isset($_SESSION['access'])) {

            $this->view->render('admin/register-teacher');
        } else {
            $_SESSION['message'] = "Debe iniciar sesion para ingresar al sistema";  // Guardamos el mensaje en la sesión
            header("Location: " . __baseurl__);
            exit;
        }
    }

    // proceso para registrar docente
    public function insert_teacher()
    {
        $p_nombre        = $this->validarEntrada($_POST['p_nombre']);
        $s_nombre        = $this->validarEntrada($_POST['s_nombre']);
        $p_apellido      = $this->validarEntrada($_POST['p_apellido']);
        $s_apellido      = $this->validarEntrada($_POST['s_apellido']);
        $cedula          = $this->validarEntrada($_POST['cedula']);
        $telefono        = $this->validarEntrada($_POST['telefono']);
        $correo          = $this->validarEntrada($_POST['correo']);
        $areas_formacion = $this->validarEntrada($_POST['areas_formacion']);
        $fecha           = $this->validarEntrada($_POST['fecha']);
        $direccion       = $this->validarEntrada($_POST['direccion']);
        $primero         = $this->validarEntrada($_POST['primero']);
        $segundo         = $this->validarEntrada($_POST['segundo']);
        $tercero         = $this->validarEntrada($_POST['tercero']);
        $cuarto          = $this->validarEntrada($_POST['cuarto']);
        $quinto          = $this->validarEntrada($_POST['quinto']);
        $sexto           = $this->validarEntrada($_POST['sexto']);

        $primero = ($primero == "on") ? 1 : 0;
        $segundo = ($segundo == "on") ? 1 : 0;
        $tercero = ($tercero == "on") ? 1 : 0;
        $cuarto  = ($cuarto == "on") ? 1 : 0;
        $quinto  = ($quinto == "on") ? 1 : 0;
        $sexto   = ($sexto == "on") ? 1 : 0;

        if (
            $p_nombre        != "" &&
            $p_apellido      != "" &&
            $cedula          != "" &&
            $telefono        != "" &&
            $fecha           != "" &&
            $direccion       != "" &&
            $areas_formacion != ""
        ) {
            $this->model->insert_teacher(
                $p_nombre,
                $s_nombre,
                $p_apellido,
                $s_apellido,
                $cedula,
                $telefono,
                $correo,
                $areas_formacion,
                $fecha,
                $direccion,
                $primero,
                $segundo,
                $tercero,
                $cuarto,
                $quinto,
                $sexto
            );
        } else {
            header("Location: " . __baseurl__ . "home/register_teacher_view?datos");
        }
    }

    // registrar-responsable
    public function register_responsable_view()
    {
        if (isset($_SESSION['access'])) {

            $this->view->render('admin/register-responsable');
        } else {
            $_SESSION['message'] = "Debe iniciar sesion para ingresar al sistema";  // Guardamos el mensaje en la sesión
            header("Location: " . __baseurl__);
            exit;
        }
    }

    // proceso para registrar responsable
    public function insert_responsable()
    {
        $p_nombre        = $this->validarEntrada($_POST['p_nombre']);
        $s_nombre        = $this->validarEntrada($_POST['s_nombre']);
        $p_apellido      = $this->validarEntrada($_POST['p_apellido']);
        $s_apellido      = $this->validarEntrada($_POST['s_apellido']);
        $cedula          = $this->validarEntrada($_POST['cedula']);
        $telefono        = $this->validarEntrada($_POST['telefono']);
        $correo          = $this->validarEntrada($_POST['correo']);
        $fecha           = $this->validarEntrada($_POST['fecha']);
        $direccion       = $this->validarEntrada($_POST['direccion']);

        if (
            $p_nombre        != "" &&
            $p_apellido      != "" &&
            $cedula          != "" &&
            $telefono        != "" &&
            $fecha           != "" &&
            $direccion       != ""
        ) {
            $this->model->insert_responsable(
                $p_nombre,
                $s_nombre,
                $p_apellido,
                $s_apellido,
                $cedula,
                $telefono,
                $correo,
                $fecha,
                $direccion
            );
        } else {
            header("Location: " . __baseurl__ . "home/register_responsable_view?datos");
        }
    }

    // proceso para registrar pago de matricula
    public function register_payment()
    {
        $id_alumno        = $this->validarEntrada($_POST['id_alumno']);
        $cedula           = $this->validarEntrada($_POST['cedula']);
        $fecha_matricula  = $this->validarEntrada($_POST['fecha_matricula']);
        $instrumento_pago = $this->validarEntrada($_POST['instrumento_pago']);
        $tipo_pago        = $this->validarEntrada($_POST['tipo_pago']);
        $monto_total      = $this->validarEntrada($_POST['monto_total']);
        $fecha_pago       = $this->validarEntrada($_POST['fecha_pago']);
        $nota             = $this->validarEntrada($_POST['nota']);

        if (
            $fecha_matricula  != "" &&
            $instrumento_pago != "" &&
            $tipo_pago        != "" &&
            $monto_total      != "" &&
            $fecha_pago       != "" &&
            $nota             != ""
        ) {
            // Registrar el pago
            $this->model->register_payment(
                $id_alumno,
                $cedula,
                $fecha_matricula,
                $instrumento_pago,
                $tipo_pago,
                $monto_total,
                $fecha_pago,
                $nota
            );


            // Redirigir a la vista de datos del estudiante
            $this->consulting_cedula($cedula, 'alumnos');
            exit(); // Asegúrate de salir para que no se ejecute más código
        } else {
            header("Location: " . __baseurl__ . "home/consulting_view?datos");
            exit();
        }
    }


    // procesar consulta de cedula
    public function select_payment_student()
    {
        // Get raw POST data
        $rawData = file_get_contents("php://input");

        // Decode JSON data
        $postData = json_decode($rawData, true);

        // Check if 'nivel' exists in decoded data
        $idStudent = isset($postData["idStudent"]) ? $postData["idStudent"] : null;

        $result = $this->model->select_payment_student($idStudent);
        echo json_encode($result);
    }

    // consultar cedulas
    public function consulting_view()
    {
        if (isset($_SESSION['access'])) {
            $this->view->render('admin/consulting');
        } else {
            $_SESSION['message'] = "Debe iniciar sesion para ingresar al sistema";  // Guardamos el mensaje en la sesión
            header("Location: " . __baseurl__);
            exit;
        }
    }

    // procesar consulta de cedula
    public function consulting_cedula($cedulaa = '', $opcionn = '')
    {

        $cedula = (isset($_POST['cedula'])) ? $this->validarEntrada($_POST['cedula']) : $this->validarEntrada($cedulaa);
        $opcion = (isset($_POST['opcion'])) ? $this->validarEntrada($_POST['opcion']) : $this->validarEntrada($opcionn);

        if ($cedula != "" && $opcion != "") {
            if ($opcion == "alumnos") {
                $_SESSION['cedula'] = $cedula;
                $_SESSION['opcion'] = $opcion;
                header("Location: " . __baseurl__ . "home/view_data_student");
                exit;
            } elseif ($opcion == "docentes") {
                $result = $this->model->consulting_cedula($cedula, $opcion);
                $this->view_data_teacher($result);
            } elseif ($opcion == "representante") {
                $result = $this->model->consulting_cedula($cedula, $opcion);
                $this->view_data_representante($result);
            }
        } else {

            header("Location: " . __baseurl__ . "home/consulting_view?datos");
        }
    }

    // schedule_view
    public function schedule_view()
    {
        if (isset($_SESSION['access'])) {
            $this->view->array = $this->model->select_teacher();
            $this->view->render('admin/schedule');
        } else {
            $_SESSION['message'] = "Debe iniciar sesion para ingresar al sistema";  // Guardamos el mensaje en la sesión
            header("Location: " . __baseurl__);
            exit;
        }
    }

    public  function submit_schedule()
    {
        $dias = $_POST['horario_dia'];
        $horasInicio = $_POST['horario_hora_inicio'];
        $horasFin = $_POST['horario_hora_fin'];
        $docentes = $_POST['horario_docente'];
        $materias = $_POST['horario_materia'];
        $nivel = $_POST['nivel'];
        $seccion = $_POST['seccion'];
        $mencion = $_POST['mencion'];

        $result = $this->model->model_register_schedule($dias, $horasInicio, $horasFin, $docentes, $materias, $nivel, $seccion, $mencion);
        if ($result) {
            $_SESSION['message'] = "Horario registrado exitosamente";  // Guardamos el mensaje en la sesión
            header("Location: " . __baseurl__ . "home/schedule_view");  // Redirigimos a la vista de horario sin pasar parámetros en la URL
            exit;
        } else {
            $_SESSION['message'] = "Error al registrar el horario";  // Guardamos el mensaje en la sesión
            header("Location: " . __baseurl__ . "home/schedule_view?error");  // Redirigimos a la vista de horario con error
            exit;
        }
    }

    // visualizar datos de estudiante
    public function view_data_student()
    {
        if (isset($_SESSION['access'])) {
            // Si ya se pasó información en $data (por ejemplo, desde una consulta), se utiliza esa
            if (isset($_SESSION['cedula']) && isset($_SESSION['opcion'])) {
                $cedula = $_SESSION['cedula'];
                $opcion = $_SESSION['opcion'];
                // Se consulta la información actualizada del estudiante según su ID
                $data = $this->model->consulting_cedula($cedula, $opcion);
                unset($_SESSION['cedula']);  // Eliminamos para que se comporte como flash data
                unset($_SESSION['opcion']);  // Eliminamos para que se comporte como flash data
                if ($data) {
                    $this->view->data = $data;
                    $this->view->render('admin/view-data-student');
                }
            }
            // Caso contrario, se asume que se llegó desde un update y se busca el ID en la sesión
            elseif (isset($_SESSION['updated_student'])) {
                $studentId = $_SESSION['updated_student'];
                // Se consulta la información actualizada del estudiante según su ID
                $data = $this->model->consulting_cedula($studentId, 'alumnos');
                unset($_SESSION['updated_student']);  // Eliminamos para que se comporte como flash data
                if ($data) {
                    $data['message'] = "Los datos se han actualizado correctamente.";
                    $this->view->data = $data;
                    $this->view->render('admin/view-data-student');
                }
            } else {
                // Si no se tiene información de ninguna forma, redirigimos con error
                header("Location: " . __baseurl__ . "home/consulting_view?errorCedula");
                exit;
            }
        } else {
            $_SESSION['message'] = "Debe iniciar sesion para ingresar al sistema";  // Guardamos el mensaje en la sesión
            header("Location: " . __baseurl__);
            exit;
        }
    }




    // visualizar datos de maestro
    public function view_data_teacher($data)
    {
        if (isset($_SESSION['access'])) {
            $this->view->data = $data;
            $this->view->render('admin/view-data-teacher');
        } else {
            $_SESSION['message'] = "Debe iniciar sesion para ingresar al sistema";  // Guardamos el mensaje en la sesión
            header("Location: " . __baseurl__);
            exit;
        }
    }

    // visualizar datos de representante
    public function view_data_representante($data)
    {
        if (isset($_SESSION['access'])) {
            $this->view->data = $data;
            $this->view->render('admin/view-data-representante');
        } else {
            $_SESSION['message'] = "Debe iniciar sesion para ingresar al sistema";  // Guardamos el mensaje en la sesión
            header("Location: " . __baseurl__);
            exit;
        }
    }

    // proceso para editar estudiante
    public function edit_student()
    {
        $action     = $this->validarEntrada($_POST['action']);
        $id         = $this->validarEntrada($_POST['id']);
        $p_nombre   = $this->validarEntrada($_POST['p_nombre']);
        $s_nombre   = $this->validarEntrada($_POST['s_nombre']);
        $p_apellido = $this->validarEntrada($_POST['p_apellido']);
        $s_apellido = $this->validarEntrada($_POST['s_apellido']);
        $cedula     = $this->validarEntrada($_POST['cedula']);
        $telefono   = $this->validarEntrada($_POST['telefono']);
        $sexo       = $this->validarEntrada($_POST['sexo']);
        $correo     = $this->validarEntrada($_POST['correo']);
        $fecha      = $this->validarEntrada($_POST['fecha']);
        $edad       = $this->validarEntrada($_POST['edad']);
        $direccion  = $this->validarEntrada($_POST['direccion']);
        $documentos = $this->validarEntrada($_POST['documentos']);
        $grado      = $this->validarEntrada($_POST['grado']);
        $seccion    = $this->validarEntrada($_POST['seccion']);
        $mencion    = $this->validarEntrada($_POST['mencion']);
        $opcion     = $this->validarEntrada($_POST['opcion']);
        $cedula_r   = $this->validarEntrada($_POST['cedula_r']);

        if ($action == 'update') {


            $sexo = ($sexo == "Femenino") ? 1 : 0;

            if (
                $p_nombre        != "" &&
                $p_apellido      != "" &&
                $cedula          != "" &&
                $fecha           != "" &&
                $edad            != "" &&
                $telefono        != ""
            ) {

                $data = $this->model->model_edit_student(
                    $id,
                    $p_nombre,
                    $s_nombre,
                    $p_apellido,
                    $s_apellido,
                    $cedula,
                    $telefono,
                    $sexo,
                    $correo,
                    $fecha,
                    $edad,
                    $direccion,
                    $documentos,
                    $grado,
                    $seccion,
                    $mencion,
                    $cedula_r
                );
                if ($data === true) {
                    // Almacenar el mensaje de éxito y el ID (o la información) del estudiante en la sesión

                    $_SESSION['updated_student'] = $cedula;  // Asumiendo que 'a_id' es el ID del alumno actualizado

                    // Redirigir a la vista sin pasar parámetros en la URL
                    header("Location: " . __baseurl__ . "home/view_data_student");
                    exit;
                } else {
                    $_SESSION['message'] = "Error al actualizar el registro";
                    $_SESSION['updated_student'] = $cedula;  // En caso de error, se puede conservar el ID original
                    header("Location: " . __baseurl__ . "home/view_data_student");
                    exit;
                }
            } else {
                header("Location: " . __baseurl__ . "home/view_data_student?datos");
            }
        }

        if ($action == 'delete') {
            $cedula = $this->validarEntrada($_POST['cedula']);
            $this->model->deleted_cedula($cedula, $opcion, $id);
        }
    }

    // proceso para editar docente
    public function edit_teacher()
    {
        $action          = $this->validarEntrada($_POST['action']);
        $id              = $this->validarEntrada($_POST['id']);
        $p_nombre        = $this->validarEntrada($_POST['p_nombre']);
        $s_nombre        = $this->validarEntrada($_POST['s_nombre']);
        $p_apellido      = $this->validarEntrada($_POST['p_apellido']);
        $s_apellido      = $this->validarEntrada($_POST['s_apellido']);
        $cedula          = $this->validarEntrada($_POST['cedula']);
        $telefono        = $this->validarEntrada($_POST['telefono']);
        $correo          = $this->validarEntrada($_POST['correo']);
        $areas_formacion = $this->validarEntrada($_POST['areas_formacion']);
        $fecha           = $this->validarEntrada($_POST['fecha']);
        $direccion       = $this->validarEntrada($_POST['direccion']);
        $opcion          = $this->validarEntrada($_POST['opcion']);

        if ($action == "update") {
            $primero = isset($_POST['primero']) ? ($_POST['primero'] == "on" ? 1 : 0) : 0;
            $segundo = isset($_POST['segundo']) ? ($_POST['segundo'] == "on" ? 1 : 0) : 0;
            $tercero = isset($_POST['tercero']) ? ($_POST['tercero'] == "on" ? 1 : 0) : 0;
            $cuarto = isset($_POST['cuarto']) ? ($_POST['cuarto'] == "on" ? 1 : 0) : 0;
            $quinto = isset($_POST['quinto']) ? ($_POST['quinto'] == "on" ? 1 : 0) : 0;
            $sexto = isset($_POST['sexto']) ? ($_POST['sexto'] == "on" ? 1 : 0) : 0;


            if (
                $p_nombre        != "" &&
                $p_apellido      != "" &&
                $cedula          != "" &&
                $telefono        != "" &&
                $fecha           != "" &&
                $direccion       != "" &&
                $areas_formacion != ""
            ) {
                $data = $this->model->edit_teacher(
                    $id,
                    $p_nombre,
                    $s_nombre,
                    $p_apellido,
                    $s_apellido,
                    $cedula,
                    $telefono,
                    $correo,
                    $areas_formacion,
                    $fecha,
                    $direccion,
                    $primero,
                    $segundo,
                    $tercero,
                    $cuarto,
                    $quinto,
                    $sexto
                );
                $this->view_data_teacher($data);
            } else {
                header("Location: " . __baseurl__ . "home/register_teacher_view?datos");
            }
        }

        if ($action == 'delete') {
            $cedula = $this->validarEntrada($_POST['cedula']);
            $this->model->deleted_cedula($cedula, $opcion, $id);
        }
    }

    // proceso para editar representante
    public function edit_representante()
    {
        $action          = $this->validarEntrada($_POST['action']);
        $id              = $this->validarEntrada($_POST['id']);
        $p_nombre        = $this->validarEntrada($_POST['p_nombre']);
        $s_nombre        = $this->validarEntrada($_POST['s_nombre']);
        $p_apellido      = $this->validarEntrada($_POST['p_apellido']);
        $s_apellido      = $this->validarEntrada($_POST['s_apellido']);
        $cedula          = $this->validarEntrada($_POST['cedula']);
        $telefono        = $this->validarEntrada($_POST['telefono']);
        $correo          = $this->validarEntrada($_POST['correo']);
        $fecha           = $this->validarEntrada($_POST['fecha']);
        $direccion       = $this->validarEntrada($_POST['direccion']);
        $opcion          = $this->validarEntrada($_POST['opcion']);

        if ($action == "update") {

            if (
                $p_nombre        != "" &&
                $p_apellido      != "" &&
                $cedula          != "" &&
                $telefono        != "" &&
                $fecha           != "" &&
                $direccion       != ""
            ) {
                $data = $this->model->edit_representante(
                    $id,
                    $p_nombre,
                    $s_nombre,
                    $p_apellido,
                    $s_apellido,
                    $cedula,
                    $telefono,
                    $correo,
                    $fecha,
                    $direccion
                );
                $this->view_data_representante($data);
            } else {
                header("Location: " . __baseurl__ . "home/register_teacher_view?datos");
            }
        }

        if ($action == 'delete') {

            $this->model->deleted_cedula($cedula, $opcion, $id);
        }
    }

    // proceso para editar datos institucion
    public function edit_institution()
    {
        $action    = $this->validarEntrada($_POST['action']);
        $id        = $this->validarEntrada($_POST['id']);
        $nombre    = $this->validarEntrada($_POST['nombre']);
        $director  = $this->validarEntrada($_POST['director']);
        $ubicacion = $this->validarEntrada($_POST['ubicacion']);
        $telefono  = $this->validarEntrada($_POST['telefono']);
        $correo    = $this->validarEntrada($_POST['correo']);
        $codigo    = $this->validarEntrada($_POST['codigo']);
        $opcion    = $this->validarEntrada($_POST['opcion']);

        if ($action == "update") {

            if (
                $nombre    != "" &&
                $ubicacion != "" &&
                $director  != "" &&
                $telefono  != "" &&
                $codigo    != ""
            ) {
                $data = $this->model->model_edit_institution(
                    $id,
                    $nombre,
                    $director,
                    $ubicacion,
                    $telefono,
                    $correo,
                    $codigo
                );

                if ($data === true) {
                    $_SESSION['updated_institution'] = true;
                    header("Location: " . __baseurl__ . "home/view_institution");
                } else {
                    header("Location: " . __baseurl__ . "home/institution?error");
                    exit;
                }

                // $data['mensaje'] = "Los datos se han actualizado correctamente.";
                // $this->view_institution($data);
            } else {
                header("Location: " . __baseurl__ . "home/institution?datos");
            }
        }
    }

    // tablas
    public function tables()
    {
        if (isset($_SESSION['access'])) {
            $data = $this->model->read_all();
            $this->view->array = $data;
            $this->view->render('admin/tables');
        } else {
            $_SESSION['message'] = "Debe iniciar sesion para ingresar al sistema";  // Guardamos el mensaje en la sesión
            header("Location: " . __baseurl__);
            exit;
        }
    }

    // procesar consulta de cedula
    public function consulting_tabla()
    {
        // Get raw POST data
        $rawData = file_get_contents("php://input");

        // Decode JSON data
        $postData = json_decode($rawData, true);

        // Check if 'nivel' exists in decoded data
        $nivel = isset($postData["nivel"]) ? $postData["nivel"] : null;
        $seccion = isset($postData["seccion"]) ? $postData["seccion"] : null;
        $mencion = isset($postData["mencion"]) ? $postData["mencion"] : null;

        $result = $this->model->consulting_tabla($nivel, $seccion, $mencion);
        echo json_encode($result);
    }

    // documentos
    public function documents()
    {
        if (isset($_SESSION['access'])) {

            $this->view->render('admin/documents');
        } else {
            $_SESSION['message'] = "Debe iniciar sesion para ingresar al sistema";  // Guardamos el mensaje en la sesión
            header("Location: " . __baseurl__);
            exit;
        }
    }

    // institucion
    public function view_institution()
    {
        if (isset($_SESSION['access'])) {
            if ((isset($_SESSION['updated_institution']))) {
                $datos = $this->model->institution();
                $_SESSION['message'] = "Los datos se han actualizado correctamente.";
                $this->view->institution = $datos;
                $this->view->render('admin/view-data-institution');
            } else {
                $datos = $this->model->institution();
                $this->view->institution = $datos;
                $this->view->render('admin/view-data-institution');
            }
            unset($_SESSION['updated_institution']);
        } else {
            $_SESSION['message'] = "Debe iniciar sesion para ingresar al sistema";  // Guardamos el mensaje en la sesión
            header("Location: " . __baseurl__);
            exit;
        }
    }

    // consulta alumno para constancias
    public function constancy()
    {
        $action = $this->validarEntrada($_POST['action']);
        $cedula = $this->validarEntrada($_POST['cedula']);
        $motivo = $this->validarEntrada($_POST['motivo']);
        $movil = $this->validarEntrada($_POST['movil']);

        if ($cedula != '') {
            $datos = $this->model->constancy($cedula);
            if ($datos != '') {
                $this->constancyGenerator($action, $datos, $motivo, $movil);
            }
        } else {
            $_SESSION['message'] = "Ingrese un valor en el campo";  // Guardamos el mensaje en la sesión
            header("Location: " . __baseurl__ . "home/documents");
            exit;
        }
    }

    // generador constancias
    private function constancyGenerator($action, $datos, $motivo, $movil)
    {
        setlocale(LC_TIME, 'es_ES.UTF-8');
        if ($action === "estudio" && $motivo === '') {
            $dataTime = getdate();
            $monthNum  = date('n');
            $dateObj   = DateTime::createFromFormat('!m', $monthNum);
            $monthName = strftime('%b', $dateObj->getTimestamp());
            $this->pdf->AddPage();
            $this->pdf->Image('public/img/logos/logo-ali.jpeg', 10, 10, 25);
            $this->pdf->SetFont('Arial', 'B', 19);
            $this->pdf->Ln(15);

            $this->pdf->MultiCell(190, 10, utf8_decode('Escuela Técnica Robinsoniana Petroquímica y Agroambiental Alí Primera'), 0, 'C', 0);
            $this->pdf->Ln(25);
            $this->pdf->SetFont('Arial', 'B', 17);
            $this->pdf->Cell(0, 0, 'CONSTANCIA DE ESTUDIO', 0, 1, 'C');
            $this->pdf->SetFont('Arial', 'B', 14);
            $this->pdf->Ln(20);
            $this->pdf->Cell(0, 0, utf8_decode('A quién pueda interesar:'), 0, 1);
            $this->pdf->Ln(15);
            $this->pdf->MultiCell(0, 10, utf8_decode("A través de la presente, yo [Nombre y apellido del director], director(a) de la E.T.R.P.A Alí Primera hago constar que: " . $datos['p_nombre'] . " " . $datos['s_nombre'] . " " . $datos['p_apellido'] . " " . $datos['s_apellido'] . ", con numero de cedula: V-" . $datos['cedula'] . ". Esta cursando '" . $datos['nivel'] . "' de Bachillerato, en la Sección: '" . $datos['seccion'] . "' , con Mención: '" . $datos['mencion'] . "'. En esta institución."), 0, 0);
            $this->pdf->Ln(10);
            $this->pdf->MultiCell(0, 10, utf8_decode("La presente constancia se entrega a petición de la parte interesada para los fines que le convengan a los " . $dataTime['mday'] . " días del mes de " . strftime('%b') . " del año " . $dataTime['year'] . "."), 0, 0);
            $this->pdf->Ln(20);
            $this->pdf->Cell(0, 0, utf8_decode('[Firma del director] [Sello de la institución]'), 0, 1, 'C');
            $this->pdf->Ln(20);
            $this->pdf->Cell(0, 0, utf8_decode('[Nombre y apellido del director]'), 0, 1, 'C');
            $this->pdf->Ln(20);
            $this->pdf->Cell(0, 0, utf8_decode('E.T.R.P.A Alí Primera'), 0, 1, 'C');
            // if ($movil === 'movil') {

            // } else {

            //     $this->pdf->Output('D');
            //     $_SESSION['message'] = "Documento generado correctamente";
            //     header("Location: " . __baseurl__ . "home/documents");
            //     exit;

            // }

            $this->pdf->Output('D');
            $_SESSION['message'] = "Documento generado correctamente";
            header("Location: " . __baseurl__ . "home/documents");
            exit;
        } elseif ($action === "retiro" && $motivo != '') {
            setlocale(LC_TIME, 'Spanish');
            $dataTime = getdate();
            $this->pdf->AddPage();
            $this->pdf->Image('public/img/logos/logo-ali.jpeg', 10, 10, 25);
            $this->pdf->SetFont('Arial', 'B', 19);
            $this->pdf->Ln(15);

            $this->pdf->MultiCell(190, 10, utf8_decode('Escuela Técnica Robinsoniana Petroquímica y Agroambiental Alí Primera'), 0, 'C', 0);
            $this->pdf->Ln(25);
            $this->pdf->SetFont('Arial', 'B', 17);
            $this->pdf->Cell(0, 0, 'CONSTANCIA DE RETIRO', 0, 1, 'C');
            $this->pdf->SetFont('Arial', 'B', 14);
            $this->pdf->Ln(20);

            $this->pdf->MultiCell(0, 10, utf8_decode("    A través de la presente, yo [Nombre y apellido del director], director(a) de la E.T.R.P.A Alí Primera hago constar que: " . $datos['p_nombre'] . " " . $datos['s_nombre'] . " " . $datos['p_apellido'] . " " . $datos['s_apellido'] . ", con numero de cedula: V-" . $datos['cedula'] . ". Cursante de '" . $datos['nivel'] . "' de Bachillerato, en la Sección: '" . $datos['seccion'] . "' , con Mención: '" . $datos['mencion'] . "'. Fue retirado de esta institución por su Representante: " . $datos['p_nombre_r'] . ' ' . $datos['p_apellido_r'] . ". Por Motivo: " . $motivo . "."), 0, 0);
            $this->pdf->Ln(10);
            $this->pdf->MultiCell(0, 10, utf8_decode("    La presente constancia se expide a los " . $dataTime['mday'] . " días del mes de " . strftime("%B") . " del año " . $dataTime['year'] . "."), 0, 0);
            $this->pdf->Ln(20);
            $this->pdf->Cell(0, 0, utf8_decode('[Firma del director] [Sello de la institución]'), 0, 1, 'C');
            $this->pdf->Ln(20);
            $this->pdf->Cell(0, 0, utf8_decode('[Nombre y apellido del director]'), 0, 1, 'C');
            $this->pdf->Ln(20);
            $this->pdf->Cell(0, 0, utf8_decode('E.T.R.P.A Alí Primera'), 0, 1, 'C');

            // if ($movil === 'movil') {
            //     $this->pdf->Output('D');
            //     $_SESSION['message'] = "Documento generado correctamente";
            //     header("Location: " . __baseurl__ . "home/documents");
            //     exit;
            // } else {

            //     $this->pdf->Output('D');
            //     $_SESSION['message'] = "Documento generado correctamente";
            //     header("Location: " . __baseurl__ . "home/documents");
            //     exit;
            // }
            $this->pdf->Output('D');
            $_SESSION['message'] = "Documento generado correctamente";
            header("Location: " . __baseurl__ . "home/documents");
            exit;
        } else {
            header("Location: " . __baseurl__ . "home/documents?errorGenerar");
        }
    }

    // cerrare sesion
    public function logOut()
    {
        session_unset(); // Eliminar todas las variables de sesión
        session_destroy(); // Destruir la sesión
        // Redirigir a la página de inicio o login
        header("Location: " . __baseurl__);  // Redirigimos a login en caso de error
        exit;
    }

    private function validarEntrada($valor)
    {
        $valor = trim($valor); // Eliminar espacios en blanco al inicio y al final

        if (empty($valor)) {
            return ""; // O podrías lanzar una excepción si los campos vacíos no son permitidos
        }

        // Detectar el tipo de dato y aplicar la validación correspondiente
        if (is_numeric($valor)) {
            $valor = filter_var($valor, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            $valor = floatval($valor); // Convertir a float si es un número
        } elseif (filter_var($valor, FILTER_VALIDATE_EMAIL)) {
            $valor = filter_var($valor, FILTER_SANITIZE_EMAIL);
        } elseif (preg_match('/^\d{4}-\d{2}-\d{2}$/', $valor)) { // Validar fecha (yyyy-mm-dd)
            // No se aplica sanitización especial, pero se podría validar el rango de fechas si es necesario
        } else {
            $valor = htmlspecialchars($valor, ENT_QUOTES, 'UTF-8'); // Escapar caracteres especiales
        }

        return $valor;
    }
}
