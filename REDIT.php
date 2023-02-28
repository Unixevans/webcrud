<?php
session_start();
if ( !isset($_SESSION["login"]) ) {
  header("Location: login.php");
  exit;
}
require 'function.php';

$id = $_GET["id"];
$ss = query("SELECT * FROM siswalaki WHERE id = $id")[0];

if ( isset($_POST["submit"]) ) {
  if ( edit($_POST) > 0 ) {
    echo "<script>
              alert('Data berhasil diedit');
              document.location.href = 'index.php';
          </script>
    ";
  } else {
    echo "<script>
              alert('Data gagal diedit');
              document.location.href = 'index.php';
          </script>
    ";
  }
}


?>

<!DOCTYPE html>
<html>
<head>
  <title>EDIT PAGE</title>
  <body bgcolor="#BADA55">
</head>
<style>
  .body {
    background: green;
    color: white;
    padding: 20px;
    text-align: center;
    width: 400px;
    height: 500px;
    margin: 20px auto;
    border: 3px solid black;
    text-transform: capitalize;
  }
  .kiri {
    float: right;
    margin: 5px;
  }
</style>
<body>
<div class="kiri"><a href="index.php"><button>BACK</button></a></div>
<br>
<br>
<div class="body"><img src="img/logo.png" width="150">
<h1>EDIT DATA</h1>
<p><?php echo $ss["nama"]; ?></p>
  <form action="" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id" id="id" required value="<?php echo $ss["id"]; ?>">
    <input type="hidden" name="gambarLama" value="<?php echo $ss["gambar"]; ?>">
    <label for="nama"></label>
    <input type="text" name="nama" id="nama" size="25" autocomplete="off" placeholder="Masukkan nama" required value="<?php echo $ss["nama"]; ?>">
    <br>
    <br>
    <label for="telepon"></label>
    <input type="text" name="telepon" id="telepon" size="25" autocomplete="off" placeholder="Masukkan telepon" required value="<?php echo $ss["telepon"]; ?>">
    <br>
    <br>
    <label for="email"></label>
    <input type="text" name="email" id="email" size="25" autocomplete="off" placeholder="Masukkan email" required value="<?php echo $ss["email"]; ?>">
    <br>
    <br>
    <label for="jurusan"></label>
    <input type="text" name="jurusan" id="jurusan" size="25" autocomplete="off" placeholder="Masukkan jurusan" required value="<?php echo $ss["jurusan"]; ?>">
    <br>
    <br>
    <label for="gambar"></label>
    <input type="file" name="gambar" id="gambar">
    <br>
    <br>
    <button type="submit" name="submit">EDIT</button>
  </form>
</div>
</body>
  
  
</html>