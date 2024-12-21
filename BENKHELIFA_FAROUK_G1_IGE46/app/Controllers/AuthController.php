<?php
namespace App\Controllers;

use App\Models\User;

class AuthController {
    private $userModel;

    public function __construct() {
        $this->userModel = new User();
    }

    public function showLoginForm() {
        session_start();
        // Check if there's an error parameter in the query string
        $error = isset($_GET['error']) ? $_GET['error'] : '';
    
        // Render the login page and pass the error message (if any)
        require_once __DIR__ . '/../Views/auth/login.php';  // Pass error to the view
    }

    public function login() {
        session_start();  // Ensure session is started to access session variables
        
        if (isset($_POST['username']) && isset($_POST['password'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];
            
            // Validate user credentials
            $user = $this->userModel->getByUsername($username);  // Fetch user by username
            
            // Use MD5 hash verification for existing passwords in your DB
            if ($user && md5($password) === $user['password_hash']) {
                // Correct password, set session variables
                $_SESSION['username'] = $user['username'];
                $_SESSION['_role'] = $user['_role'];  // Set the session role
                
                // Redirect to the dashboard
                header('Location: /BENKHELIFA_FAROUK_G1_IGE46/public/dashboard');  
                exit;
            } else {
                // Invalid login, redirect back to login with error message
                header('Location: /BENKHELIFA_FAROUK_G1_IGE46/public/login?error=invalid_credentials');
                exit;
            }
        }
    }    

    public function logout() {
        session_start();
        session_unset();  // Clear all session variables
        session_destroy();  // Destroy the session
        header('Location: /BENKHELIFA_FAROUK_G1_IGE46/public/login');  // Redirect to login if not logged in
        exit;
    }
}
