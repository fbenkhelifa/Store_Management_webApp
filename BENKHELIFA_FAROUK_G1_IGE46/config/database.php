<?php
namespace Config;

use PDO;
use PDOException;

class Database {
    private $host = 'localhost';
    private $dbname = 'benkhelifaFarouk';
    private $user = 'root';
    private $password = '';
    private $conn;

    public function connect() {
        try {
            // Connect to the database server
            $this->conn = new PDO("mysql:host=$this->host", $this->user, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Create the database if it doesn't exist
            $this->createDatabaseIfNotExists();

            // Use the created database
            $this->conn->exec("USE $this->dbname");

            // Create tables if they don't exist
            $this->createTables();

            // Insert initial data if necessary
            $this->insertInitialData();

            return $this->conn;
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    private function createDatabaseIfNotExists() {
        try {
            // Create the database if it doesn't exist
            $this->conn->exec("CREATE DATABASE IF NOT EXISTS $this->dbname");
        } catch (PDOException $e) {
            die("Error creating database: " . $e->getMessage());
        }
    }

    private function createTables() {
        // Create `users` table
        $this->conn->exec("CREATE TABLE IF NOT EXISTS users (
            id INT AUTO_INCREMENT PRIMARY KEY,
            username VARCHAR(50) NOT NULL UNIQUE,
            password_hash VARCHAR(255) NOT NULL,
            _role ENUM('admin', 'user') NOT NULL DEFAULT 'user'
        ) AUTO_INCREMENT = 1000");

        // Create `products` table
        $this->conn->exec("CREATE TABLE IF NOT EXISTS products (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(100) NOT NULL,
            description TEXT,
            price DECIMAL(10, 2) NOT NULL,
            stock INT NOT NULL
        ) AUTO_INCREMENT = 1000");

        // Create `clients` table
        $this->conn->exec("CREATE TABLE IF NOT EXISTS clients (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(100) NOT NULL,
            email VARCHAR(100) NOT NULL,
            phone VARCHAR(15),
            address TEXT
        ) AUTO_INCREMENT = 1000");

        // Create `workers` table
        $this->conn->exec("CREATE TABLE IF NOT EXISTS workers (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(100) NOT NULL,
            job_title VARCHAR(100) NOT NULL,
            salary DECIMAL(10, 2) NOT NULL,
            hire_date DATE
        ) AUTO_INCREMENT = 1000");

        // Create `bills` table
        $this->conn->exec("CREATE TABLE IF NOT EXISTS bills (
            id INT AUTO_INCREMENT PRIMARY KEY,
            worker_id INT NOT NULL,
            user_id INT NOT NULL,
            client_id INT NOT NULL,
            product_ids VARCHAR(255) NOT NULL,
            date DATE NOT NULL,
            individu_price VARCHAR(255) NOT NULL,
            total_price DECIMAL(10, 2) NOT NULL,
            FOREIGN KEY (worker_id) REFERENCES workers(id) ON DELETE CASCADE,
            FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
            FOREIGN KEY (client_id) REFERENCES clients(id) ON DELETE CASCADE
        ) AUTO_INCREMENT = 1000");
    }

    private function insertInitialData() {
        // Insert initial users if the users table is empty
        $stmt = $this->conn->query("SELECT COUNT(*) FROM users");
        if ($stmt->fetchColumn() == 0) {
            $this->conn->exec("INSERT INTO users (username, password_hash, _role) VALUES
                ('admin', MD5('admin'), 'admin'),
                ('user1', MD5('password1'), 'user'),
                ('user2', MD5('password2'), 'user'),
                ('user3', MD5('password3'), 'user'),
                ('user4', MD5('password4'), 'user'),
                ('user5', MD5('password5'), 'user'),
                ('user6', MD5('password6'), 'user'),
                ('user7', MD5('password7'), 'user'),
                ('user8', MD5('password8'), 'user'),
                ('user9', MD5('password9'), 'user'),
                ('user10', MD5('password10'), 'user'),
                ('user11', MD5('password11'), 'user'),
                ('user12', MD5('password12'), 'user'),
                ('user13', MD5('password13'), 'user'),
                ('user14', MD5('password14'), 'user'),
                ('user15', MD5('password15'), 'user')");
        }

        // Insert initial products if the products table is empty
        $stmt = $this->conn->query("SELECT COUNT(*) FROM products");
        if ($stmt->fetchColumn() == 0) {
            $this->conn->exec("INSERT INTO products (name, description, price, stock) VALUES
               ('Product 1', 'Description of Product 1', 10.00, 100),
                ('Product 2', 'Description of Product 2', 20.00, 200),
                ('Product 3', 'Description of Product 3', 15.00, 150),
                ('Product 4', 'Description of Product 4', 25.00, 80),
                ('Product 5', 'Description of Product 5', 30.00, 50),
                ('Product 6', 'Description of Product 6', 12.00, 90),
                ('Product 7', 'Description of Product 7', 18.00, 110),
                ('Product 8', 'Description of Product 8', 5.00, 300),
                ('Product 9', 'Description of Product 9', 7.50, 120),
                ('Product 10', 'Description of Product 10', 60.00, 40),
                ('Product 11', 'Description of Product 11', 100.00, 20),
                ('Product 12', 'Description of Product 12', 45.00, 70),
                ('Product 13', 'Description of Product 13', 32.00, 55),
                ('Product 14', 'Description of Product 14', 60.00, 30),
                ('Product 15', 'Description of Product 15', 75.00, 25)");
        }

        // Insert initial clients if the clients table is empty
        $stmt = $this->conn->query("SELECT COUNT(*) FROM clients");
        if ($stmt->fetchColumn() == 0) {
            $this->conn->exec("INSERT INTO clients (name, email, phone, address) VALUES
                 ('Client 1', 'client1@example.com', '123456789', '123 Street'),
                ('Client 2', 'client2@example.com', '234567890', '456 Avenue'),
                ('Client 3', 'client3@example.com', '345678901', '789 Boulevard'),
                ('Client 4', 'client4@example.com', '456789012', '321 Square'),
                ('Client 5', 'client5@example.com', '567890123', '654 Road'),
                ('Client 6', 'client6@example.com', '678901234', '987 Path'),
                ('Client 7', 'client7@example.com', '789012345', '147 Place'),
                ('Client 8', 'client8@example.com', '890123456', '258 Crescent'),
                ('Client 9', 'client9@example.com', '901234567', '369 Terrace'),
                ('Client 10', 'client10@example.com', '012345678', '753 Park'),
                ('Client 11', 'client11@example.com', '123450987', '951 Avenue'),
                ('Client 12', 'client12@example.com', '234560987', '159 Street'),
                ('Client 13', 'client13@example.com', '345670987', '852 Plaza'),
                ('Client 14', 'client14@example.com', '456780987', '741 Hill'),
                ('Client 15', 'client15@example.com', '567890987', '963 Valley')");
        }

        // Insert initial workers if the workers table is empty
        $stmt = $this->conn->query("SELECT COUNT(*) FROM workers");
        if ($stmt->fetchColumn() == 0) {
            $this->conn->exec("INSERT INTO workers (name, job_title, salary, hire_date) VALUES
                 ('Worker 1', 'Manager', 55000.00, '2023-01-01'),
                ('Worker 2', 'Cashier', 30000.00, '2023-02-01'),
                ('Worker 3', 'Stock Clerk', 25000.00, '2023-03-01'),
                ('Worker 4', 'Security', 22000.00, '2023-04-01'),
                ('Worker 5', 'Janitor', 20000.00, '2023-05-01'),
                ('Worker 6', 'Assistant', 28000.00, '2023-06-01'),
                ('Worker 7', 'Supervisor', 58000.00, '2023-07-01'),
                ('Worker 8', 'Technician', 45000.00, '2023-08-01'),
                ('Worker 9', 'Receptionist', 32000.00, '2023-09-01'),
                ('Worker 10', 'Operator', 35000.00, '2023-10-01'),
                ('Worker 11', 'Analyst', 50000.00, '2023-11-01'),
                ('Worker 12', 'Designer', 42000.00, '2023-12-01'),
                ('Worker 13', 'Cleaner', 25000.00, '2024-01-01'),
                ('Worker 14', 'Driver', 27000.00, '2024-02-01'),
                ('Worker 15', 'Administrator', 60000.00, '2024-03-01')");
        }

        // Insert initial bills if the bills table is empty
        $stmt = $this->conn->query("SELECT COUNT(*) FROM bills");
        if ($stmt->fetchColumn() == 0) {
            $this->conn->exec("INSERT INTO bills (worker_id, user_id, client_id, product_ids, date, individu_price, total_price) VALUES
                (1001, 1000, 1000, '1001,1002', '2023-01-10', '10.00,20.00', 30.00),
                (1002, 1001, 1002, '1003,1004', '2023-01-11', '15.00,25.00', 40.00),
                (1003, 1002, 1003, '1005,1006', '2023-01-12', '18.00,22.00', 40.00),
                (1004, 1003, 1004, '1007,1008', '2023-01-13', '12.00,28.00', 40.00),
                (1005, 1004, 1005, '1009,1010', '2023-01-14', '20.00,30.00', 50.00),
                (1006, 1005, 1006, '1011,1012', '2023-01-15', '25.00,35.00', 60.00),
                (1007, 1006, 1007, '1013,1014', '2023-01-16', '30.00,40.00', 70.00),
                (1008, 1007, 1008, '1011,1010', '2023-01-17', '35.00,45.00', 80.00),
                (1009, 1008, 1009, '1001,1008', '2023-01-18', '40.00,50.00', 90.00),
                (1010, 1009, 1010, '1009,1010', '2023-01-19', '45.00,55.00', 100.00),
                (1011, 1010, 1011, '1001,1002', '2023-01-20', '10.00,20.00', 30.00),
                (1012, 1001, 1012, '1003,1004', '2023-01-21', '15.00,25.00', 40.00),
                (1013, 1002, 1013, '1005,1006', '2023-01-22', '18.00,22.00', 40.00),
                (1014, 1003, 1014, '1007,1008', '2023-01-23', '12.00,28.00', 40.00),
                (1010, 1004, 1011, '1009,1010', '2023-01-24', '20.00,30.00', 50.00)");
        }
    }
}
?>
