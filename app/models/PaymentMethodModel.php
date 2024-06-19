<?php
class PaymentMethodModel extends Model {
    public function getAllPaymentMethods() {
        $stmt = $this->db->prepare("SELECT * FROM MetodoPago WHERE activo = TRUE");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function getPaymentMethodById($idMetodoPago) {
        $stmt = $this->db->prepare("SELECT * FROM MetodoPago WHERE idMetodoPago = :idMetodoPago AND activo = TRUE");
        $stmt->bindParam(':idMetodoPago', $idMetodoPago);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function createPaymentMethod($nombre, $notas, $codigo, $tarifa_adicional, $disponible, $url_integracion) {
        $stmt = $this->db->prepare("INSERT INTO MetodoPago (nombre, notas, codigo, tarifa_adicional, disponible, url_integracion, activo) 
                                    VALUES (:nombre, :notas, :codigo, :tarifa_adicional, :disponible, :url_integracion, TRUE)");
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':notas', $notas);
        $stmt->bindParam(':codigo', $codigo);
        $stmt->bindParam(':tarifa_adicional', $tarifa_adicional);
        $stmt->bindParam(':disponible', $disponible);
        $stmt->bindParam(':url_integracion', $url_integracion);
        $stmt->execute();
    }

    public function updatePaymentMethod($idMetodoPago, $nombre, $notas, $codigo, $tarifa_adicional, $disponible, $url_integracion) {
        $stmt = $this->db->prepare("UPDATE MetodoPago SET nombre = :nombre, notas = :notas, codigo = :codigo, tarifa_adicional = :tarifa_adicional, disponible = :disponible, url_integracion = :url_integracion 
                                    WHERE idMetodoPago = :idMetodoPago AND activo = TRUE");
        $stmt->bindParam(':idMetodoPago', $idMetodoPago);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':notas', $notas);
        $stmt->bindParam(':codigo', $codigo);
        $stmt->bindParam(':tarifa_adicional', $tarifa_adicional);
        $stmt->bindParam(':disponible', $disponible);
        $stmt->bindParam(':url_integracion', $url_integracion);
        $stmt->execute();
    }

    public function deletePaymentMethod($idMetodoPago) {
        $stmt = $this->db->prepare("UPDATE MetodoPago SET activo = FALSE WHERE idMetodoPago = :idMetodoPago");
        $stmt->bindParam(':idMetodoPago', $idMetodoPago);
        $stmt->execute();
    }
}
?>
