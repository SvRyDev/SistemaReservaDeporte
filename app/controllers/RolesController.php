<?php
class RolesController extends Controller
{
    public function __construct()
    {
        $this->checkEmployeeOrAdmin(); // Verifica si el usuario es empleado o administrador
    }

    public function index()
    {
        $roleModel = $this->model('RoleModel');
        $roles = $roleModel->getAllRoles();

        $data = [
            'title' => 'Gestionar Roles',
            'short_title' => 'Roles',
            'icon_page' => '<i class="mdi mdi-account-key"></i>',
            'module' => 'roles',
            'singular' => 'Rol',
            'roles' => $roles,

        ];

        if (isAjax()) {
            echo json_encode($roles);
            return;
        }


        $this->view('admin.dashboard.manage_roles', $data);
    }

    public function new()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nombre = $_POST['nombre'];
            $descripcion = $_POST['descripcion'];

            $roleModel = $this->model('RoleModel');
            $idRole = $roleModel->createRole($nombre, $descripcion);

            if (isAjax()) {
                header('Content-Type: application/json');
                echo json_encode([
                    'status' => 'success',
                    'message' => 'Rol Registrado Correctamente :D',
                    'role' => [
                        'idRole' => $idRole,
                        'nombre' => $nombre,
                        'descripcion' => $descripcion,
                    ]
                ]);
                return;
            }
  
        }
    }

    public function edit($idRol)
    {
        $roleModel = $this->model('RoleModel');
        $role = $roleModel->getRoleById($idRol);

        if (isAjax()) {
            header('Content-Type: application/json');
            echo json_encode([
                'role' => $role,
            ]);
            return;
        }
    }

    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            try {

                $idRol = $_POST['idRol'];
                $nombre = $_POST['nombre'];
                $descripcion = $_POST['descripcion'];

                $roleModel = $this->model('RoleModel');
                $roleModel->updateRole($idRol, $nombre, $descripcion);


                if (isAjax()) {
                    header('Content-Type: application/json');
                    echo json_encode([
                        'status' => 'success',
                        'message' => 'Rol Actualizado Correctamente :D',
                        'employee' => [
                            'idRol' => $idRol,
                            'nombre' => $nombre,
                            'descripcion' => $descripcion,

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


    public function delete($idRol)
    {
        $roleModel = $this->model('RoleModel');
        $roleModel->deleteRole($idRol);

        if (isAjax()) {
            header('Content-Type: application/json');
            echo json_encode([

                'idRol' => $idRol,
                'status' => 'success', 
                'message' => 'Rol eliminado correctamente']
            );
            return;
        }


    }
}
