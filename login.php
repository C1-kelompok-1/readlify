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
      <form action="#">
        <h1>Masuk</h1>
        <input type="text" placeholder="Email atau username" />
        <input type="password" placeholder="Password" />
        <select name="role">
          <option value="Pembaca">Pembaca</option>
          <option value="Penulis">Penulis</option>
        </select>
        <button>Masuk</button>
        <div class="content">
          <div class="checkbox">
            <input type="checkbox" name="checkbox" id="checkbox" />
            <label>Ingat saya</label>
          </div>
        </div>
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