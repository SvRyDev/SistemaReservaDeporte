<?php
class EmployeeModel extends Model {
    public function getAllEmployees() {
        $stmt = $this->db->prepare("SELECT Empleado.*, Usuario.activo AS usuario_activo, Rol.nombre AS rol_nombre 
                                    FROM Empleado
                                    JOIN Usuario ON Empleado.idUsuario = Usuario.idUsuario
                                    JOIN Rol ON Usuario.idRol = Rol.idRol
                                    WHERE Empleado.activo = TRUE");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function getEmployeeById($idEmpleado) {
        $stmt = $this->db->prepare("SELECT Empleado.*, Usuario.idRol FROM Empleado JOIN Usuario ON Empleado.idUsuario = Usuario.idUsuario WHERE Empleado.idEmpleado = :idEmpleado AND Empleado.activo = TRUE");
        $stmt->bindParam(':idEmpleado', $idEmpleado);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function createEmployee($nombre, $apellido, $dni, $telefono, $email, $direccion, $salario, $idUsuario) {
        $stmt = $this->db->prepare("INSERT INTO Empleado (nombre, apellido, dni, telefono, email, direccion, salario, activo, idUsuario, fechaRegistro) 
                                    VALUES (:nombre, :apellido, :dni, :telefono, :email, :direccion, :salario, TRUE, :idUsuario, CURDATE())");
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':apellido', $apellido);
        $stmt->bindParam(':dni', $dni);
        $stmt->bindParam(':telefono', $telefono);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':direccion', $direccion);
        $stmt->bindParam(':salario', $salario);
        $stmt->bindParam(':idUsuario', $idUsuario);
        $stmt->execute();
        return $this->db->lastInsertId();
    }

    public function updateEmployee($idEmpleado, $nombre, $apellido, $dni, $telefono, $email, $direccion, $salario, $roleId) {
        $stmt = $this->db->prepare("UPDATE Empleado JOIN Usuario ON Empleado.idUsuario = Usuario.idUsuario 
                                    SET Empleado.nombre = :nombre, Empleado.apellido = :apellido, Empleado.dni = :dni, Empleado.telefono = :telefono, Empleado.email = :email, Empleado.direccion = :direccion, Empleado.salario = :salario, Usuario.idRol = :roleId
                                    WHERE Empleado.idEmpleado = :idEmpleado AND Empleado.activo = TRUE");
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':apellido', $apellido);
        $stmt->bindParam(':dni', $dni);
        $stmt->bindParam(':telefono', $telefono);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':direccion', $direccion);
        $stmt->bindParam(':salario', $salario);
        $stmt->bindParam(':roleId', $roleId);
        $stmt->bindParam(':idEmpleado', $idEmpleado);
        $stmt->execute();
    }

    public function deleteEmployee($idEmpleado) {
        $stmt = $this->db->prepare("UPDATE Empleado SET activo = FALSE WHERE idEmpleado = :idEmpleado");
        $stmt->bindParam(':idEmpleado', $idEmpleado);
        $stmt->execute();
    }
}
?>
