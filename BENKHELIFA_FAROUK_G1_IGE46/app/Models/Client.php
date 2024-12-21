<?php
namespace App\Models;

use Config\Database;
use PDO;

class Client {
    private $conn;
    private $table = 'clients';

    public function __construct() {
        $db = new Database();
        $this->conn = $db->connect();
    }

    public function getAll() {
        $stmt = $this->conn->query("SELECT * FROM $this->table");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $query = "SELECT * FROM $this->table WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data) {
        $query = "INSERT INTO $this->table (name, email, phone, address) VALUES (:name, :email, :phone, :address)";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute($data);
    }

    public function update($data) {
        $query = "UPDATE $this->table SET name = :name, email = :email, phone = :phone, address = :address WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute($data);
    }

    public function delete($id) {
        $query = "DELETE FROM $this->table WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute(['id' => $id]);
    }

    public function search($query) {
        $stmt = $this->conn->prepare("SELECT * FROM $this->table WHERE name LIKE :query OR id = :id");
        $stmt->execute([
            'query' => '%' . $query . '%',
            'id' => $query,
        ]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
