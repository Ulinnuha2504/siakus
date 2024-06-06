<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Log in (v2)</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <style>
    body {
          background-image: url("dist/img/background.jpg");
          background-repeat: no-repeat;
          background-size: 100%;
          /* background-color: #cccccc; */
          }
  </style>
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <h1><b>SIAKUS</b></h1>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Silahkan Masuk untuk melakukan operasi</p>
      <form action="ceklogin.php" method="post">
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Username" name="username" required >
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control"  placeholder="Password" name="password"required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <select name="masuk" id="masuk"class="form-control" required>
            <option value="">Login Sebagai</option>
            <option value="Administrator">Administrator</option>
            <option value="Kepala Sekolah">Kepala Sekolah</option>
            <option value="Keuangan">Keuangan</option>
            <option value="Pengaju">Pengaju</option>
          </select>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-star"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
            <input type="checkbox" id="show-password">
            <label for="show-password">
              Show Password
            </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
      
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    const showPasswordCheckbox = document.getElementById('show-password');
    const passwordInput = document.querySelector('input[type="password"]');

    showPasswordCheckbox.addEventListener('change', function() {
      if (this.checked) {
        passwordInput.type = 'text';
      } else {
        passwordInput.type = 'password';
      }
    });
  });
</script>

</body>
</html>
