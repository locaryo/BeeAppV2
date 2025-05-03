<?php
class Teacher extends Controller
{
    public $view;

    public function __construct()
    {
        session_start();
        parent::__construct();
        $this->view->horarios = "";
        $this->view->array               = [];
        $this->view->sections            = [];
        $this->view->grades              = [];
        $this->view->mentions            = [];
    }

    // dashboard
    public function dashboard()
    {
        if (isset($_SESSION['access']) && $_SESSION['access'] == true && $_SESSION['rol'] == 2) {
            $count_teacher       = $this->model->count_teacher();
            $count_student       = $this->model->count_student();
            $count_student_m     = $this->model->count_student_m();
            $count_student_f     = $this->model->count_student_f();
            $count_student_petro = $this->model->count_student_petro();
            $count_student_meca  = $this->model->count_student_meca();
            $count_student_elec  = $this->model->count_student_elec();

            $this->view->count_teacher       = $count_teacher;
            $this->view->count_student       = $count_student;
            $this->view->count_student_m     = $count_student_m;
            $this->view->count_student_f     = $count_student_f;
            $this->view->count_student_petro = json_encode($count_student_petro);
            $this->view->count_student_meca  = json_encode($count_student_meca);
            $this->view->count_student_elec  = json_encode($count_student_elec);
            $this->view->render('teacher/dashboard');
        } else {
            $_SESSION['message'] = "Debe iniciar sesion para ingresar al sistema";  // Guardamos el mensaje en la sesión
            header("Location: " . __baseurl__);  // Redirigimos a login en caso de error
            exit;
        }
    }

    public function createUserTeacher()
    {
        $username = $this->validarEntrada($_POST['username']);
        $password = $this->validarEntrada($_POST['password']);

        if (!empty($username) && !empty($password)) {
            $result = $this->model->model_register_teacher_user($username, $password); // Llamar al modelo para crear el usuario
            if ($result == true) {
                $_SESSION['message'] = "Usuario creado correctamente";  // Guardamos el mensaje en la sesión
                header("Location: " . __baseurl__ . "teacher/dashboard");  // Redirigimos a dashboard en caso de éxito
                exit;
            } else {
                $_SESSION['message'] = "Error al crear el usuario";  // Guardamos el mensaje en la sesión
                header("Location: " . __baseurl__ . "teacher/dashboard");  // Redirigimos a dashboard en caso de error
                exit;
            }
        } else {
            $_SESSION['message'] = "Los campos no pueden estar vacíos";  // Guardamos el mensaje en la sesión
            header("Location: " . __baseurl__ . "teacher/dashboard");  // Redirigimos a dashboard en caso de error
            exit;
        }
    }

    // consultar horarios para docentes
    public function schedule_view()
    {
        if (isset($_SESSION['access']) && $_SESSION['access'] == true && $_SESSION['rol'] == 2) {

            $id_teacher = (string) $_SESSION['id_docente']; // Forzamos a string
            $horarios = $this->model->model_select_schedule_teacher();
            $horarios_filtrados = [];

            foreach ($horarios as $horario_data) {
                // Decodificamos los campos
                $docentes     = json_decode($horario_data['docente'], true);
                $dias_semana  = json_decode($horario_data['dia_semana'], true);
                $horas_inicio = json_decode($horario_data['hora_inicio'], true);
                $horas_fin    = json_decode($horario_data['hora_fin'], true);
                $materias     = json_decode($horario_data['materia'], true);

                // Validamos que todos sean arrays y del mismo tamaño
                if (
                    is_array($docentes) && is_array($dias_semana) && is_array($horas_inicio) &&
                    is_array($horas_fin) && is_array($materias) &&
                    count($docentes) === count($horas_inicio) &&
                    count($docentes) === count($horas_fin) &&
                    count($docentes) === count($materias)
                ) {
                    foreach (array_keys($docentes) as $indice) {
                        // Comparamos ambos como string por seguridad
                        $docente_id = (string) trim($docentes[$indice]);
                        if ($docente_id === (string)$id_teacher) {
                            $horario_docente = [
                                'seccion'    => $horario_data['seccion'],
                                'nivel'    => $horario_data['nivel'],
                                'dia_semana'    => $dias_semana[$indice] ?? null,
                                'hora_inicio' => isset($horas_inicio[$indice]) ? date('H:i', strtotime($horas_inicio[$indice])) : null,
                                'hora_fin'    => isset($horas_fin[$indice]) ? date('H:i', strtotime($horas_fin[$indice])) : null,
                                'materia'     => $materias[$indice] ?? null,
                            ];
                            $horarios_filtrados[] = $horario_docente;
                        }
                    }
                }
            }
            $this->view->horarios = $horarios_filtrados;
            $this->view->render('teacher/schedule_view');
        } else {
            $_SESSION['message'] = "Debe iniciar sesion para ingresar al sistema";  // Guardamos el mensaje en la sesión
            header("Location: " . __baseurl__);  // Redirigimos a login en caso de error
            exit;
        }
    }

    // consultar seccion que atiende el docente
    public function sections_view()
    {
        if (isset($_SESSION['access']) && $_SESSION['access'] == true && $_SESSION['rol'] == 2) {
            $id_teacher = (string) $_SESSION['id_docente']; // Forzamos a string
            $horarios = $this->model->model_select_schedule_teacher();
            $horarios_filtrados = [];

            foreach ($horarios as $horario_data) {
                // Decodificamos los campos
                $docentes     = json_decode($horario_data['docente'], true);
                $materias     = json_decode($horario_data['materia'], true);

                // Validamos que todos sean arrays y del mismo tamaño
                if (
                    is_array($docentes) && is_array($materias) &&
                    count($docentes) === count($materias)
                ) {
                    foreach (array_keys($docentes) as $indice) {
                        // Comparamos ambos como string por seguridad
                        $docente_id = (string) trim($docentes[$indice]);
                        if ($docente_id === (string)$id_teacher) {
                            $horario_docente = [
                                'seccion'    => $horario_data['seccion'],
                                'nivel'    => $horario_data['nivel'],
                                'materia'     => $materias[$indice] ?? null,
                            ];
                            $horarios_filtrados[] = $horario_docente;
                        }
                    }
                }
            }
            $this->view->horarios = $horarios_filtrados;
            $this->view->render('teacher/sections_view');
        } else {
            $_SESSION['message'] = "Debe iniciar sesion para ingresar al sistema";  // Guardamos el mensaje en la sesión
            header("Location: " . __baseurl__);  // Redirigimos a login en caso de error
            exit;
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
