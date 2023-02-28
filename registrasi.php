<?php 
require 'function.php';

if (isset($_POST["register"])) {
	if ( registrasi($_POST) > 0 ) {
		echo "<script>
				alert('User baru berhasil ditambahkan');
				document.location.href = 'login.php';
			</script>";
	} else {
		echo mysqli_error($conn);
	}
}

?>




<!DOCTYPE html>
<html>
<head>
	<title>REGISTRASI PAGE</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
	<link rel="stylesheet" href="stylelr.css">
</head>
<body>
	<div class="fcontainer">
		<div class="content">
			<div class="masuk">
				<h1>REGISTRASI USER</h1>
				<form action="" method="post">
					<input class="form-control" type="text" name="username" id="input" size="35" placeholder="Masukkan username.." required autofocus>
					<br>
					<input class="form-control" type="password" name="password" id="input" size="35" placeholder="Masukkan password.." required autofocus>
					<br>
					<input class="form-control" type="password" name="password2" id="input" size="35" placeholder="Masukkan konfirmasi password.." required autofocus>
					<br>
					<button type="submit" name="register" id="submit">SIGN UP</button>
				</form>
			</div>
			<div class="clip">
				<p class="asw">Sudah punya akun?<a href="login.php">Login</a></p>
				<p class="anj">v1.2</p>
			</div>
		</div>
	</div>
</body>
</html>