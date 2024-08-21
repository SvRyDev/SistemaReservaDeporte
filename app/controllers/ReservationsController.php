<?php
class ReservationsController extends Controller
{
    public function __construct()
    {
        $this->checkEmployeeOrAdmin(); // Verifica si el usuario es empleado o administrador
    }

    public function index()
    {
        $reservationModel = $this->model('ReservationModel');
        $reservations = $reservationModel->getAllReservations();

        // Encriptar los IDs
        foreach ($reservations as &$reservation) {
            $reservation->encrypted_id = hmacEncrypt($reservation->idReserva);
        }

        $data = [
            'title' => 'Gestionar Reservas',
            'short_title' => 'Reservas',
            'icon_page' => '<i class="mdi mdi-calendar-clock"></i>',
            'module' => 'reservations',


            'reservations' => $reservations,
        ];

        if (isAjax()) {
            echo json_encode($reservations);
            return;
        }



        $this->view('admin.dashboard.manage_reservations', $data);
    }

    // Método para ver los pagos de una reserva
    public function viewPayments($idReserva)
    {
        $reservationModel = $this->model('ReservationModel');
        $reservation = $reservationModel->getReservationById($idReserva);
        $payments = $reservationModel->getPaymentsByReservation($idReserva);

        $data = [
            'title' => 'Pagos de la Reserva',
            'short_title' => 'Reservas',
            'icon_page' => '<i class="mdi mdi-calendar-clock"></i>',
            'module' => 'reservations',
            
            'reservation' => $reservation,
            'payments' => $payments
        ];

        $this->view('admin.dashboard.view_payments', $data);
    }


    public function create()
    {
        $sportsFieldModel = $this->model('SportsFieldModel');
        $fields = $sportsFieldModel->getAllFields();

        $clientModel = $this->model('ClientModel');
        $clients = $clientModel->getAllClients();

        $statusModel = $this->model('StatusModel');
        $status = $statusModel->getAllStates();

        $sportEquipmentModel = $this->model('SportEquipmentModel');
        $equipments = $sportEquipmentModel->getAllEquipments();

        $data = [
            'title' => 'Agregar Reserva',
            'short_title' => 'Reservas',
            'icon_page' => '<i class="mdi mdi-calendar-clock"></i>',
            'module' => 'reservations',

            'fields' => $fields,
            'clients' => $clients,
            'states' => $status,
            'equipments' => $equipments
        ];

        $this->view('admin.dashboard.add_reservation', $data);
    }

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $idCampo = $_POST['idCampo'];
            $idCliente = $_POST['idCliente'];
            $idEmpleado = $_SESSION['user_id']; // Obtener el ID del empleado logueado
            $detalle = $_POST['detalle'];
            $fechaEntrada = $_POST['fechaEntrada'];
            $fechaSalida = $_POST['fechaSalida'];
            $duracion = $_POST['duracion'];
            $precioTotal = $_POST['precioTotal'];

            
            $reservationModel = $this->model('ReservationModel');
            $sportsFieldModel = $this->model('SportsFieldModel');
            $clientModel = $this->model('ClientModel');
            $stateModel = $this->model('StatusModel');
            $sportEquipmentModel = $this->model('SportEquipmentModel');

            // Verificar si hay una reserva solapada
            if ($reservationModel->isOverlappingReservation($idCampo, $fechaEntrada, $fechaSalida)) {
                $data = [
                    'title' => 'Agregar Reserva',
                    'short_title' => 'Reservas',
                    'icon_page' => '<i class="mdi mdi-calendar-clock"></i>',
                    'module' => 'reservations',
        
                    'error' => 'Ya existe una reserva confirmada para este campo en el intervalo de tiempo seleccionado.',
                    'fields' => $sportsFieldModel->getAllFields(),
                    'clients' => $clientModel->getAllClients(),
                    'states' => $stateModel->getAllStates(),
                    'equipments' => $sportEquipmentModel->getAllEquipments()
                ];
                $this->view('admin.dashboard.add_reservation', $data);
                return;
            }

            $idReserva = $reservationModel->createReservation($idCampo, $idCliente, $idEmpleado, $detalle, $fechaEntrada, $fechaSalida, $duracion, $precioTotal, $idEstado = 1, $estadoPago = "Pendiente");

            // Agregar los implementos deportivos a la reserva (solo los seleccionados)
            if (!empty($_POST['implementos'])) {
                $implementos = [];
                foreach ($_POST['implementos'] as $id => $implemento) {
                    if (isset($implemento['id'])) {
                        $implementos[] = [
                            'idImplemento' => $id,
                            'Cantidad' => $implemento['cantidad'],
                            'PrecioTotal' => $implemento['precio']
                        ];
                    }
                }
                $reservationModel->addSportEquipmentsToReservation($idReserva, $implementos);
            }

            header("Location: " . APP_URL . "/reservations");
            exit();
        }
    }

    public function edit($encryptId)
    {
        $idReserva = hmacDecrypt($encryptId);

        if (!$idReserva) {
            // Manejar error de desencriptación
            die('ID de reserva inválido');
        }
        
        $reservationModel = $this->model('ReservationModel');
        $reservation = $reservationModel->getReservationById($idReserva);
        $reservation->implementos = $reservationModel->getSportEquipmentsByReservation($idReserva);
    
        $sportsFieldModel = $this->model('SportsFieldModel');
        $fields = $sportsFieldModel->getAllFields();
    
        $clientModel = $this->model('ClientModel');
        $clients = $clientModel->getAllClients();
    
        $statusModel = $this->model('StatusModel');
        $status = $statusModel->getAllStates();
    
        $sportEquipmentModel = $this->model('SportEquipmentModel');
        $equipments = $sportEquipmentModel->getAllEquipments();

        // Verificar si la solicitud es AJAX
        if (isAjax()) {
            header('Content-Type: application/json');
            echo json_encode([
                'details' => $reservation,
                'equipments' => $equipments,
            ]);
        } else {
            $data = [
                'title' => 'Editar Reserva',
                'short_title' => 'Reservas',
                'icon_page' => '<i class="mdi mdi-calendar-clock"></i>',
                'module' => 'reservations',
                
                'reservation' => $reservation,
                'fields' => $fields,
                'clients' => $clients,
                'status' => $status,
                'equipments' => $equipments
            ];
            $this->view('admin.dashboard.edit_reservation', $data);
        }
    }

    // Método para verificar si la solicitud es AJAX


    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $idReserva = $_POST['idReserva'];
            $idCampo = $_POST['idCampo'];
            $idCliente = $_POST['idCliente'];
            $idEmpleado = $_SESSION['user_id']; // Obtener el ID del empleado logueado
            $detalle = $_POST['detalle'];
            $fechaEntrada = $_POST['fechaEntrada'];
            $fechaSalida = $_POST['fechaSalida'];
            $duracion = $_POST['duracion'];
            $precioTotal = $_POST['precioTotal'];

            $reservationModel = $this->model('ReservationModel');
            $sportsFieldModel = $this->model('SportsFieldModel');
            $clientModel = $this->model('ClientModel');
            $stateModel = $this->model('StatusModel');
            $sportEquipmentModel = $this->model('SportEquipmentModel');

            // Verificar si hay una reserva solapada, excluyendo la reserva actual
            if ($reservationModel->isOverlappingReservation($idCampo, $fechaEntrada, $fechaSalida, $idReserva)) {
                $reservation = $reservationModel->getReservationById($idReserva);
                $reservation->implementos = $reservationModel->getSportEquipmentsByReservation($idReserva);

                $data = [
                    'title' => 'Editar Reserva',
                    'error' => 'Ya existe una reserva confirmada para este campo en el intervalo de tiempo seleccionado.',
                    'reservation' => $reservation,
                    'fields' => $sportsFieldModel->getAllFields(),
                    'clients' => $clientModel->getAllClients(),
                    'states' => $stateModel->getAllStates(),
                    'equipments' => $sportEquipmentModel->getAllEquipments()
                ];
                $this->view('admin.dashboard.edit_reservation', $data);
                return;
            }

            $reservationModel->updateReservation($idReserva, $idCampo, $idCliente, $idEmpleado, $detalle, $fechaEntrada, $fechaSalida, $duracion, $precioTotal);

            // Actualizar los implementos deportivos de la reserva (solo los seleccionados)
            $reservationModel->deleteSportEquipmentsFromReservation($idReserva);
            if (!empty($_POST['implementos'])) {
                $implementos = [];
                foreach ($_POST['implementos'] as $id => $implemento) {
                    if (isset($implemento['id'])) {
                        $implementos[] = [
                            'idImplemento' => $id,
                            'Cantidad' => $implemento['cantidad'],
                            'PrecioTotal' => $implemento['precio']
                        ];
                    }
                }
                $reservationModel->addSportEquipmentsToReservation($idReserva, $implementos);
            }

            header("Location: " . APP_URL . "/reservations");
            exit();
        }
    }

    public function delete($idReserva)
    {
        $reservationModel = $this->model('ReservationModel');
        $reservationModel->deleteReservation($idReserva);

        header("Location: " . APP_URL . "/reservations");
        exit();
    }



    public function updateState($idReserva)
    {
        $stateModel = $this->model('StatusModel');
        $states = $stateModel->getAllStates();
        $reservationModel = $this->model('ReservationModel');
        $reservation = $reservationModel->getReservationById($idReserva);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $idEstado = $_POST['idEstado'];
            $reservationModel->updateReservationState($idReserva, $idEstado);

            header("Location: " . APP_URL . "/reservations");
            exit();
        }

        $data = [
            'title' => 'Actualizar Estado de Reserva',
            'short_title' => 'Reservas',
            'icon_page' => '<i class="mdi mdi-calendar-clock"></i>',
            'module' => 'reservations',

            'reservation' => $reservation,
            'states' => $states
        ];

        $this->view('admin.dashboard.update_reservation_state', $data);
    }

    public function updatePaymentState($idReserva)
    {
        $reservationModel = $this->model('ReservationModel');
        $reservation = $reservationModel->getReservationById($idReserva);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $estadoPago = $_POST['estado_pago'];
            $reservationModel->updateReservationPaymentState($idReserva, $estadoPago);

            header("Location: " . APP_URL . "/reservations");
            exit();
        }

        $data = [
            'title' => 'Actualizar Estado de Pago de Reserva',
            'short_title' => 'Reservas',
            'icon_page' => '<i class="mdi mdi-calendar-clock"></i>',
            'module' => 'reservations',

            'reservation' => $reservation
        ];

        $this->view('admin.dashboard.update_reservation_payment_state', $data);
    }
}
