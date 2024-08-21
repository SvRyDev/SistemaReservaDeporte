<?php
class StatusController extends Controller
{
    public function __construct()
    {
        $this->checkEmployeeOrAdmin(); // Verifica si el usuario es empleado o administrador
    }

    //Carga incial
    public function index()
    {
        $stateModel = $this->model('StatusModel');
        $status = $stateModel->getAllStates();

        $data = [
            'title' => 'Gestionar Estados de Reserva',
            'short_title' => 'Estados ',
            'icon_page' => '<i class="mdi mdi-soccer"></i>',
            'module' => 'status',
            'singular' => 'Estado de Reserva',
            'status' => $status
        ];

        if (isAjax()) {
            echo json_encode($status);
            return;
        }

        $this->view('admin.dashboard.manage_status', $data);
    }

    //Create Data
    public function new()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nombre = $_POST['nombre'];
            $descripcion = $_POST['descripcion'];
            $color = $_POST['color'];
            $considerar_solapamiento = isset($_POST['considerar_solapamiento']) ? 1 : 0;

            $statusModel = $this->model('StatusModel');
            $idEstado = $statusModel->createState($nombre, $descripcion, $color, $considerar_solapamiento);

            if (isAjax()) {
                header('Content-Type: application/json');
                echo json_encode([
                    'status' => 'success',
                    'message' => 'Deporte Registrado Correctamente :D',
                    'statu' => [
                        'idEstado' => $idEstado,
                        'nombre' => $nombre,
                        'descripcion' => $descripcion,
                        'color' => $color,
                        'considerar_solapamiento' => $considerar_solapamiento,
                    ]
                ]);
                return;
            }
        }
    }

    //Load Data by Id 
    public function edit($idEstado)
    {
        $statusModel = $this->model('StatusModel');
        $statu = $statusModel->getStateById($idEstado);

        if (isAjax()) {
            header('Content-Type: application/json');
            echo json_encode([
                'statu' => $statu,
            ]);
            return;
        }
    }

    //Update Data
    public function update()
    {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            try {
                $idEstado = $_POST['idEstado'];
                $nombre = $_POST['nombre'];
                $descripcion = $_POST['descripcion'];
                $color = $_POST['color'];
                $considerar_solapamiento = isset($_POST['considerar_solapamiento']) ? 1 : 0;

                $statusModel = $this->model('StatusModel');
                $statusModel->updateState($idEstado, $nombre, $descripcion, $color, $considerar_solapamiento);



                if (isAjax()) {
                    header('Content-Type: application/json');
                    echo json_encode([
                        'status' => 'success',
                        'message' => 'Deporte Actualizado Correctamente :D',
                        'statu' => [
                            'idEstado' => $idEstado,
                            'nombre' => $nombre,
                            'descripcion' => $descripcion,
                            'color' => $color,
                            'considerar_solapamiento' => $considerar_solapamiento,
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

    //Delete Data
    public function delete($idEstado)
    {
        $statusModel = $this->model('StatusModel');
        $statusModel->deleteState($idEstado);

        if (isAjax()) {
            header('Content-Type: application/json');
            echo json_encode(
                [
                    'idEstado' => $idEstado,
                    'status' => 'success',
                    'message' => 'Deporte eliminado correctamente'
                ]
            );
            return;
        }
    }
}
