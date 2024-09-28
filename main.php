<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once 'model/crud.model.php';
$crud = new CrudModel();
$action = isset($_GET['action']) ? $_GET['action'] : '';
error_log("Action: $action");

switch ($action) {
    case 'getAllUsers':
        header('Content-Type: application/json');
        $users = $crud->getAllUsers();
        echo json_encode($users);
        break;

    case 'getUser':
        $data = json_decode(file_get_contents("php://input"), true);
        $id = isset($data['id']) ? intval($data['id']) : 0;
        header('Content-Type: application/json');
        echo json_encode($crud->getUser($id));
        break;

    case 'insertUser':
        $data = json_decode(file_get_contents("php://input"), true);
        if ($crud->insertUser($data['firstname'], $data['lastname'], $data['is_admin'])) {
            echo json_encode(['status' => 'User inserted']);
        } else {
            echo json_encode(['status' => 'Insert failed']);
        }
        break;

    case 'updateUser':
        $data = json_decode(file_get_contents("php://input"), true);
        $id = isset($data['id']) ? intval($data['id']) : 0;
        if ($crud->updateUser($id, $data['firstname'], $data['lastname'], $data['is_admin'])) {
            echo json_encode(['status' => 'User updated']);
        } else {
            echo json_encode(['status' => 'Update failed']);
        }
        break;

    case 'deleteUser':
        $data = json_decode(file_get_contents("php://input"), true);
        $id = isset($data['id']) ? intval($data['id']) : 0;
        if ($crud->deleteUser($id)) {
            echo json_encode(['status' => 'User deleted']);
        } else {
            echo json_encode(['status' => 'Delete failed']);
        }
        break;

    default:
        http_response_code(404);
        echo json_encode(['status' => 'Action not found']);
        break;
}
?>
