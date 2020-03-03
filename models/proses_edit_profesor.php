<?php 
include '../config/koneksi.php';

$nik = $_POST['nik'];
$nama = $_POST['nama'];
$alamat = $_POST['alamat'];
$gender = $_POST['gender'];
mysqli_query($connect, "UPDATE tb_profesor SET nama = '$nama', alamat = '$alamat', gender = '$gender' WHERE nik = '$nik' ");
 echo "<script>window.location='?page=Profesor';</script>";
?>