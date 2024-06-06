<?php
    $aktif="User";
    require "koneksi.php";
    include "sidebar.php";
    $us =  $_SESSION["username"];
    $pgn = $kon->query("SELECT * FROM pengguna WHERE username='$us'");
    ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Profile Akun Anda</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Profile</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Section -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
            <div class="col-md-7">
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Update Profile Anda</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="proses.php" method="post" enctype="multipart/form-data" class="form-horizontal">
              <?php foreach ($pgn as $pg) : $id=$pg['pg_id'];?>
                <div class="card-body">
                    <div class="text-center mb-5">
                    <img class="profile-user-img img-fluid img-circle"
                       src="<?php 
                       if (file_exists($imgdir . $_SESSION['username'].'.jpg')) {
                        echo $imgdir . $_SESSION['username'].'.jpg';
                        } else {
                        echo $imgkosong;
                        };?>"
                       alt="User profile picture">
                    </div>
                  <div class="form-group row">
                    <label for="inputnama" class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" value="<?= $pg['pg_nama'];?>"id="inputnama" name="nm" placeholder="Nama" required>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="InputKontak" class="col-sm-2 col-form-label">Kontak</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="kt"id="InputKontak" value="<?= $pg['pg_kontak'];?>" placeholder="Email / No.Telepon" required>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="username" class="col-sm-2 col-form-label">Username</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="InputKontak"value="<?= $pg['username'];?>" disabled>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="level" class="col-sm-2 col-form-label">Level</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="level" value="<?= $pg['pg_level'];?>"disabled>
                      <input type="hidden" name="id" value="<?= $pg['pg_id'];?>">
                      <input type="hidden" name="us" value="<?= $pg['username'];?>">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="InputFile" class="col-sm-2 col-form-label">Foto</label>
                    <div class="col-sm-10">
                      <input type="file" class="form-control" name="fl"id="InputFile"accept=".jpg">
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" name="submitUpdateProfile"class="btn btn-success">Simpan Perubahan</button>
                  <button type="reset" class="btn btn-danger float-right">Reset</button>
                </div>
                <?php endforeach; ?>
                <!-- /.card-footer -->
              </form>
            </div>
            </div>
            <div class="col-md-5">
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Ganti Password</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="proses.php"class="form-horizontal" method="post">
                <div class="card-body">
                  <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-4 col-form-label">Password Lama</label>
                    <div class="col-sm-8">
                      <input type="password" class="form-control" id="inputPassword3"name="pasold" placeholder="Password lama">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-4 col-form-label">Password Baru</label>
                    <div class="col-sm-8">
                      <input type="password" class="form-control" id="pasnew"name="pasnew" placeholder="Password baru">
                      <input type="hidden" name="id" id="id" value="<?= $id;?>">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-4 col-form-label">Konfirmasi Password Baru</label>
                    <div class="col-sm-8">
                      <input type="password" class="form-control" id="konpasnew"name="konpasnew" placeholder="Konfirmasi Password Baru">
                    </div>
                  </div>
                  <div id="password-match-warning" style="display: none; color: red;">
                    Password baru dan konfirmasi password harus sama.
                  </div>
                  <div class="col-8">
                    <div class="icheck-primary">
                    <input type="checkbox" id="show-password">
                    <label for="show-password">
                      Show Password
                    </label>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" name="UpdatePassword"class="form-control btn btn-success">Ganti Password</button>
                </div>
                <!-- /.card-footer -->
              </form>
            </div>
            </div>
        </div>
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- End Section -->
</div>
<script>
  // Show Password
  document.getElementById("show-password").addEventListener("change", function() {
    var passwordInputs = document.querySelectorAll("input[type='password']");
    passwordInputs.forEach(function(input) {
      input.type = this.checked ? "text" : "password";
    }, this);
  });
  
</script>
<script>
  document.addEventListener("DOMContentLoaded", function() {
    var form = document.querySelector("form");
    var passNewInput = document.getElementById("pasnew");
    var konPassNewInput = document.getElementById("konpasnew");
    var submitButton = document.querySelector("button[type='submit']");

    passNewInput.addEventListener("input", function() {
      validatePasswords();
    });

    konPassNewInput.addEventListener("input", function() {
      validatePasswords();
    });

    form.addEventListener("submit", function(event) {
      if (!validatePasswords()) {
        event.preventDefault(); // Prevent form submission if passwords don't match
      }
    });

    function validatePasswords() {
      var passNew = passNewInput.value;
      var konPassNew = konPassNewInput.value;

      if (passNew !== konPassNew) {
        document.getElementById("password-match-warning").style.display = "block";
        submitButton.disabled = false;
        return false;
      } else {
        document.getElementById("password-match-warning").style.display = "none";
        submitButton.disabled = false;
        return true;
      }
    }
  });
</script>

