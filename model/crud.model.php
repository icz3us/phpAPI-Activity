<?php
class CrudModel {
    private $conn;
    
    public function __construct() {
        $this->conn = $this->dbConnection();
    }

    private function dbConnection() {
        include 'configs/database.php';
        return $conn;
    }

    public function getAllUsers() {
        $query = "SELECT * FROM Users";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getUser($id) {
        $query = "SELECT * FROM Users WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function insertUser($firstname, $lastname, $is_admin) {
        $query = "INSERT INTO Users (firstname, lastname, is_admin) VALUES (:firstname, :lastname, :is_admin)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':firstname', $firstname);
        $stmt->bindParam(':lastname', $lastname);
        $stmt->bindParam(':is_admin', $is_admin);
        return $stmt->execute();
    }

    public function updateUser($id, $firstname, $lastname, $is_admin) {
        $query = "UPDATE Users SET firstname = :firstname, lastname = :lastname, is_admin = :is_admin WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':firstname', $firstname);
        $stmt->bindParam(':lastname', $lastname);
        $stmt->bindParam(':is_admin', $is_admin);
        return $stmt->execute();
    }

    public function deleteUser($id) {
        $query = "DELETE FROM Users WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}

