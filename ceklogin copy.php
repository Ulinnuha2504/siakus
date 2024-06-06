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
$qdata    = mysqli_query($kon,"SELECT * FROM pengguna where username='$username' and password='$password' and level='$masuk'");
$data    = mysqli_fetch_array($qdata);
$cekdata  = mysqli_num_rows($qdata);
// jika salah maka login kembali
if($cekdata == 0) {
    header('location:login.php?pesan=1');
    exit; // Pastikan keluar dari skrip setelah pengalihan
}
// jika benar maka masuk sebagai hak akses ADMIN / PIMPINAN / STAFF / PENGAJU
else {
    // Menyimpan data sementara pengguna yang nantinya akan digunakan sebagai variabel pemanggil di dalam dashboard
    $_SESSION["nama"] = $data['nama'];
    $_SESSION["level"] = $data['level'];
    $_SESSION["username"] = $data['username'];

    if($data['level'] == 'Administrator') {
        header('location:index.php?page=uji');
        // echo $data['nama'].'-'.$data['level'].'-'.$data['username'];
        // echo $_SESSION['nama'].'-'.$_SESSION['level'].'-'.$_SESSION['username'];
        exit; // Pastikan keluar dari skrip setelah pengalihan
    }
    else {
        header('location:pimpinan/');
        exit; // Pastikan keluar dari skrip setelah pengalihan
    }
}

