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
      <form action="#">
        <h1>Register</h1>
        <input type="text" placeholder="Name" />
        <input type="email" placeholder="Email" />
        <input type="password" placeholder="Password" />
        <select name="role">
          <option value="Reader">Reader</option>
          <option value="Creator">Creator</option>
        </select>
        <button>Register</button>
        <span>or use your account</span>
        <div class="social-container">
          <a href="#" class="social"><img src="assets/images/social/facebook.svg" alt="" /><i class="lni lni-facebook-fill"></i></a>
          <a href="#" class="social"><img src="assets/images/social/google.svg" alt="" /><i class="lni lni-google"></i></a>
          <a href="#" class="social"><img src="assets/images/social/twitter.svg" alt="" /><i class="lni lni-linkedin-original"></i></a>
        </div>
      </form>
    </div>

    <div class="form-container login-container">
      <form action="#">
        <h1>Buat akun</h1>
        <input type="email" placeholder="Email" />
        <input type="text" placeholder="Username" />
        <input type="password" placeholder="Password" />
        <input type="password" placeholder="Konfirmasi password" />
        <button>Daftar</button>
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