<?php
namespace App\Controllers;

use App\Models\User;
require_once __DIR__ . '/../Models/User.php';

class UserController {
    private $userModel;

    public function __construct() {
        $this->userModel = new User();
    }

    // Show the users page with a search if query is provided
    public function index() {
        $search = isset($_GET['search_name']) ? $_GET['search_name'] : '';
        $users = $search ? $this->userModel->search($search) : $this->userModel->getAll();
        require_once __DIR__ . '/../Views/pages/users.php';
    }

    // Add a new user
    public function store() {
        if (isset($_POST['username'], $_POST['password'], $_POST['_role'])) {
            $data = [
                'username' => htmlspecialchars($_POST['username']),
                'password_hash' => MD5($_POST['password'], PASSWORD_DEFAULT), // Hash the password
                '_role' => htmlspecialchars($_POST['_role']),
            ];
            $this->userModel->create($data);
            header('Location: /BENKHELIFA_FAROUK_G1_IGE46/public/users');
        }
    }

    public function update() {
        if (isset($_POST['id'])) {
            // Fetch the existing user data
            $user = $this->userModel->getById($_POST['id']);
    
            if ($user) {
                $newUsername = !empty($_POST['username']) ? $_POST['username'] : $user['username'];
    
                // Check if the new username is already taken by another user
                if ($this->userModel->isUsernameTaken($newUsername, $_POST['id'])) {
                    header('Location: /BENKHELIFA_FAROUK_G1_IGE46/public/users?error=username_taken');
                    exit;
                }
    
                // Prepare the data for the update
                $data = [
                    'id' => $_POST['id'],
                    'username' => $newUsername,
                    'password_hash' => !empty($_POST['password']) ? password_hash($_POST['password'], PASSWORD_DEFAULT) : $user['password_hash'],
                    '_role' => !empty($_POST['_role']) ? $_POST['_role'] : $user['_role'],
                ];
    
                // Update the user data
                $this->userModel->update($data);
                header('Location: /BENKHELIFA_FAROUK_G1_IGE46/public/users');
            } else {
                // Redirect if user is not found
                header('Location: /BENKHELIFA_FAROUK_G1_IGE46/public/users?error=user_not_found');
            }
        }
    }
    
    

    // Delete a user
    public function delete() {
        if (isset($_POST['id'])) {
            $this->userModel->delete($_POST['id']);
            header('Location: /BENKHELIFA_FAROUK_G1_IGE46/public/users');
        }
    }

    // Search for a user by username
    public function search() {
        $searchName = isset($_GET['search_name']) ? $_GET['search_name'] : '';
        $users = $this->userModel->search($searchName);
        require_once __DIR__ . '/../Views/pages/users.php';
    }
}
