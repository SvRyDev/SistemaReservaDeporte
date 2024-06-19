<?php
class RoleModel extends Model {
    public function getAllRoles() {
        $stmt = $this->db->prepare("SELECT * FROM Rol WHERE activo = TRUE");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function getRoleById($idRol) {
        $stmt = $this->db->prepare("SELECT * FROM Rol WHERE idRol = :idRol AND activo = TRUE");
        $stmt->bindParam(':idRol', $idRol);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function createRole($nombre, $descripcion) {
        $stmt = $this->db->prepare("INSERT INTO Rol (nombre, descripcion, activo) VALUES (:nombre, :descripcion, TRUE)");
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':descripcion', $descripcion);
        $stmt->execute();
        return $this->db->lastInsertId();
    }

    public function updateRole($idRol, $nombre, $descripcion) {
        $stmt = $this->db->prepare("UPDATE Rol SET nombre = :nombre, descripcion = :descripcion WHERE idRol = :idRol AND activo = TRUE");
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':descripcion', $descripcion);
        $stmt->bindParam(':idRol', $idRol);
        $stmt->execute();
    }

    public function deleteRole($idRol) {
        $stmt = $this->db->prepare("UPDATE Rol SET activo = FALSE WHERE idRol = :idRol");
        $stmt->bindParam(':idRol', $idRol);
        $stmt->execute();
    }
}
?>
