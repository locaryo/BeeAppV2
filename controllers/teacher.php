<?php
class Teacher extends Controller
{
    public $view;
    private $id_teacher;

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

            $this->view->count_teacher       = $count_teacher ? $count_teacher : 0;
            $this->view->count_student       = $count_student ? $count_student : 0;
            $this->view->count_student_m     = $count_student_m ? $count_student_m : 0;
            $this->view->count_student_f     = $count_student_f ? $count_student_f : 0;
            $this->view->count_student_petro = json_encode($count_student_petro) ? $count_student_petro : [];
            $this->view->count_student_meca  = json_encode($count_student_meca) ? $count_student_meca : [];
            $this->view->count_student_elec  = json_encode($count_student_elec) ? $count_student_elec : [];
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
            $horarios = $this->model->model_select_schedule_teacher(); // Aseguramos que $horarios sea un array
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

    // visualizar datos de maestro
    public function profile_view()
    {
        if (isset($_SESSION['access']) && $_SESSION['access'] == true && $_SESSION['rol'] == 2) {

            $data = $this->model->model_view_profile($_SESSION['id_docente']);
            $payment = $this->model->model_consulting_teacher_payments($_SESSION['id_docente']);
            $this->view->data = $data ? $data : [];
            $this->view->payments = $payment ? $payment : [];
            $this->view->render('teacher/profile_view');
        } else {
            $_SESSION['message'] = "Debe iniciar sesion para ingresar al sistema";  // Guardamos el mensaje en la sesión
            header("Location: " . __baseurl__);
            exit;
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
                    $_SESSION['message'] = "Perfil actualizado correctamente";
                    header("Location: " . __baseurl__ . "teacher/profile_view");
                    exit;
                } else {
                    $_SESSION['message'] = "Error al actualizar el registro";
                    header("Location: " . __baseurl__ . "teacher/profile_view");
                    exit;
                }
            } else {
                header("Location: " . __baseurl__ . "teacher/profile_view");
            }
        }

        if ($action == 'delete') {
            $cedula = $this->validarEntrada($_POST['cedula']);
            $this->model->deleted_cedula($cedula, $opcion, $id);
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
