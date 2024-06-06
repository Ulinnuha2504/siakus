<style>
    body {
          background-image: url("dist/img/background.jpg");
          background-repeat: no-repeat;
          background-size: 100%;
          /* background-color: #cccccc; */
          }
  </style>
  <body>
    
  </body>
<?php
// Memanggil Koneksi
session_start();
include('koneksi.php');

// Mengambil Data dari Form
$username = mysqli_real_escape_string($kon,$_POST['username']);
$password = mysqli_real_escape_string($kon,$_POST['password']);
$masuk    = mysqli_real_escape_string($kon,$_POST['masuk']);
// Merubah Passwor menjadi md5
$password = md5($password);


// cek username ada di database atau tidak
$qdata    = mysqli_query($kon,"SELECT * FROM pengguna where username='$username' and password='$password' and pg_level='$masuk'");
$data    = mysqli_fetch_array($qdata);
$cekdata  = mysqli_num_rows($qdata);
// jika salah maka login kembali
if($cekdata == 0) {
    // echo $password.'-'.$masuk.'-'.$username;
    echo '<script src="dist/js/sweater.js"></script>';
    echo '<script>
            document.addEventListener("DOMContentLoaded", function() {
                Swal.fire({
                    position: "top-center",
                    icon: "error",
                    title: "Username atau Password Salah",
                    text: "Silahkan Ulangi Lagi!",
                    showConfirmButton: true,
                    timer: 2000
                }).then((result) => {
                    // Redirect setelah notifikasi ditutup
                    window.location.href = "login.php";
                });
            });
        </script>';
    // header('location:login.php?pesan=1');
    exit; // Pastikan keluar dari skrip setelah pengalihan
}
// jika benar maka masuk sebagai hak akses ADMIN / PIMPINAN / STAFF / PENGAJU
else {
    if ($data['pg_status']=='0') {
        echo '<script src="dist/js/sweater.js"></script>';
        echo '<script>
                document.addEventListener("DOMContentLoaded", function() {
                    Swal.fire({
                        position: "top-center",
                        icon: "warning",
                        title: "Mohon maaf Status Akun Tidak Aktif",
                        text: "Silahkan Menghubungi Admin",
                        showConfirmButton: true,
                        timer: 3000
                    }).then((result) => {
                        // Redirect setelah notifikasi ditutup
                        window.location.href = "login.php";
                    });
                });
            </script>';
        // header('location:login.php?pesan=1');
        exit; // Pastikan keluar dari skrip setelah pengalihan
    } else {
    // Menyimpan data sementara pengguna yang nantinya akan digunakan sebagai variabel pemanggil di dalam dashboard
    $_SESSION["nama"] = $data['pg_nama'];
    $_SESSION["level"] = $data['pg_level'];
    $_SESSION["username"] = $data['username'];
    $_SESSION["pesan"] = 'SELAMAT DATANG DI SIAKUS';

    if($data['pg_level'] == 'Administrator') {
        echo '<script src="dist/js/sweater.js"></script>';
        echo '<script>
                document.addEventListener("DOMContentLoaded", function() {
                    Swal.fire({
                        position: "top-center",
                        icon: "success",
                        title: "Berhasil Masuk",
                        showConfirmButton: true,
                        timer: 2000
                    }).then((result) => {
                        // Redirect setelah notifikasi ditutup
                        window.location.href = "index.php";
                    });
                });
            </script>';
        exit; // Pastikan keluar dari skrip setelah pengalihan
    }
    elseif ($data['pg_level'] == 'Kepala Sekolah') {
        echo '<script src="dist/js/sweater.js"></script>';
        echo '<script>
                document.addEventListener("DOMContentLoaded", function() {
                    Swal.fire({
                        position: "top-center",
                        icon: "success",
                        title: "Berhasil Masuk",
                        showConfirmButton: true,
                        timer: 2000
                    }).then((result) => {
                        // Redirect setelah notifikasi ditutup
                        window.location.href = "index.php";
                    });
                });
            </script>';
        exit; // Pastikan keluar dari skrip setelah pengalihan
        // header('location:index.php');
        
    }
    elseif ($data['pg_level'] == 'Keuangan') {
        echo '<script src="dist/js/sweater.js"></script>';
        echo '<script>
                document.addEventListener("DOMContentLoaded", function() {
                    Swal.fire({
                        position: "top-center",
                        icon: "success",
                        title: "Berhasil Masuk",
                        showConfirmButton: true,
                        timer: 2000
                    }).then((result) => {
                        // Redirect setelah notifikasi ditutup
                        window.location.href = "index.php";
                    });
                });
            </script>';
        exit; 
    }
    else {
        echo '<script src="dist/js/sweater.js"></script>';
        echo '<script>
                document.addEventListener("DOMContentLoaded", function() {
                    Swal.fire({
                        position: "top-center",
                        icon: "success",
                        title: "Berhasil Masuk",
                        showConfirmButton: true,
                        timer: 2000
                    }).then((result) => {
                        // Redirect setelah notifikasi ditutup
                        window.location.href = "index.php";
                    });
                });
            </script>';
        exit; // Pastikan keluar dari skrip setelah pengalihan
        // header('location:index.php');
        
    }
    // else {
    //     echo 'Gagal';
    //     exit; // Pastikan keluar dari skrip setelah pengalihan
    // }
}
}

