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
        $this->view->niveles            = [];
        $this->view->secciones          = [];
        $this->view->materias           = [];
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
    public function asign_ratings_view()
    {
        if (isset($_SESSION['access']) && $_SESSION['access'] == true && $_SESSION['rol'] == 2) {
            $id_teacher = (string) $_SESSION['id_docente']; // Forzamos a string
            $horarios = $this->model->model_select_schedule_teacher();
            $horarios_filtrados = [];
            $vistos = [];

            foreach ($horarios as $horario_data) {
                $docentes = json_decode($horario_data['docente'], true);
                $materias = json_decode($horario_data['materia'], true);

                if (
                    is_array($docentes) && is_array($materias) &&
                    count($docentes) === count($materias)
                ) {
                    foreach (array_keys($docentes) as $indice) {
                        $docente_id = (string) trim($docentes[$indice]);
                        $materia    = $materias[$indice] ?? null;
                        $seccion    = $horario_data['seccion'];
                        $nivel      = $horario_data['nivel'];

                        $clave_unica = "$materia|$seccion|$nivel"; // Clave única para evitar duplicados

                        if ($docente_id === (string)$id_teacher && !isset($vistos[$clave_unica])) {
                            $horarios_filtrados[] = [
                                'materia' => $materia,
                                'seccion' => $seccion,
                                'nivel'   => $nivel,
                            ];
                            $vistos[$clave_unica] = true;
                        }
                    }
                }
            }
            $niveles = [];
            $secciones = [];
            $materias = [];

            foreach ($horarios_filtrados as $item) {
                $niveles[$item['nivel']] = $item['nivel'];
                $secciones[$item['seccion']] = $item['seccion'];
                $materias[$item['materia']] = $item['materia'];
            }

            $this->view->niveles = array_values($niveles);
            $this->view->secciones = array_values($secciones);
            $this->view->materias = array_values($materias);
            $this->view->render('teacher/asign_ratings_view');
        } else {
            $_SESSION['message'] = "Debe iniciar sesion para ingresar al sistema";  // Guardamos el mensaje en la sesión
            header("Location: " . __baseurl__);  // Redirigimos a login en caso de error
            exit;
        }
    }

    public function filtrar_classroom()
    {
        // Get raw POST data
        $rawData = file_get_contents("php://input");

        // Decode JSON data
        $postData = json_decode($rawData, true);
        $result = $this->model->model_filtrar_classroom($postData['section'], $postData['grade']);

        echo json_encode($result);
    }

    public function save_ratings()
    {
        $teacherId = $_SESSION['id_docente'];
        $mention = $this->validarEntrada($_POST['materia']);
        $section = $this->validarEntrada($_POST['seccion']);
        $grade = $this->validarEntrada($_POST['nivel']);

        // Verificar si ya existen notas para esta combinación
        $sectionId = $this->model->getSectionId($section);
        $gradeId = $this->model->getGradeId($grade);

        $exists = $this->model->ratings_exist($teacherId, $mention, $sectionId, $gradeId);
        if ($exists) {
            $_SESSION['message'] = "Ya existen notas registradas para esta sección, curso y grado.";
            header("Location: " . __baseurl__ . "teacher/asign_ratings_view");
            exit;
        }

        // Insertar las notas
        if (isset($_POST['notas']) && is_array($_POST['notas'])) {
            foreach ($_POST['notas'] as $estudianteId => $notas) {
                foreach ($notas as $nota) {
                    if (trim($nota) !== '') {
                        $result = $this->model->model_register_rating(
                            $estudianteId,
                            $teacherId,
                            $nota,
                            $mention,
                            $sectionId,
                            $gradeId
                        );

                        if ($result) {
                            $_SESSION['message'] = "Notas guardadas correctamente";
                            header("Location: " . __baseurl__ . "teacher/asign_ratings_view");
                            exit;
                        } else {
                            $_SESSION['message'] = "Error al guardar las notas";
                            header("Location: " . __baseurl__ . "teacher/asign_ratings_view");
                            exit;
                        }
                    }
                }
            }
        } else {
            $_SESSION['message'] = "No se han recibido notas";
            header("Location: " . __baseurl__ . "teacher/asign_ratings_view");
            exit;
        }
    }

    // consultar seccion que atiende el docente
    public function list_ratings_view()
    {
        if (isset($_SESSION['access']) && $_SESSION['access'] == true && $_SESSION['rol'] == 2) {
            $id_teacher = (string) $_SESSION['id_docente']; // Forzamos a string
            $horarios = $this->model->model_select_schedule_teacher();
            $horarios_filtrados = [];
            $vistos = [];

            foreach ($horarios as $horario_data) {
                $docentes = json_decode($horario_data['docente'], true);
                $materias = json_decode($horario_data['materia'], true);

                if (
                    is_array($docentes) && is_array($materias) &&
                    count($docentes) === count($materias)
                ) {
                    foreach (array_keys($docentes) as $indice) {
                        $docente_id = (string) trim($docentes[$indice]);
                        $materia    = $materias[$indice] ?? null;
                        $seccion    = $horario_data['seccion'];
                        $nivel      = $horario_data['nivel'];

                        $clave_unica = "$materia|$seccion|$nivel"; // Clave única para evitar duplicados

                        if ($docente_id === (string)$id_teacher && !isset($vistos[$clave_unica])) {
                            $horarios_filtrados[] = [
                                'materia' => $materia,
                                'seccion' => $seccion,
                                'nivel'   => $nivel,
                            ];
                            $vistos[$clave_unica] = true;
                        }
                    }
                }
            }
            $niveles = [];
            $secciones = [];
            $materias = [];

            foreach ($horarios_filtrados as $item) {
                $niveles[$item['nivel']] = $item['nivel'];
                $secciones[$item['seccion']] = $item['seccion'];
                $materias[$item['materia']] = $item['materia'];
            }

            $this->view->niveles = array_values($niveles);
            $this->view->secciones = array_values($secciones);
            $this->view->materias = array_values($materias);
            $this->view->render('teacher/list_ratings_view');
        } else {
            $_SESSION['message'] = "Debe iniciar sesion para ingresar al sistema";  // Guardamos el mensaje en la sesión
            header("Location: " . __baseurl__);  // Redirigimos a login en caso de error
            exit;
        }
    }

    public function filtrar_ratings()
    {
        // Get raw POST data
        $rawData = file_get_contents("php://input");

        // Decode JSON data
        $postData = json_decode($rawData, true);
        $result = $this->model->model_filtrar_ratings($postData['materia'], $postData['section'], $postData['grade']);

        echo json_encode($result);
    }

    public function edit_ratings()
    {
        $teacherId = $_SESSION['id_docente'];
        $mention = $this->validarEntrada($_POST['materia']);
        $section = $this->validarEntrada($_POST['seccion']);
        $grade = $this->validarEntrada($_POST['nivel']);

        $sectionId = $this->model->getSectionId($section);
        $gradeId = $this->model->getGradeId($grade);

        $success = true; // bandera de éxito

        if (isset($_POST['notas']) && is_array($_POST['notas'])) {
            foreach ($_POST['notas'] as $estudianteId => $notas) {
                $notasIds = $_POST['notas_id'][$estudianteId] ?? [];

                foreach ($notas as $i => $nota) {
                    $idNota = $notasIds[$i] ?? null;

                    if (trim($nota) !== '') {
                        $result = $this->model->model_edit_rating(
                            $idNota,
                            $estudianteId,
                            $teacherId,
                            $nota,
                            $mention,
                            $sectionId,
                            $gradeId
                        );

                        if (!$result) {
                            $success = false;
                        }
                    }
                }
            }

            if ($success) {
                $_SESSION['message'] = "Notas actualizadas correctamente";
            } else {
                $_SESSION['message'] = "Algunas notas no se pudieron actualizar";
            }

            header("Location: " . __baseurl__ . "teacher/list_ratings_view");
            exit;
        } else {
            $_SESSION['message'] = "No se han recibido notas";
            header("Location: " . __baseurl__ . "teacher/list_ratings_view");
            exit;
        }
    }

    public function delete_rating()
    {
        // Get raw POST data
        $rawData = file_get_contents("php://input");

        // Decode JSON data
        $postData = json_decode($rawData, true);
        $result = $this->model->model_deleted_rating($postData['id'], $postData['deleted']);

        if ($result) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false]);
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
