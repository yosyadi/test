<?php 
include '../config/koneksi.php';

$kd_kelas = $_POST['kd_kelas'];
$lokasi = $_POST['lokasi'];
$kapasitas = $_POST['kapasitas'];
mysqli_query($connect, "UPDATE tb_kelas SET lokasi = '$lokasi', kapasitas = '$kapasitas' WHERE kd_kelas = '$kd_kelas' ");
 echo "<script>window.location='?page=Kelas';</script>";
?>