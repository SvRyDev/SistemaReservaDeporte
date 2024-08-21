<?php
class AccountClientController extends Controller
{

    public function __construct()
    {
        $this->checkClient(); // Verifica si el usuario es empleado o administrador
    }

    public function index()
    {

        $clientModel = $this->model('ClientModel');
        $idUser = $_SESSION['user_id'];
        $client = $clientModel->getClientDetailsByUserId($idUser);

        $data = [
            'title' => 'Mi Perfil',
            'content' => 'Aquí puedes poner la información sobre tu organización, su historia, misión, visión, etc.',
            'module' => 'accountClient',
        ];

        if (isAjax()) {
            echo json_encode($client);
            return;
        }


        $this->view('client/account', $data);
    }


    public function update()
    {
        // Verificar si la sesión ya está iniciada
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $idUsuario = $_POST['idUsuario'];
                $nombre = $_POST['nombre'];
                $telefono = $_POST['telefono'];
                $email = $_POST['email'];
                $contrasena = $_POST['contrasena'];

                $clientModel = $this->model('ClientModel');

                // Encriptar la contraseña si se proporcionó
                if (!empty($contrasena) && preg_match('/[a-zA-Z0-9]/', $contrasena)) {
                    $contrasenaEncriptada = hash('sha256', $contrasena);
                    $clientModel->updateClientDetailsByUserId($idUsuario, $nombre, $telefono, $email, $contrasenaEncriptada);

                    // Destruir la sesión actual si se actualizó la contraseña
                    session_destroy();

                    // Redirigir al usuario al inicio de sesión
                    header("Location: " . APP_URL . "/login");
                    exit();
                } else {
                    // Si no se proporcionó contraseña, solo actualizar datos del cliente
                    $clientModel->updateClientDetailsByUserId($idUsuario, $nombre, $telefono, $email);

                    // Actualizar variables de sesión con los nuevos datos
                    $_SESSION['user_email'] = $email;
                    $_SESSION['user_phone'] = $telefono;
                    $_SESSION['user_name'] = $nombre;

                    // Responder si es una solicitud AJAX
                    if (isAjax()) {
                        header('Content-Type: application/json');
                        echo json_encode([
                            'status' => 'success',
                            'message' => 'Datos actualizados correctamente',
                        ]);
                        return;
                    }

                    // Redirigir a alguna página después de actualizar los datos si no es AJAX
                    header("Location: " . APP_URL . "/dashboard");
                    exit();
                }
            } catch (Exception $e) {
                // Manejar errores
                if (isAjax()) {
                    header('Content-Type: application/json');
                    echo json_encode([
                        'status' => 'error',
                        'message' => 'Error al actualizar datos: ' . $e->getMessage()
                    ]);
                    return;
                } else {
                    // Manejar errores no AJAX
                    // Puedes redirigir a una página de error o mostrar un mensaje
                    echo 'Error: ' . $e->getMessage();
                }
            }
        }
    }
}
