<?php
class SportsFieldModel extends Model {
    public function getAllFields() {
        $stmt = $this->db->prepare("SELECT CampoDeportivo.*, TipoDeporte.nombre AS tipo_deporte
                                    FROM CampoDeportivo
                                    JOIN TipoDeporte ON CampoDeportivo.idTipoDeporte = TipoDeporte.idTipoDeporte
                                    WHERE CampoDeportivo.activo = TRUE");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function getFieldById($idCampo) {
        $stmt = $this->db->prepare("SELECT * FROM CampoDeportivo WHERE idCampo = :idCampo AND activo = TRUE");
        $stmt->bindParam(':idCampo', $idCampo);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function getFieldBySportId($idSport) {
        $stmt = $this->db->prepare("SELECT * FROM CampoDeportivo WHERE idTipoDeporte = :idSports AND activo = TRUE");
        $stmt->bindParam(':idSports', $idSport);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function createField($codigo, $alquilerHora, $idTipoDeporte, $estado, $disponible) {
        $stmt = $this->db->prepare("INSERT INTO CampoDeportivo (codigo, alquilerHora, idTipoDeporte, estado, disponible, activo) 
                                    VALUES (:codigo, :alquilerHora, :idTipoDeporte, :estado, :disponible, TRUE)");
        $stmt->bindParam(':codigo', $codigo);
        $stmt->bindParam(':alquilerHora', $alquilerHora);
        $stmt->bindParam(':idTipoDeporte', $idTipoDeporte);
        $stmt->bindParam(':estado', $estado);
        $stmt->bindParam(':disponible', $disponible);
        $stmt->execute();
        return $this->db->lastInsertId();
    }

    public function updateField($idCampo, $codigo, $alquilerHora, $idTipoDeporte, $estado, $disponible) {
        $stmt = $this->db->prepare("UPDATE CampoDeportivo SET codigo = :codigo, alquilerHora = :alquilerHora, idTipoDeporte = :idTipoDeporte, estado = :estado, disponible = :disponible 
                                    WHERE idCampo = :idCampo AND activo = TRUE");
        $stmt->bindParam(':codigo', $codigo);
        $stmt->bindParam(':alquilerHora', $alquilerHora);
        $stmt->bindParam(':idTipoDeporte', $idTipoDeporte);
        $stmt->bindParam(':estado', $estado);
        $stmt->bindParam(':disponible', $disponible);
        $stmt->bindParam(':idCampo', $idCampo);
        $stmt->execute();
    }

    public function deleteField($idCampo) {
        $stmt = $this->db->prepare("UPDATE CampoDeportivo SET activo = FALSE WHERE idCampo = :idCampo");
        $stmt->bindParam(':idCampo', $idCampo);
        $stmt->execute();
    }
}
?>
