<?php
class EmployeesController extends Controller {
    public function __construct() {
        $this->checkEmployeeOrAdmin(); // Verifica si el usuario es empleado o administrador
    }

    public function index() {
        $employeeModel = $this->model('EmployeeModel');
        $employees = $employeeModel->getAllEmployees();

        $data = [
            'title' => 'Gestionar Empleados',
            'employees' => $employees
        ];

        $this->view('admin.dashboard.manage_employee', $data);
    }

    public function create() {
        $userModel = $this->model('UserModel');
        $roles = $userModel->getAllRolesExceptClient();

        $data = [
            'title' => 'Agregar Empleado',
            'roles' => $roles
        ];

        $this->view('admin.dashboard.add_employee', $data);
    }

    public function store() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nombre = $_POST['nombre'];
            $apellido = $_POST['apellido'];
            $dni = $_POST['dni'];
            $telefono = $_POST['telefono'];
            $email = $_POST['email'];
            $direccion = $_POST['direccion'];
            $salario = $_POST['salario'];
            $password = hash('sha256', $_POST['password']);
            $roleId = $_POST['role'];

            // Crear usuario
            $userModel = $this->model('UserModel');
            $userId = $userModel->createUser($password, $roleId);

            // Crear empleado
            $employeeModel = $this->model('EmployeeModel');
            $employeeModel->createEmployee($nombre, $apellido, $dni, $telefono, $email, $direccion, $salario, $userId);

            header("Location: " . APP_URL . "/employees");
            exit();
        }
    }

    public function edit($idEmpleado) {
        $employeeModel = $this->model('EmployeeModel');
        $employee = $employeeModel->getEmployeeById($idEmpleado);

        $userModel = $this->model('UserModel');
        $roles = $userModel->getAllRolesExceptClient();

        $data = [
            'title' => 'Editar Empleado',
            'employee' => $employee,
            'roles' => $roles
        ];

        $this->view('admin.dashboard.edit_employee', $data);
    }

    public function update() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $idEmpleado = $_POST['idEmpleado'];
            $nombre = $_POST['nombre'];
            $apellido = $_POST['apellido'];
            $dni = $_POST['dni'];
            $telefono = $_POST['telefono'];
            $email = $_POST['email'];
            $direccion = $_POST['direccion'];
            $salario = $_POST['salario'];
            $roleId = $_POST['role'];

            $employeeModel = $this->model('EmployeeModel');
            $employeeModel->updateEmployee($idEmpleado, $nombre, $apellido, $dni, $telefono, $email, $direccion, $salario, $roleId);

            header("Location: " . APP_URL . "/employees");
            exit();
        }
    }

    public function delete($idEmpleado) {
        $employeeModel = $this->model('EmployeeModel');
        $employeeModel->deleteEmployee($idEmpleado);

        header("Location: " . APP_URL . "/employees");
        exit();
    }
}
?>
