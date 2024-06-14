<?php
class UserModel extends Model {
    public function findUserByEmail($email) {
        $stmt = $this->db->prepare("SELECT * FROM Usuario WHERE idUsuario = 
            (SELECT idUsuario FROM Persona WHERE email = :email)");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }
}
?>
