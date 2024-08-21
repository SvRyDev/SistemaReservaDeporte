<?php
class SportsFieldsController extends Controller
{
    public function __construct()
    {
        $this->checkEmployeeOrAdmin(); // Verifica si el usuario es empleado o administrador
    }

    public function index()
    {
        $sportsFieldModel = $this->model('SportsFieldModel');
        $fields = $sportsFieldModel->getAllFields();

        $sportModel = $this->model('SportModel');
        $sports = $sportModel->getAllSports();

        $data = [
            'title' => 'Gestionar Campos Deportivos',
            'short_title' => 'Campos Deportivos',
            'icon_page' => '<i class="mdi mdi-stadium"></i>',
            'module' => 'SportsFields',
            'singular' => 'Campo Deportivo',
            'fields' => $fields,
            'sports' => $sports,
        ];

        if (isAjax()) {
            echo json_encode($fields);
            return;
        }

        $this->view('admin.dashboard.manage_sports_fields', $data);
    }

    public function new()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $codigo = $_POST['codigo'];
            $alquilerHora = $_POST['alquilerHora'];
            $idTipoDeporte = $_POST['idTipoDeporte'];
            $estado = "";
            $disponible = isset($_POST['disponible']) ? 1 : 0;

            $sportsFieldModel = $this->model('SportsFieldModel');
            $idCampo = $sportsFieldModel->createField($codigo, $alquilerHora, $idTipoDeporte, $estado, $disponible);

            if (isAjax()) {
                header('Content-Type: application/json');
                echo json_encode([
                    'status' => 'success',
                    'message' => 'Campo Registrado Correctamente :D',
                    'field' => [
                        'idCampo' => $idCampo,
                        'codigo' => $codigo,
                        'alquilerHora' => $alquilerHora,
                        'idTipoDeporte' => $idTipoDeporte,
                        'estado' => $estado,
                        'disponible' => $disponible,

                        
                    ]
                ]);
                return;
            }
        }
    }


    public function edit($idCampo)
    {
        $sportsFieldModel = $this->model('SportsFieldModel');
        $field = $sportsFieldModel->getFieldById($idCampo);

        $sportModel = $this->model('SportModel');
        $sports = $sportModel->getAllSports();

        if (isAjax()) {
            header('Content-Type: application/json');
            echo json_encode([
                'field' => $field,
                'sports' => $sports,
            ]);
            return;
        }
    }

    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            try {

            $idCampo = $_POST['idCampo'];
            $codigo = $_POST['codigo'];
            $alquilerHora = $_POST['alquilerHora'];
            $idTipoDeporte = $_POST['idTipoDeporte'];
            $estado = "";
            $disponible = isset($_POST['disponible']) ? 1 : 0;

            $sportsFieldModel = $this->model('SportsFieldModel');
            $sportsFieldModel->updateField($idCampo, $codigo, $alquilerHora, $idTipoDeporte, $estado, $disponible);

                if (isAjax()) {
                    header('Content-Type: application/json');
                    echo json_encode([
                        'status' => 'success',
                        'message' => 'Campo Actualizado Correctamente :D',
                        'field' => [
                            'idCampo' => $idCampo,
                            'codigo' => $codigo,
                            'alquilerHora' => $alquilerHora,
                            'idTipoDeporte' => $idTipoDeporte,
                            'estado' => $estado,
                            'disponible' => $disponible,
                        ]
                    ]);
                    return;
                }

                header("Location: " . APP_URL . "");
                exit();
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

    public function delete($idCampo)
    {
        $sportsFieldModel = $this->model('SportsFieldModel');
        $sportsFieldModel->deleteField($idCampo);


        if (isAjax()) {
            header('Content-Type: application/json');
            echo json_encode([
                'idCampo' => $idCampo,
                'status' => 'success', 
                'message' => 'Campo eliminado correctamente']
            );
            return;
        }

    }
}
