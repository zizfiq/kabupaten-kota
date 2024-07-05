<?php
error_reporting(E_ALL);
ini_set('display_error', 1);

Header('Access-Control-Allow-Origin: *');
Header('Content-Type: application/json');
Header('Access-Control-Allow-Method: DELETE');

include_once('conf/db_config.php');
include_once('model/kabkota.php');

$database = new Database;
$db = $database->connect();
$kabkota = new KabKota($db);

if(isset($_GET['id'])) {
    $data_kab_kota = $kabkota->readKabKotaById($_GET['id']);
    $list_data = [];
    
    if($data_kab_kota->rowCount()) {
        $row = $data_kab_kota->fetch(PDO::FETCH_OBJ);
        $path_dir = "../image/logo/";
        $target_file = $path_dir . $row->logo;
        
        if(file_exists($target_file)) {
            unlink($target_file);
        }
        
        if($kabkota->deleteKabKota($_GET['id'])) {
            echo json_encode(['message' => 'Berhasil menghapus data kabupaten kota!', 'data' => $row]);
        } else {
            echo json_encode(['message' => 'Data kabupaten kota tidak ditemukan!', 'data' => null]);
        }
    }
}
?>