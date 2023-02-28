<?php
session_start();
if ( !isset($_SESSION["login"]) ) {
  header("Location: login.php");
  exit;
}
require 'function.php';

if ( isset($_POST["submit"]) ) {
  if ( tambah($_POST) > 0 ) {
    echo "<script>
              alert('Data berhasil ditambahkan');
              document.location.href = 'index.php';
          </script>
    ";
  } else {
    echo "<script>
              alert('Data gagal ditambahkan');
              document.location.href = 'index.php';
          </script>
    ";
  }
}


?>

<!DOCTYPE html>
<html>
<head>
  <title>INSERT PAGE</title>
  <body bgcolor="#BADA55">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
  <link rel="stylesheet" href="styleedtam.css">
</head>
<body>
  <div class="fContainer">
    <div class="wr">
      <button class="back" type="submit"><a href="index.php">BACK</a></button>
    </div>
    <div class="form">
      <div class="card">
        <h1 class="h1">TAMBAH DATA</h1>
        <form action="" method="post" enctype="multipart/form-data">
          <label for="nama"></label>
          <input class="form-control" type="text" name="nama" id="nama" placeholder="Masukkan Nama" size="25" autocomplete="off" required>
          <label for="telepon"></label>
          <input class="form-control" type="text" name="telepon" id="telepon" placeholder="Masukkan Telepon" size="25" autocomplete="off" required>
          <label for="email"></label>
          <input class="form-control" type="text" name="email" id="email" placeholder="Masukkan Email" size="25" autocomplete="off" required>
          <label for="jurusan"></label>
          <input class="form-control" type="text" name="jurusan" id="jurusan" placeholder="Masukkan Jurusan" size="25" autocomplete="off" required>
          <label for="gambar"></label>
          <input class="form-control" type="file" name="gambar" id="gambar" size="25">
          <br>
          <button class="btn btn-primary btn-sm" type="submit" name="submit">TAMBAH</button>
        </form>
      </div>
    </div>
    <em>
        <p><strong>Harap diperhatikan sebelum mengupload gambar :</strong></p>
        <p>Wajib mengupload gambar</p>
        <p>Ekstensi gambar harus jpg, jpeg, atau png</p>
        <p>Maksimal ukuran gambar 1MB</p>
      </em>
  </div>
</div>
</body>
  
  
</html>