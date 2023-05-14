<?php

require "database.php";
require "helpers/input.php";
require "helpers/alert.php";
require "helpers/auth.php";

if (isset($_POST["tambah"])){
  $username = $_POST["username"];
  $email = $_POST["email"];
  $password = $_POST["password"];
  $confirmPassword = $_POST["confirmPassword"];

  // cek email
  if (!$email) {
    setInputError('email', 'Tolong isi email');
  }

  // cek email
  if (strlen($email) > 50) {
    setInputError('email', 'Maksimal panjang email hanya 50 karakter');
  }

  // cek email valid
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    setInputError('email', 'Email tidak valid');
  }
  
  // cek username
  if (!$username) {
    setInputError('username', 'Tolong isi username');
  }

  // cek username
  if (strlen($username) > 50) {
    setInputError('username', 'Maksimal panjang username hanya 50 karakter');
  }

  // cek password
  if (!$password) {
    setInputError('password', 'Tolong isi password');
  }

  // cek panjang password
  if (strlen($password) < 8) {
    setInputError('password', 'Password harus berisi minimal 8 karakter');
  }

  // cek konfirmasi password
  if (!$confirmPassword) {
    setInputError('confirmPassword', 'Tolong isi konfirmasi password');
  }

  // cek kecocokan password
  if ($confirmPassword != $password) {
    setInputError('confirmPassword', 'Password tidak cocok');
  }

  if (!isThereAnyInputError()) {
    $admin = fetchOne('SELECT COUNT(id) AS sudah_ada FROM pengguna WHERE email = :email OR username = :username', [
      ':email' => $email,
      ':username' => $username,
    ]);

    if (!$admin['sudah_ada']) {
      try {
        query("INSERT INTO pengguna (id, username, email, password, role) VALUES (null, :username, :email, :password, 'admin')", [
          ':username' => $username,
          ':email' => $email,
          ':password' => password_hash($password, PASSWORD_DEFAULT),
        ]);
        
        setAlert('success', 'Berhasil menambah akun admin');
        redirect('daftar_pgna.php');
      } catch (Exception $error) {
        setAlert('danger', 'Gagal menambah admin, silakan coba lagi');
      }
    } else {
      setAlert('danger', 'Akun admin dengan email dan username tersebut sudah digunakan');
      redirect('tambah_pgna.php');
    }
  } else {
    setOldInputs();
    redirect('tambah_pgna.php');
  }
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Tambah admin</title>
    <?php require 'layouts/styles.php'; ?>
  </head>

  <body class="bg-theme bg-theme1">
    <div id="wrapper">
      <?php require 'layouts/sidebar.php'; ?>
      <?php require 'layouts/navbar.php'; ?>
      <?php require 'layouts/scripts.php'; ?>
      
      <div class="content-wrapper">
        <div class="container-fluid">
          <?= getAlert(); ?>
          <div class="card">
            <div class="card-body">
              <div class="d-flex align-items-center justify-content-between">
                <h5 class="card-title">Tambah admin</h5>
                <a href="daftar_pgna.php" class="btn btn-info mb-3">
                  <i class="fa fa-arrow-left"></i>
                  Kembali
                </a>
              </div>
              <form action="tambah_pgna.php" method="POST">
                <div class="form-group">
                  <input type="text" class="form-control" name="username" placeholder="Username" value="<?= getOldInput('username'); ?>">
                  <?= getInputError('username'); ?>
                </div>
                <div class="form-group">
                  <input type="email" class="form-control" name="email" placeholder="Email" value="<?= getOldInput('email'); ?>">
                  <?= getInputError('email'); ?>
                </div>
                <div class="form-group">
                  <input type="password" class="form-control" name="password" placeholder="Password">
                  <?= getInputError('password'); ?>
                </div>
                <div class="form-group">
                  <input type="password" class="form-control" name="confirmPassword" placeholder="Konfirmasi password">
                  <?= getInputError('confirmPassword'); ?>
                </div>
                <div class="form-group">
                  <button type="submit" name="tambah" class="btn btn-primary">Tambah</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>