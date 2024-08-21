<?php
class StatusModel extends Model {
    public function getAllStates() {
        $stmt = $this->db->prepare("SELECT * FROM EstadoReserva");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function getStateById($idEstado) {
        $stmt = $this->db->prepare("SELECT * FROM EstadoReserva WHERE idEstado = :idEstado");
        $stmt->bindParam(':idEstado', $idEstado);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function createState($nombre, $descripcion, $color, $considerar_solapamiento) {
        $stmt = $this->db->prepare("INSERT INTO EstadoReserva (nombre, descripcion, color, considerar_solapamiento) 
                                    VALUES (:nombre, :descripcion, :color, :considerar_solapamiento)");
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':descripcion', $descripcion);
        $stmt->bindParam(':color', $color);
        $stmt->bindParam(':considerar_solapamiento', $considerar_solapamiento);
        $stmt->execute();
    }

    public function updateState($idEstado, $nombre, $descripcion, $color, $considerar_solapamiento) {
        $stmt =  $this->db->prepare("UPDATE EstadoReserva SET nombre = :nombre, descripcion = :descripcion, color = :color, considerar_solapamiento = :considerar_solapamiento 
                                    WHERE idEstado = :idEstado");
        $stmt->bindParam(':idEstado', $idEstado);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':descripcion', $descripcion);
        $stmt->bindParam(':color', $color);
        $stmt->bindParam(':considerar_solapamiento', $considerar_solapamiento);
        $stmt->execute();
    }

    public function deleteState($idEstado) {
        $stmt = $this->db->prepare("DELETE FROM EstadoReserva WHERE idEstado = :idEstado");
        $stmt->bindParam(':idEstado', $idEstado);
        $stmt->execute();
    }
}
?>
