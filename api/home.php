<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

Header('Access-Control-Allow-Origin: *');
Header('Content-Type: application/json');
Header('Access-Control-Allow-Method: GET');

include_once('conf/db_config.php');
include_once('model/kabkota.php');

$database=new Database;
$db=$database->connect();
$kabkota=new KabKota($db);
$data=$kabkota->home();

echo json_encode(['message'=>$data,'data'=>null]);
?>
