<?php
namespace App\Models;

require_once __DIR__ . '/../../config/database.php';
use Config\Database;
use PDO;

class Worker {
    private $conn;
    private $table = 'workers';

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
        $query = "INSERT INTO $this->table (name, job_title, salary, hire_date) VALUES (:name, :job_title, :salary, :hire_date)";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute($data);
    }

    public function update($data) {
        $query = "UPDATE $this->table SET name = :name, job_title = :job_title, salary = :salary, hire_date = :hire_date WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute($data);
    }

    public function delete($id) {
        $query = "DELETE FROM $this->table WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute(['id' => $id]);
    }

    public function searchByName($name) {
        $query = "SELECT * FROM $this->table WHERE name LIKE :name";
        $stmt = $this->conn->prepare($query);
        $name = '%' . $name . '%';
        $stmt->bindParam(':name', $name);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
