<?php

// error_reporting(0);
// ini_set('display_errors', 0);
class Home extends Controller
{
    public $view;
    private $id_student;
    private $id_teacher;

    // constructor
    public function __construct()
    {
        session_start();
        parent::__construct();

        $this->id_student = 0;
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
        if (isset($_SESSION['access']) && $_SESSION['access'] == true && $_SESSION['rol'] == 1) {
            $count_teacher       = $this->model->count_teacher();
            $count_student       = $this->model->count_student();
            $count_student_m     = $this->model->count_student_m();
            $count_student_f     = $this->model->count_student_f();
            $count_menciones = $this->model->count_students_by_mention();

            $ingresoEgreso  = $this->model->model_product_billing_count();
            $this->view->ingresoEgreso = json_encode($ingresoEgreso) ? json_encode($ingresoEgreso) : [];

            $montoPagosMatriculaDashboard  = $this->model->model_select_registration_payment();
            $this->view->montoPagosMatriculaDashboard = json_encode($montoPagosMatriculaDashboard) ? json_encode($montoPagosMatriculaDashboard) : [];

            $montoMensualidad  = $this->model->model_select_registration_monthly_payment();
            $this->view->montoMensualidad = json_encode($montoMensualidad) ? json_encode($montoMensualidad) : [];
            // print_r($count_menciones);
            $this->view->count_teacher       = $count_teacher ? $count_teacher : 0;
            $this->view->count_student       = $count_student ? $count_student : 0;
            $this->view->count_student_m     = $count_student_m ? $count_student_m : 0;
            $this->view->count_student_f     = $count_student_f ? $count_student_f : 0;
            $this->view->count_student_petro = json_encode($count_menciones) ? json_encode($count_menciones) : [];
            $this->view->render('admin/dashboard');
        } elseif ($_SESSION['access'] === true && $_SESSION['rol'] === 2) {
            header("Location: " . __baseurl__ . "teacher/dashboard");  // Redirigimos al dashboard sin pasar parámetros en la URL
        } else {
            $_SESSION['message'] = "Debe iniciar sesion para ingresar al sistema";  // Guardamos el mensaje en la sesión
            header("Location: " . __baseurl__);  // Redirigimos a login en caso de error
            exit;
        }
    }

    // accountingDashboard
    public function accountingDashboard()
    {
        if (isset($_SESSION['access']) && $_SESSION['access'] == true && $_SESSION['rol'] == 1) {
            $expenses_category = $this->model->model_select_expenses_category();
            $this->view->expenses_category = $expenses_category ? $expenses_category : [];

            $income_source = $this->model->model_select_income_source();
            $this->view->income_source = $income_source ? $income_source : [];

            $montoPagosMatriculaDashboard  = $this->model->model_select_registration_payment();
            $this->view->montoPagosMatriculaDashboard = json_encode($montoPagosMatriculaDashboard) ? json_encode($montoPagosMatriculaDashboard) : [];

            $montoMensualidad  = $this->model->model_select_registration_monthly_payment();
            $this->view->montoMensualidad = json_encode($montoMensualidad) ? json_encode($montoMensualidad) : [];

            $receivePayment = $this->model->model_receive_payments();
            $this->view->receivePayment = $receivePayment ? $receivePayment : 0;

            $sendPayment = $this->model->model_send_payments();
            $this->view->sendPayment = $sendPayment ? $sendPayment : 0;

            $profit = $receivePayment[0]['total_amount'] - $sendPayment[0]['total_amount'];
            $this->view->profit = $profit ? $profit : 0;

            $benefit = $profit / $receivePayment[0]['total_amount'] * 100;
            $this->view->benefit = number_format($benefit, 2) ? number_format($benefit, 2) : 0;

            $teacherPayments = $this->model->model_teacher_payments();
            $this->view->teacherPayment = $teacherPayments ? $teacherPayments : 0;

            $this->view->render('admin/accounting-dashboard');
        } else {
            $_SESSION['message'] = "Debe iniciar sesion para ingresar al sistema";  // Guardamos el mensaje en la sesión
            header("Location: " . __baseurl__);
            exit;
        }
    }

    public function filtrar_grafica()
    {
        // Get raw POST data
        $rawData = file_get_contents("php://input");

        // Decode JSON data
        $postData = json_decode($rawData, true);
        $fecha_inicio = $postData['fecha_inicio'] ?? null;
        $fecha_fin = $postData['fecha_fin'] ?? null;
        $result = $this->model->model_filtrar_grafica($postData['tipo'], $postData['categoria'], $fecha_inicio, $fecha_fin);

        echo json_encode($result);
    }

    // vista registrar servicio
    public function view_register_service_payment()
    {
        if (isset($_SESSION['access']) && $_SESSION['access'] == true && $_SESSION['rol'] == 1) {
            $payment_method = $this->model->model_select_payment_method();
            $expenses_category = $this->model->model_select_expenses_category();
            $this->view->payment_mehtod = $payment_method ? $payment_method : [];
            $this->view->income_source = $expenses_category ? $expenses_category : [];
            $this->view->render('admin/register-service-payment');
        } else {
            $_SESSION['message'] = "Debe iniciar sesion para ingresar al sistema";  // Guardamos el mensaje en la sesión
            header("Location: " . __baseurl__);
            exit;
        }
    }

    public function register_service_payment()
    {
        $bills        = $this->validarEntrada($_POST['servicio']);
        $id_teacher        = $this->validarEntrada($_POST['id-docente']);
        $amount        = $this->validarEntrada($_POST['monto']);
        $payment_method      = $this->validarEntrada($_POST['metodo_pago']);
        $reference      = $this->validarEntrada($_POST['referencia']);
        $nota      = $this->validarEntrada($_POST['nota']);
        $date_payment      = $this->validarEntrada($_POST['fecha']);


        if ($bills != "" && $amount != "" && $payment_method != "" && $date_payment != "" || $bills == 0) {
            $result = $this->model->model_register_service_payment(
                $bills,
                $id_teacher,
                $amount,
                $payment_method,
                $reference,
                $nota,
                $date_payment
            );
            if ($result == true) {
                $_SESSION['message'] = "Pago registrado exitosamente";  // Guardamos el mensaje en la sesión
                header("Location: " . __baseurl__ . "home/view_register_service_payment");  // Redirigimos a la vista de horario sin pasar parámetros en la URL
                exit;
            } else {
                $_SESSION['message'] = "Error al registrar el pago";  // Guardamos el mensaje en la sesión
                header("Location: " . __baseurl__ . "home/view_register_service_payment");  // Redirigimos a la vista de horario con error
                exit;
            }
        } else {
            $_SESSION['message'] = "Ingrese todos los datos";
            header("Location: " . __baseurl__ . "home/view_register_service_payment");
            exit;
        }
    }

    // vista registrar pago recibido
    public function view_register_receive_payment()
    {
        if (isset($_SESSION['access']) && $_SESSION['access'] == true && $_SESSION['rol'] == 1) {
            $payment_method = $this->model->model_select_payment_method();
            $income_source = $this->model->model_select_income_source();
            $this->view->payment_mehtod = $payment_method ? $payment_method : [];
            $this->view->income_source = $income_source ? $income_source : [];
            $this->view->render('admin/register-receive-payment');
        } else {
            $_SESSION['message'] = "Debe iniciar sesion para ingresar al sistema";  // Guardamos el mensaje en la sesión
            header("Location: " . __baseurl__);
            exit;
        }
    }

    public function register_receive_payment()
    {
        $revenue        = $this->validarEntrada($_POST['servicio']);
        $id_student        = $this->validarEntrada($_POST['id-estudiante']);
        $amount        = $this->validarEntrada($_POST['monto']);
        $payment_method      = $this->validarEntrada($_POST['metodo_pago']);
        $reference      = $this->validarEntrada($_POST['referencia']);
        $nota      = $this->validarEntrada($_POST['nota']);
        $date_payment      = $this->validarEntrada($_POST['fecha']);
        $start_monthly_payment      = $this->validarEntrada($_POST['start_monthly_payment']);
        $end_monthly_payment      = $this->validarEntrada($_POST['end_monthly_payment']);

        if ($revenue != "" && $amount != "" && $payment_method != "" && $date_payment != "" || $revenue == 0) {
            $result = $this->model->model_register_receive_payment(
                $id_student,
                $revenue,
                $amount,
                $payment_method,
                $reference,
                $nota,
                $date_payment,
                $start_monthly_payment,
                $end_monthly_payment
            );
            if ($result == true) {
                $_SESSION['message'] = "Pago registrado exitosamente";  // Guardamos el mensaje en la sesión
                header("Location: " . __baseurl__ . "home/view_register_receive_payment");  // Redirigimos a la vista de horario sin pasar parámetros en la URL
                exit;
            } else {
                $_SESSION['message'] = "Error al registrar el pago";  // Guardamos el mensaje en la sesión
                header("Location: " . __baseurl__ . "home/view_register_receive_payment");  // Redirigimos a la vista de horario con error
                exit;
            }
        } else {
            $_SESSION['message'] = "Ingrese todos los datos";
            header("Location: " . __baseurl__ . "home/view_register_receive_payment");
            exit;
        }
    }

    // registrar-estudiantes
    public function register_student_view()
    {
        if (isset($_SESSION['access']) && $_SESSION['access'] == true && $_SESSION['rol'] == 1) {
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
                $documentos
            );
        } else {
            header("Location: " . __baseurl__ . "home/register_student_view?datos");
        }
    }

    // registrar-docente
    public function register_teacher_view()
    {
        if (isset($_SESSION['access']) && $_SESSION['access'] == true && $_SESSION['rol'] == 1) {

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
        if (isset($_SESSION['access']) && $_SESSION['access'] == true && $_SESSION['rol'] == 1) {

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

    public function filtrar_estudiantes()
    {
        // Get raw POST data
        $rawData = file_get_contents("php://input");

        // Decode JSON data
        $postData = json_decode($rawData, true);
        $result = $this->model->model_filtrar_estudiantes($postData['query']);

        echo json_encode($result);
    }

    public function filtrar_docente()
    {
        // Get raw POST data
        $rawData = file_get_contents("php://input");

        // Decode JSON data
        $postData = json_decode($rawData, true);
        $result = $this->model->model_filtrar_docentes($postData['query']);

        echo json_encode($result);
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
        if (isset($_SESSION['access']) && $_SESSION['access'] == true && $_SESSION['rol'] == 1) {
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
                $_SESSION['cedula'] = $cedula;
                $_SESSION['opcion'] = $opcion;
                header("Location: " . __baseurl__ . "home/view_data_teacher");
                exit;
            } elseif ($opcion == "representante") {
                $result = $this->model->consulting_cedula($cedula, $opcion);
                $this->view_data_representante($result);
            }
        } else {

            header("Location: " . __baseurl__ . "home/consulting_view?datos");
        }
    }

    // view create sections
    public function view_create_sections()
    {
        if (isset($_SESSION['access']) && $_SESSION['access'] == true && $_SESSION['rol'] == 1) {
            $result = $this->model->model_select_teacher();
            $sections = $this->model->model_select_sections();
            $grades = $this->model->model_select_grades();
            $mentions = $this->model->model_select_mentions();
            $this->view->array = $result ? $result : [];
            $this->view->sections = $sections ? $sections : [];
            $this->view->grades = $grades ? $grades : [];
            $this->view->mentions = $mentions ? $mentions : [];
            $this->view->render('admin/view_create_sections');
        } else {
            $_SESSION['message'] = "Debe iniciar sesion para ingresar al sistema";  // Guardamos el mensaje en la sesión
            header("Location: " . __baseurl__);
            exit;
        }
    }

    public  function submit_sections()
    {
        $estudiantes = $_POST['estudiantes'];
        $grade = $_POST['grade'];
        $section = $_POST['section'];
        $mention = $_POST['mention'];

        if (!empty($estudiantes) && $grade != 0 && $section != 0 && $mention != 0) {
            $result = $this->model->model_register_sections($grade, $section, $mention, $estudiantes);
            if ($result) {
                $_SESSION['message'] = "Aula registrada exitosamente";  // Guardamos el mensaje en la sesión
                header("Location: " . __baseurl__ . "home/view_create_sections");  // Redirigimos a la vista de horario sin pasar parámetros en la URL
                exit;
            } else {
                $_SESSION['message'] = "Error al registrar el aula";  // Guardamos el mensaje en la sesión
                header("Location: " . __baseurl__ . "home/view_create_sections");  // Redirigimos a la vista de horario con error
                exit;
            }
        } else {
            $_SESSION['message'] = "Seleccione al menos un estudiante y complete todos los campos";  // Guardamos el mensaje en la sesión
            header("Location: " . __baseurl__ . "home/view_create_sections?error");  // Redirigimos a la vista de horario con error
            exit;
        }
    }

    public  function view_consulting_sections()
    {
        if (isset($_SESSION['access']) && $_SESSION['access'] == true && $_SESSION['rol'] == 1) {
            $result = $this->model->model_select_teacher();
            $sections = $this->model->model_select_sections();
            $grades = $this->model->model_select_grades();
            $mentions = $this->model->model_select_mentions();
            $this->view->array = $result ? $result : [];
            $this->view->sections = $sections ? $sections : [];
            $this->view->grades = $grades ? $grades : [];
            $this->view->mentions = $mentions ? $mentions : [];
            $this->view->render('admin/view_consulting_sections');
        } else {
            $_SESSION['message'] = "Debe iniciar sesion para ingresar al sistema";  // Guardamos el mensaje en la sesión
            header("Location: " . __baseurl__);
            exit;
        }
    }

    public function consulting_classroom()
    {
        // Get raw POST data
        $rawData = file_get_contents("php://input");

        // Decode JSON data
        $postData = json_decode($rawData, true);
        $result = $this->model->consulting_classroom($postData['grade'],  $postData['section'], $postData['mention']);;

        echo json_encode($result);
    }

    // schedule_view
    public function schedule_view()
    {
        if (isset($_SESSION['access']) && $_SESSION['access'] == true && $_SESSION['rol'] == 1) {
            $result = $this->model->model_select_teacher();
            $sections = $this->model->model_select_sections();
            $grades = $this->model->model_select_grades();
            $mentions = $this->model->model_select_mentions();
            $this->view->array = $result ? $result : [];
            $this->view->sections = $sections ? $sections : [];
            $this->view->grades = $grades ? $grades : [];
            $this->view->mentions = $mentions ? $mentions : [];
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
        if (isset($_SESSION['access']) && $_SESSION['access'] == true && $_SESSION['rol'] == 1) {
            // Si ya se pasó información en $data (por ejemplo, desde una consulta), se utiliza esa
            if (isset($_SESSION['cedula']) && isset($_SESSION['opcion'])) {
                $cedula = $_SESSION['cedula'];
                $opcion = $_SESSION['opcion'];
                // Se consulta la información actualizada del estudiante según su ID
                $data = $this->model->consulting_cedula($cedula, $opcion);
                unset($_SESSION['cedula']);  // Eliminamos para que se comporte como flash data
                unset($_SESSION['opcion']);  // Eliminamos para que se comporte como flash data
                $this->id_student = $data['a_id'];
                $payment = $this->model->model_consulting_student_payments($this->id_student);
                if ($data) {
                    $this->view->data = $data;
                    $this->view->payments = $payment;
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
    public function view_data_teacher()
    {
        if (isset($_SESSION['access']) && $_SESSION['access'] == true && $_SESSION['rol'] == 1) {
            // $this->view->data = $data;
            // $this->view->render('admin/view-data-teacher');

            // Si ya se pasó información en $data (por ejemplo, desde una consulta), se utiliza esa
            if (isset($_SESSION['cedula']) && isset($_SESSION['opcion'])) {
                $cedula = $_SESSION['cedula'];
                $opcion = $_SESSION['opcion'];
                // Se consulta la información actualizada del estudiante según su ID
                $data = $this->model->consulting_cedula($cedula, $opcion);
                unset($_SESSION['cedula']);  // Eliminamos para que se comporte como flash data
                unset($_SESSION['opcion']);  // Eliminamos para que se comporte como flash data
                $this->id_teacher = $data['id'];
                $payment = $this->model->model_consulting_teacher_payments($this->id_teacher);
                if ($data) {
                    $this->view->data = $data;
                    $this->view->payments = $payment;
                    $this->view->render('admin/view-data-teacher');
                }
            }
            // Caso contrario, se asume que se llegó desde un update y se busca el ID en la sesión
            elseif (isset($_SESSION['updated_teacher'])) {
                $teacherId = $_SESSION['updated_teacher'];
                // Se consulta la información actualizada del estudiante según su ID
                $data = $this->model->consulting_cedula($teacherId, 'docentes');
                unset($_SESSION['updated_teacher']);  // Eliminamos para que se comporte como flash data
                if ($data) {
                    $data['message'] = "Los datos se han actualizado correctamente.";
                    $this->view->data = $data;
                    $this->view->render('admin/view-data-teacher');
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

    // visualizar datos de representante
    public function view_data_representante($data)
    {
        if (isset($_SESSION['access']) && $_SESSION['access'] == true && $_SESSION['rol'] == 1) {
            $this->view->data = $data ? $data : [];
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
        $avatar      = !empty($_FILES['logo']['name']) ? $this->validarImagen($_FILES['logo']) : "";
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
                    $cedula_r,
                    $avatar
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
        $avatar      = !empty($_FILES['logo']['name']) ? $this->validarImagen($_FILES['logo']) : "";
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
                    $sexto,
                    $avatar
                );
                if ($data === true) {
                    // Almacenar el mensaje de éxito y el ID (o la información) del estudiante en la sesión

                    $_SESSION['updated_teacher'] = $cedula;  // Asumiendo que 'a_id' es el ID del teacher actualizado

                    // Redirigir a la vista sin pasar parámetros en la URL
                    header("Location: " . __baseurl__ . "home/view_data_teacher");
                    exit;
                } else {
                    $_SESSION['message'] = "Error al actualizar el registro";
                    $_SESSION['updated_teacher'] = $cedula;  // En caso de error, se puede conservar el ID original
                    header("Location: " . __baseurl__ . "home/view_data_teacher");
                    exit;
                }
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
        $id        = $this->validarEntrada($_POST['id']);
        $logo      = !empty($_FILES['logo']['name']) ? $this->validarImagen($_FILES['logo']) : "";
        $nombre    = $this->validarEntrada($_POST['nombre']);
        $director  = $this->validarEntrada($_POST['director']);
        $monto_matricula  = $this->validarEntrada($_POST['monto_matricula']);
        $monto_mensualidad  = $this->validarEntrada($_POST['monto_mensualidad']);
        $ubicacion = $this->validarEntrada($_POST['ubicacion']);
        $telefono  = $this->validarEntrada($_POST['telefono']);
        $correo    = $this->validarEntrada($_POST['correo']);
        $codigo    = $this->validarEntrada($_POST['codigo']);

        if (
            $nombre    != "" &&
            $ubicacion != "" &&
            $director  != "" &&
            $monto_matricula  != "" &&
            $monto_mensualidad  != "" &&
            $telefono  != "" &&
            $codigo    != ""
        ) {
            $data = $this->model->model_edit_institution(
                $id,
                $nombre,
                $director,
                $monto_matricula,
                $monto_mensualidad,
                $ubicacion,
                $telefono,
                $correo,
                $codigo,
                $logo
            );

            if ($data === true) {
                $_SESSION['message'] = "Informacion actualizada correctamenta";
                header("Location: " . __baseurl__ . "home/view_institution");
            } else {
                $_SESSION['message'] = "Error al actualizar los datos";
                header("Location: " . __baseurl__ . "home/view_institution");
                exit;
            }
        } else {
            header("Location: " . __baseurl__ . "home/institution?datos");
        }
    }

    // tablas
    public function tables()
    {
        if (isset($_SESSION['access']) && $_SESSION['access'] == true && $_SESSION['rol'] == 1) {
            $data = $this->model->read_all();
            $sections = $this->model->model_select_sections();
            $grades = $this->model->model_select_grades();
            $mentions = $this->model->model_select_mentions();
            $this->view->grades = $grades ? $grades : [];
            $this->view->sections = $sections ? $sections : [];
            $this->view->mentions = $mentions ? $mentions : [];
            $this->view->array = $data ? $data : [];
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
        if (isset($_SESSION['access']) && $_SESSION['access'] == true && $_SESSION['rol'] == 1) {

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
        if (isset($_SESSION['access']) && $_SESSION['access'] == true && $_SESSION['rol'] == 1) {
            $datos = $this->model->institution();
            $mentions = $this->model->model_select_mentions();
            $expenses = $this->model->model_select_expenses_category();
            $income_source = $this->model->model_select_income_source();
            $this->view->income_source = $income_source ? $income_source : [];
            $this->view->expenses = $expenses ? $expenses : [];
            $this->view->institution = $datos ? $datos : [];
            $this->view->mentions = $mentions ? $mentions : [];
            $this->view->render('admin/view-data-institution');
        } else {
            $_SESSION['message'] = "Debe iniciar sesion para ingresar al sistema";  // Guardamos el mensaje en la sesión
            header("Location: " . __baseurl__);
            exit;
        }
    }

    public function delete_mention()
    {
        // Get raw POST data
        $rawData = file_get_contents("php://input");

        // Decode JSON data
        $postData = json_decode($rawData, true);
        $result = $this->model->delete_mention($postData['id']);

        echo json_encode($result);
    }

    public function insert_mention()
    {
        // Get raw POST data
        $rawData = file_get_contents("php://input");

        // Decode JSON data
        $postData = json_decode($rawData, true);
        $result = $this->model->insert_mention($postData['name']);

        echo json_encode($result);
    }

    public function delete_expense()
    {
        // Get raw POST data
        $rawData = file_get_contents("php://input");

        // Decode JSON data
        $postData = json_decode($rawData, true);
        $result = $this->model->delete_expense($postData['id']);

        echo json_encode($result);
    }

    public function insert_expense()
    {
        // Get raw POST data
        $rawData = file_get_contents("php://input");

        // Decode JSON data
        $postData = json_decode($rawData, true);
        $result = $this->model->insert_expense($postData['name']);

        echo json_encode($result);
    }

    public function delete_income()
    {
        // Get raw POST data
        $rawData = file_get_contents("php://input");

        // Decode JSON data
        $postData = json_decode($rawData, true);
        $result = $this->model->delete_income($postData['id']);

        echo json_encode($result);
    }

    public function insert_income()
    {
        // Get raw POST data
        $rawData = file_get_contents("php://input");

        // Decode JSON data
        $postData = json_decode($rawData, true);
        $result = $this->model->insert_income($postData['name']);

        echo json_encode($result);
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

    private function validarImagen($imagen)
    {

        $tipos_permitidos = ['png', 'jpg', 'jpeg', 'svg', 'webp'];
        $extension = pathinfo($imagen['name'], PATHINFO_EXTENSION);
        $extension = strtolower($extension);

        // 1. Validar tipo de archivo
        if (!in_array($extension, $tipos_permitidos)) {
            return ['error' => 'Tipo de archivo no permitido. Solo se aceptan: ' . implode(', ', $tipos_permitidos)];
        }

        // 2. Comprimir la imagen
        $ruta_temporal = $imagen['tmp_name'];
        $nombre_original = $imagen['name'];
        $tipo = $imagen['type'];
        $tamanio_original = $imagen['size'];
        $imagen_comprimida = null;

        // Definir una calidad de compresión (puedes ajustarla)
        $calidad_jpeg = 75;
        $calidad_webp = 80;

        if ($extension === 'jpg' || $extension === 'jpeg') {
            $imagen_source = imagecreatefromjpeg($ruta_temporal);
            if ($imagen_source) {
                ob_start();
                imagejpeg($imagen_source, null, $calidad_jpeg);
                $imagen_comprimida = ob_get_contents();
                ob_end_clean();
                imagedestroy($imagen_source);
            } else {
                return ['error' => 'Error al procesar la imagen JPEG.'];
            }
        } elseif ($extension === 'png') {
            $imagen_source = imagecreatefrompng($ruta_temporal);
            if ($imagen_source) {
                // La compresión de PNG se puede hacer con el nivel de compresión (0-9, siendo 9 la máxima compresión)
                // y se guarda sin pérdida, por lo que aquí principalmente optimizamos.
                ob_start();
                imagepng($imagen_source, null, 9); // Nivel de compresión 9
                $imagen_comprimida = ob_get_contents();
                ob_end_clean();
                imagedestroy($imagen_source);
            } else {
                return ['error' => 'Error al procesar la imagen PNG.'];
            }
        } elseif ($extension === 'webp') {
            $imagen_source = imagecreatefromwebp($ruta_temporal);
            if ($imagen_source) {
                ob_start();
                imagewebp($imagen_source, null, $calidad_webp);
                $imagen_comprimida = ob_get_contents();
                ob_end_clean();
                imagedestroy($imagen_source);
            } else {
                return ['error' => 'Error al procesar la imagen WebP.'];
            }
        } elseif ($extension === 'svg') {
            // Los archivos SVG ya son basados en vectores y suelen ser ligeros.
            // Aquí simplemente leemos el contenido del archivo.
            $imagen_comprimida = file_get_contents($ruta_temporal);
            if ($imagen_comprimida === false) {
                return ['error' => 'Error al leer el archivo SVG.'];
            }
        }

        // 3. Retornar la imagen con los cambios y validaciones
        if ($imagen_comprimida !== null) {
            return [
                'nombre' => $nombre_original,
                'tipo' => $tipo,
                'datos' => $imagen_comprimida,
                'tamanio_original' => $tamanio_original,
                'tamanio_comprimido' => strlen($imagen_comprimida),
                'extension' => $extension
            ];
        }

        return ['error' => 'Ocurrió un error al procesar la imagen.'];
    }
}
