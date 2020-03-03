<?php 
include '../config/koneksi.php';

$kd_ajar = $_POST['kd_ajar'];
$nik = $_POST['nik'];
$kd_kelas = $_POST['kd_kelas'];
mysqli_query($connect, "UPDATE tb_Ajar SET nik = '$nik', kd_kelas = '$kd_kelas' WHERE kd_ajar = '$kd_ajar' ");
 echo "<script>window.location='?page=Ajar';</script>";
?>