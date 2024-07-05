<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>KabKota Login</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css" />
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="../../plugins/icheck-bootstrap/icheck-bootstrap.min.css" />
    <!-- Theme style -->
    <link rel="stylesheet" href="../../dist/css/adminlte.min.css" />
  </head>
  <body class="hold-transition login-page">

    <?php
    if(isset($_COOKIE['email']) && isset($_COOKIE['username']) && isset($_COOKIE['role'])) {
        session_start();
        $_SESSION['email'] = $_COOKIE['email'];
        $_SESSION['username'] = $_COOKIE['username'];
        $_SESSION['role'] = $_COOKIE['role'];
        echo "<script>window.location.href='../../index.php';</script>";
        exit();
    }
    ?>

    <div class="login-box">
      <!--/login-logo -->
      <div class="card card-outline card-primary">
        <div class="card-header text-center">
          <a href="index.php" class="h1"><b>KabKota</b>App</a>
        </div>
        <div class="card-body">
          <p class="login-box-msg">Silahkan login untuk mengelola data</p>
          <form id="loginForm" action="../../proses/user/proses_login.php" method="post">
            <div class="input-group mb-3">
              <input type="email" class="form-control" placeholder="Email" id="email" name="email" required />
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fa fa-envelope"></span>
                </div>
              </div>
            </div>
            <div class="input-group mb-3">
              <input type="password" class="form-control" placeholder="Password" id="password" name="password" required />
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fa fa-lock"></span>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-8">
                <div class="icheck-primary">
                  <input type="checkbox" id="remember" name="remember" />
                  <label for="remember">Ingatkan saya</label>
                </div>
              </div>
              <!--/.col -->
              <div class="col-4">
                <button type="submit" class="btn btn-primary btn-block">Masuk</button>
              </div>
              <!--/.col -->
            </div>
          </form>
        </div>
        <!--/.card-body-->
      </div>
      <!--/.card -->
    </div>
    <!--/.login-box -->

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <!-- jQuery Validation Plugin -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.20.0/jquery.validate.min.js"></script>
    <script src="validation.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../../dist/js/adminlte.min.js"></script>
  </body>
</html>
