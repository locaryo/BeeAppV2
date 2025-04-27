<?php

class HomeModel extends Model
{

    public function __construct()
    {
        parent::__construct();
    }
    // admin
    public function login($user, $pass, $rol)
    {
        $new_pass = md5($pass);
        if ($user && $new_pass) {
            $sql = $this->db->conn()->prepare("SELECT * FROM users WHERE user = ? AND password = ? AND rol = ?");
            $sql->execute([$user, $new_pass, $rol]);
            $result = $sql->fetch(PDO::FETCH_DEFAULT);
            if ($result == true) {
                if ($result['rol'] == '1') {
                    $session =
                        [
                            $_SESSION['user'] = $result['user'],
                            $_SESSION['id'] = $result['id'],
                            $_SESSION['tiempo_inicio'] = time(),
                            $_SESSION['ultima_actividad'] = time(),
                            $_SESSION['access'] = true,
                            $_SESSION['rol'] = $result['rol'],
                            $_SESSION['token'] = md5(uniqid(mt_rand(), true))
                        ];
                    return true;
                } elseif ($result['rol'] == '2') {
                    $session =
                        [
                            $_SESSION['user'] = $result['username'],
                            $_SESSION['id'] = $result['id'],
                            $_SESSION['tiempo_inicio'] = time(),
                            $_SESSION['ultima_actividad'] = time(),
                            $_SESSION['access'] = true,
                            $_SESSION['rol'] = $result['rol'],
                            $_SESSION['centro'] = $result['centro'],
                            $_SESSION['token'] = md5(uniqid(mt_rand(), true))
                        ];
                    return true;
                } else {
                    echo "homeModel, line 46";
                }
            } else {
                return false;
            }
        }
        $sql->closeCursor();
        $sql = null;
        $this->db = null;
    }

    // consultar datos por numero de cedula
    public function consulting_cedula($cedula, $opcion)
    {
        if ($opcion === "alumnos") {
            $sql = $this->db->conn()->prepare("SELECT *, alumnos.id as a_id, alumnos.correo as a_correo, r.deleted AS eliminado FROM $opcion INNER JOIN representante r ON r.cedula_r = alumnos.ci_representante WHERE alumnos.cedula = ? AND alumnos.deleted = 0");
            $sql->execute([$cedula]);
            $result = $sql->fetch(PDO::FETCH_DEFAULT);
            if ($result) {
                return $result;
            } else {
                $_SESSION['message'] = "No se encontró información del estudiante";
                header("Location: " . __baseurl__ . "home/consulting_view");
            }
        } elseif ($opcion === "representante") {
            $sql = $this->db->conn()->prepare("SELECT * FROM $opcion WHERE cedula_r = ? and deleted = 0");
            $sql->execute([$cedula]);
            $result = $sql->fetch(PDO::FETCH_DEFAULT);
            if ($result) {
                return $result;
            } else {
                $_SESSION['message'] = "No se encontró información del representante";
                header("Location: " . __baseurl__ . "home/consulting_view");
            }
        } else {
            $sql = $this->db->conn()->prepare("SELECT * FROM $opcion WHERE cedula = ? and deleted = 0");
            $sql->execute([$cedula]);
            $result = $sql->fetch(PDO::FETCH_DEFAULT);
            if ($result) {
                return $result;
            } else {
                $_SESSION['message'] = "No se encontró información del docente";
                header("Location: " . __baseurl__ . "home/consulting_view");
            }
        }

        $sql->closeCursor();
        $sql = null;
        $this->db = null;
    }

    // registrar factura de servicio
    public function model_register_service_payment(
        $bills,
        $amount,
        $payment_method,
        $reference,
        $nota,
        $date_payment
    ) {
        $sql = $this->db->conn()->prepare("INSERT INTO send_payment (
                id_bills, 
                amount, 
                id_payment_method, 
                reference,
                note,
                date_payment
            ) VALUES (?,?,?,?,?,?)");
        if ($sql->execute([
            $bills,
            $amount,
            $payment_method,
            $reference,
            $nota,
            $date_payment

        ])) {
            header("Location: " . __baseurl__ . "home/view_register_service_payment");
        } else {
            header("Location: " . __baseurl__ . "home/view_register_service_payment?error");
        }

        $sql->closeCursor();
        $sql = null;
        $this->db = null;
    }

    // registrar pago recibido
    public function model_register_receive_payment(
        $revenue,
        $amount,
        $payment_method,
        $reference,
        $nota,
        $date_payment
    ) {
        $sql = $this->db->conn()->prepare("INSERT INTO receive_payment (
                id_revenue, 
                amount, 
                id_payment_method, 
                reference,
                note,
                date_payment
            ) VALUES (?,?,?,?,?,?)");
        if ($sql->execute([
            $revenue,
            $amount,
            $payment_method,
            $reference,
            $nota,
            $date_payment
        ])) {
            header("Location: " . __baseurl__ . "home/view_register_receive_payment");
        } else {
            header("Location: " . __baseurl__ . "home/view_register_receive_payment?error");
        }

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

    // insertar representante
    public function insert_responsable(
        $p_nombre,
        $s_nombre,
        $p_apellido,
        $s_apellido,
        $cedula,
        $telefono,
        $correo,
        $fecha,
        $direccion
    ) {
        $sql = $this->db->conn()->prepare("SELECT cedula_r FROM representante WHERE cedula_r = ? and deleted = 0");
        $sql->execute([$cedula]);
        $result = $sql->fetch(PDO::FETCH_DEFAULT);
        if ($result) {
            header("Location: " . __baseurl__ . "home/register_responsable_view?existe");
        } else {
            $sql = $this->db->conn()->prepare("INSERT INTO representante (
                p_nombre_r, 
                s_nombre_r, 
                p_apellido_r, 
                s_apellido_r, 
                cedula_r, 
                telefono,
                correo,
                fecha_r,
                direccion,
                data_registered,
                deleted
            ) VALUES (?,?,?,?,?,?,?,?,?,CURRENT_TIMESTAMP,0)");
            if ($sql->execute([
                $p_nombre,
                $s_nombre,
                $p_apellido,
                $s_apellido,
                $cedula,
                $telefono,
                $correo,
                $fecha,
                $direccion

            ])) {
                header("Location: " . __baseurl__ . "home/register_responsable_view?registrado");
            } else {
                header("Location: " . __baseurl__ . "home/register_responsable_view?error");
            }
        }
        $sql->closeCursor();
        $sql = null;
        $this->db = null;
    }

    // insertar docente
    public function insert_teacher(
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
        $sql = $this->db->conn()->prepare("SELECT cedula FROM docentes WHERE cedula = ? and deleted = 0");
        $sql->execute([$cedula]);
        $result = $sql->fetch(PDO::FETCH_DEFAULT);
        if ($result) {
            header("Location: " . __baseurl__ . "home/register_teacher_view?existe");
        } else {
            $sql = $this->db->conn()->prepare("INSERT INTO docentes (
                p_nombre, 
                s_nombre, 
                p_apellido, 
                s_apellido, 
                cedula, 
                telefono,
                correo,
                areas_formacion,
                fecha,
                direccion,
                primero,
                segundo,
                tercero,
                cuarto,
                quinto,
                sexto,
                data_registered,
                deleted
            ) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,CURRENT_TIMESTAMP,0)");
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
                $sexto
            ])) {
                $sql = $this->db->conn()->prepare("SELECT COUNT('id') FROM docentes WHERE deleted = 0");
                $sql->execute();
                $result = $sql->fetchColumn(PDO::FETCH_DEFAULT);
                if ($result != "") {
                    $sql = $this->db->conn()->prepare("UPDATE institucion SET docentes_matricula = $result WHERE id = 1 and deleted = 0");
                    $sql->execute();

                    header("Location: " . __baseurl__ . "home/register_teacher_view?registrado");
                }
            } else {
                header("Location: " . __baseurl__ . "home/register_teacher_view?error");
            }
        }
        $sql->closeCursor();
        $sql = null;
        $this->db = null;
    }

    // insertar estudiante
    public function insert_student(
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
    ) {
        $sql = $this->db->conn()->prepare("SELECT id,cedula FROM alumnos WHERE cedula = ? and deleted = 0");
        $sql->execute([$cedula]);
        $result = $sql->fetch(PDO::FETCH_DEFAULT);
        if ($result) {
            header("Location: " . __baseurl__ . "home/register_student_view?existe");
        } else {
            $sql = $this->db->conn()->prepare("SELECT id FROM representante WHERE cedula_r = ? and deleted = 0");
            $sql->execute([$ci_representante]);
            $result = $sql->fetch(PDO::FETCH_DEFAULT);
            if ($result) {
                $sql = $this->db->conn()->prepare("INSERT INTO alumnos (
                id_representante,
                p_nombre, 
                s_nombre, 
                p_apellido, 
                s_apellido, 
                cedula, 
                telefono,
                fecha,
                edad,
                ci_representante,
                direccion,
                documentos,
                sexo,
                correo,
                nivel,
                seccion,
                mencion,
                data_registered,
                deleted
                ) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,CURRENT_TIMESTAMP,0)");
                if ($sql->execute([
                    $result['id'],
                    $p_nombre,
                    $s_nombre,
                    $p_apellido,
                    $s_apellido,
                    $cedula,
                    $telefono,
                    $fecha,
                    $edad,
                    $ci_representante,
                    $direccion,
                    $documentos,
                    $sexo,
                    $correo,
                    $grado,
                    $seccion,
                    $mencion
                ])) {
                    $sql = $this->db->conn()->prepare("SELECT COUNT('id') FROM alumnos WHERE deleted = 0");
                    $sql->execute();
                    $result = $sql->fetchColumn(PDO::FETCH_DEFAULT);
                    if ($result != "") {
                        $sql = $this->db->conn()->prepare("UPDATE institucion SET alumnos_matricula = $result WHERE id = 1 and deleted = 0");
                        $sql->execute();

                        header("Location: " . __baseurl__ . "home/register_student_view?registrado");
                    }
                } else {
                    header("Location: " . __baseurl__ . "home/register_student_view?error");
                }
            } else {
                header("Location: " . __baseurl__ . "home/register_student_view?no_representante");
            }
        }
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
            $result = $this->consulting_cedula($cedula, "docentes");
            return $result;
        } else {
            header("Location: " . __baseurl__ . "home/register_teacher_view?error");
        }

        $sql->closeCursor();
        $sql = null;
        $this->db = null;
    }

    // actualizar representante
    public function edit_representante(
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
    ) {
        $sql = $this->db->conn()->prepare("
            UPDATE representante 
            SET p_nombre_r   = ?, 
                s_nombre_r   = ?, 
                p_apellido_r = ?, 
                s_apellido_r = ?, 
                cedula_r     = ?, 
                telefono     = ?, 
                correo       = ?, 
                fecha_r      = ?, 
                direccion    = ?
            WHERE id = ? and deleted = 0");

        if ($sql->execute([
            $p_nombre,
            $s_nombre,
            $p_apellido,
            $s_apellido,
            $cedula,
            $telefono,
            $correo,
            $fecha,
            $direccion,
            $id
        ])) {
            $sql = $this->db->conn()->prepare("
                UPDATE alumnos 
                SET ci_representante   = ? 
                WHERE id_representante = ?");
            $sql->execute([$cedula, $id]);
            $result = $this->consulting_cedula($cedula, "representante");
            return $result;
        } else {
            header("Location: " . __baseurl__ . "home/register_teacher_view?error");
        }

        $sql->closeCursor();
        $sql = null;
        $this->db = null;
    }

    // actualizar datos institucion
    public function model_edit_institution(
        $id,
        $nombre,
        $director,
        $ubicacion,
        $telefono,
        $correo,
        $codigo
    ) {
        $sql = $this->db->conn()->prepare("
            UPDATE institucion 
            SET nombre_institucion    = ?, 
                director              = ?, 
                direccion             = ?, 
                telefono              = ?, 
                correo                = ?, 
                codigo                = ?
            WHERE id = ? and deleted = 0");

        if ($sql->execute([
            $nombre,
            $director,
            $ubicacion,
            $telefono,
            $correo,
            $codigo,
            $id
        ])) {

            // $result = $this->institution();
            return true;
        } else {
            return false;
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

    public function model_consulting_payments($id_alumno)
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

    // consultar datos por numero de cedula
    public function constancy($cedula)
    {
        $sql = $this->db->conn()->prepare("SELECT * FROM alumnos INNER JOIN representante ON cedula_r = alumnos.ci_representante WHERE alumnos.cedula = ? and alumnos.deleted = 0");
        $sql->execute([$cedula]);
        $result = $sql->fetch(PDO::FETCH_DEFAULT);
        if ($result) {
            return $result;
        } else {
            header("Location: " . __baseurl__ . "home/documents?errorCedula");
        }
        $sql->closeCursor();
        $sql = null;
        $this->db = null;
    }

    public function institution()
    {
        $sql = $this->db->conn()->prepare("SELECT * FROM institucion WHERE deleted = 0");
        $sql->execute([]);
        $result = $sql->fetch(PDO::FETCH_DEFAULT);

        if ($result) {
            return $result;
        } else {
            header("Location: " . __baseurl__ . "home/documents?errorCedula");
        }
        $sql->closeCursor();
        $sql = null;
        $this->db = null;
    }

    public function select_teacher()
    {
        $sql = $this->db->conn()->prepare("SELECT id, p_nombre, p_apellido FROM docentes WHERE deleted = '0'; ");
        $sql->execute([]);
        $result = $sql->fetchAll(PDO::FETCH_DEFAULT);

        return $result;

        $sql->closeCursor();
        $sql = null;
        $this->db = null;
    }

    public function model_register_schedule($dias, $horasInicio, $horasFin, $docentes, $materias, $nivel, $seccion, $mencion)
    {
        $diaArray = [];
        $horaInicioArray = [];
        $horaFinArray = [];
        $docenteArray = [];
        $materiaArray = [];

        foreach ($dias as $key => $value) {
            $diaArray[] = $value;
        }
        foreach ($horasInicio as $key => $value) {
            $horaInicioArray[] = $value;
        }
        foreach ($horasFin as $key => $value) {
            $horaFinArray[] = $value;
        }
        foreach ($docentes as $key => $value) {
            $docenteArray[] = $value;
        }
        foreach ($materias as $key => $value) {
            $materiaArray[] = $value;
        }
        $sql = $this->db->conn()->prepare("INSERT INTO horarios (dia_semana, hora_inicio, hora_fin, docente, materia, nivel, seccion, mencion) VALUES (?,?,?,?,?,?,?,?)");
        if ($sql->execute([
            json_encode($diaArray),
            json_encode($horaInicioArray),
            json_encode($horaFinArray),
            json_encode($docenteArray),
            json_encode($materiaArray),
            $nivel,
            $seccion,
            $mencion
        ])) {
            return true;
        } else {
            return false;
        }
        $sql->closeCursor();
        $sql = null;
        $this->db = null;
    }
}
