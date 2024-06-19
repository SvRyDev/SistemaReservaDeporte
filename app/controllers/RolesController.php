<?php
class RolesController extends Controller {
    public function __construct() {
        $this->checkEmployeeOrAdmin(); // Verifica si el usuario es empleado o administrador
    }

    public function index() {
        $roleModel = $this->model('RoleModel');
        $roles = $roleModel->getAllRoles();

        $data = [
            'title' => 'Gestionar Roles',
            'roles' => $roles
        ];

        $this->view('admin.dashboard.manage_roles', $data);
    }

    public function create() {
        $data = [
            'title' => 'Agregar Rol'
        ];

        $this->view('admin.dashboard.add_role', $data);
    }

    public function store() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nombre = $_POST['nombre'];
            $descripcion = $_POST['descripcion'];

            $roleModel = $this->model('RoleModel');
            $roleModel->createRole($nombre, $descripcion);

            header("Location: " . APP_URL . "/roles");
            exit();
        }
    }

    public function edit($idRol) {
        $roleModel = $this->model('RoleModel');
        $role = $roleModel->getRoleById($idRol);

        $data = [
            'title' => 'Editar Rol',
            'role' => $role
        ];

        $this->view('admin.dashboard.edit_role', $data);
    }

    public function update() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $idRol = $_POST['idRol'];
            $nombre = $_POST['nombre'];
            $descripcion = $_POST['descripcion'];

            $roleModel = $this->model('RoleModel');
            $roleModel->updateRole($idRol, $nombre, $descripcion);

            header("Location: " . APP_URL . "/roles");
            exit();
        }
    }

    public function delete($idRol) {
        $roleModel = $this->model('RoleModel');
        $roleModel->deleteRole($idRol);

        header("Location: " . APP_URL . "/roles");
        exit();
    }
}
?>
