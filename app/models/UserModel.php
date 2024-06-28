<?php
class UserModel extends Model {
    public function findUserByEmail($email) {
        $stmt = $this->db->prepare("SELECT Usuario.*, 
                                   Cliente.email AS cliente_email, Cliente.telefono AS cliente_telefono,
                                   Empleado.email AS empleado_email, Empleado.nombre AS empleado_nombre, Empleado.telefono AS empleado_telefono,
                                   Cliente.nombre AS cliente_nombre
                                   FROM Usuario
                                   LEFT JOIN Cliente ON Usuario.idUsuario = Cliente.idUsuario
                                   LEFT JOIN Empleado ON Usuario.idUsuario = Empleado.idUsuario
                                   WHERE (Cliente.email = :email OR Empleado.email = :email) AND Usuario.activo = TRUE");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function createUser($contrasena, $idRol) {
        $stmt = $this->db->prepare("INSERT INTO Usuario (contrasena, idRol, fechaRegistro, activo) 
                                    VALUES (:contrasena, :idRol, CURDATE(), TRUE)");
        $stmt->bindParam(':contrasena', $contrasena);
        $stmt->bindParam(':idRol', $idRol);
        $stmt->execute();
        return $this->db->lastInsertId(); // Llamada correcta al método lastInsertId()
    }

    public function getRoleId($roleName) {
        $stmt = $this->db->prepare("SELECT idRol FROM Rol WHERE nombre = :roleName AND activo = TRUE");
        $stmt->bindParam(':roleName', $roleName);
        $stmt->execute();
        return $stmt->fetchColumn();
    }

    public function getUserRole($userId) {
        $stmt = $this->db->prepare("SELECT r.nombre FROM Usuario u JOIN Rol r ON u.idRol = r.idRol WHERE u.idUsuario = :userId AND u.activo = TRUE");
        $stmt->bindParam(':userId', $userId);
        $stmt->execute();
        return $stmt->fetchColumn();
    }

    public function isEmployee($userId) {
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM Empleado WHERE idUsuario = :userId AND activo = TRUE");
        $stmt->bindParam(':userId', $userId);
        $stmt->execute();
        return $stmt->fetchColumn() > 0;
    }

    
    public function isClient($userId) {
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM Cliente WHERE idUsuario = :userId AND activo = TRUE");
        $stmt->bindParam(':userId', $userId);
        $stmt->execute();
        return $stmt->fetchColumn() > 0;
    }

    public function getAllRolesExceptClient() {
        $stmt = $this->db->prepare("SELECT idRol, nombre FROM Rol WHERE nombre != 'cliente' AND activo = TRUE");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
}
?>
