<?php
namespace App\Models;

use Config\Database;
use PDO;

class User {
    private $conn;
    private $table = 'users';

    public function __construct() {
        $db = new Database();
        $this->conn = $db->connect();
    }

    // Get all users
    public function getAll() {
        $stmt = $this->conn->query("SELECT id, username, _role FROM $this->table");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    // User.php model
    public function getByUsername($username) {
        $query = "SELECT * FROM $this->table WHERE username = :username LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);  // Return user data
    }

    // Get user by ID
    public function getById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM $this->table WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function isUsernameTaken($username, $excludeId = null) {
        $query = "SELECT COUNT(*) FROM $this->table WHERE username = :username";
        if ($excludeId) {
            $query .= " AND id != :id";
        }
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':username', $username);
        if ($excludeId) {
            $stmt->bindParam(':id', $excludeId, PDO::PARAM_INT);
        }
        $stmt->execute();
        return $stmt->fetchColumn() > 0; // Returns true if the username exists
    }
    
    // Create a new user
    public function create($data) {
        $stmt = $this->conn->prepare("INSERT INTO $this->table (username, password_hash, _role) VALUES (:username, :password_hash, :_role)");
        return $stmt->execute($data);
    }

    // Update user
    public function update($data) {
        // Ensure all the parameters are present and bind them correctly
        $query = "UPDATE $this->table SET username = :username, password_hash = :password_hash, _role = :_role WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        
        // Ensure all parameters are provided in the $data array
        $stmt->bindParam(':username', $data['username']);
        $stmt->bindParam(':password_hash', $data['password_hash']);
        $stmt->bindParam(':_role', $data['_role']);
        $stmt->bindParam(':id', $data['id'], PDO::PARAM_INT);
        
        return $stmt->execute();  // Execute the query
    }
    

    // Delete user
    public function delete($id) {
        $stmt = $this->conn->prepare("DELETE FROM $this->table WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }

    // Search for users by username
    public function search($searchName) {
        $stmt = $this->conn->prepare("SELECT * FROM $this->table WHERE username LIKE :username");
        $stmt->execute(['username' => '%' . $searchName . '%']);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
