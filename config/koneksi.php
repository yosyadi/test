<?php 
$host = "localhost";
$user = "root";
$pass = "";
$database = "universitas";

$connect = mysqli_connect($host, $user, $pass, $database);
if(!$connect){
	echo"KONEKSI GAGAL";
}
 ?>