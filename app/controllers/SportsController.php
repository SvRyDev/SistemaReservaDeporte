<?php
class SportsController extends Controller
{
    public function __construct()
    {
        $this->checkEmployeeOrAdmin(); // Verifica si el usuario es empleado o administrador
    }

    //Carga incial
    public function index()
    {
        $sportModel = $this->model('SportModel');
        $sports = $sportModel->getAllSports();

        $data = [
            'title' => 'Gestionar Deportes',
            'short_title' => 'Tipo Deportes',
            'icon_page' => '<i class="mdi mdi-soccer"></i>',
            'module' => 'sports',
            'singular' => 'Deporte',
            'sports' => $sports,
        ];

        if (isAjax()) {
            echo json_encode($sports);
            return;
        }


        $this->view('admin.dashboard.manage_sports', $data);
    }


    //Create Data
    public function new()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nombre = $_POST['nombre'];
            $descripcion = $_POST['descripcion'];

            $sportModel = $this->model('SportModel');
            $idTipoDeporte = $sportModel->createSport($nombre, $descripcion);

            if (isAjax()) {
                header('Content-Type: application/json');
                echo json_encode([
                    'status' => 'success',
                    'message' => 'Deporte Registrado Correctamente :D',
                    'role' => [
                        'idTipoDeporte' => $idTipoDeporte,
                        'nombre' => $nombre,
                        'descripcion' => $descripcion,
                    ]
                ]);
                return;
            }
        }
    }

    //Load Data by Id 
    public function edit($idTipoDeporte)
    {
        $sportModel = $this->model('SportModel');
        $sport = $sportModel->getSportById($idTipoDeporte);

        if (isAjax()) {
            header('Content-Type: application/json');
            echo json_encode([
                'sport' => $sport,
            ]);
            return;
        }
    }

    //Update Data
    public function update()
    {


        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            try {

                $idTipoDeporte = $_POST['idTipoDeporte'];
                $nombre = $_POST['nombre'];
                $descripcion = $_POST['descripcion'];

                $sportModel = $this->model('SportModel');
                $sportModel->updateSport($idTipoDeporte, $nombre, $descripcion);



                if (isAjax()) {
                    header('Content-Type: application/json');
                    echo json_encode([
                        'status' => 'success',
                        'message' => 'Deporte Actualizado Correctamente :D',
                        'sport' => [
                            'idTipoDeporte' => $idTipoDeporte,
                            'nombre' => $nombre,
                            'descripcion' => $descripcion,

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
    public function delete($idTipoDeporte)
    {
        $sportModel = $this->model('SportModel');
        $sportModel->deleteSport($idTipoDeporte);

        if (isAjax()) {
            header('Content-Type: application/json');
            echo json_encode(
                [

                    'idTipoDeporte' => $idTipoDeporte,
                    'status' => 'success',
                    'message' => 'Deporte eliminado correctamente'
                ]
            );
            return;
        }
    }
}
