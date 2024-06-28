<?php
class ClientReservationsController extends Controller
{
    public function __construct()
    {
        $this->checkClient(); // Verifica si el usuario es empleado o administrador
    }

    public function index()
    {

        $reservationModel = $this->model('ReservationModel');
        $reservations = $reservationModel->getAllReservations();

        // Encriptar los IDs
        foreach ($reservations as &$reservation) {
            $reservation->encrypted_id = hmacEncrypt($reservation->idReserva);
        }

        $sportModel = $this->model('SportModel');
        $sports = $sportModel->getAllSports();

            $data = [
            'title' => 'Hacer una Reserva',
            'short_title' => 'Reservas',
            '$sports' => $sports,
            'reservations' => $reservations,
            'module' => 'ClientReservations'
        ];

        if (isAjax()) {
            echo json_encode($sports);
            return;
        }

        

        $this->view('client.reservation', $data);
    }


    function getSportFields(){
        $id = isset($_GET['id']) ? $_GET['id'] : '';
        $sportsFieldModel = $this->model('SportsFieldModel');
        $field = $sportsFieldModel->getFieldBySportId($id);


        if (isAjax()) {
            echo json_encode($field);
            return;
        }

   }

   function getAllAvailableReservations(){
    $reservationModel = $this->model('ReservationModel');
    $id = isset($_GET['id']) ? $_GET['id'] : '';
    $reservationsbyField = $reservationModel->getReservationsByField($id);

    if (isAjax()) {
        echo json_encode($reservationsbyField);
        return;
    }


   }

   function craeteReservation(){
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Sanitize input data
            $idCampo = filter_input(INPUT_POST, 'idCampo', FILTER_VALIDATE_INT);
            $idCliente = filter_input(INPUT_POST, 'idCliente', FILTER_VALIDATE_INT);
            $idEmpleado = filter_input(INPUT_POST, 'idEmpleado', FILTER_VALIDATE_INT);
            $detalle = filter_input(INPUT_POST, 'detalle', FILTER_SANITIZE_STRING);
            $fechaEntrada = filter_input(INPUT_POST, 'fechaEntrada', FILTER_SANITIZE_STRING);
            $fechaSalida = filter_input(INPUT_POST, 'fechaSalida', FILTER_SANITIZE_STRING);
            $duracion = filter_input(INPUT_POST, 'duracion', FILTER_VALIDATE_INT);
            $precioTotal = filter_input(INPUT_POST, 'precioTotal', FILTER_VALIDATE_FLOAT);
    
            // Load models
            $reservationModel = $this->model('ReservationModel');
            $sportsFieldModel = $this->model('SportsFieldModel');
            $clientModel = $this->model('ClientModel');
            $stateModel = $this->model('StateModel');
            $sportEquipmentModel = $this->model('SportEquipmentModel');
    
            // Check for overlapping reservations
            if ($reservationModel->isOverlappingReservation($idCampo, $fechaEntrada, $fechaSalida)) {
                $data = [
                    'title' => 'Agregar Reserva',
                    'error' => 'Ya existe una reserva confirmada para este campo en el intervalo de tiempo seleccionado.',
                    'fields' => $sportsFieldModel->getAllFields(),
                    'clients' => $clientModel->getAllClients(),
                    'states' => $stateModel->getAllStates(),
                    'equipments' => $sportEquipmentModel->getAllEquipments()
                ];
                $this->view('admin.dashboard.add_reservation', $data);
                return;
            }
    
            // Create reservation
            $idReserva = $reservationModel->createReservation(
                $idCampo, 
                $idCliente, 
                $idEmpleado, 
                $detalle, 
                $fechaEntrada, 
                $fechaSalida, 
                $duracion, 
                $precioTotal, 
                1, // idEstado
                "pendiente" // estado_pago
            );
    
            // Add sport equipments to reservation if any
            if (!empty($_POST['implementos'])) {
                $implementos = [];
                foreach ($_POST['implementos'] as $id => $implemento) {
                    if (isset($implemento['id'])) {
                        $implementos[] = [
                            'idImplemento' => filter_var($implemento['id'], FILTER_VALIDATE_INT),
                            'Cantidad' => filter_var($implemento['cantidad'], FILTER_VALIDATE_INT),
                            'PrecioTotal' => filter_var($implemento['precio'], FILTER_VALIDATE_FLOAT)
                        ];
                    }
                }
                $reservationModel->addSportEquipmentsToReservation($idReserva, $implementos);
            }
    
            header("Location: " . APP_URL . "/reservations");
            exit();
        } else {
            // Handle non-POST requests
            header("HTTP/1.1 405 Method Not Allowed");
            echo "Método no permitido";
            exit();
        }
    
    }
   }
}
