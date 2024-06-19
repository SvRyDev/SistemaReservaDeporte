<?php
class HomeController extends Controller {
    public function index() {
        $data = [
            'title' => 'Página de Inicio',
            'welcomeMessage' => 'Bienvenido a nuestro sistema de reserva de deportes!'
        ];
        $this->view('client/home', $data);
    }
}
?>
