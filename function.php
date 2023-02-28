<?php
// Koneksi ke Database
$conn = mysqli_connect("localhost", "root", "", "perpus");

// function query untuk menampilkan seluruh Database
function query($query) {
  global $conn;
  $result = mysqli_query($conn, $query);
  $rows = [];
  while ( $row = mysqli_fetch_assoc($result) ) {
    $rows[] = $row;
  }
  return $rows;
}

// function untuk query insert/menambahkan data
function tambah($data) {
  global $conn;
  
  $nama = htmlspecialchars($data["nama"]);
  $telepon = htmlspecialchars($data["telepon"]);
  $email = htmlspecialchars($data["email"]);
  $jurusan = htmlspecialchars($data["jurusan"]);

  //upload gambar
  $gambar  = upload();
  if ( $gambar === false ) {
    return false;
  }
  $query = "INSERT INTO siswalaki VALUES ('0', '$nama', '$telepon', '$email', '$jurusan', '$gambar')";
  mysqli_query($conn, $query);
  return mysqli_affected_rows($conn);
}

function upload() {
  $namaFile = $_FILES['gambar']['name'];
  $ukuranFile = $_FILES['gambar']['size'];
  $error = $_FILES['gambar']['error'];
  $tmpName = $_FILES['gambar']['tmp_name'];

  //cek sudah upload gambar
  if ( $error === 4 ) {
    echo "<script>
            alert('Upload Gambar Terlebih Dahulu!');
          </script>";
    return false;
  }

  //cek ekstensi gambar
  $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
  $ekstensiGambar = explode('.', $namaFile);
  $ekstensiGambar = strtolower(end($ekstensiGambar));
  if (in_array($ekstensiGambar, $ekstensiGambarValid) === false) {
    echo "<script>
            alert('Mohon upload gambar berkestensi jpg, jpeg, dan png!');
          </script>";
    return false;
  }
  
  //cek ukuran gambar
  if ($ukuranFile > 1000000) {
    echo "<script>
            alert('Ukuran gambar terlalu besar!');
          </script>";
    return false;
  }
  
  //generate nama file baru
  $namaFileBaru = uniqid();
  $namaFileBaru .= '.';
  $namaFileBaru .= $ekstensiGambar;
  //lolos pengecekan, siap upload gambar
  move_uploaded_file($tmpName, 'img/' . $namaFileBaru);
  
  return $namaFileBaru;
  
  
}

// function untuk menghapus data
function hapus($id) {
  global $conn;
  mysqli_query($conn, "DELETE FROM siswalaki WHERE id = $id");
  return mysqli_affected_rows($conn);
}

// function untuk mengedit data
function edit($data) {
  global $conn;

  $id = $data["id"];
  $nama = htmlspecialchars($data["nama"]);
  $telepon = htmlspecialchars($data["telepon"]);
  $email = htmlspecialchars($data["email"]);
  $jurusan = htmlspecialchars($data["jurusan"]);
  $gambarLama = $data["gambarLama"];

  //cek user
  if ( $_FILES['gambar']['error'] === 4 ) {
    $gambar = $gambarLama;
  } else {
    $gambar = upload();
  }

  $query = "UPDATE siswalaki SET nama = '$nama', telepon = '$telepon', email = '$email', jurusan = '$jurusan', gambar = '$gambar' WHERE id = '$id'";
  mysqli_query($conn, $query);
  return mysqli_affected_rows($conn);
}

// function untuk mencari data
function cari($keyword) {
  $query = "SELECT * FROM siswalaki WHERE nama LIKE '%$keyword%' OR telepon LIKE '%$keyword%' OR email = '%$keyword%' OR jurusan LIKE '%$keyword%'";
  return query($query);
}

function registrasi($data) {
  global $conn;

  $username = strtolower(stripslashes($data["username"]));
  $password = mysqli_real_escape_string($conn, $data["password"]);
  $password2 = mysqli_real_escape_string($conn, $data["password2"]);

  //cek konfirmasi username sudah ada atau belum
  $arrow = mysqli_query($conn, "SELECT username FROM user WHERE username = '$username'");

  if ( mysqli_fetch_assoc($arrow) ) {
    echo "<script>
              alert('Username sudah terdaftar gagal menambahkan user baru!')
          </script>";
    return false;
  }

  //cek konfirmasi password
  if ( $password !== $password2 ) {
    echo "<script>
            alert('Konfirmasi password tidak sesuai!')
          </script>";
    return false;
  }

  //enkripsi password
  $password = password_hash($password, PASSWORD_DEFAULT);

  //tambahkan user baru ke dalam database
  mysqli_query($conn, "INSERT INTO user VALUES('0', '$username', '$password')");
  return mysqli_affected_rows($conn);
}
?>