<?php
class ClientsController extends Controller {
    public function __construct() {
        $this->checkEmployeeOrAdmin(); // Verifica si el usuario es empleado o administrador
    }

    public function index() {
        $clientModel = $this->model('ClientModel');
        $clients = $clientModel->getAllClients();

        $data = [
            'title' => 'Gestionar Clientes',
            'clients' => $clients
        ];

        $this->view('admin.dashboard.manage_client', $data);
    }

    public function create() {
        $data = [
            'title' => 'Agregar Cliente'
        ];

        $this->view('admin.dashboard.add_client', $data);
    }

    public function store() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nombre = $_POST['nombre'];
            $telefono = $_POST['telefono'];
            $email = $_POST['email'];
            $password = hash('sha256', $_POST['password']);
            $roleId = $this->model('UserModel')->getRoleId('cliente');

            // Crear usuario
            $userModel = $this->model('UserModel');
            $userId = $userModel->createUser($password, $roleId);

            // Crear cliente
            $clientModel = $this->model('ClientModel');
            $clientModel->createClient($nombre, $telefono, $email, $userId);

            header("Location: " . APP_URL . "/clients");
            exit();
        }
    }

    public function edit($idCliente) {
        $clientModel = $this->model('ClientModel');
        $client = $clientModel->getClientById($idCliente);

        $data = [
            'title' => 'Editar Cliente',
            'client' => $client
        ];

        $this->view('admin.dashboard.edit_client', $data);
    }

    public function update() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $idCliente = $_POST['idCliente'];
            $nombre = $_POST['nombre'];
            $telefono = $_POST['telefono'];
            $email = $_POST['email'];

            $clientModel = $this->model('ClientModel');
            $clientModel->updateClient($idCliente, $nombre, $telefono, $email);

            header("Location: " . APP_URL . "/clients");
            exit();
        }
    }

    public function delete($idCliente) {
        $clientModel = $this->model('ClientModel');
        $clientModel->deleteClient($idCliente);

        header("Location: " . APP_URL . "/clients");
        exit();
    }
}
?>
