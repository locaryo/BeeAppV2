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

    // seleccionar facturas de servicios (ingresos, gastos)
    public function model_product_billing_count()
    {
        $sql = $this->db->conn()->prepare("SELECT SUM(amount) AS total_monto_ingresos FROM receive_payment WHERE deleted = '0'; ");
        $sql->execute();
        $result_ingresos = $sql->fetchAll(PDO::FETCH_DEFAULT);

        $sql = $this->db->conn()->prepare("SELECT SUM(amount) AS total_monto_egresos FROM send_payment WHERE deleted = '0'; ");
        $sql->execute();
        $result_egresos = $sql->fetchAll(PDO::FETCH_DEFAULT);
        $ingresosEgresos = [$result_ingresos, $result_egresos];

        return $ingresosEgresos;

        $sql->closeCursor();
        $sql = null;
        $this->db = null;
    }

    public function model_select_registration_monthly_payment()
    {
        // Preparamos la consulta con GROUP BY
        $sql = $this->db->conn()->prepare(
            "SELECT 
            start_monthly_payment,
            end_monthly_payment,
            SUM(amount) AS total_monto_ingresos
         FROM receive_payment
         WHERE id_revenue = :rev
           AND deleted    = 0
         GROUP BY start_monthly_payment, end_monthly_payment;"
        );

        // Vinculamos el parámetro de forma segura
        $sql->bindValue(':rev', 2, PDO::PARAM_INT);
        $sql->execute();

        // Obtenemos los resultados
        $result_ingresos = $sql->fetchAll(PDO::FETCH_ASSOC);

        return $result_ingresos;

        $sql->closeCursor();
        $sql = null;
        $this->db = null;
    }

    public function model_select_registration_payment()
    {
        // Preparamos la consulta con GROUP BY
        $sql = $this->db->conn()->prepare(
            "SELECT 
            date_payment,
            SUM(amount) AS total_monto_ingresos
         FROM receive_payment
         WHERE id_revenue = :rev
           AND deleted    = 0;"
        );

        // Vinculamos el parámetro de forma segura
        $sql->bindValue(':rev', 1, PDO::PARAM_INT);
        $sql->execute();

        // Obtenemos los resultados
        $result_ingresos = $sql->fetchAll(PDO::FETCH_ASSOC);

        return $result_ingresos;

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

    

    // actualizar estudiante
    public function model_edit_student(
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
    ) {
        $sql = $this->db->conn()->prepare("SELECT id,cedula_r FROM representante WHERE cedula_r = ? and deleted = 0");
        $sql->execute([$cedula_r]);
        $result = $sql->fetch(PDO::FETCH_DEFAULT);
        if ($result) {

            $sql = $this->db->conn()->prepare("
                UPDATE alumnos 
                SET id_representante = ?,
                    p_nombre         = ?, 
                    s_nombre         = ?, 
                    p_apellido       = ?, 
                    s_apellido       = ?, 
                    cedula           = ?, 
                    telefono         = ?, 
                    sexo             = ?, 
                    correo           = ?, 
                    fecha            = ?, 
                    edad             = ?, 
                    ci_representante = ?, 
                    direccion        = ?, 
                    documentos       = ?, 
                    nivel            = ?, 
                    seccion          = ?, 
                    mencion          = ? 
                WHERE id = ? and deleted = 0");

            if ($sql->execute([
                $result['id'],
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
                $result['cedula_r'],
                $direccion,
                $documentos,
                $grado,
                $seccion,
                $mencion,
                $id
            ])) {
                return true;
            } else {
                return false;
            }
        } else {
            header("Location: " . __baseurl__ . "home/consulting_view?errorCedulaRepresentante");
        }


        $sql->closeCursor();
        $sql = null;
        $this->db = null;
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
        $sexto
    ) {
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
            header("Location: " . __baseurl__ . "home/register_teacher_view?error");
        }

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
    public function model_filtrar_docentes($query)
    {
        $sql = $this->db->conn()->prepare("SELECT id, p_nombre, s_nombre, p_apellido, s_apellido, cedula FROM docentes WHERE deleted = 0 AND (p_nombre LIKE ? OR p_apellido LIKE ? OR cedula LIKE ?) ORDER BY p_nombre");
        $sql->execute([
            '%' . $query . '%',
            '%' . $query . '%',
            '%' . $query . '%'
        ]);
        $result = $sql->fetchAll(PDO::FETCH_DEFAULT);
        return $result;
    }

    // consultar datos por opciones desde tabla
    public function consulting_tabla($nivel, $seccion, $mencion)
    {
        if ($nivel != 'Seleccionar' && $seccion == 'Seleccionar' && $mencion == 'Seleccionar') {

            $sql = $this->db->conn()->prepare("SELECT id, p_nombre, s_nombre, p_apellido, s_apellido, cedula, sexo FROM alumnos WHERE nivel = ? and deleted = 0");
            $sql->execute([$nivel]);
            $result = $sql->fetchAll(PDO::FETCH_DEFAULT);
            return $result;
        } elseif ($seccion != 'Seleccionar' && $nivel == 'Seleccionar' && $mencion == 'Seleccionar') {
            $sql = $this->db->conn()->prepare("SELECT id, p_nombre, s_nombre, p_apellido, s_apellido, cedula, sexo FROM alumnos WHERE seccion = ? and deleted = 0");
            $sql->execute([$seccion]);
            $result = $sql->fetchAll(PDO::FETCH_DEFAULT);
            return $result;
        } elseif ($mencion != 'Seleccionar' && $nivel == 'Seleccionar' && $seccion == 'Seleccionar') {
            $sql = $this->db->conn()->prepare("SELECT id, p_nombre, s_nombre, p_apellido, s_apellido, cedula, sexo FROM alumnos WHERE mencion = ? and deleted = 0");
            $sql->execute([$mencion]);
            $result = $sql->fetchAll(PDO::FETCH_DEFAULT);
            return $result;
        } elseif ($nivel != 'Seleccionar' && $seccion != 'Seleccionar' && $mencion == 'Seleccionar') {
            $sql = $this->db->conn()->prepare("SELECT id, p_nombre, s_nombre, p_apellido, s_apellido, cedula, sexo FROM alumnos WHERE nivel = ? AND seccion = ? and deleted = 0");
            $sql->execute([$nivel, $seccion]);
            $result = $sql->fetchAll(PDO::FETCH_DEFAULT);
            return $result;
        } elseif ($nivel != 'Seleccionar' && $mencion != 'Seleccionar' && $seccion == 'Seleccionar') {
            $sql = $this->db->conn()->prepare("SELECT id, p_nombre, s_nombre, p_apellido, s_apellido, cedula, sexo FROM alumnos WHERE nivel = ? AND mencion = ? and deleted = 0");
            $sql->execute([$nivel, $mencion]);
            $result = $sql->fetchAll(PDO::FETCH_DEFAULT);
            return $result;
        } elseif ($seccion != 'Seleccionar' && $mencion != 'Seleccionar' && $nivel == 'Seleccionar') {
            $sql = $this->db->conn()->prepare("SELECT id, p_nombre, s_nombre, p_apellido, s_apellido, cedula, sexo FROM alumnos WHERE seccion = ? AND mencion = ? and deleted = 0");
            $sql->execute([$seccion, $mencion]);
            $result = $sql->fetchAll(PDO::FETCH_DEFAULT);
            return $result;
        } elseif ($seccion != 'Seleccionar' && $mencion != 'Seleccionar' && $nivel != 'Seleccionar') {
            $sql = $this->db->conn()->prepare("SELECT id, p_nombre, s_nombre, p_apellido, s_apellido, cedula, sexo FROM alumnos WHERE nivel = ? AND seccion = ? AND mencion = ? and deleted = 0");
            $sql->execute([$nivel, $seccion, $mencion]);
            $result = $sql->fetchAll(PDO::FETCH_DEFAULT);
            return $result;
        } elseif ($nivel == 'Seleccionar' && $seccion == 'Seleccionar' && $mencion == 'Seleccionar') {
            $sql = $this->db->conn()->prepare("SELECT id, p_nombre, s_nombre, p_apellido, s_apellido, cedula, sexo FROM alumnos where deleted = 0 ORDER BY p_nombre LIMIT 15");
            $sql->execute();
            $result = $sql->fetchAll(PDO::FETCH_DEFAULT);
            return $result;
        } else {
            echo "Error, model line: 415";
        }
    }

    public function model_consulting_student_payments($id_alumno)
    {
        $sql = $this->db->conn()->prepare("SELECT r.*, a.p_nombre, a.s_nombre, a.p_apellido, a.s_apellido, i.income_name, pm.payment_method
        FROM receive_payment as r 
        INNER JOIN alumnos as a ON a.id = r.id_student 
        INNER JOIN income_source as i ON i.id = r.id_revenue 
        INNER JOIN payment_method as pm ON pm.id = r.id_payment_method 
        WHERE r.id_student = ? AND r.deleted = 0; ");
        $sql->execute([$id_alumno]);
        $result = $sql->fetchAll(PDO::FETCH_DEFAULT);
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
