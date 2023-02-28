<?php 
session_start();
require 'function.php';
//cek cookie
if ( isset($_COOKIE['id']) && isset($_COOKIE['key']) ) {
  $id = $_COOKIE['id'];
  $key = $_COOKIE['key'];
  
  //ambil username berdasarkan nama
  $result = mysqli_query($conn, "SELECT username FROM user WHERE id = $id");
  $row = mysqli_fetch_assoc($result);
  
  //cek cookie dan username
  if ( $key === hash('sha256', $row['username']) ) {
    $_SESSION['login'] = true;
  }
  
  
}

if ( isset($_SESSION["login"]) ) {
	header("Location: login.php");
	exit;
}

if ( isset($_POST["login"]) ) {
	
	$username = $_POST["username"];
	$password = $_POST["password"];

	$result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");

	if ( mysqli_num_rows($result) === 1 ) {

		//cek password
		$row = mysqli_fetch_assoc($result);
		if ( password_verify($password, $row["password"]) ) {
			// set session
			$_SESSION["login"] = true;

      if ( isset($_POST["remember"]) ) {
        //buat cookie
         
         setcookie('id', $row['id'], time()+30);
         setcookie('key', hash('sha256', $row['username']), time()+30);
      }
      
      
			header("Location: index.php");
			exit;
		}
	}

	$error = true;
}




?>
<!DOCTYPE html>
<html>
<head>
	<title>LOGIN PAGE</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
	<link rel="stylesheet" href="stylelr.css">
</head>
<body>
	<div class="fcontainer">
		<div class="content">
			<div class="masuk">
				<h1>LOGIN ADMIN</h1>
					<?php if ( isset($error) ) : ?>
					<p style="color: red"><i>Username atau password salah</i></p>
				<?php endif; ?>
				<form action="" method="post">
					<input class="form-control" type="text" name="username" id="input" size="35" placeholder="Username" autofocus required>
					<br>
					<input class="form-control" type="password" name="password" id="input" size="35" placeholder="Password" autofocus required>
					<br>
					<input class="remember" type="checkbox" name="remember">
					<label class="remember">Remember Me</label>
					<br>
					<button type="submit" name="login" id="submit">LOGIN</button>
				</form>
			</div>
			<div class="clip">
				<p class="register">Belum punya akun?<a href="registrasi.php">Register</a></p>
				<p class="versi">v1.2</p>
			</div>
		</div>
	</div>
</body>
</html>