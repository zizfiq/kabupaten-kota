<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

Header('Access-Control-Allow-Origin: *');
Header('Content-Type: application/json');
Header('Access-Control-Allow-Method: GET');

include_once('conf/db_config.php');
include_once('model/user.php');

$database = new Database();
$db = $database->connect();
$user = new User($db);

if (isset($_GET['id'])) {
    $data = $user->readUserById($_GET['id']);
    if ($data->rowCount()) {
        $list_data = [];
        while ($row = $data->fetch(PDO::FETCH_OBJ)) {
            $list_data = [
                'id' => $row->id,
                'username' => $row->username,
                'email' => $row->email,
                'password' => $row->password,
                'no_hp' => $row->no_hp,
                'role' => $row->role
            ];
        }
        echo json_encode(['message' => 'Data user berhasil ditemukan!', 'data' => $list_data]);
    } else {
        echo json_encode(['message' => 'Data user yang dicari tidak ada!', 'data' => null]);
    }
} else {
    $data = $user->readUsers();
    if ($data->rowCount()) {
        $list_data = [];
        while ($row = $data->fetch(PDO::FETCH_OBJ)) {
            $item = array(
                'id' => $row->id,
                'username' => $row->username,
                'email' => $row->email,
                'password' => $row->password,
                'no_hp' => $row->no_hp,
                'role' => $row->role
            );
            array_push($list_data, $item);
        }
        echo json_encode(['message' => 'Data user berhasil diambil!', 'data' => $list_data]);
    } else {
        echo json_encode(['message' => 'Data user tidak berhasil diambil!', 'data' => null]);
    }
}
?>
