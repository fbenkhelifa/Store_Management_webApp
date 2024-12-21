<?php
use App\Controllers\AuthController;
use App\Controllers\WorkerController;
use App\Models\Worker;
use App\Controllers\ClientController;
use App\Models\Client;
use App\Controllers\ProductController;
use App\Models\Product;
use App\Controllers\UserController;
use App\Models\User;
use App\Controllers\BillController;
use App\Models\Bill;

require_once __DIR__ . '/../app/Controllers/AuthController.php';
require_once __DIR__ . '/../app/Controllers/WorkerController.php';
require_once __DIR__ . '/../app/Models/Worker.php';
require_once __DIR__ . '/../app/Controllers/ClientController.php';
require_once __DIR__ . '/../app/Models/Client.php';
require_once __DIR__ . '/../app/Controllers/ProductController.php';
require_once __DIR__ . '/../app/Models/Product.php';
require_once __DIR__ . '/../app/Controllers/BillController.php';
require_once __DIR__ . '/../app/Models/Bill.php';
require_once __DIR__ . '/../app/Controllers/UserController.php';
require_once __DIR__ . '/../app/Models/User.php';

// Define the base path for your application
$basePath = '/BENKHELIFA_FAROUK_G1_IGE46/public';

// Get and normalize the Request URI
$requestUri = $_SERVER['REQUEST_URI'];
if (strpos($requestUri, $basePath) === 0) {
    $requestUri = substr($requestUri, strlen($basePath));
}
$requestUri = rtrim($requestUri, '/'); // Remove trailing slash
$parsedUri = parse_url($requestUri, PHP_URL_PATH); // Extract path
$requestMethod = $_SERVER['REQUEST_METHOD'];

// Instantiate Controllers
$authController = new AuthController();
$workerController = new WorkerController();
$clientController = new ClientController();
$productController = new ProductController();
$billController = new BillController();
$userController = new UserController();

// Helper function to check authentication and roles
function checkAuth($requiredRole = null) {
    session_start();  // Start the session before checking
    if (!isset($_SESSION['_role'])) {
        header('Location: /BENKHELIFA_FAROUK_G1_IGE46/public/login');
        exit;
    }
    if ($requiredRole && $_SESSION['_role'] !== $requiredRole) {
        header('Location: /BENKHELIFA_FAROUK_G1_IGE46/public/dashboard');
        exit;
    }
}

// Route Handling
switch ($parsedUri) {
    // Default route - redirect to login
    case '':
    case '/':
        header("Location: /BENKHELIFA_FAROUK_G1_IGE46/public/login");
        break;

    // Authentication routes
    case '/login':
        if ($requestMethod === 'POST') {
            $authController->login();
        } else {
            $authController->showLoginForm();
        }
        break;

    case '/logout':
        $authController->logout();
        break;

    // Dashboard route - protected for logged-in users
    case '/dashboard':
        session_start();
        if (isset($_SESSION['_role'])) {
            require_once __DIR__ . '/../app/Views/pages/dashboard.php';
        } else {
            header('Location: /BENKHELIFA_FAROUK_G1_IGE46/public/login');
            exit;
        }
        break;

    // ** User Routes (Admin Only) **
    case '/users':
        checkAuth('admin');
        $userController->index();
        break;

    case '/users/store':
        checkAuth('admin');
        $userController->store();
        break;

    case '/users/update':
        checkAuth('admin');
        $userController->update();
        break;

    case '/users/delete':
        checkAuth('admin');
        $userController->delete();
        break;

    case '/users/search':
        checkAuth('admin');
        $userController->search();
        break;

    // ** Worker Routes (Admin Only) **
    case '/workers':
        checkAuth('admin');
        $workerController->index();
        break;

    case '/workers/add':
        checkAuth('admin');
        $workerController->add();
        break;

    case '/workers/update':
        checkAuth('admin');
        $workerController->update();
        break;

    case '/workers/delete':
        checkAuth('admin');
        $workerController->delete();
        break;

    case '/workers/search':
        checkAuth('admin');
        $workerController->search();
        break;

    // ** Client Routes (Logged-in Users) **
    case '/clients':
        checkAuth();
        $clientController->index();
        break;

    case '/clients/add':
        checkAuth();
        $clientController->add();
        break;

    case '/clients/update':
        checkAuth();
        $clientController->update();
        break;

    case '/clients/delete':
        checkAuth();
        $clientController->delete();
        break;

    case '/clients/search':
        checkAuth();
        $clientController->search();
        break;

    // ** Product Routes (Logged-in Users) **
    case '/products':
        checkAuth();
        $productController->index();
        break;

    case '/products/add':
        checkAuth();
        $productController->add();
        break;

    case '/products/update':
        checkAuth();
        $productController->update();
        break;

    case '/products/delete':
        checkAuth();
        $productController->delete();
        break;

    case '/products/search':
        checkAuth();
        $productController->search();
        break;

    // ** Bill Routes (Logged-in Users) **
    case '/bills':
        checkAuth();
        $billController->index();
        break;

    case '/bills/add':
        checkAuth();
        $billController->add();
        break;

    case '/bills/update':
        checkAuth();
        $billController->update();
        break;

    case '/bills/delete':
        checkAuth();
        $billController->delete();
        break;

    case '/bills/search':
        checkAuth();
        $billController->search();
        break;

    // 404 - Page not found
    default:
        echo "404 Page Not Found!";
        break;
}
