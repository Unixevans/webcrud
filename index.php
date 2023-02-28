<?php
session_start();

if ( !isset($_SESSION["login"]) ) {
  header("Location: login.php");
  exit;
}
require 'function.php';

//Pagination
//Konfigurasi
$jumlahDataPerPage = 5;
$jumlahData = count(query("SELECT * FROM siswalaki"));
$jumlahPage = ceil($jumlahData / $jumlahDataPerPage);
$halamanAktif = ( isset($_GET["halaman"]) ) ? $_GET["halaman"] : 1;
//halaman 2, awal data 2
$awalData = ($jumlahDataPerPage * $halamanAktif) - $jumlahDataPerPage;


$siswa = query("SELECT * FROM siswalaki LIMIT $awalData, $jumlahDataPerPage");

if ( isset($_POST["cari"]) ) {
  $siswa = cari($_POST["keyword"]);
}

 
?>
<!DOCTYPE html>
<html>
<head>
  <title>AWAL</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="fContainer">
    <nav class="wrapper">
      <div class="brand">
        <div class="Daftar">DAFTAR</div>
        <div class="Absen">SISWA</div>
      </div>
      <ul class="navigation">
        <li><a href="tambah.php"><i class="fa-solid fa-user-plus"></i></a></li>
        <li><a href="logout.php"><button style="background: transparent; border: none;" type="button" onclick="return confirm('Apakah anda yakin ingin keluar?');" id="kanan"><i class="fa-sharp fa-solid fa-arrow-right-from-bracket"></i></button></a></li>
        <!-- <li><a href="tambah.php"><button id="kiri">TAMBAH DATA</button></a></li> -->
      </ul>
    </nav>
    <div class="content">
      <form action="" method="post">
        <div class="searching">
          <input type="text" class="form-control" name="keyword" id="cari" size="35" autofocus autocomplete="off" placeholder="Masukkan keyword pencarian...">
          <button style="background: transparent; border: none;" type="submit" name="cari" id="cariv2"><i class="fa-solid fa-magnifying-glass"></i></button>
        </div>
        </form>
        <table class="table table-striped">
          <tr>
            <th>NO</th>
            <th>NAMA</th>
            <th>TELEPON</th>
            <th>EMAIL</th>
            <th>JURUSAN</th>
            <th>AKSI</th>
            <th>BIO</th>
          </tr>
          <?php $i = 1; ?>
          <?php foreach ($siswa as $row) : ?>
          <tr>
            <td><?php echo $row["id"]; ?></td>
            <td><?php echo $row["nama"]; ?></td>
            <td><?php echo $row["telepon"]; ?></td>
            <td><?php echo $row["email"]; ?></td>
            <td><?php echo $row["jurusan"]; ?></td>
            <td>
              <a href="edit.php?id=<?php echo $row["id"]; ?>"><i class="fa-solid fa-pen-to-square"></i></a>
              <a href="hapus.php?id=<?php echo $row["id"]; ?>" onclick="return confirm('Apakah Anda Yakin?');"><i class="fa-solid fa-trash"></i></a>
            </td>
            <td>
              <a href="bio.php?id=<?php echo $row['id']; ?>"><button type="submit" style="border:none; background-color:lightslategrey; border-radius:5px;">SHOW</button></a>
            </td>
          </tr>
          <?php $i++; ?>
          <?php endforeach; ?>
        <div class="halaman">
          <div class="pagin">
            <?php if ($halamanAktif > 1) : ?>
              <a class="page-link" href="?halaman=<?php echo $halamanAktif - 1; ?>" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
              </a>
            <?php endif; ?>

            <?php for($i = 1; $i <= $jumlahPage; $i++) : ?>
              <?php if ($i == $halamanAktif) : ?>
                <a class="page-link" href="?halaman=<?php echo $i; ?>" style="font-weight: bold; color: red;"><?php echo $i; ?></a>
              <?php else : ?>
                <a class="page-link" href="?halaman=<?php echo $i; ?>"><?php echo $i; ?></a>
              <?php endif; ?>
            <?php endfor; ?>

            <?php if ($halamanAktif < $jumlahPage) : ?>
              <a class="page-link" href="?halaman=<?php echo $halamanAktif + 1; ?>">
                <span aria-hidden="true">&raquo;</span>
              </a>
            <?php endif; ?>
          </div>
        </div>
    </div>
  </div>
</body>
  
</html>

