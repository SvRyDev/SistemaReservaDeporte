<?php
class SportModel extends Model {
    public function getAllSports() {
        $stmt = $this->db->prepare("SELECT * FROM TipoDeporte WHERE activo = TRUE");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function getSportById($idTipoDeporte) {
        $stmt = $this->db->prepare("SELECT * FROM TipoDeporte WHERE idTipoDeporte = :idTipoDeporte AND activo = TRUE");
        $stmt->bindParam(':idTipoDeporte', $idTipoDeporte);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function createSport($nombre, $descripcion) {
        $stmt = $this->db->prepare("INSERT INTO TipoDeporte (nombre, descripcion, activo) VALUES (:nombre, :descripcion, TRUE)");
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':descripcion', $descripcion);
        $stmt->execute();
        return $this->db->lastInsertId();
    }

    public function updateSport($idTipoDeporte, $nombre, $descripcion) {
        $stmt = $this->db->prepare("UPDATE TipoDeporte SET nombre = :nombre, descripcion = :descripcion WHERE idTipoDeporte = :idTipoDeporte AND activo = TRUE");
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':descripcion', $descripcion);
        $stmt->bindParam(':idTipoDeporte', $idTipoDeporte);
        $stmt->execute();
    }

    public function deleteSport($idTipoDeporte) {
        $stmt = $this->db->prepare("UPDATE TipoDeporte SET activo = FALSE WHERE idTipoDeporte = :idTipoDeporte");
        $stmt->bindParam(':idTipoDeporte', $idTipoDeporte);
        $stmt->execute();
    }
}
?>
