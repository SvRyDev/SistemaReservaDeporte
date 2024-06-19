<?php
class SportsFieldsController extends Controller {
    public function __construct() {
        $this->checkEmployeeOrAdmin(); // Verifica si el usuario es empleado o administrador
    }

    public function index() {
        $sportsFieldModel = $this->model('SportsFieldModel');
        $fields = $sportsFieldModel->getAllFields();

        $data = [
            'title' => 'Gestionar Campos Deportivos',
            'fields' => $fields
        ];

        $this->view('admin.dashboard.manage_sports_fields', $data);
    }

    public function create() {
        $sportModel = $this->model('SportModel');
        $sports = $sportModel->getAllSports();

        $data = [
            'title' => 'Agregar Campo Deportivo',
            'sports' => $sports
        ];

        $this->view('admin.dashboard.add_sports_field', $data);
    }

    public function store() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $codigo = $_POST['codigo'];
            $alquilerHora = $_POST['alquilerHora'];
            $idTipoDeporte = $_POST['idTipoDeporte'];
            $estado = $_POST['estado'];
            $disponible = isset($_POST['disponible']) ? 1 : 0;

            $sportsFieldModel = $this->model('SportsFieldModel');
            $sportsFieldModel->createField($codigo, $alquilerHora, $idTipoDeporte, $estado, $disponible);

            header("Location: " . APP_URL . "/sportsFields");
            exit();
        }
    }

    public function edit($idCampo) {
        $sportsFieldModel = $this->model('SportsFieldModel');
        $field = $sportsFieldModel->getFieldById($idCampo);

        $sportModel = $this->model('SportModel');
        $sports = $sportModel->getAllSports();

        $data = [
            'title' => 'Editar Campo Deportivo',
            'field' => $field,
            'sports' => $sports
        ];

        $this->view('admin.dashboard.edit_sports_field', $data);
    }

    public function update() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $idCampo = $_POST['idCampo'];
            $codigo = $_POST['codigo'];
            $alquilerHora = $_POST['alquilerHora'];
            $idTipoDeporte = $_POST['idTipoDeporte'];
            $estado = $_POST['estado'];
            $disponible = isset($_POST['disponible']) ? 1 : 0;

            $sportsFieldModel = $this->model('SportsFieldModel');
            $sportsFieldModel->updateField($idCampo, $codigo, $alquilerHora, $idTipoDeporte, $estado, $disponible);

            header("Location: " . APP_URL . "/sportsFields");
            exit();
        }
    }

    public function delete($idCampo) {
        $sportsFieldModel = $this->model('SportsFieldModel');
        $sportsFieldModel->deleteField($idCampo);

        header("Location: " . APP_URL . "/sportsFields");
        exit();
    }
}
?>
