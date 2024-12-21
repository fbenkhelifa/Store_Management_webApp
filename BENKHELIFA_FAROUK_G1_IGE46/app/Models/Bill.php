<?php
namespace App\Models;

require_once __DIR__ . '/../../config/database.php';

use Config\Database;
use PDO;

class Bill {
    private $conn;
    private $table = 'bills';

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
        $query = "INSERT INTO $this->table (worker_id, user_id, client_id, product_ids, date, total_price) 
                  VALUES (:worker_id, :user_id, :client_id, :product_ids, :date, :total_price)";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute($data);
    }

    public function update($data) {
        $query = "UPDATE $this->table 
                  SET worker_id = :worker_id, user_id = :user_id, client_id = :client_id, 
                      product_ids = :product_ids, date = :date, total_price = :total_price 
                  WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute($data);
    }

    public function delete($id) {
        $query = "DELETE FROM $this->table WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute(['id' => $id]);
    }

    public function getBillDetails($billId) {
        $query = "
            SELECT 
                b.id AS bill_id, 
                b.date AS bill_date, 
                b.total_price, 
                c.id AS client_id, 
                c.name AS client_name, 
                u.username AS user_name, 
                w.id AS worker_id, 
                w.name AS worker_name, 
                b.product_ids, 
                p.name AS product_name, 
                p.price AS product_price
            FROM $this->table b
            JOIN clients c ON b.client_id = c.id
            JOIN users u ON b.user_id = u.id
            JOIN workers w ON b.worker_id = w.id
            LEFT JOIN products p ON FIND_IN_SET(p.id, b.product_ids)
            WHERE b.id = :bill_id
        ";

        $stmt = $this->conn->prepare($query);
        $stmt->execute(['bill_id' => $billId]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
