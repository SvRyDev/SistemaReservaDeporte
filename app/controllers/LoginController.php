<?php
class LoginController extends Controller {
    public function index() {
        $data = [
            'title' => 'Login'
        ];
        $this->view('login', $data);
    }

    public function authenticate() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = $_POST['email'];
            $password = hash(ENCRYPT, $_POST['password']);

            $userModel = $this->model('UserModel');
            $user = $userModel->findUserByEmail($email);

            if ($user && hash_equals($password, $user->contrasena)) {
                // Usuario autenticado correctamente
                session_start();
                $_SESSION['user_id'] = $user->idUsuario;
                $_SESSION['user_email'] = $user->email;
                $_SESSION['user_name'] = $user->usuario;

                header("Location: " . APP_URL);
                exit();
            } else {
                // Credenciales incorrectas
                $data = [
                    'title' => 'Login',
                    'error' => 'Credenciales incorrectas. Por favor, intenta de nuevo.'
                ];
                $this->view('login', $data);
            }
        } else {
            header("Location: " . APP_URL . "/login");
            exit();
        }
    }

    public function logout() {
        session_start();
        session_unset();
        session_destroy();
        header("Location: " . APP_URL);
        exit();
    }
}
?>
