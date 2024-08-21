<?php
class AccountReservesController extends Controller
{

    public function __construct()
    {
        $this->checkClient(); // Verifica si el usuario es empleado o administrador
    }

    public function index()
    {

        $clientModel = $this->model('ClientModel');
        $idUser = $_SESSION['user_id'];
        $client = $clientModel->getClientDetailsByUserId($idUser);
        $reservationModel = $this->model('ReservationModel');
        $reservationsClient = $reservationModel->getReservationsByUserId($idUser);

        $data = [
            'title' => 'Mi Perfil',
            'content' => 'Aquí puedes poner la información sobre tu organización, su historia, misión, visión, etc.',
            'module' => 'accountReserves',
        ];

        if (isAjax()) {
            echo json_encode($reservationsClient);
            return;
        }


        $this->view('client.myReserves', $data);
    }


        
    
}
