<?php
namespace App\Controllers;

use App\Models\Bill;

class BillController {
    private $billModel;

    public function __construct() {
        $this->billModel = new Bill();
    }

    public function index() {
        $bills = $this->billModel->getAll();
        require_once __DIR__ . '/../Views/pages/bills.php';
    }

    public function add() {
        if (isset($_POST['worker_id'])) {
            $data = [
                'worker_id' => $_POST['worker_id'],
                'user_id' => $_POST['user_id'],
                'client_id' => $_POST['client_id'],
                'product_ids' => $_POST['product_ids'],
                'date' => $_POST['date'],
                'total_price' => $_POST['total_price'],
            ];
            $this->billModel->create($data);
            header('Location: /BENKHELIFA_FAROUK_G1_IGE46/public/bills');
        }
    }

    public function update() {
        if (isset($_POST['id'])) {
            $bill = $this->billModel->getById($_POST['id']);
            if ($bill) {
                $data = [
                    'id' => $_POST['id'],
                    'worker_id' => !empty($_POST['worker_id']) ? $_POST['worker_id'] : $bill['worker_id'],
                    'user_id' => !empty($_POST['user_id']) ? $_POST['user_id'] : $bill['user_id'],
                    'client_id' => !empty($_POST['client_id']) ? $_POST['client_id'] : $bill['client_id'],
                    'product_ids' => !empty($_POST['product_ids']) ? $_POST['product_ids'] : $bill['product_ids'],
                    'date' => !empty($_POST['date']) ? $_POST['date'] : $bill['date'],
                    'total_price' => !empty($_POST['total_price']) ? $_POST['total_price'] : $bill['total_price'],
                ];
                $this->billModel->update($data);
                header('Location: /BENKHELIFA_FAROUK_G1_IGE46/public/bills');
            } else {
                header('Location: /BENKHELIFA_FAROUK_G1_IGE46/public/bills?error=not_found');
            }
        }
    }

    public function delete() {
        if (isset($_POST['id'])) {
            $this->billModel->delete($_POST['id']);
            header('Location: /BENKHELIFA_FAROUK_G1_IGE46/public/bills');
        }
    }

    public function search() {
        $billId = isset($_GET['bill_id']) ? $_GET['bill_id'] : '';
        if ($billId) {
            // Fetch bill details by bill_id
            $billDetails = $this->billModel->getBillDetails($_GET['bill_id']);
     
            // If there are results, display them
            if ($billDetails) {
                require_once __DIR__ . '/../Views/pages/bill_details.php';
            } else {
                echo "No bill found with ID: " . htmlspecialchars($billId); // Debugging message
            }
        } else {
            echo "Please provide a valid Bill ID"; // Debugging message
        }
    }
    
}
