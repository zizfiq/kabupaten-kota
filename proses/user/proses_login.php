<?php
include("../../conf/db_conn.php");

$email = mysqli_real_escape_string($conn, $_POST['email']); 
$password = mysqli_real_escape_string($conn, $_POST['password']);
$sql_query = "SELECT * FROM tb_user WHERE email='$email' AND password='".md5($password)."'";
$result = mysqli_query($conn, $sql_query);
$row = mysqli_fetch_array($result);
if($row){
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    $_SESSION['email'] = $row['email'];
    $username = $row['username'];
    $_SESSION['username'] = $username;
    $_SESSION['role'] = $row['role'];

    if(isset($_POST['remember'])){
        // Set cookies for 1 hour
        setcookie('email', $row['email'], time() + (3600), "/");
        setcookie('username', $username, time() + (3600), "/");
        setcookie('role', $row['role'], time() + (3600), "/");
    }

    echo "<script>alert('Selamat datang $username, kamu telah berhasil login!');</script>"; 
    echo "<script>window.location.href='../../index.php';</script>";
}else{
    echo "<script>alert('Masukkan data email dan password dengan benar!');</script>"; 
    echo "<script>window.location.href='../../pages/user/login.php';</script>";
}
?>
