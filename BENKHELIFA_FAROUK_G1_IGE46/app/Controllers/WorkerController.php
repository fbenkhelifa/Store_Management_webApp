<?php
namespace App\Controllers;

use App\Models\Worker;
require_once __DIR__ . '/../Models/Worker.php';

class WorkerController {
    private $workerModel;

    public function __construct() {
        $this->workerModel = new Worker();
    }

    public function index() {
        $search = isset($_GET['search_name']) ? $_GET['search_name'] : '';
        if (!empty($search)) {
            $workers = $this->workerModel->searchByName($search);
        } else {
            $workers = $this->workerModel->getAll();
        }
        require_once __DIR__ . '/../Views/pages/workers.php';
    }

    public function add() {
        if (isset($_POST['name'])) {
            $data = [
                'name' => $_POST['name'],
                'job_title' => $_POST['job_title'],
                'salary' => $_POST['salary'],
                'hire_date' => $_POST['hire_date'],
            ];
            $this->workerModel->create($data);
            header('Location: /BENKHELIFA_FAROUK_G1_IGE46/public/workers');
        }
    }

    public function update() {
        if (isset($_POST['id'])) {
            $worker = $this->workerModel->getById($_POST['id']);
            if ($worker) {
                $data = [
                    'id' => $_POST['id'],
                    'name' => !empty($_POST['name']) ? $_POST['name'] : $worker['name'],
                    'job_title' => !empty($_POST['job_title']) ? $_POST['job_title'] : $worker['job_title'],
                    'salary' => !empty($_POST['salary']) ? $_POST['salary'] : $worker['salary'],
                    'hire_date' => !empty($_POST['hire_date']) ? $_POST['hire_date'] : $worker['hire_date'],
                ];
                $this->workerModel->update($data);
                header('Location: /BENKHELIFA_FAROUK_G1_IGE46/public/workers');
            } else {
                header('Location: /BENKHELIFA_FAROUK_G1_IGE46/public/workers?error=not_found');
            }
        }
    }

    public function delete() {
        if (isset($_POST['id'])) {
            $this->workerModel->delete($_POST['id']);
            header('Location: /BENKHELIFA_FAROUK_G1_IGE46/public/workers');
        }
    }

    public function search() {
        $searchName = $_GET['search_name'];
        $workers = $this->workerModel->searchByName($searchName);
        require_once __DIR__ . '/../Views/pages/workers.php';
    }
}
