<?php
class SportsController extends Controller {
    public function __construct() {
        $this->checkEmployeeOrAdmin(); // Verifica si el usuario es empleado o administrador
    }

    public function index() {
        $sportModel = $this->model('SportModel');
        $sports = $sportModel->getAllSports();

        $data = [
            'title' => 'Gestionar Deportes',
            'sports' => $sports
        ];

        $this->view('admin.dashboard.manage_sports', $data);
    }

    public function create() {
        $data = [
            'title' => 'Agregar Deporte'
        ];

        $this->view('admin.dashboard.add_sport', $data);
    }

    public function store() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nombre = $_POST['nombre'];
            $descripcion = $_POST['descripcion'];

            $sportModel = $this->model('SportModel');
            $sportModel->createSport($nombre, $descripcion);

            header("Location: " . APP_URL . "/sports");
            exit();
        }
    }

    public function edit($idTipoDeporte) {
        $sportModel = $this->model('SportModel');
        $sport = $sportModel->getSportById($idTipoDeporte);

        $data = [
            'title' => 'Editar Deporte',
            'sport' => $sport
        ];

        $this->view('admin.dashboard.edit_sport', $data);
    }

    public function update() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $idTipoDeporte = $_POST['idTipoDeporte'];
            $nombre = $_POST['nombre'];
            $descripcion = $_POST['descripcion'];

            $sportModel = $this->model('SportModel');
            $sportModel->updateSport($idTipoDeporte, $nombre, $descripcion);

            header("Location: " . APP_URL . "/sports");
            exit();
        }
    }

    public function delete($idTipoDeporte) {
        $sportModel = $this->model('SportModel');
        $sportModel->deleteSport($idTipoDeporte);

        header("Location: " . APP_URL . "/sports");
        exit();
    }
}
?>
