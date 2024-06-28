<?php
class DashboardController extends Controller {
    public function __construct() {
        $this->checkEmployeeOrAdmin(); // Verifica si el usuario es empleado o administrador
    }

    public function index() {


        $reservationModel = $this->model('ReservationModel');
        $reservations = $reservationModel->getAllReservations();

        $paymentModel = $this->model('PaymentModel');
        $payments = $paymentModel->getAllPayments();

        $clientModel = $this->model('ClientModel');
        $clients = $clientModel->getCountClients();



        $data = [
            'title' => 'Dashboard',
            'icon_page' => '<i class="mdi mdi-view-dashboard"></i>',
            'short_title' => '',
            'module' => 'dashboard',
        ];
        $this->view('admin.index', $data);
    }
}
?>
