<?php
class ContactController extends Controller {
    public function index() {
        $data = [
            'title' => 'Contacto',
            'content' => 'Aquí puedes poner la información de contacto, como la dirección, teléfono, email, etc.'
        ];
        $this->view('contact', $data);
    }
}
?>
