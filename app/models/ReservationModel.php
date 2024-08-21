<?php
class ReservationModel extends Model {
    // Método existente para obtener todas las reservas
    public function getAllReservations() {
        $stmt = $this->db->prepare("SELECT Reserva.*, CampoDeportivo.codigo AS campo_codigo, Cliente.nombre AS cliente_nombre, Empleado.nombre AS empleado_nombre, EstadoReserva.nombre AS estado_nombre, EstadoReserva.color AS estado_color
                                    FROM Reserva
                                    JOIN CampoDeportivo ON Reserva.idCampo = CampoDeportivo.idCampo
                                    JOIN Cliente ON Reserva.idCliente = Cliente.idCliente
                                    JOIN Empleado ON Reserva.idEmpleado = Empleado.idEmpleado
                                    JOIN EstadoReserva ON Reserva.idEstado = EstadoReserva.idEstado
                                    WHERE Reserva.activo = TRUE");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function getReservationsByField($idCampo) {
        $stmt = $this->db->prepare("SELECT Reserva.*, CampoDeportivo.codigo AS campo_codigo, Cliente.nombre AS cliente_nombre, Empleado.nombre AS empleado_nombre, EstadoReserva.nombre AS estado_nombre, EstadoReserva.color AS estado_color
                                    FROM Reserva
                                    JOIN CampoDeportivo ON Reserva.idCampo = CampoDeportivo.idCampo
                                    JOIN Cliente ON Reserva.idCliente = Cliente.idCliente
                                    JOIN Empleado ON Reserva.idEmpleado = Empleado.idEmpleado
                                    JOIN EstadoReserva ON Reserva.idEstado = EstadoReserva.idEstado
                                    WHERE Reserva.activo = TRUE
                                    AND CampoDeportivo.idCampo = :idCampo");
        $stmt->bindParam(':idCampo', $idCampo, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    // Método para obtener los pagos asociados a una reserva
    public function getPaymentsByReservation($idReserva) {
        $stmt = $this->db->prepare("SELECT Pagos.*, MetodoPago.nombre AS metodo_nombre 
                                    FROM Pagos
                                    JOIN MetodoPago ON Pagos.idMetodoPago = MetodoPago.idMetodoPago
                                    WHERE Pagos.idReserva = :idReserva");
        $stmt->bindParam(':idReserva', $idReserva);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    // Método para verificar si hay solapamiento de reservas
    public function isOverlappingReservation($idCampo, $fechaEntrada, $fechaSalida, $idReserva = null) {
        $query = "SELECT COUNT(*) FROM Reserva WHERE idCampo = :idCampo AND (fechaEntrada < :fechaSalida AND fechaSalida > :fechaEntrada) AND idEstado IN (SELECT idEstado FROM EstadoReserva WHERE considerar_solapamiento = 1)";
        if ($idReserva !== null) {
            $query .= " AND idReserva != :idReserva";
        }

        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':idCampo', $idCampo);
        $stmt->bindParam(':fechaEntrada', $fechaEntrada);
        $stmt->bindParam(':fechaSalida', $fechaSalida);
        if ($idReserva !== null) {
            $stmt->bindParam(':idReserva', $idReserva);
        }
        $stmt->execute();
        return $stmt->fetchColumn() > 0;
    }

    // Método para crear una nueva reserva
    public function createReservation($idCampo, $idCliente, $idEmpleado, $detalle, $fechaEntrada, $fechaSalida, $duracion, $precioTotal, $idEstado, $estadoPago) {
        $stmt = $this->db->prepare("INSERT INTO Reserva (idCampo, idCliente, idEmpleado, detalle, fechaEntrada, fechaSalida, duracion, precioTotal, idEstado, estado_pago, activo) 
                                    VALUES (:idCampo, :idCliente, :idEmpleado, :detalle, :fechaEntrada, :fechaSalida, :duracion, :precioTotal, :idEstado, :estado_pago, TRUE)");
        $stmt->bindParam(':idCampo', $idCampo);
        $stmt->bindParam(':idCliente', $idCliente);
        $stmt->bindParam(':idEmpleado', $idEmpleado);
        $stmt->bindParam(':detalle', $detalle);
        $stmt->bindParam(':fechaEntrada', $fechaEntrada);
        $stmt->bindParam(':fechaSalida', $fechaSalida);
        $stmt->bindParam(':duracion', $duracion);
        $stmt->bindParam(':precioTotal', $precioTotal);
        $stmt->bindParam(':idEstado', $idEstado);
        $stmt->bindParam(':estado_pago', $estadoPago);
        $stmt->execute();
        return $this->db->lastInsertId();
    }

    // Método para asociar implementos deportivos a una reserva
    public function addSportEquipmentsToReservation($idReserva, $implementos) {
        foreach ($implementos as $implemento) {
            $stmt = $this->db->prepare("INSERT INTO ImplementoDeportivo_Reserva (idImplemento, idReserva, Cantidad, PrecioTotal) 
                                        VALUES (:idImplemento, :idReserva, :Cantidad, :PrecioTotal)");
            $stmt->bindParam(':idImplemento', $implemento['idImplemento']);
            $stmt->bindParam(':idReserva', $idReserva);
            $stmt->bindParam(':Cantidad', $implemento['Cantidad']);
            $stmt->bindParam(':PrecioTotal', $implemento['PrecioTotal']);
            $stmt->execute();
        }
    }

    // Método para obtener los implementos deportivos asociados a una reserva
    public function getSportEquipmentsByReservation($idReserva) {
        $stmt = $this->db->prepare("SELECT ImplementoDeportivo_Reserva.*, ImplementoDeportivo.nombre 
                                    FROM ImplementoDeportivo_Reserva
                                    JOIN ImplementoDeportivo ON ImplementoDeportivo_Reserva.idImplemento = ImplementoDeportivo.idImplemento
                                    WHERE idReserva = :idReserva");
        $stmt->bindParam(':idReserva', $idReserva);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    // Método existente para actualizar una reserva
    public function updateReservation($idReserva, $idCampo, $idCliente, $idEmpleado, $detalle, $fechaEntrada, $fechaSalida, $duracion, $precioTotal) {
        $stmt = $this->db->prepare("UPDATE Reserva SET idCampo = :idCampo, idCliente = :idCliente, idEmpleado = :idEmpleado, detalle = :detalle, fechaEntrada = :fechaEntrada, fechaSalida = :fechaSalida, duracion = :duracion, precioTotal = :precioTotal
                                    WHERE idReserva = :idReserva AND activo = TRUE");
        $stmt->bindParam(':idCampo', $idCampo);
        $stmt->bindParam(':idCliente', $idCliente);
        $stmt->bindParam(':idEmpleado', $idEmpleado);
        $stmt->bindParam(':detalle', $detalle);
        $stmt->bindParam(':fechaEntrada', $fechaEntrada);
        $stmt->bindParam(':fechaSalida', $fechaSalida);
        $stmt->bindParam(':duracion', $duracion);
        $stmt->bindParam(':precioTotal', $precioTotal);
        $stmt->bindParam(':idReserva', $idReserva);
        $stmt->execute();
    }

    // Método para eliminar implementos deportivos de una reserva
    public function deleteSportEquipmentsFromReservation($idReserva) {
        $stmt = $this->db->prepare("DELETE FROM ImplementoDeportivo_Reserva WHERE idReserva = :idReserva");
        $stmt->bindParam(':idReserva', $idReserva);
        $stmt->execute();
    }


    public function getReservationsByUserId($idUsuario) {
        $stmt = $this->db->prepare("SELECT Reserva.*, 
                                           CampoDeportivo.codigo AS campo_codigo, 
                                           Cliente.nombre AS cliente_nombre, 
                                           Empleado.nombre AS empleado_nombre, 
                                           EstadoReserva.nombre AS estado_nombre, 
                                           EstadoReserva.color AS estado_color
                                    FROM Reserva
                                    JOIN CampoDeportivo ON Reserva.idCampo = CampoDeportivo.idCampo
                                    JOIN Cliente ON Reserva.idCliente = Cliente.idCliente
                                    JOIN Empleado ON Reserva.idEmpleado = Empleado.idEmpleado
                                    JOIN EstadoReserva ON Reserva.idEstado = EstadoReserva.idEstado
                                    WHERE Reserva.activo = TRUE
                                    AND Cliente.idUsuario = :idUsuario");
        $stmt->bindParam(':idUsuario', $idUsuario, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function deleteReservation($idReserva) {
        // Eliminar implementos deportivos asociados
        $this->deleteSportEquipmentsFromReservation($idReserva);

        // Eliminar pagos asociados
        $stmt = $this->db->prepare("DELETE FROM Pagos WHERE idReserva = :idReserva");
        $stmt->bindParam(':idReserva', $idReserva);
        $stmt->execute();

        // Eliminar reserva
        $stmt = $this->db->prepare("DELETE FROM Reserva WHERE idReserva = :idReserva");
        $stmt->bindParam(':idReserva', $idReserva);
        $stmt->execute();
    }

    public function getReservationById($idReserva) {
        $stmt = $this->db->prepare("SELECT r.*, c.nombre AS cliente_nombre, e.nombre AS estado_nombre, e.color AS estado_color FROM Reserva r, Cliente c, EstadoReserva e WHERE e.idEstado = r.idEstado AND c.idCliente = r.idCliente AND idReserva = :idReserva AND r.activo = TRUE");
        $stmt->bindParam(':idReserva', $idReserva);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function updateReservationPaymentState($idReserva, $estadoPago) {
        $stmt = $this->db->prepare("UPDATE Reserva SET estado_pago = :estado_pago WHERE idReserva = :idReserva");
        $stmt->bindParam(':estado_pago', $estadoPago);
        $stmt->bindParam(':idReserva', $idReserva);
        $stmt->execute();
    }

    public function updateReservationState($idReserva, $idEstado) {
        $stmt = $this->db->prepare("UPDATE Reserva SET idEstado = :idEstado WHERE idReserva = :idReserva");
        $stmt->bindParam(':idEstado', $idEstado);
        $stmt->bindParam(':idReserva', $idReserva);
        $stmt->execute();
    }


    public function getReservationDetails($idReserva) {
        $stmt = $this->db->prepare("SELECT Reserva.*, Cliente.nombre AS cliente_nombre
                                    FROM Reserva
                                    JOIN Cliente ON Reserva.idCliente = Cliente.idCliente
                                    WHERE Reserva.idReserva = :idReserva");
        $stmt->bindParam(':idReserva', $idReserva);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }
}
?>
