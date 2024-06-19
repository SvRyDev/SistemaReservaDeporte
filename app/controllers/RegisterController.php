<?php
class RegisterController extends Controller {
    public function index() {
        $data = [
            'title' => 'Register'
        ];
        $this->view('client.auth.register', $data);
    }

    public function store() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nombre = $_POST['nombre'];
            $telefono = $_POST['telefono'];
            $email = $_POST['email'];
            $password = hash('sha256', $_POST['password']);

            $userModel = $this->model('UserModel');
            $roleId = $userModel->getRoleId('cliente'); // Asignar rol de cliente

            if ($roleId) {
                $userId = $userModel->createUser($password, $roleId);

                $clientModel = $this->model('ClientModel');
                $clientModel->createClient($nombre, $telefono, $email, $userId);

                header("Location: " . APP_URL . "/login");
                exit();
            } else {
                $data = [
                    'title' => 'Register',
                    'error' => 'Error al registrar el usuario. Por favor, intenta de nuevo.'
                ];
                $this->view('client.auth.register', $data);
            }
        } else {
            header("Location: " . APP_URL . "/register");
            exit();
        }
    }
}
?>
