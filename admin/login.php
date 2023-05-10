<?php
if (isset($_SESSION['logged_account']) && $_SESSION['logged_account']) {
  $accountRole = $_SESSION['logged_account']['role'];

  if ($accountRole == 'member') header('Location: books.php');
  if ($accountRole == 'staff') header('Location: books.php');
  if ($accountRole == 'admin') header('Location: dashboard.php');

  die;
}

if (isset($_POST['login'])) {
  $email = $_POST['email'];
  $password = $_POST['password'];
  $role = $_POST['role'];

  $accounts = $_SESSION['accounts'];
  $errorMessage = null;
  $oldEmail = null;
  
  foreach ($accounts as $account) {
    if ($email == $account['email'] && password_verify($password, $account['password'])) {
      $logged_account = [
        'email' => $account['email'],
        'name' => $account['name'],
        'role' => $account['role'],
        'logged_at' => time()
      ];

      if ($role == 'member' && $account['role'] == 'member') {
        $_SESSION['logged_account'] = $logged_account;
        header('Location: books.php');
        die;
      }

      if ($role == 'staff' && $account['role'] == 'staff') {
        $_SESSION['logged_account'] = $logged_account;
        header('Location: books.php');
        die;
      }

      if ($role == 'admin' && $account['role'] == 'admin') {
        $_SESSION['logged_account'] = $logged_account;
        header('Location: dashboard.php');
        die;
      }
    }
  }

  $errorMessage = 'Email atau password tidak ditemukan';
  $oldEmail = $email;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Login &mdash; Readlify</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="assets/modules/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/modules/fontawesome/css/all.min.css">

  <!-- Template CSS -->
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/components.css">
</head>

<body>
  <div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
            <div class="login-brand">
              <h1 style="user-select: none;">Readlify</h1>
            </div>

            <div class="card card-primary">
              <div class="card-header"><h4>Login</h4></div>

              <div class="card-body">
                <form method="POST" action="login.php" class="needs-validation">
                  <?php if (isset($errorMessage)): ?>
                    <div class="alert alert-danger"><?= $errorMessage; ?></div>
                  <?php endif; ?>

                  <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" type="email" class="form-control" name="email" tabindex="1" required autofocus value="<?= isset($oldEmail) ? $oldEmail : ''; ?>">
                    <div class="invalid-feedback"></div>
                  </div>

                  <div class="form-group">
                    <div class="d-block">
                    	<label for="password" class="control-label">Password</label>
                    </div>
                    <input id="password" type="password" class="form-control" name="password" tabindex="2" required>
                    <div class="invalid-feedback"></div>
                  </div>

                  <div class="form-group">
                    <label for="role">Role</label>
                    <select name="role" id="role" class="form-control">
                      <option value="member">Anggota</option>
                      <option value="staff">Staff</option>
                      <option value="admin">Admin</option>
                    </select>
                  </div>

                  <!-- <div class="form-group">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" name="remember" class="custom-control-input" tabindex="3" id="remember-me">
                      <label class="custom-control-label" for="remember-me">Ingat saya</label>
                    </div>
                  </div> -->

                  <div class="form-group">
                    <button type="submit" name="login" class="btn btn-primary btn-lg btn-block" tabindex="4">
                      Login
                    </button>
                  </div>
                </form>
              </div>
            </div>
            <div class="simple-footer">
              Copyright &copy; Readlify 2023
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <!-- General JS Scripts -->
  <script src="assets/modules/jquery.min.js"></script>
  <script src="assets/modules/bootstrap/js/bootstrap.min.js"></script>
  <script src="assets/modules/nicescroll/jquery.nicescroll.min.js"></script>
  <script src="assets/js/stisla.js"></script>
  
  <!-- JS Libraies -->

  <!-- Page Specific JS File -->
  
  <!-- Template JS File -->
  <script src="assets/js/scripts.js"></script>
  <script src="assets/js/custom.js"></script>
</body>
</html>