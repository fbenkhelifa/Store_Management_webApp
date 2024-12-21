<?php
namespace App\Controllers;

use App\Models\Client;

require_once __DIR__ . '/../Models/Client.php';

class ClientController {
    private $clientModel;

    public function __construct() {
        $this->clientModel = new Client();
    }

    public function index() {
        // Get all clients or search results if `search_name` is provided
        $search = isset($_GET['search_name']) ? $_GET['search_name'] : '';
        $clients = !empty($search) ? $this->clientModel->search($search) : $this->clientModel->getAll();
        require_once __DIR__ . '/../Views/pages/clients.php';
    }

    public function add() {
        if (isset($_POST['name'])) {
            $data = [
                'name' => $_POST['name'],
                'email' => $_POST['email'],
                'phone' => $_POST['phone'],
                'address' => $_POST['address'],
            ];
            $this->clientModel->create($data);
            header('Location: /BENKHELIFA_FAROUK_G1_IGE46/public/clients');
        }
    }

    public function update() {
        if (isset($_POST['id'])) {
            $client = $this->clientModel->getById($_POST['id']);
            if ($client) {
                $data = [
                    'id' => $_POST['id'],
                    'name' => !empty($_POST['name']) ? $_POST['name'] : $client['name'],
                    'email' => !empty($_POST['email']) ? $_POST['email'] : $client['email'],
                    'phone' => !empty($_POST['phone']) ? $_POST['phone'] : $client['phone'],
                    'address' => !empty($_POST['address']) ? $_POST['address'] : $client['address'],
                ];
                $this->clientModel->update($data);
                header('Location: /BENKHELIFA_FAROUK_G1_IGE46/public/clients');
            } else {
                header('Location: /BENKHELIFA_FAROUK_G1_IGE46/public/clients?error=not_found');
            }
        }
    }

    public function delete() {
        if (isset($_POST['id'])) {
            $this->clientModel->delete($_POST['id']);
            header('Location: /BENKHELIFA_FAROUK_G1_IGE46/public/clients');
        }
    }

    public function search() {
        $searchName = isset($_GET['search_name']) ? $_GET['search_name'] : '';
        $clients = $this->clientModel->search($searchName);
        require_once __DIR__ . '/../Views/pages/clients.php';
    }
}
