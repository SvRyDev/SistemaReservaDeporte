<?php
class PaymentModel extends Model {
    public function getAllPayments() {
        $stmt = $this->db->prepare("SELECT Pagos.*, Reserva.idReserva, MetodoPago.nombre AS metodo_nombre 
                                    FROM Pagos
                                    JOIN Reserva ON Pagos.idReserva = Reserva.idReserva
                                    JOIN MetodoPago ON Pagos.idMetodoPago = MetodoPago.idMetodoPago");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function getPaymentById($idPago) {
        $stmt = $this->db->prepare("SELECT * FROM Pagos WHERE idPago = :idPago");
        $stmt->bindParam(':idPago', $idPago);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function createPayment($monto, $fechaPago, $observacion, $idReserva, $idMetodoPago) {
        $stmt = $this->db->prepare("INSERT INTO Pagos (monto, fechaPago, observacion, idReserva, idMetodoPago) 
                                    VALUES (:monto, :fechaPago, :observacion, :idReserva, :idMetodoPago)");
        $stmt->bindParam(':monto', $monto);
        $stmt->bindParam(':fechaPago', $fechaPago);
        $stmt->bindParam(':observacion', $observacion);
        $stmt->bindParam(':idReserva', $idReserva);
        $stmt->bindParam(':idMetodoPago', $idMetodoPago);
        $stmt->execute();
        return $this->db->lastInsertId();
    }

    public function updatePayment($idPago, $monto, $fechaPago, $observacion, $idReserva, $idMetodoPago) {
        $stmt = $this->db->prepare("UPDATE Pagos SET monto = :monto, fechaPago = :fechaPago, observacion = :observacion, idReserva = :idReserva, idMetodoPago = :idMetodoPago 
                                    WHERE idPago = :idPago");
        $stmt->bindParam(':monto', $monto);
        $stmt->bindParam(':fechaPago', $fechaPago);
        $stmt->bindParam(':observacion', $observacion);
        $stmt->bindParam(':idReserva', $idReserva);
        $stmt->bindParam(':idMetodoPago', $idMetodoPago);
        $stmt->bindParam(':idPago', $idPago);
        $stmt->execute();
    }

    public function deletePayment($idPago) {
        $stmt = $this->db->prepare("DELETE FROM Pagos WHERE idPago = :idPago");
        $stmt->bindParam(':idPago', $idPago);
        $stmt->execute();
    }

    public function addPayment($idReserva, $monto, $idMetodoPago, $observacion) {
        $stmt = $this->db->prepare("INSERT INTO Pagos (monto, fechaPago, observacion, idReserva, idMetodoPago) 
                                    VALUES (:monto, ".CURRENT_TIME.", :observacion, :idReserva, :idMetodoPago)");
        $stmt->bindParam(':monto', $monto);
        $stmt->bindParam(':observacion', $observacion);
        $stmt->bindParam(':idReserva', $idReserva);
        $stmt->bindParam(':idMetodoPago', $idMetodoPago);
        $stmt->execute();
        return $this->db->lastInsertId();
    }
}
?>
