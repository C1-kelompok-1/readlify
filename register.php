<?php
include('koneksi.php');

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

function getInputValue($name)
{
  if (isset($_POST[$name])) {
    echo $_POST[$name];
  }
}
// Fungsi untuk menambahkan user ke database
function tambahUser($conn, $email, $username, $password, $role)
{
  // Cek apakah email atau username sudah ada di database
  $query = "SELECT * FROM pengguna WHERE email = '$email' OR username = '$username'";
  $result = mysqli_query($conn, $query);

  if (mysqli_num_rows($result) > 0) {
    // Jika sudah ada, kembalikan false
    return false;
  } else {
    // Jika belum ada, tambahkan pengguna ke database
    $sql = "INSERT INTO pengguna (role, username, password, email) VALUES ('$role', '$username', '$password', '$email')";
    $query = mysqli_query($conn, $sql);
    return $query;
  }
}

// Cek apakah tombol submit sudah di klik
if (isset($_POST["daftar"])) {
  $email = $_POST["email"];
  $username = $_POST["username"];
  $password = $_POST["password"];
  $konfirmasipw = $_POST["konfirmasipw"];
  $role = $_POST["role"];


  if (empty($email) || empty($username) || empty($password) || empty($konfirmasipw)) {
    echo "<script>alert('Email, username, password, dan konfirmasi password harus diisi!')</script>";
    header('Location: register.php');
  } else {

    // // Cek apakah password dan konfirmasi password sama
    if ($password === $konfirmasipw) {
      // Enkripsi password
      $password = password_hash($password, PASSWORD_DEFAULT);

      // Tambahkan user ke database
      $result = tambahUser($conn, $email, $username, $password, $role);
      if ($result) {
        $_SESSION['success'] = "Registrasi berhasil. Silakan login.";
        echo "<script>alert('Registrasi berhasil. Silakan login.')</script>";
        header('Location: login.php');
      } else {
        // $_SESSION['error'] = "Registrasi gagal. Silakan coba lagi.";
        echo "<script>alert('Email atau username sudah terdaftar. Silakan coba lagi.')</script>";
        // header('Location: register.php');
      }
    } else {
      echo "<script>alert('Password dan konfirmasi password tidak sama!.')</script>";
    }
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <title>Document</title>

  <?php require 'layouts/auth/styles.php'; ?>
</head>

<body>
  <div class="container" id="container">
    <div class="form-container register-container">
      <form action="#" method="post">
        <h1>Buat akun</h1>
        <input type="email" name="email" placeholder="Email" />
        <input type="text" name="username" placeholder="Username" />
        <input type="password" name="password" placeholder="Password" />
        <input type="password" name="konfirmasipw" placeholder="Konfirmasi password" />
        <select name="role">
          <option value="Pembaca">Pembaca</option>
          <option value="Penulis">Penulis</option>
        </select>
        <button type="submit" name="daftar">Daftar</button>
      </form>
    </div>

    <div class="overlay-container">
      <div class="overlay">
        <div class="overlay-panel overlay-right">
          <h1 class="title">
            Mulai langsung baca
          </h1>
          <p>
            Kalo sudah punya akun langsung masuk aja kesini
          </p>
          <a href="login.php" class="button ghost" id="register">
            Masuk
            <i class="lni lni-arrow-right register"></i>
          </a>
        </div>
      </div>
    </div>
  </div>

  <?php require 'layouts/auth/scripts.php' ?>
</body>

</html>