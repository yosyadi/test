<?php 
include '../config/koneksi.php';

$kd_mk = $_POST['kd_mk'];
$nama_mk = $_POST['nama_mk'];
$sks = $_POST['sks'];
mysqli_query($connect, "UPDATE tb_matkul SET nama_mk = '$nama_mk', sks = '$sks' WHERE kd_mk = '$kd_mk' ");
 echo "<script>window.location='?page=MataKuliah';</script>";
?>