<?php
require "session.php";
require "database.php";
require "helpers/base.php";
require "helpers/input.php";
require "helpers/auth.php";

redirectIfAuthenticated('index.php');

if (isset($_POST['login'])) {
  setOldInputs();

  // Get input values
  $username = $_POST['username'];
  $password = $_POST['password'];

  // cek username
  if (!$username) {
    setInputError('username', 'Tolong isi usernamemu');
  }

  if (!$password) {
    setInputError('password', 'Tolong isi passwordmu');
  }

  if (!isThereAnyError()) {
    // Check user credentials in database
    $userSql = "SELECT * FROM pengguna WHERE username = :username OR email = :email";
    $userParams = ['username' => $username, 'email' => $username];
    $user = fetchOne($userSql, $userParams);
    
    if ($user) {
      if (password_verify($password, $user['password'])) {
        $_SESSION['user'] = $user;
        redirect('index.php');
      }
    }
    
    setAlert('danger', 'Akun tidak ditemukan.');
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <title>Readify | Login</title>

  <?php require 'layouts/favicon.php'; ?>
  <?php require 'layouts/auth/styles.php'; ?>
</head>

<body>
  <div class="container" id="container">
    <div class="form-container login-container">
      <form action="login.php" method="POST">
        <h1>Masuk</h1>
        <?= getAlert(); ?>
        <input type="text" name="username" placeholder="Email atau username" value="<?= getOldInput('username'); ?>" />
        <?= getInputError('username'); ?>
        <input type="password" name="password" placeholder="Password" />
        <?= getInputError('password'); ?>
        <!-- <div class="content">
          <div class="checkbox">
            <input type="checkbox" name="checkbox" id="checkbox" />
            <label>Ingat saya</label>
          </div>
        </div> -->
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