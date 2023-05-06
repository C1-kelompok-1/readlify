<?php
include 'koneksi.php';
require 'helpers/alert.php';
require 'helpers/input.php';
require 'helpers/auth.php';

redirectIfAuthenticated('index.php');

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

function getInputValue($name)
{
  if (isset($_POST[$name])) {
    echo $_POST[$name];
  }
}
// Fungsi untuk menambahkan user ke database
function tambahUser($conn, $email, $username, $password)
{
  // Cek apakah email atau username sudah ada di database
  $query = "SELECT * FROM pengguna WHERE email = '$email' OR username = '$username'";
  $result = mysqli_query($conn, $query);

  if (mysqli_num_rows($result) > 0) {
    // Jika sudah ada, kembalikan false
    return false;
  } else {
    // Jika belum ada, tambahkan pengguna ke database
    $sql = "INSERT INTO pengguna (role, username, password, email) VALUES ('pembaca', '$username', '$password', '$email')";
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

  // cek email
  if (!$email) {
    setInputError('email', 'Tolong isi emailmu');
  }

  // cek email valid
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    setInputError('email', 'Emailmu tidak valid');
  }
  
  // cek username
  if (!$username) {
    setInputError('username', 'Tolong isi usernamemu');
  }

  // cek password
  if (!$password) {
    setInputError('password', 'Tolong isi passwordmu');
  }

  // cek panjang password
  if (strlen($password) < 8) {
    setInputError('password', 'Password harus berisi minimal 8 karakter');
  }

  // cek konfirmasi password
  if (!$konfirmasipw) {
    setInputError('konfirmasipw', 'Tolong isi konfirmasi password');
  }

  // cek kecocokan password
  if ($konfirmasipw != $password) {
    setInputError('konfirmasipw', 'Password tidak cocok');
  }
  
  if (!isThereAnyInputError()) {
    // Enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    // Tambahkan user ke database
    $result = tambahUser($conn, $email, $username, $password);
    if ($result) {
      setAlert('success', 'Akun berhasil terdaftar, silakan login.');
      redirect('login.php');
    } else {
      setAlert('danger', 'Email atau username sudah terdaftar. Silakan coba lagi.');
    }
  } else {
    setOldInputs();
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <title>Readify | Register</title>

  <?php require 'layouts/favicon.php'; ?>
  <?php require 'layouts/auth/styles.php'; ?>
</head>

<body>
  <div class="container" id="container">
    <div class="form-container register-container">
      <form action="#" method="post">
        <h1>Buat akun</h1>

        <?= getAlert(); ?>
        
        <input type="email" name="email" placeholder="Email" value="<?= getOldInput('email'); ?>" />
        <?= getInputError('email'); ?>

        <input type="text" name="username" placeholder="Username" value="<?= getOldInput('username'); ?>" />
        <?= getInputError('username'); ?>

        <input type="password" name="password" placeholder="Password" />
        <?= getInputError('password'); ?>

        <input type="password" name="konfirmasipw" placeholder="Konfirmasi password" />
        <?= getInputError('konfirmasipw'); ?>

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