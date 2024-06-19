<?php
class SportEquipmentsController extends Controller {
    public function __construct() {
        $this->checkEmployeeOrAdmin(); // Verifica si el usuario es empleado o administrador
    }

    public function index() {
        $equipmentModel = $this->model('SportEquipmentModel');
        $equipments = $equipmentModel->getAllEquipments();

        $data = [
            'title' => 'Gestionar Implementos Deportivos',
            'equipments' => $equipments
        ];

        $this->view('admin.dashboard.manage_sport_equipments', $data);
    }

    public function create() {
        $data = [
            'title' => 'Agregar Implemento Deportivo'
        ];

        $this->view('admin.dashboard.add_sport_equipment', $data);
    }

    public function store() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nombre = $_POST['nombre'];
            $descripcion = $_POST['descripcion'];
            $precioAlquiler = $_POST['precioAlquiler'];
            $estado = $_POST['estado'];

            $equipmentModel = $this->model('SportEquipmentModel');
            $equipmentModel->createEquipment($nombre, $descripcion, $precioAlquiler, $estado);

            header("Location: " . APP_URL . "/sportEquipments");
            exit();
        }
    }

    public function edit($idImplemento) {
        $equipmentModel = $this->model('SportEquipmentModel');
        $equipment = $equipmentModel->getEquipmentById($idImplemento);

        $data = [
            'title' => 'Editar Implemento Deportivo',
            'equipment' => $equipment
        ];

        $this->view('admin.dashboard.edit_sport_equipment', $data);
    }

    public function update() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $idImplemento = $_POST['idImplemento'];
            $nombre = $_POST['nombre'];
            $descripcion = $_POST['descripcion'];
            $precioAlquiler = $_POST['precioAlquiler'];
            $estado = $_POST['estado'];

            $equipmentModel = $this->model('SportEquipmentModel');
            $equipmentModel->updateEquipment($idImplemento, $nombre, $descripcion, $precioAlquiler, $estado);

            header("Location: " . APP_URL . "/sportEquipments");
            exit();
        }
    }

    public function delete($idImplemento) {
        $equipmentModel = $this->model('SportEquipmentModel');
        $equipmentModel->deleteEquipment($idImplemento);

        header("Location: " . APP_URL . "/sportEquipments");
        exit();
    }
}
?>
