<?php
class ClientModel extends Model {
    public function getAllClients() {
        $stmt = $this->db->prepare("SELECT Cliente.*, Usuario.activo AS usuario_activo 
                                    FROM Cliente
                                    JOIN Usuario ON Cliente.idUsuario = Usuario.idUsuario
                                    WHERE Cliente.activo = TRUE");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function getCountClients() {
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM Cliente WHERE activo = TRUE");
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function getClientById($idCliente) {
        $stmt = $this->db->prepare("SELECT * FROM Cliente WHERE idCliente = :idCliente AND activo = TRUE");
        $stmt->bindParam(':idCliente', $idCliente);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function createClient($nombre, $telefono, $email, $idUsuario) {
        $stmt = $this->db->prepare("INSERT INTO Cliente (nombre, telefono, email, idUsuario, fechaRegistro, activo) 
                                    VALUES (:nombre, :telefono, :email, :idUsuario, CURDATE(), TRUE)");
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':telefono', $telefono);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':idUsuario', $idUsuario);
        $stmt->execute();
        return $this->db->lastInsertId();
    }

    public function updateClient($idCliente, $nombre, $telefono, $email) {
        $stmt = $this->db->prepare("UPDATE Cliente SET nombre = :nombre, telefono = :telefono, email = :email
                                    WHERE idCliente = :idCliente AND activo = TRUE");
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':telefono', $telefono);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':idCliente', $idCliente);
        $stmt->execute();
    }

    public function deleteClient($idCliente) {
        $stmt = $this->db->prepare("UPDATE Cliente SET activo = FALSE WHERE idCliente = :idCliente");
        $stmt->bindParam(':idCliente', $idCliente);
        $stmt->execute();
    }
}
?>
