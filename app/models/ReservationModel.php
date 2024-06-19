<?php
class ReservationModel extends Model {
    public function getAllReservations() {
        $stmt = $this->db->prepare("SELECT Reserva.*, CampoDeportivo.codigo AS campo_codigo, Cliente.nombre AS cliente_nombre, Empleado.nombre AS empleado_nombre, EstadoReserva.nombre AS estado_nombre
                                    FROM Reserva
                                    JOIN CampoDeportivo ON Reserva.idCampo = CampoDeportivo.idCampo
                                    JOIN Cliente ON Reserva.idCliente = Cliente.idCliente
                                    JOIN Empleado ON Reserva.idEmpleado = Empleado.idEmpleado
                                    JOIN EstadoReserva ON Reserva.idEstado = EstadoReserva.idEstado
                                    WHERE Reserva.activo = TRUE");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function getReservationById($idReserva) {
        $stmt = $this->db->prepare("SELECT * FROM Reserva WHERE idReserva = :idReserva AND activo = TRUE");
        $stmt->bindParam(':idReserva', $idReserva);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function createReservation($idCampo, $idCliente, $idEmpleado, $detalle, $fechaEntrada, $fechaSalida, $duracion, $precioTotal, $idEstado) {
        $stmt = $this->db->prepare("INSERT INTO Reserva (idCampo, idCliente, idEmpleado, detalle, fechaEntrada, fechaSalida, duracion, precioTotal, idEstado, activo) 
                                    VALUES (:idCampo, :idCliente, :idEmpleado, :detalle, :fechaEntrada, :fechaSalida, :duracion, :precioTotal, :idEstado, TRUE)");
        $stmt->bindParam(':idCampo', $idCampo);
        $stmt->bindParam(':idCliente', $idCliente);
        $stmt->bindParam(':idEmpleado', $idEmpleado);
        $stmt->bindParam(':detalle', $detalle);
        $stmt->bindParam(':fechaEntrada', $fechaEntrada);
        $stmt->bindParam(':fechaSalida', $fechaSalida);
        $stmt->bindParam(':duracion', $duracion);
        $stmt->bindParam(':precioTotal', $precioTotal);
        $stmt->bindParam(':idEstado', $idEstado);
        $stmt->execute();
        return $this->db->lastInsertId();
    }

    public function updateReservation($idReserva, $idCampo, $idCliente, $idEmpleado, $detalle, $fechaEntrada, $fechaSalida, $duracion, $precioTotal, $idEstado) {
        $stmt = $this->db->prepare("UPDATE Reserva SET idCampo = :idCampo, idCliente = :idCliente, idEmpleado = :idEmpleado, detalle = :detalle, fechaEntrada = :fechaEntrada, fechaSalida = :fechaSalida, duracion = :duracion, precioTotal = :precioTotal, idEstado = :idEstado 
                                    WHERE idReserva = :idReserva AND activo = TRUE");
        $stmt->bindParam(':idCampo', $idCampo);
        $stmt->bindParam(':idCliente', $idCliente);
        $stmt->bindParam(':idEmpleado', $idEmpleado);
        $stmt->bindParam(':detalle', $detalle);
        $stmt->bindParam(':fechaEntrada', $fechaEntrada);
        $stmt->bindParam(':fechaSalida', $fechaSalida);
        $stmt->bindParam(':duracion', $duracion);
        $stmt->bindParam(':precioTotal', $precioTotal);
        $stmt->bindParam(':idEstado', $idEstado);
        $stmt->bindParam(':idReserva', $idReserva);
        $stmt->execute();
    }

    public function deleteReservation($idReserva) {
        $stmt = $this->db->prepare("UPDATE Reserva SET activo = FALSE WHERE idReserva = :idReserva");
        $stmt->bindParam(':idReserva', $idReserva);
        $stmt->execute();
    }
}
?>
