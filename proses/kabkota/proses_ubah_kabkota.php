<?php
include("../../conf/db_conn.php");

const TARGET_DIR = "../../image/logo/";
const ALLOWED_EXT = array('png', 'jpg', 'jpeg', 'gif');
const MAX_FILE_SIZE = 512000;

function checkImage($image, $remove_image)
{
    $filename = $_FILES[$image]['name'];
    $ukuran = $_FILES[$image]['size'];
    $tmp_file = $_FILES[$image]['tmp_name'];
    $ext = pathinfo($filename, PATHINFO_EXTENSION);
    $target_file = TARGET_DIR . basename($filename);
    
    if ($_FILES[$image]['error'] != UPLOAD_ERR_OK) {
        return ["Tidak ada file yang diupload atau error!"];
    }
    
    $imageInfo = getimagesize($tmp_file);
    if (!$imageInfo) {
        return ["File yang diupload bukan image!"];
    }
    
    if (file_exists($target_file)) {
        return ["File yang diupload sudah ada, silahkan ganti nama file!"];
    }
    
    if ($ukuran > MAX_FILE_SIZE) {
        return ["File yang diupload melebihi 512kb!"];
    }
    
    if (!in_array($ext, ALLOWED_EXT)) {
        return ["Ekstensi file yang diupload tidak diperbolehkan (upload hanya .png | .jpg | .jpeg | .gif)!"];
    }
    
    if (move_uploaded_file($tmp_file, $target_file)) {
        $remove_file = TARGET_DIR . $remove_image;
        if (file_exists($remove_file)) {
            unlink($remove_file);
        }
        return ["OK"];
    }
    
    return ["Gagal mengupload file: $target_file!"];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $kabupaten_kota = $_POST['kabupaten_kota'];
    $pusat_pemerintahan = $_POST['pusat_pemerintahan'];
    $bupati_walikota = $_POST['bupati_walikota'];
    $tanggal_berdiri = $_POST['tanggal_berdiri'];
    $luas_wilayah = $_POST['luas_wilayah'];
    $jumlah_penduduk = $_POST['jumlah_penduduk'];
    $jumlah_kecamatan = $_POST['jumlah_kecamatan'];
    $jumlah_kelurahan = $_POST['jumlah_kelurahan'];
    $jumlah_desa = $_POST['jumlah_desa'];
    $url_peta_wilayah = $_POST['url_peta_wilayah'];
    $deskripsi = strip_tags($_POST['deskripsi']);    
    $remove_image = $_POST['logo_lama'];
    $ubah_logo = isset($_POST['ubah_logo']) && $_POST['ubah_logo'] ? true : false;

    if ($ubah_logo) {
        $result = checkImage('logo', $remove_image);
        $filename = $_FILES['logo']['name'];
        
        if ($result[0] != "OK") {
            echo "<script>alert('". addslashes($result[0]) ."');</script>";
            echo "<script>window.location = '../../index.php?page=ubah_kabkota&id=$id';</script>";
            exit();
        }
    } else {
        $filename = $remove_image;
    }

    $query = "UPDATE tb_kab_kota SET
        kabupaten_kota = '$kabupaten_kota',
        pusat_pemerintahan = '$pusat_pemerintahan',
        bupati_walikota = '$bupati_walikota',
        tanggal_berdiri = '$tanggal_berdiri',
        luas_wilayah = '$luas_wilayah',
        jumlah_penduduk = '$jumlah_penduduk',
        jumlah_kecamatan = '$jumlah_kecamatan',
        jumlah_kelurahan = '$jumlah_kelurahan',
        jumlah_desa = '$jumlah_desa',
        url_peta_wilayah = '$url_peta_wilayah',
        deskripsi = '$deskripsi',
        logo = '$filename'
        WHERE id='$id'";

    $result = mysqli_query($conn, $query);

    if ($result) {
        echo "<script>alert('Berhasil mengubah data ". addslashes($kabupaten_kota) ."!');</script>";
        echo "<script>window.location = '../../index.php?page=data_kabkota';</script>";
    } else {
        $error_message = addslashes(mysqli_error($conn));
        echo "<script>alert('Gagal mengubah data ". addslashes($kabupaten_kota) .", coba cek isian anda! Error: $error_message');</script>";
        echo "<script>window.location = '../../index.php?page=ubah_kabkota&id=$id';</script>";
    }
}
?>
