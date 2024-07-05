<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

Header('Access-Control-Allow-Origin: *');
Header('Content-Type: application/json');
Header('Access-Control-Allow-Method: DELETE');

include_once('conf/db_config.php');
include_once('model/user.php');

$database = new Database();
$db = $database->connect();
$user = new User($db);

if (isset($_GET['id'])) {
    $data_user = $user->readUserById($_GET['id']);
    
    if ($data_user->rowCount()) {
        $row = $data_user->fetch(PDO::FETCH_OBJ);
        
        if ($user->deleteUser($_GET['id'])) {
            echo json_encode(['message' => 'Berhasil menghapus data user!', 'data' => $row]);
        } else {
            echo json_encode(['message' => 'Data user tidak ditemukan!', 'data' => null]);
        }
    } else {
        echo json_encode(['message' => 'Data user tidak ditemukan!', 'data' => null]);
    }
} else {
    echo json_encode(['message' => 'ID tidak diberikan!', 'data' => null]);
}
?>
