<?php
class EmployeesController extends Controller
{
    public function __construct()
    {
        $this->checkEmployeeOrAdmin(); // Verifica si el usuario es empleado o administrador
    }

    public function index()
    {
        $employeeModel = $this->model('EmployeeModel');
        $employees = $employeeModel->getAllEmployees();
        $userModel = $this->model('UserModel');
        $roles = $userModel->getAllRolesExceptClient();

        $data = [
            'title' => 'Gestionar Empleados',
            'short_title' => 'Empleados',
            'employees' => $employees,
            'icon_page' => '<i class="fas fa-users"> </i>',
            'module' => 'employees',
            'roles' => $roles,
            
        ];
        if (isAjax()) {
            echo json_encode($employees);
            return;
        }
        
        $this->view('admin.dashboard.manage_employee', $data);
    }

    public function create()
    {
        $userModel = $this->model('UserModel');
        $roles = $userModel->getAllRolesExceptClient();

        $data = [
            'title' => 'Agregar Empleado',
            'short_title' => 'Nuevo Empleado',
            'icon_page' => '<i class="fas fa-user-plus"></i>',
            'roles' => $roles
        ];

        $this->view('admin.dashboard.add_employee', $data);
    }

    public function new()
    {
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
            $idEmpleado = $employeeModel->createEmployee($nombre, $apellido, $dni, $telefono, $email, $direccion, $salario, $userId);


            if (isAjax()) {
                header('Content-Type: application/json');
                echo json_encode([
                    'status' => 'success',
                    'message' => 'Empleado Registrado Correctamente :D',
                    'employee' => [
                        'idEmpleado' => $idEmpleado,
                        'nombre' => $nombre,
                        'apellido' => $apellido,
                        'dni' => $dni,
                        'telefono' => $telefono,
                        'email' => $email,
                        'direccion' => $direccion,
                        'salario' => $salario,
                        'rol_nombre' => $employeeModel->getRoleNameById($roleId)
                    ]
                ]);
                return;
            }


            header("Location: " . APP_URL . "/employees");
            exit();
        }
    }

    public function edit($idEmpleado)
    {
        $employeeModel = $this->model('EmployeeModel');
        $employee = $employeeModel->getEmployeeById($idEmpleado);
        $userModel = $this->model('UserModel');
        $roles = $userModel->getAllRolesExceptClient();
        // Verifica si la solicitud es AJAX
        if (isAjax()) {
            header('Content-Type: application/json');
            echo json_encode([
                'employee' => $employee,
                'roles' => $roles,
            ]);
            return;
        }

        $data = [
            'title' => 'Actualizar Empleado',
            'short_title' => 'Editar Empleado',
            'employee' => $employee,
            'icon_page' => '<i class="fas fa-user-plus"></i>',
            'roles' => $roles
        ];

        $this->view('admin.dashboard.edit_employee', $data);
    }

    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            try {

                $idEmpleado = $_POST['idEmpleado'];
                $nombre = $_POST['nombre'];
                $apellido = $_POST['apellido'];
                $dni = $_POST['dni'];
                $telefono = $_POST['telefono'];
                $email = $_POST['email'];
                $direccion = $_POST['direccion'];
                $salario = $_POST['salario'];
                $roleId = $_POST['role'];
                $password = !empty($_POST['password']) ? hash('sha256', $_POST['password']) : null;

                $employeeModel = $this->model('EmployeeModel');
                $employeeModel->updateEmployee($idEmpleado, $nombre, $apellido, $dni, $telefono, $email, $direccion, $salario, $roleId, $password);

                if (isAjax()) {
                    header('Content-Type: application/json');
                    echo json_encode([
                        'status' => 'success',
                        'message' => 'Empleado Actualizado Correctamente :D',
                        'employee' => [
                            'idEmpleado' => $idEmpleado,
                            'nombre' => $nombre,
                            'apellido' => $apellido,
                            'dni' => $dni,
                            'telefono' => $telefono,
                            'email' => $email,
                            'direccion' => $direccion,
                            'salario' => $salario,
                            'rol_nombre' => $employeeModel->getRoleNameById($roleId)
                        ]
                    ]);
                    return;
                }

                header("Location: " . APP_URL . "");
                exit();
            } catch (Exception $e) {
                if (isAjax()) {
                    header('Content-Type: application/json');
                    echo json_encode([
                        'status' => 'error',
                        'message' => $e->getMessage()
                    ]);
                    return;
                }

                // Manejo de errores no AJAX
                header("Location: " . APP_URL . "/employees");
                exit();
            }
        }
    }


    public function delete($idEmpleado)
    {
        $employeeModel = $this->model('EmployeeModel');
        $employeeModel->deleteEmployee($idEmpleado);

        if (isAjax()) {
            header('Content-Type: application/json');
            echo json_encode([

                'idEmpleado' => $idEmpleado,
                'status' => 'success', 
                'message' => 'Empleado eliminado correctamente']
            );
            return;
        }

        header("Location: " . APP_URL . "/employees");
        exit();
    }
}
