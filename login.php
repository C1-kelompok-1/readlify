<?php
require "session.php";
include('koneksi.php');
if (isset($_POST['login'])) {
  // Get input values
  $username = $_POST['username'];
  $password = $_POST['password'];
  $role = $_POST['role'];

  // Check user credentials in database
  $query = "SELECT * FROM pengguna WHERE username = '$username' AND role = '$role'";
  $result = mysqli_query($conn, $query);

  if (mysqli_num_rows($result) > 0) {
    $user = mysqli_fetch_assoc($result);




    // if(password_verify($password, $user['password'])) {
    // if ($password == $user['password']) {
    if (password_verify($password, $user['password']) || $password == $user['password']) {

      $_SESSION['user'] = $user['username'];
      $_SESSION['role'] = $user['role'];

      if ($role == 'Pembaca') {
        header('Location: index.php');
      } else if ($role == 'Penulis') {
        header('Location: koin.php');
      } else if ($role == 'Admin') {
        header('Location: admin/index.php');
      }
    } else {
      echo "<script>alert('Password yang Anda masukkan salah.');</script>";
      // echo "Password yang Anda masukkan salah. Password yang dimasukkan: $password. Password yang tersimpan di database: {$user['password']}";

    }
  } else {
    echo "<script>alert('Username tidak ditemukan.');</script>";
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
    <div class="form-container login-container">

      <form action="" method="POST">
        <h1>Masuk</h1>
        <input type="text" name="username" placeholder="Email atau username" />
        <input type="password" name="password" placeholder="Password" />
        <select name="role">
          <option value="Pembaca">Pembaca</option>
          <option value="Penulis">Penulis</option>
          <option value="Admin">Admin</option>
        </select>
        <div class="content">
          <div class="checkbox">
            <input type="checkbox" name="checkbox" id="checkbox" />
            <label>Ingat saya</label>
          </div>
        </div>
        <button type="submit" name="login">Masuk</button>
      </form>
    </div>

    <div class="overlay-container">
      <div class="overlay">
        <div class="overlay-panel overlay-right">
          <p>
            Belum ada akun? daftar disini
          </p>
          <a href="register.php" class="button ghost" id="register">
            Daftar
            <i class="lni lni-arrow-right register"></i>
          </a>
        </div>
      </div>
    </div>
  </div>

  <?php require 'layouts/auth/scripts.php' ?>
</body>

</html>