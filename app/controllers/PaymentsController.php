<?php
class PaymentsController extends Controller
{
    public function __construct()
    {
        $this->checkEmployeeOrAdmin(); // Verifica si el usuario es empleado o administrador
    }

    public function index()
    {
        $paymentModel = $this->model('PaymentModel');
        $payments = $paymentModel->getAllPayments();

        $data = [
            'title' => 'Gestionar Pagos',
            'payments' => $payments,
            'icon_page' => '<i class="mdi mdi-credit-card"></i>',
            'short_title' => 'Pagos',
            'module' => 'payments',
            'singular' => 'Pago',
        ];

        $this->view('admin.dashboard.manage_payments', $data);
    }

    public function create($idReserva = null)
    {
        $reservationModel = $this->model('ReservationModel');
        $paymentMethodModel = $this->model('PaymentMethodModel');

        $reservation = null;
        if ($idReserva) {
            $reservation = $reservationModel->getReservationDetails($idReserva);
        }

        $reservations = $reservationModel->getAllReservations(); // Obtener todas las reservas
        $methods = $paymentMethodModel->getAllPaymentMethods();

        $data = [
            'title' => 'Agregar Pago',
            'reservation' => $reservation,
            'reservations' => $reservations, // Pasar todas las reservas a la vista
            'methods' => $methods,
            'from_reservations' => $idReserva !== null // Indicador si viene de gestión de reservas
        ];

        $this->view('admin.dashboard.add_payment', $data);
    }

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $monto = $_POST['monto'];
            $fechaPago = CURRENT_TIME;
            $observacion = $_POST['observacion'];
            $idReserva = $_POST['idReserva'];
            $idMetodoPago = $_POST['idMetodoPago'];
            $estadoPago = $_POST['estado_pago'];

            $paymentModel = $this->model('PaymentModel');
            $paymentModel->createPayment($monto, $fechaPago, $observacion, $idReserva, $idMetodoPago);

            // Actualizar el estado de pago de la reserva
            $reservationModel = $this->model('ReservationModel');
            $reservationModel->updateReservationPaymentState($idReserva, $estadoPago);

            header("Location: " . APP_URL . "/reservations");
            exit();
        }
    }

    public function edit($idPago)
    {
        $paymentModel = $this->model('PaymentModel');
        $payment = $paymentModel->getPaymentById($idPago);

        $reservationModel = $this->model('ReservationModel');
        $paymentMethodModel = $this->model('PaymentMethodModel');

        $reservation = $reservationModel->getReservationDetails($payment->idReserva);
        $reservations = $reservationModel->getAllReservations();
        $methods = $paymentMethodModel->getAllPaymentMethods();

        $data = [
            'title' => 'Editar Pago',
            'payment' => $payment,
            'reservation' => $reservation,
            'reservations' => $reservations,
            'methods' => $methods,
            'from_reservations' => true // Asumimos que la edición viene de la gestión de reservas
        ];

        $this->view('admin.dashboard.edit_payment', $data);
    }

    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $idPago = $_POST['idPago'];
            $monto = $_POST['monto'];
            $fechaPago = $_POST['fechaPago'];
            $observacion = $_POST['observacion'];
            $idReserva = $_POST['idReserva'];
            $idMetodoPago = $_POST['idMetodoPago'];
            $estadoPago = $_POST['estado_pago'];

            $paymentModel = $this->model('PaymentModel');
            $paymentModel->updatePayment($idPago, $monto, $fechaPago, $observacion, $idReserva, $idMetodoPago);

            // Actualizar el estado de pago de la reserva
            $reservationModel = $this->model('ReservationModel');
            $reservationModel->updateReservationPaymentState($idReserva, $estadoPago);

            header("Location: " . APP_URL . "/payments");
            exit();
        }
    }

    public function delete($idPago)
    {
        $paymentModel = $this->model('PaymentModel');
        $paymentModel->deletePayment($idPago);

        header("Location: " . APP_URL . "/payments");
        exit();
    }
}
