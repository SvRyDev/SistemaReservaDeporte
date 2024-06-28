<?php
class PaymentMethodsController extends Controller
{
    public function __construct()
    {
        $this->checkEmployeeOrAdmin();
    }

    public function index()
    {
        $paymentMethodModel = $this->model('PaymentMethodModel');
        $paymentMethods = $paymentMethodModel->getAllPaymentMethods();

        $data = [
            'title' => 'Gestionar Métodos de Pago',
            'paymentMethods' => $paymentMethods,
            'icon_page' => '<i class="mdi mdi-cash"></i>',
            'short_title' => 'Metodos de Pago',
            'module' => 'paymentsmethods',
            'singular' => 'Método de Pago',
        ];

        $this->view('admin.dashboard.manage_payment_methods', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Agregar Método de Pago'
            
        ];

        $this->view('admin.dashboard.add_payment_method', $data);
    }

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nombre = $_POST['nombre'];
            $notas = $_POST['notas'];
            $codigo = $_POST['codigo'];
            $tarifa_adicional = $_POST['tarifa_adicional'];
            $disponible = isset($_POST['disponible']) ? 1 : 0;
            $url_integracion = $_POST['url_integracion'];

            $paymentMethodModel = $this->model('PaymentMethodModel');
            $paymentMethodModel->createPaymentMethod($nombre, $notas, $codigo, $tarifa_adicional, $disponible, $url_integracion);

            header("Location: " . APP_URL . "/paymentMethods");
            exit();
        }
    }

    public function edit($idMetodoPago)
    {
        $paymentMethodModel = $this->model('PaymentMethodModel');
        $paymentMethod = $paymentMethodModel->getPaymentMethodById($idMetodoPago);

        $data = [
            'title' => 'Editar Método de Pago',
            'paymentMethod' => $paymentMethod
        ];

        $this->view('admin.dashboard.edit_payment_method', $data);
    }

    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $idMetodoPago = $_POST['idMetodoPago'];
            $nombre = $_POST['nombre'];
            $notas = $_POST['notas'];
            $codigo = $_POST['codigo'];
            $tarifa_adicional = $_POST['tarifa_adicional'];
            $disponible = isset($_POST['disponible']) ? 1 : 0;
            $url_integracion = $_POST['url_integracion'];

            $paymentMethodModel = $this->model('PaymentMethodModel');
            $paymentMethodModel->updatePaymentMethod($idMetodoPago, $nombre, $notas, $codigo, $tarifa_adicional, $disponible, $url_integracion);

            header("Location: " . APP_URL . "/paymentMethods");
            exit();
        }
    }

    public function delete($idMetodoPago)
    {
        $paymentMethodModel = $this->model('PaymentMethodModel');
        $paymentMethodModel->deletePaymentMethod($idMetodoPago);

        header("Location: " . APP_URL . "/paymentMethods");
        exit();
    }
}
