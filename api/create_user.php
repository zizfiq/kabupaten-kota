<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

Header('Access-Control-Allow-Origin: *');
Header('Content-Type: application/json');
Header('Access-Control-Allow-Method: POST');

include_once('conf/db_config.php');
include_once('model/user.php');

$database = new Database();
$db = $database->connect();
$user = new User($db);

if (count($_POST)) {
    $params = [
        'username' => $_POST['username'],
        'email' => $_POST['email'],
        'password' => password_hash($_POST['password'], PASSWORD_BCRYPT),
        'no_hp' => $_POST['no_hp'],
        'role' => $_POST['role']
    ];

    if ($user->createUser($params)) {
        echo json_encode(['message' => 'User berhasil ditambahkan!', 'data' => $params]);
    } else {
        echo json_encode(['message' => 'User gagal ditambahkan!', 'data' => null]);
    }
} else {
    echo json_encode(['message' => 'Tidak ada data yang dikirim!', 'data' => null]);
}
?>
