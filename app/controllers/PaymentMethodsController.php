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
            'short_title' => 'Metodos de Pago',
            'icon_page' => '<i class="mdi mdi-cash"></i>',
            'module' => 'paymentmethods',
            'singular' => 'Método de Pago',
            'paymentMethods' => $paymentMethods,
        ];

        if (isAjax()) {
            echo json_encode($paymentMethods);
            return;
        }

        $this->view('admin.dashboard.manage_payment_methods', $data);
    }



    //Create Data
    public function new()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $nombre = $_POST['nombre'];
            $notas = $_POST['notas'];
            $codigo = $_POST['codigo'];
            $tarifa_adicional = $_POST['tarifa_adicional'];
            $disponible = isset($_POST['disponible']) ? 1 : 0;
            $url_integracion = $_POST['url_integracion'];

            $paymentMethodModel = $this->model('PaymentMethodModel');
            $idMetodoPago = $paymentMethodModel->createPaymentMethod($nombre, $notas, $codigo, $tarifa_adicional, $disponible, $url_integracion);

            if (isAjax()) {
                header('Content-Type: application/json');
                echo json_encode([
                    'status' => 'success',
                    'message' => 'Metodo de Pago Registrado Correctamente :D',
                    'paymentMethod' => [
                        'idMetodoPago' => $idMetodoPago,
                        'nombre' => $nombre,
                        'notas' => $notas,
                        'codigo' => $codigo,
                        'tarifa_adicional' => $tarifa_adicional,
                        'disponible' => $disponible,
                        'url_integracion' => $url_integracion,
                    ]
                ]);
                return;
            }

        }
    }


    //Load Data by Id 
    public function edit($idMetodoPago)
    {
        $paymentMethodModel = $this->model('PaymentMethodModel');
        $paymentMethod = $paymentMethodModel->getPaymentMethodById($idMetodoPago);


        if (isAjax()) {
            header('Content-Type: application/json');
            echo json_encode([
                'paymentMethod' => $paymentMethod,
            ]);
            return;
        }
    }


    //Update Data
    public function update()
    {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            try {

                $idMetodoPago = $_POST['idMetodoPago'];
                $nombre = $_POST['nombre'];
                $notas = $_POST['notas'];
                $codigo = $_POST['codigo'];
                $tarifa_adicional = $_POST['tarifa_adicional'];
                $disponible = isset($_POST['disponible']) ? 1 : 0;
                $url_integracion = $_POST['url_integracion'];


                $paymentMethodModel = $this->model('PaymentMethodModel');
                $paymentMethodModel->updatePaymentMethod($idMetodoPago, $nombre, $notas, $codigo, $tarifa_adicional, $disponible, $url_integracion);;



                if (isAjax()) {
                    header('Content-Type: application/json');
                    echo json_encode([
                        'status' => 'success',
                        'message' => 'Metodo de Pago Actualizado Correctamente :D',
                        'paymentMethod' => [
                            'idMetodoPago' => $idMetodoPago,
                            'nombre' => $nombre,
                            'notas' => $notas,
                            'codigo' => $codigo,
                            'tarifa_adicional' => $tarifa_adicional,
                            'disponible' => $disponible,
                            'url_integracion' => $url_integracion,

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
    public function delete($idMetodoPago)
    {
        $paymentMethodModel = $this->model('PaymentMethodModel');
        $paymentMethodModel->deletePaymentMethod($idMetodoPago);

        if (isAjax()) {
            header('Content-Type: application/json');
            echo json_encode(
                [

                    'idMetodoPago' => $idMetodoPago,
                    'status' => 'success',
                    'message' => 'Metodo de Pago eliminado correctamente'
                ]
            );
            return;
        }
    }
}
