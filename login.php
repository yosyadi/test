<?php 
ob_start();
session_start();

// test
//test 2

include 'config/koneksi.php';

// proses loggin
if(isset($_POST['login'])){
	$username = $_POST['username'];
	$password = $_POST['password'];
	if($username == "admin" && $password == "admin"){
		$username = "admin";
		$password = "admin";
		$sql_login = mysqli_query($connect, "SELECT * FROM user WHERE username = '$username' AND password = '$password'" );
		if(mysqli_num_rows($sql_login)>0){
		header('location: views/admin/index.php');
		}
	}
	else{
		$sql_login = mysqli_query($connect, "SELECT * FROM user WHERE username = '$username' AND password = '$password'" );
		if(mysqli_num_rows($sql_login)>0){
		header('location: views/user/index.php');
		}
		else{
		header('location: login.php?login-gagal');
		}
	}
	
}

 ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>LOGIN</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">

    <!-- Add custom CSS here -->
    <link href="assets/css/sb-admin.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
  </head>

  <body>
		<div class="container">
			<div class="row mt-5 justify-content-center">
				<div class="col-lg-10">
					<center>
					<form action="" method="POST">
						<h1>LOGIN</h1>
						<table>
							<tr>
								<td>Username</td><td>:</td><td><input type="text" name="username" required></td>
							</tr>
							<tr>
								<td>Password</td><td>:</td><td><input type="password" name="password" required></td>
							</tr>
							<?php 
							if(isset($_GET['login-gagal'])){
							 ?>
							
							<tr>
								<td>
									<div>
										<p>Maaf, Username/Password yang Anda masukkan salah!</p>
									</div>
								</td>
							</tr>
						<?php } ?>
							<tr>
								<td><input type="submit" name="login" value="Login"></td>
							</tr>
						</table>
						
					</form>
					</center>
				</div>
			</div>
		</div>
			
	 <script src="assets/js/jquery-1.10.2.js"></script>
    <script src="assets/js/bootstrap.js"></script>

  </body>
</html>
<<<<<<< HEAD
<!-- hai hai 
ziziziziziziz
skdfjskfds-->
=======
<-- hiu hiu -->
>>>>>>> 5871b7188e6281e397f2b3516e7a9f6414c44bff

<?php 
ob_end_flush();
 ?>
