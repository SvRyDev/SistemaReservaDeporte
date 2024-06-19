<?php
class StateController extends Controller {
    public function __construct() {
        $this->checkEmployeeOrAdmin(); // Verifica si el usuario es empleado o administrador
    }

    public function index() {
        $stateModel = $this->model('StateModel');
        $states = $stateModel->getAllStates();

        $data = [
            'title' => 'Gestionar Estados',
            'states' => $states
        ];

        $this->view('admin.dashboard.manage_states', $data);
    }

    public function create() {
        $data = [
            'title' => 'Agregar Estado'
        ];

        $this->view('admin.dashboard.add_state', $data);
    }

    public function store() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nombre = $_POST['nombre'];
            $descripcion = $_POST['descripcion'];

            $stateModel = $this->model('StateModel');
            $stateModel->createState($nombre, $descripcion);

            header("Location: " . APP_URL . "/state");
            exit();
        }
    }

    public function edit($idEstado) {
        $stateModel = $this->model('StateModel');
        $state = $stateModel->getStateById($idEstado);

        $data = [
            'title' => 'Editar Estado',
            'state' => $state
        ];

        $this->view('admin.dashboard.edit_state', $data);
    }

    public function update() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $idEstado = $_POST['idEstado'];
            $nombre = $_POST['nombre'];
            $descripcion = $_POST['descripcion'];

            $stateModel = $this->model('StateModel');
            $stateModel->updateState($idEstado, $nombre, $descripcion);

            header("Location: " . APP_URL . "/state");
            exit();
        }
    }

    public function delete($idEstado) {
        $stateModel = $this->model('StateModel');
        $stateModel->deleteState($idEstado);

        header("Location: " . APP_URL . "/state");
        exit();
    }
}
?>
