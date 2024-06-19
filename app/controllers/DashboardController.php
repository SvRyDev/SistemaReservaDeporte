<?php
class DashboardController extends Controller {
    public function __construct() {
        $this->checkEmployeeOrAdmin(); // Verifica si el usuario es empleado o administrador
    }

    public function index() {
        $data = [
            'title' => 'Dashboard'
        ];
        $this->view('admin.index', $data);
    }
}
?>
