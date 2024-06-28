<?php
class LoginController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Login'
        ];
        $this->view('client/auth/login', $data);
    }

    public function authenticate()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = $_POST['email'];
            $password = hash('sha256', $_POST['password']);

            $userModel = $this->model('UserModel');
            $user = $userModel->findUserByEmail($email);
            echo ('<script>console.log( ' . $password . ');</script>');

            if ($user && hash_equals($password, $user->contrasena)) {
                // Usuario autenticado correctamente
                session_start();
                $_SESSION['user_id'] = $user->idUsuario;
                $_SESSION['user_role'] = $userModel->getUserRole($user->idUsuario);
                $_SESSION['is_employee'] = $userModel->isEmployee($user->idUsuario);

                // Establecer el correo electrónico y el nombre en la sesión
                if (isset($user->cliente_email)) {
                    $_SESSION['user_email'] = $user->cliente_email;
                    $_SESSION['user_phone'] = $user->cliente_telefono;
                    $_SESSION['user_name'] = $user->cliente_nombre; // Asumiendo que el nombre está en el campo `nombre`
                } elseif (isset($user->empleado_email)) {
                    $_SESSION['user_email'] = $user->empleado_email;
                    $_SESSION['user_phone'] = $user->empleado_telefono;
                    $_SESSION['user_name'] = $user->empleado_nombre; // Asumiendo que el nombre está en el campo `nombre`

                }

                header("Location: " . APP_URL);
                exit();
            } else {
                // Credenciales incorrectas
                $data = [
                    'title' => 'Login',
                    'error' => 'Credenciales incorrectas. Por favor, intenta de nuevo.'
                ];
                $this->view('client/auth/login', $data);
            }
        } else {
            header("Location: " . APP_URL . "/login");
            exit();
        }
    }

    public function logout()
    {
        session_start();
        session_unset();
        session_destroy();
        header("Location: " . APP_URL . "/login");
        exit();
    }
}
