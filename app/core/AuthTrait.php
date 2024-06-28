<?php
trait AuthTrait {
    protected function checkLogin() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['user_id']) || !isset($_SESSION['user_role'])) {
            header("Location: " . APP_URL . "/login");
            exit();
        }
    }

    protected function checkEmployeeOrAdmin() {
        $this->checkLogin();
        $userModel = $this->model('UserModel');
        $userId = $_SESSION['user_id'];
        $userRole = $_SESSION['user_role'];

        $isEmployee = $userModel->isEmployee($userId);

        if (!$isEmployee && $userRole !== 'admin') {
            header("Location: " . APP_URL);
            exit();
        }
    }


    protected function checkClient(){
        $this->checkLogin();
        $userModel = $this->model('UserModel');
        $userId = $_SESSION['user_id'];
        $userRole = $_SESSION['user_role'];

        $isClient = $userModel->isClient($userId);

        if (!$isClient && $userRole !== 'cliente') {
            header("Location: " . APP_URL);
            exit();
        }

    }
}
?>
