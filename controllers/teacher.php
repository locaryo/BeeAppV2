<?php 
class Teacher extends Controller
{
    public $view;
    
    public function __construct()
    {
        session_start();
        parent::__construct();
    }

    // dashboard
    public function dashboard()
    {
        if (isset($_SESSION['access'])) {
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
            $this->view->render('admin/dashboard');
        } else {
            $_SESSION['message'] = "Debe iniciar sesion para ingresar al sistema";  // Guardamos el mensaje en la sesión
            header("Location: " . __baseurl__);  // Redirigimos a login en caso de error
            exit;
        }
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = $_POST;
            $this->model->createTeacher($data);
            header('Location: /teacher');
            exit;
        }
        $this->view->render('teacher/create');
    }
}
?>