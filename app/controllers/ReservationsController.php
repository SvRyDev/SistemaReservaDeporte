<?php
class ReservationsController extends Controller {
    public function __construct() {
        $this->checkEmployeeOrAdmin(); // Verifica si el usuario es empleado o administrador
    }

    public function index() {
        $reservationModel = $this->model('ReservationModel');
        $reservations = $reservationModel->getAllReservations();

        $data = [
            'title' => 'Gestionar Reservas',
            'reservations' => $reservations
        ];

        $this->view('admin.dashboard.manage_reservations', $data);
    }

    public function create() {
        $sportsFieldModel = $this->model('SportsFieldModel');
        $fields = $sportsFieldModel->getAllFields();

        $clientModel = $this->model('ClientModel');
        $clients = $clientModel->getAllClients();

        $stateModel = $this->model('StateModel');
        $states = $stateModel->getAllStates();

        $data = [
            'title' => 'Agregar Reserva',
            'fields' => $fields,
            'clients' => $clients,
            'states' => $states
        ];

        $this->view('admin.dashboard.add_reservation', $data);
    }

    public function store() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $idCampo = $_POST['idCampo'];
            $idCliente = $_POST['idCliente'];
            $idEmpleado = $_SESSION['user_id']; // Obtener el ID del empleado logueado
            $detalle = $_POST['detalle'];
            $fechaEntrada = $_POST['fechaEntrada'];
            $fechaSalida = $_POST['fechaSalida'];
            $duracion = $_POST['duracion'];
            $precioTotal = $_POST['precioTotal'];
            $idEstado = $_POST['idEstado'];

            $reservationModel = $this->model('ReservationModel');
            $reservationModel->createReservation($idCampo, $idCliente, $idEmpleado, $detalle, $fechaEntrada, $fechaSalida, $duracion, $precioTotal, $idEstado);

            header("Location: " . APP_URL . "/reservations");
            exit();
        }
    }

    public function edit($idReserva) {
        $reservationModel = $this->model('ReservationModel');
        $reservation = $reservationModel->getReservationById($idReserva);

        $sportsFieldModel = $this->model('SportsFieldModel');
        $fields = $sportsFieldModel->getAllFields();

        $clientModel = $this->model('ClientModel');
        $clients = $clientModel->getAllClients();

        $stateModel = $this->model('StateModel');
        $states = $stateModel->getAllStates();

        $data = [
            'title' => 'Editar Reserva',
            'reservation' => $reservation,
            'fields' => $fields,
            'clients' => $clients,
            'states' => $states
        ];

        $this->view('admin.dashboard.edit_reservation', $data);
    }

    public function update() {
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
            $idEstado = $_POST['idEstado'];

            $reservationModel = $this->model('ReservationModel');
            $reservationModel->updateReservation($idReserva, $idCampo, $idCliente, $idEmpleado, $detalle, $fechaEntrada, $fechaSalida, $duracion, $precioTotal, $idEstado);

            header("Location: " . APP_URL . "/reservations");
            exit();
        }
    }

    public function delete($idReserva) {
        $reservationModel = $this->model('ReservationModel');
        $reservationModel->deleteReservation($idReserva);

        header("Location: " . APP_URL . "/reservations");
        exit();
    }
}
?>
