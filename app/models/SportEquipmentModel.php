<?php
class SportEquipmentModel extends Model {
    public function getAllEquipments() {
        $stmt = $this->db->prepare("SELECT * FROM ImplementoDeportivo WHERE activo = TRUE");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function getEquipmentById($idImplemento) {
        $stmt = $this->db->prepare("SELECT * FROM ImplementoDeportivo WHERE idImplemento = :idImplemento AND activo = TRUE");
        $stmt->bindParam(':idImplemento', $idImplemento);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function createEquipment($nombre, $descripcion, $precioAlquiler, $estado) {
        $stmt = $this->db->prepare("INSERT INTO ImplementoDeportivo (nombre, descripcion, precioAlquiler, estado, activo, fechaRegistro) VALUES (:nombre, :descripcion, :precioAlquiler, :estado, TRUE, CURDATE())");
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':descripcion', $descripcion);
        $stmt->bindParam(':precioAlquiler', $precioAlquiler);
        $stmt->bindParam(':estado', $estado);
        $stmt->execute();
        return $this->db->lastInsertId();
    }

    public function updateEquipment($idImplemento, $nombre, $descripcion, $precioAlquiler, $estado) {
        $stmt = $this->db->prepare("UPDATE ImplementoDeportivo SET nombre = :nombre, descripcion = :descripcion, precioAlquiler = :precioAlquiler, estado = :estado WHERE idImplemento = :idImplemento AND activo = TRUE");
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':descripcion', $descripcion);
        $stmt->bindParam(':precioAlquiler', $precioAlquiler);
        $stmt->bindParam(':estado', $estado);
        $stmt->bindParam(':idImplemento', $idImplemento);
        $stmt->execute();
    }

    public function deleteEquipment($idImplemento) {
        $stmt = $this->db->prepare("UPDATE ImplementoDeportivo SET activo = FALSE WHERE idImplemento = :idImplemento");
        $stmt->bindParam(':idImplemento', $idImplemento);
        $stmt->execute();
    }
}
?>
