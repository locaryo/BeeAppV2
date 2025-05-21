<?php

class TeacherModel extends Model
{

    public function __construct()
    {
        parent::__construct();
    }

    // insertar usuario docente
    public function model_register_teacher_user(
        $user,
        $pass
    ) {

        $sql = $this->db->conn()->prepare("SELECT user FROM users WHERE user = ? and deleted = 0");
        $sql->execute([$user]);
        $result = $sql->fetch(PDO::FETCH_DEFAULT);
        if ($result) {
            return false;
        } else {
            $new_pass = md5($pass);
            $rol = 2;
            $sql = $this->db->conn()->prepare("INSERT INTO users (
                user, 
                password, 
                rol
            ) VALUES (?,?,?)");

            if ($sql->execute([
                $user,
                $new_pass,
                $rol
            ])) {
                return true;
            } else {
                return false;
            }
        }
        $sql->closeCursor();
        $sql = null;
        $this->db = null;
    }

    // seleccionar horarios
    public function model_select_schedule_teacher()
    {
        $sql = $this->db->conn()->prepare("SELECT * FROM horarios WHERE deleted = '0' ORDER BY nivel; ");
        $sql->execute([]);
        $result = $sql->fetchAll(PDO::FETCH_ASSOC);

        return $result;

        $sql->closeCursor();
        $sql = null;
        $this->db = null;
    }

    public function model_select_sections()
    {
        $sql = $this->db->conn()->prepare("SELECT sections FROM sections WHERE deleted = '0'; ");
        $sql->execute([]);
        $result = $sql->fetchAll(PDO::FETCH_ASSOC);

        return $result;

        $sql->closeCursor();
        $sql = null;
        $this->db = null;
    }

    public function model_select_grades()
    {
        $sql = $this->db->conn()->prepare("SELECT grades FROM grades WHERE deleted = '0'; ");
        $sql->execute([]);
        $result = $sql->fetchAll(PDO::FETCH_ASSOC);

        return $result;

        $sql->closeCursor();
        $sql = null;
        $this->db = null;
    }

    // seleccionar tipos de ingresos
    public function model_select_income_source()
    {
        $sql = $this->db->conn()->prepare("SELECT id, income_name, description FROM income_source WHERE deleted = '0'; ");
        $sql->execute();
        $result = $sql->fetchAll(PDO::FETCH_DEFAULT);

        return $result;

        $sql->closeCursor();
        $sql = null;
        $this->db = null;
    }

    // seleccionar tipos de gastos
    public function model_select_expenses_category()
    {
        $sql = $this->db->conn()->prepare("SELECT id, expenses, description FROM expenses_category WHERE deleted = '0'; ");
        $sql->execute();
        $result = $sql->fetchAll(PDO::FETCH_DEFAULT);

        return $result;

        $sql->closeCursor();
        $sql = null;
        $this->db = null;
    }

    // seleccionar metodos de pago
    public function model_select_payment_method()
    {
        $sql = $this->db->conn()->prepare("SELECT id, payment_method FROM payment_method WHERE deleted = '0'; ");
        $sql->execute();
        $result = $sql->fetchAll(PDO::FETCH_DEFAULT);

        return $result;

        $sql->closeCursor();
        $sql = null;
        $this->db = null;
    }

    // seleccionar pagos mesuales de un estudiante
    public function model_select_monthly_payment($id_alumno)
    {
        $sql = $this->db->conn()->prepare("SELECT id, id_student, amount, id_payment_method, reference, note, date_payment, start_monthly_payment, end_monthly_payment FROM receive_payment WHERE id_alumno = ? AND id_revenue = '2' AND deleted = '0'; ");
        $sql->execute([$id_alumno]);
        $result = $sql->fetchAll(PDO::FETCH_DEFAULT);

        return $result;

        $sql->closeCursor();
        $sql = null;
        $this->db = null;
    }

    // seleccionar pagos de matricula estudiantes
    public function select_payment_student_count()
    {
        $sql = $this->db->conn()->prepare("SELECT monto AS total_monto, fecha_pago  FROM ingresos_institucion WHERE deleted = '0'; ");
        $sql->execute();
        $result = $sql->fetchAll(PDO::FETCH_DEFAULT);
        return $result;

        $sql->closeCursor();
        $sql = null;
        $this->db = null;
    }

    // seleccionar pagos de matricula estudiantes
    public function select_payment_student_count_total_dasboard()
    {
        $sql = $this->db->conn()->prepare("SELECT SUM(monto) AS total_monto FROM ingresos_institucion WHERE deleted = '0'; ");
        $sql->execute();
        $result = $sql->fetchAll(PDO::FETCH_DEFAULT);
        return $result;

        $sql->closeCursor();
        $sql = null;
        $this->db = null;
    }

    // seleccionar pagos de matricula estudiantes
    public function select_payment_student_uniformes_total_dasboard()
    {
        $sql = $this->db->conn()->prepare("SELECT SUM(monto) AS total_monto FROM contabilidad_ingreso WHERE motivo = 'uniformes' AND deleted = '0'; ");
        $sql->execute();
        $result = $sql->fetchAll(PDO::FETCH_DEFAULT);
        return $result;

        $sql->closeCursor();
        $sql = null;
        $this->db = null;
    }

    // eliminar dato
    public function deleted_cedula($cedula, $opcion, $id)
    {
        if ($opcion == 'representante') {
            $sql = $this->db->conn()->prepare("UPDATE $opcion SET deleted = 1 WHERE id = $id and cedula_r = $cedula");
            $sql->execute();

            header("Location: " . __baseurl__ . "home/dashboard?delete");
        } else {
            $sql = $this->db->conn()->prepare("UPDATE $opcion SET deleted = 1 WHERE id = $id and cedula = $cedula");

            if ($sql->execute()) {
                $sql = $this->db->conn()->prepare("SELECT COUNT('id') FROM $opcion WHERE deleted = 0");
                $sql->execute();
                $result = $sql->fetchColumn(PDO::FETCH_DEFAULT);
                if ($result != "") {
                    $campo = $opcion . "_matricula";
                    $sql = $this->db->conn()->prepare("UPDATE institucion SET $campo = $result WHERE id = 1 and deleted = 0");
                    $sql->execute();

                    header("Location: " . __baseurl__ . "home/dashboard?delete");
                }
            }
        }
    }

    // tabla
    public function read_all()
    {
        $sql = $this->db->conn()->prepare("SELECT id, p_nombre, s_nombre, p_apellido, s_apellido, cedula, sexo FROM alumnos where deleted = 0 ORDER BY p_nombre LIMIT 15");
        $sql->execute();
        $result = $sql->fetchAll(PDO::FETCH_DEFAULT);
        return $result;
    }

    // tabla
    public function model_filtrar_estudiantes($query)
    {
        $sql = $this->db->conn()->prepare("SELECT id, p_nombre, s_nombre, p_apellido, s_apellido, cedula FROM alumnos WHERE deleted = 0 AND (p_nombre LIKE ? OR p_apellido LIKE ? OR cedula LIKE ?) ORDER BY p_nombre");
        $sql->execute([
            '%' . $query . '%',
            '%' . $query . '%',
            '%' . $query . '%'
        ]);
        $result = $sql->fetchAll(PDO::FETCH_DEFAULT);
        return $result;
    }

    // tabla
    public function model_filtrar_classroom($section, $grade)
    {
        $section = $this->getSectionId($section);
        $grade = $this->getGradeId($grade);

        // Obtener campo students del aula
        $sql = $this->db->conn()->prepare("SELECT students FROM classrooms WHERE deleted = 0 AND section = ? AND grade = ?");
        $sql->execute([$section, $grade]);
        $result = $sql->fetch(PDO::FETCH_ASSOC);

        // Decodificar los IDs de estudiantes
        $student_ids = json_decode($result['students'], true);

        if (empty($student_ids)) {
            return []; // o lo que necesites devolver si no hay estudiantes
        }

        // Crear placeholders para la consulta IN
        $placeholders = implode(',', array_fill(0, count($student_ids), '?'));

        // Obtener datos de los estudiantes por ID
        $sql = $this->db->conn()->prepare("SELECT * FROM alumnos WHERE id IN ($placeholders) AND deleted = 0");
        $sql->execute($student_ids);
        $students = $sql->fetchAll(PDO::FETCH_ASSOC);

        return $students;
    }

    public function model_register_rating($estudents, $teacher, $ratings, $course, $section, $grade)
    {
        $sql = $this->db->conn()->prepare("INSERT INTO ratings (student, teacher, ratings, course, section, grade) VALUES (?, ?, ?, ?, ?, ?)");

        if ($sql->execute([
            $estudents,
            $teacher,
            $ratings,
            $course,
            $section,
            $grade
        ])) {
            return true;
        } else {
            return false;
        }

        $sql->closeCursor();
        $sql = null;
        $this->db = null;
    }

    // tabla
    public function model_filtrar_ratings($course, $section, $grade)
    {
        $section = $this->getSectionId($section);
        $grade = $this->getGradeId($grade);

        $sql = $this->db->conn()->prepare("SELECT r.*, a.p_nombre, a.p_apellido 
        FROM ratings r
        LEFT JOIN alumnos a ON r.student = a.id
        LEFT JOIN sections s ON r.section = s.id
        LEFT JOIN grades g ON r.grade = g.id
        WHERE  r.deleted = 0 AND a.deleted = 0 AND s.deleted = 0 AND g.deleted = 0 AND r.course = ? AND r.section = ? AND r.grade = ?");
        $sql->execute([$course, $section, $grade]);
        $result = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function model_edit_rating($idNota, $student, $teacher, $rating, $course, $section, $grade)
    {
        if ($idNota) {
            // Actualizar nota existente
            $sql = $this->db->conn()->prepare("UPDATE ratings SET ratings = ? WHERE id = ?");
            if ($sql->execute([$rating, $idNota])) {
                return true;
            } else {
                return false;
            }
        } else {
            // Insertar nueva nota
            $sql = $this->db->conn()->prepare("INSERT INTO ratings (student, teacher, ratings, course, section, grade, data_registered, data_edit, deleted) VALUES (?, ?, ?, ?, ?, ?, NOW(), NOW(), 0)");
            if ($sql->execute([$student, $teacher, $rating, $course, $section, $grade])) {
                return true;
            } else {
                return false;
            }
        }
    }

    public function model_deleted_rating($idNota, $deleted)
    {
        // Actualizar nota existente
        $sql = $this->db->conn()->prepare("UPDATE ratings SET deleted = ? WHERE id = ?");
        if ($sql->execute([$deleted, $idNota])) {
            return true;
        } else {
            return false;
        }
    }


    public function ratings_exist($teacher, $course, $section, $grade)
    {
        $checkSql = $this->db->conn()->prepare("SELECT COUNT(*) FROM ratings WHERE teacher = ? AND course = ? AND section = ? AND grade = ?");
        $checkSql->execute([$teacher, $course, $section, $grade]);
        return $checkSql->fetchColumn() > 0;
    }

    public function model_view_profile($id){
        $sql = $this->db->conn()->prepare("SELECT * FROM docentes WHERE id = ?");
        $sql->execute([$id]);
        $result = $sql->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function model_consulting_teacher_payments($id_teacher)
    {
        $sql = $this->db->conn()->prepare("SELECT s.*, d.p_nombre, d.s_nombre, d.p_apellido, d.s_apellido, e.expenses, pm.payment_method
        FROM send_payment as s 
        INNER JOIN docentes as d ON d.id = s.id_teacher 
        INNER JOIN expenses_category as e ON e.id = s.id_bills 
        INNER JOIN payment_method as pm ON pm.id = s.id_payment_method 
        WHERE s.id_teacher = ? AND s.deleted = 0; ");
        $sql->execute([$id_teacher]);
        $result = $sql->fetchAll(PDO::FETCH_DEFAULT);
        return $result;
    }

    // actualizar docente
    public function edit_teacher(
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
    ) {
        // Definir la carpeta donde se guardarán los logos
        $ruta_guardado = 'public/img/teacher/';

        // Asegurarse de que la carpeta de guardado exista, si no, crearla
        if (!is_dir($ruta_guardado)) {
            mkdir($ruta_guardado, 0755, true); // El true permite crear subdirectorios recursivamente
        }

        $nombre_archivo_logo = null;
        $logo_en_db = "";
        $saved = false;



        // Verificar si se proporcionó información del logo (es decir, si se cargó una nueva imagen)
        if ($avatar != "") {
            // Generar un nombre de archivo único para el logo
            $nombre_archivo_logo = uniqid('logo_teacher') . '.' . $avatar['extension'];
            $ruta_completa_logo = $ruta_guardado . $nombre_archivo_logo;

            // Guardar el archivo en el servidor
            if (file_put_contents($ruta_completa_logo, $avatar['datos'])) {
                // La imagen se guardó correctamente, ahora guardaremos la ruta en la base de datos
                $logo_en_db = $ruta_completa_logo;
                $saved = true;
            } else {
                // Error al guardar el archivo
                return ['error' => 'Error al guardar el archivo del logo en el servidor.'];
            }
        }

        if ($saved === true) {
            $sql = $this->db->conn()->prepare("
            UPDATE docentes
            SET p_nombre        = ?,
                s_nombre        = ?,
                p_apellido      = ?,
                s_apellido      = ?,
                cedula          = ?,
                telefono        = ?,
                correo          = ?,
                areas_formacion = ?,
                fecha           = ?,
                direccion       = ?,
                primero         = ?,
                segundo         = ?,
                tercero         = ?,
                cuarto          = ?,
                quinto          = ?,
                sexto           = ?,
                logo            = ?
            WHERE id = ? and deleted = 0");
            if ($sql->execute([
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
                $logo_en_db,
                $id
            ])) {
                return true;
            } else {
                return false;
            }
        } else {
            $sql = $this->db->conn()->prepare("
            UPDATE docentes 
            SET p_nombre        = ?, 
                s_nombre        = ?, 
                p_apellido      = ?, 
                s_apellido      = ?, 
                cedula          = ?, 
                telefono        = ?, 
                correo          = ?, 
                areas_formacion = ?, 
                fecha           = ?, 
                direccion       = ?, 
                primero         = ?,
                segundo         = ?,
                tercero         = ?,
                cuarto          = ?,
                quinto          = ?,
                sexto           = ?
            WHERE id = ? and deleted = 0");

            if ($sql->execute([
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
                $id
            ])) {
                return true;
            } else {
                return false;
            }
        }

        $sql->closeCursor();
        $sql = null;
        $this->db = null;
    }

    public function getSectionId($section)
    {
        $sql = $this->db->conn()->prepare("SELECT id FROM sections WHERE deleted = 0 AND sections = ?");
        $sql->execute([$section]);
        return $sql->fetch(PDO::FETCH_ASSOC)['id'];
    }

    public function getGradeId($grade)
    {
        $sql = $this->db->conn()->prepare("SELECT id FROM grades WHERE deleted = 0 AND grades = ?");
        $sql->execute([$grade]);
        return $sql->fetch(PDO::FETCH_ASSOC)['id'];
    }

    public function getMentionId($mention)
    {
        $sql = $this->db->conn()->prepare("SELECT id FROM mentions WHERE deleted = 0 AND mentions = ?");
        $sql->execute([$mention]);
        return $sql->fetch(PDO::FETCH_ASSOC)['id'];
    }

    public function count_teacher()
    {
        $sql = $this->db->conn()->prepare("SELECT COUNT('cedula') FROM docentes where deleted = 0");
        $sql->execute();
        $result = $sql->fetchColumn(PDO::FETCH_DEFAULT);
        return $result;
        $sql->closeCursor();
        $sql = null;
        $this->db = null;
    }

    public function count_student()
    {
        $sql = $this->db->conn()->prepare("SELECT COUNT('cedula') FROM alumnos WHERE deleted = 0");
        $sql->execute();
        $result = $sql->fetchColumn(PDO::FETCH_DEFAULT);
        return $result;
        $sql->closeCursor();
        $sql = null;
        $this->db = null;
    }

    public function count_student_m()
    {
        $sql = $this->db->conn()->prepare("SELECT COUNT('cedula') FROM alumnos WHERE sexo = 0 and deleted = 0");
        $sql->execute();
        $result = $sql->fetchColumn(PDO::FETCH_DEFAULT);
        return $result;
        $sql->closeCursor();
        $sql = null;
        $this->db = null;
    }

    public function count_student_f()
    {
        $sql = $this->db->conn()->prepare("SELECT COUNT('cedula') FROM alumnos WHERE sexo = 1 and deleted = 0");
        $sql->execute();
        $result = $sql->fetchColumn(PDO::FETCH_DEFAULT);
        return $result;
        $sql->closeCursor();
        $sql = null;
        $this->db = null;
    }

    public function count_student_petro()
    {
        $sql = $this->db->conn()->prepare("SELECT nivel,  COUNT('cedula') as cantidad FROM alumnos WHERE mencion = 'Petroquimica' and deleted = 0 GROUP BY nivel");
        $sql->execute();
        $result = $sql->fetchAll(PDO::FETCH_DEFAULT);
        return $result;
        $sql->closeCursor();
        $sql = null;
        $this->db = null;
    }

    public function count_student_meca()
    {
        $sql = $this->db->conn()->prepare("SELECT nivel,  COUNT('cedula') as cantidad FROM alumnos WHERE mencion = 'Mecanica' and deleted = 0 GROUP BY nivel");
        $sql->execute();
        $result = $sql->fetchAll(PDO::FETCH_DEFAULT);
        return $result;
        $sql->closeCursor();
        $sql = null;
        $this->db = null;
    }

    public function count_student_elec()
    {
        $sql = $this->db->conn()->prepare("SELECT nivel,  COUNT('cedula') as cantidad FROM alumnos WHERE mencion = 'Electricidad' and deleted = 0 GROUP BY nivel");
        $sql->execute();
        $result = $sql->fetchAll(PDO::FETCH_DEFAULT);
        return $result;
        $sql->closeCursor();
        $sql = null;
        $this->db = null;
    }
}
