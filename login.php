<?php
require "session.php";
require "database.php";
require "helpers/alert.php";
require "helpers/input.php";
require "helpers/auth.php";

redirectIfAuthenticated('index.php');
///tesss
if (isset($_POST['login'])) {
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

  if (!isThereAnyInputError()) {
    // Check user credentials in database
    $userSql = "SELECT * FROM pengguna WHERE username = :username OR email = :email";
    $userParams = ['username' => $username, 'email' => $username];
    $user = fetchOne($userSql, $userParams);

    if ($user) {
      if (password_verify($password, $user['password'])) {
        $_SESSION['user'] = $user;

        if (isset($_POST['remember_me'])) {
          setcookie(
            'readify_remember',
            base64_encode($user['id']),
            time() + 606024 * 30,
            '/',
            false,
            true
          );
        }

        redirect('index.php');
      }
    }

    setAlert('danger', 'Akun tidak ditemukan.');
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

  <title>Login</title>

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
        <div class="content">
          <div class="checkbox">
            <input type="checkbox" name="remember_me" id="checkbox" />
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
</body>

</html>