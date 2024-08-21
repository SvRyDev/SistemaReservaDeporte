<?php
class SportEquipmentsController extends Controller
{
    public function __construct()
    {
        $this->checkEmployeeOrAdmin(); // Verifica si el usuario es empleado o administrador
    }

    public function index()
    {
        $equipmentModel = $this->model('SportEquipmentModel');
        $equipments = $equipmentModel->getAllEquipments();

        $data = [
            'title' => 'Gestionar Implementos Deportivos',
            'short_title' => 'Implementos Deportivos',
            'icon_page' => '<i class="mdi mdi-tennis"></i>',
            'module' => 'SportEquipments',
            'singular' => 'Implemento Deportivo',
            'equipments' => $equipments,
        ];

        if (isAjax()) {
            echo json_encode($equipments);
            return;
        }


        $this->view('admin.dashboard.manage_sport_equipments', $data);
    }


    //Create Data
    public function new()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nombre = $_POST['nombre'];
            $descripcion = $_POST['descripcion'];
            $precioAlquiler = $_POST['precioAlquiler'];
            $estado = isset($_POST['estado']) ? 1 : 0;

            $equipmentModel = $this->model('SportEquipmentModel');
            $idImplemento = $equipmentModel->createEquipment($nombre, $descripcion, $precioAlquiler, $estado);

            if (isAjax()) {
                header('Content-Type: application/json');
                echo json_encode([
                    'status' => 'success',
                    'message' => 'implemento Registrado Correctamente :D',
                    'paymentMethod' => [
                        'idImplemento' => $idImplemento,
                        'nombre' => $nombre,
                        'descripcion' => $descripcion,
                        'precioAlquiler' => $precioAlquiler,
                        'estado' => $estado,
                    ]
                ]);
                return;
            }
        }
    }

    //Load Data by Id 
    public function edit($idImplemento)
    {
        $equipmentModel = $this->model('SportEquipmentModel');
        $equipment = $equipmentModel->getEquipmentById($idImplemento);


        if (isAjax()) {
            header('Content-Type: application/json');
            echo json_encode([
                'equipment' => $equipment,
            ]);
            return;
        }
    }


    //Update Data
    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            try {

                $idImplemento = $_POST['idImplemento'];
                $nombre = $_POST['nombre'];
                $descripcion = $_POST['descripcion'];
                $precioAlquiler = $_POST['precioAlquiler'];
                $estado = isset($_POST['estado']) ? 1 : 0;

                $equipmentModel = $this->model('SportEquipmentModel');
                $equipmentModel->updateEquipment($idImplemento, $nombre, $descripcion, $precioAlquiler, $estado);



                if (isAjax()) {
                    header('Content-Type: application/json');
                    echo json_encode([
                        'status' => 'success',
                        'message' => 'Implemento Actualizado Correctamente :D',
                        'paymentMethod' => [
                            'idImplemento' => $idImplemento,
                            'nombre' => $nombre,
                            'descripcion' => $descripcion,
                            'precioAlquiler' => $precioAlquiler,
                            'estado' => $estado,

                        ]
                    ]);
                    return;
                }
            } catch (Exception $e) {
                if (isAjax()) {
                    header('Content-Type: application/json');
                    echo json_encode([
                        'status' => 'error',
                        'message' => $e->getMessage()
                    ]);
                    return;
                }
            }
        }
    }

    public function delete($idImplemento)
    {
        $equipmentModel = $this->model('SportEquipmentModel');
        $equipmentModel->deleteEquipment($idImplemento);

        if (isAjax()) {
            header('Content-Type: application/json');
            echo json_encode(
                [

                    'idMetodoPago' => $idImplemento,
                    'status' => 'success',
                    'message' => 'Implemento eliminado correctamente'
                ]
            );
            return;
        }
    }
}
