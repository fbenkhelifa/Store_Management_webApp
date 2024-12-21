<?php
namespace App\Controllers;

use App\Models\Product;
require_once __DIR__ . '/../Models/Product.php';

class ProductController {
    private $productModel;

    public function __construct() {
        $this->productModel = new Product();
    }

    public function index() {
        $search = isset($_GET['search_name']) ? $_GET['search_name'] : '';
        if (!empty($search)) {
            $products = $this->productModel->searchByName($search);
        } else {
            $products = $this->productModel->getAll();
        }
        require_once __DIR__ . '/../Views/pages/products.php';
    }

    public function add() {
        if (isset($_POST['name'])) {
            $data = [
                'name' => $_POST['name'],
                'description' => $_POST['description'],
                'price' => $_POST['price'],
                'stock' => $_POST['stock'],
            ];
            $this->productModel->create($data);
            header('Location: /BENKHELIFA_FAROUK_G1_IGE46/public/products');
        }
    }

    public function update() {
        if (isset($_POST['id'])) {
            $product = $this->productModel->getById($_POST['id']);
            if ($product) {
                $data = [
                    'id' => $_POST['id'],
                    'name' => !empty($_POST['name']) ? $_POST['name'] : $product['name'],
                    'description' => !empty($_POST['description']) ? $_POST['description'] : $product['description'],
                    'price' => !empty($_POST['price']) ? $_POST['price'] : $product['price'],
                    'stock' => !empty($_POST['stock']) ? $_POST['stock'] : $product['stock'],
                ];
                $this->productModel->update($data);
                header('Location: /BENKHELIFA_FAROUK_G1_IGE46/public/products');
            } else {
                header('Location: /BENKHELIFA_FAROUK_G1_IGE46/public/products?error=not_found');
            }
        }
    }

    public function delete() {
        if (isset($_POST['id'])) {
            $this->productModel->delete($_POST['id']);
            header('Location: /BENKHELIFA_FAROUK_G1_IGE46/public/products');
        }
    }

    public function search() {
        $searchName = $_GET['search_name'];
        $products = $this->productModel->searchByName($searchName);
        require_once __DIR__ . '/../Views/pages/products.php';
    }
}
