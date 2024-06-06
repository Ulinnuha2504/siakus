<script src="dist/js/sweater.js"></script>
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
require "koneksi.php";
session_start(); // Memulai session

// Cek apakah user sudah login
if(!isset($_SESSION['username'])) {
    // Jika belum login, redirect ke halaman login
    header("Location: login.php");
    exit();
}

// LOGOUT
if (isset($_POST['Logout'])) {
    // Hapus semua variabel sesi
    $_SESSION = array();
    // Hancurkan sesi
    session_destroy();
    // Alihkan kembali ke halaman login atau halaman lain yang sesuai
    echo '<script src="dist/js/sweater.js"></script>';
    echo '<script>
            document.addEventListener("DOMContentLoaded", function() {
                Swal.fire({
                    position: "top-center",
                    icon: "success",
                    title: "Anda Berhasil Keluar",
                    showConfirmButton: true,
                    timer: 2000
                }).then((result) => {
                    // Redirect setelah notifikasi ditutup
                    window.location.href = "login.php";
                });
            });
        </script>';
    exit;
}
// Tambah Pengguna
if (isset($_POST['submitAddPengguna'])) {
    $nm = trim(htmlspecialchars($_POST['nm']));
    $em = trim(htmlspecialchars($_POST['em']));
    $us = trim(htmlspecialchars($_POST['us']));
    $lv = trim(htmlspecialchars($_POST['lv']));
    $pj = trim(htmlspecialchars($_POST['pj']));
    $st = "0";
    $pw = '12345678';
    $pw = md5($pw);
    // Proses Simpan Data
    $sql = $kon->query("INSERT INTO pengguna (pg_pj,pg_nama,pg_kontak,username,password,pg_level,pg_status) VALUES ('$pj','$nm','$em','$us','$pw','$lv','$st')");
    if (!$sql) {
        $_SESSION['pesan'] = 'Gagal menyimpan pengguna.';
        echo "<script>window.location.href = 'index.php?page=datapengguna';</script>";
        exit;
    } else {
        $_SESSION['pesan'] = 'Berhasil menyimpan pengguna.';
        echo "<script>window.location.href = 'index.php?page=datapengguna';</script>";
        exit;
    }
    
}
// Edit Pengguna - Admin
if (isset($_POST['submitEditPengguna'])) {
    $nm = trim(htmlspecialchars($_POST['nm']));
    $kt = trim(htmlspecialchars($_POST['kt']));
    $id = trim(htmlspecialchars($_POST['id']));
    $pj = trim(htmlspecialchars($_POST['pj']));
    $lv = trim(htmlspecialchars($_POST['lv']));

    // echo $nm.$kt.$id.$lv;

    // Proses Simpan
    $sql = $kon->query("UPDATE pengguna SET pg_nama = '$nm',
                                            pg_level = '$lv',
                                            pg_pj = '$pj',
                                            pg_kontak = '$kt'
                        WHERE pg_id = '$id'");
    if (!$sql) {
        $_SESSION['pesan'] = 'Gagal menyimpan pengguna.';
        echo "<script>window.location.href = 'index.php?page=datapengguna';</script>";
        exit;
    } else {
        $_SESSION['pesan'] = 'Berhasil menyimpan pengguna.';
        echo "<script>window.location.href = 'index.php?page=datapengguna';</script>";
        exit;
    }
}
if (isset($_POST['AktifkanAkun'])) {
    $id = trim(htmlspecialchars($_POST['id']));
    $sql =$kon->query("UPDATE pengguna SET pg_status='1' WHERE pg_id='$id'");
    echo "<script>window.location.href = 'index.php?page=datapengguna';</script>";
}
if (isset($_POST['MatikanAkun'])) {
    $id = trim(htmlspecialchars($_POST['id']));
    $sql =$kon->query("UPDATE pengguna SET pg_status='0' WHERE pg_id='$id'");
    echo "<script>window.location.href = 'index.php?page=datapengguna';</script>";
}
// Edit Pengguna Personal
if (isset($_POST['submitUpdateProfile'])) {
    $nm = trim(htmlspecialchars($_POST['nm']));
    $kt = trim(htmlspecialchars($_POST['kt']));
    $id = trim(htmlspecialchars($_POST['id']));
    $us = trim(htmlspecialchars($_POST['us']));
    $fl = $_FILES['fl']['name'];
    // Mendapatkan ekstensi file yang diunggah
    $ext = pathinfo($fl, PATHINFO_EXTENSION);
    // Menyusun nama file yang unik berdasarkan $id dan ekstensi file
    $newFileName = $us.'.'. $ext;
    // echo $nm.'-'.$kt.'-'.$newFileName.'-'.$id;
    // Direktory Penyimpanan
    $uploadDir = 'dist/img/';
    // Simpan Gambar
    $uploadPath = $uploadDir . $newFileName;
    // Memindahkan file yang diunggah ke lokasi yang ditentukan
    move_uploaded_file($_FILES["fl"]["tmp_name"], $uploadPath);
    // Proses Simpan
    $sql = $kon->query("UPDATE pengguna SET pg_nama = '$nm',
                                            pg_kontak = '$kt'
                        WHERE pg_id = '$id'");
    // if (!$sql) {
    //     $_SESSION['pesan'] = 'Gagal menyimpan pengguna.';
    //     echo "<script>window.location.href = 'index.php?page=profile';</script>";
    //     exit;
    // } else {
    //     $_SESSION['pesan'] = 'Berhasil menyimpan pengguna.';
    //     echo "<script>window.location.href = 'index.php?page=profile';</script>";
    //     exit;
    // }
    echo '<script>
            document.addEventListener("DOMContentLoaded", function() {
                Swal.fire({
                    position: "top-center",
                    icon: "success",
                    title: "Pembaruan Di Simpan",
                    showConfirmButton: true,
                    timer: 2000
                }).then((result) => {
                    // Redirect setelah notifikasi ditutup
                    window.location.href = "index.php?page=profile";
                });
            });
        </script>';

    
}
if (isset($_POST['UpdatePassword'])) {
    $id = trim(htmlspecialchars($_POST['id']));
    $po = trim(htmlspecialchars($_POST['pasold']));
    $pn = trim(htmlspecialchars($_POST['pasnew']));
    // echo $id.'-'.$po.$pn;
    $pasold = md5($po);
    $pasnew = md5($pn);
    // Memeriksa Password Lama
    $sql = $kon->query("SELECT * FROM pengguna WHERE pg_id='$id' and password='$pasold'");
    $cek = mysqli_num_rows($sql);
    if($cek == 0) {
        // $_SESSION['pesan'] = 'Password Lama Salah.';
        echo '<script src="dist/js/sweater.js"></script>';
        echo '<script>
                document.addEventListener("DOMContentLoaded", function() {
                    Swal.fire({
                        position: "top-center",
                        icon: "error",
                        title: "Password Lama Salah",
                        text: "Pastikan Password Lama Sesuai",
                        showConfirmButton: true,
                        timer: 2000
                    }).then((result) => {
                        // Redirect setelah notifikasi ditutup
                        window.location.href = "index.php?page=profile";
                    });
                });
            </script>';
        exit;
    }else{
        $sql = $kon->query("UPDATE pengguna set password='$pasnew' WHERE pg_id='$id'");
        // $_SESSION['pesan'] = 'Password Berhasil Diganti.';
        echo '<script>
        document.addEventListener("DOMContentLoaded", function() {
            Swal.fire({
                position: "top-center",
                icon: "success",
                title: "Password Berhasil Diperbaharui",
                text: "Silahkan Login Kembali",
                showConfirmButton: true,
                timer: 2000
            }).then((result) => {
                // Redirect setelah notifikasi ditutup
                window.location.href = "login.php";
            });
        });
        </script>';
        // echo "<script>window.location.href = 'index.php?page=profile';</script>";
        exit;
    }


    
}
// Reset Password
if (isset($_POST['submitResPassword'])) {
    $id = trim(htmlspecialchars($_POST['id']));
    $pw = '12345678';
    $pw = md5($pw);
    $sql = $kon->query("UPDATE pengguna set password='$pw' WHERE pg_id='$id'");
    if (!$sql) {
        $_SESSION['pesan'] = 'Gagal Reset Password';
        echo "<script>window.location.href = 'index.php?page=datapengguna';</script>";
        exit;
    } else {
        $_SESSION['pesan'] = 'Berhasil Mereset Password';
        echo "<script>window.location.href = 'index.php?page=datapengguna';</script>";
        exit;
    }
}
// Hapus Pengguna
if(isset($_POST['submitHapusData'])){
    $id = trim(htmlspecialchars($_POST['id']));
    $sql = $kon->query("DELETE FROM pengguna WHERE pg_id='$id'");
    if (!$sql) {
        $_SESSION['pesan'] = 'Gagal Hapus Pengguna';
        echo "<script>window.location.href = 'index.php?page=datapengguna';</script>";
        exit;
    } else {
        $_SESSION['pesan'] = 'Berhasil Menghapus Data';
        echo "<script>window.location.href = 'index.php?page=datapengguna';</script>";
        exit;
    }
}
// KELAS
    // Tambah
    if (isset($_POST['submitAddKelas'])) {
        $nm = trim(htmlspecialchars($_POST['nm']));
        $kt = trim(htmlspecialchars($_POST['kt']));
        // echo $nm.$kt;
        $sql = $kon->query("INSERT INTO kelas values(NULL,'$nm','$kt')");
        if (!$sql) {
            $_SESSION['pesan'] = 'Gagal menyimpan Kelas.';
            echo "<script>window.location.href = 'index.php?page=kelas';</script>";
            exit;
        } else {
            $_SESSION['pesan'] = 'Berhasil menyimpan Kelas.';
            echo "<script>window.location.href = 'index.php?page=kelas';</script>";
            exit;
        }
    }
    // Edit
    if(isset($_POST['EditKelas'])){
        $id = trim(htmlspecialchars($_POST['id']));
        $nm = trim(htmlspecialchars($_POST['nm']));
        $kt = trim(htmlspecialchars($_POST['kt']));
        // echo $nm.$kt.$id;
        $sql =$kon->query("UPDATE kelas SET kl_nama='$nm',kl_ket='$kt' WHERE kl_id='$id'");
        echo "<script>window.location.href = 'index.php?page=kelas';</script>";
        
    }
    // Hapus
    if(isset($_POST['HapusKelas'])){
        $id = trim(htmlspecialchars($_POST['id']));
        $sql = $kon->query("DELETE FROM kelas WHERE kl_id='$id'");
        if (!$sql) {
            $_SESSION['pesan'] = 'Gagal Hapus Kelas';
            echo "<script>window.location.href = 'index.php?page=kelas';</script>";
            exit;
        } else {
            $_SESSION['pesan'] = 'Berhasil Menghapus Kelas';
            echo "<script>window.location.href = 'index.php?page=kelas';</script>";
            exit;
        }
    }
// Siswa
    // TAMBAH SISWA
    if(isset($_POST['TambahSiswa'])){
        $kd = trim(htmlspecialchars($_POST['kd']));
        $nm = trim(htmlspecialchars($_POST['nm']));
        $jk = trim(htmlspecialchars($_POST['jk']));
        $al = trim(htmlspecialchars($_POST['al']));
        $kt = trim(htmlspecialchars($_POST['kt']));
        $kl = trim(htmlspecialchars($_POST['kl']));
        
        // echo $nm.$kt.$kd.$jk.$al.$kl;
        $sql=$kon->query("INSERT INTO siswa (sw_nama,sw_jk,sw_alamat,sw_kontak,kl_id,sw_kd)
                                      VALUES('$nm','$jk','$al','$kt','$kl','$kd')") ;   
        echo "<script>window.location.href = 'index.php?page=siswa';</script>";
    }
    // EDIT SISWA
    if(isset($_POST['EditSiswa'])){
        $kd = trim(htmlspecialchars($_POST['kd']));
        $nm = trim(htmlspecialchars($_POST['nm']));
        $jk = trim(htmlspecialchars($_POST['jk']));
        $al = trim(htmlspecialchars($_POST['al']));
        $kt = trim(htmlspecialchars($_POST['kt']));
        $kl = trim(htmlspecialchars($_POST['kl']));
        
        // echo $nm.$kt.$kd.$jk.$al.$kl;
        $sql =$kon->query("UPDATE siswa SET sw_nama  ='$nm',
                                            sw_jk    ='$jk',
                                            sw_alamat='$al',
                                            sw_kontak='$kt',
                                            kl_id    ='$kl'
                                      WHERE sw_kd    ='$kd'");
        echo "<script>window.location.href = 'index.php?page=siswa';</script>";
        
    }
    // HAPUS SISWA --Empty--
// KARYAWAN
    // TAMBAH
    if(isset($_POST['TambahKaryawan'])){
        $kd = trim(htmlspecialchars($_POST['kd']));
        $nm = trim(htmlspecialchars($_POST['nm']));
        $jk = trim(htmlspecialchars($_POST['jk']));
        $al = trim(htmlspecialchars($_POST['al']));
        $kt = trim(htmlspecialchars($_POST['kt']));
        $jb = trim(htmlspecialchars($_POST['jb']));
        
        // echo $nm.$kt.$kd.$jk.$al.$kl;
        $sql=$kon->query("INSERT INTO karyawan (kyw_nama,kyw_jk,kyw_alamat,kyw_kontak,kyw_jabatan,kyw_kd)
                                      VALUES('$nm','$jk','$al','$kt','$jb','$kd')") ;   
        echo "<script>window.location.href = 'index.php?page=karyawan';</script>";
    }
    // EDIT
    if(isset($_POST['EditKaryawan'])){
        $kd = trim(htmlspecialchars($_POST['kd']));
        $nm = trim(htmlspecialchars($_POST['nm']));
        $jk = trim(htmlspecialchars($_POST['jk']));
        $al = trim(htmlspecialchars($_POST['al']));
        $kt = trim(htmlspecialchars($_POST['kt']));
        $jb = trim(htmlspecialchars($_POST['jb']));
        
        // echo $nm.$kt.$kd.$jk.$al.$kl;
        $sql =$kon->query("UPDATE karyawan SET  kyw_nama  ='$nm',
                                                kyw_jk    ='$jk',
                                                kyw_alamat='$al',
                                                kyw_kontak='$kt',
                                                kyw_jabatan    ='$jb'
                                        WHERE   kyw_kd    ='$kd'");
        echo "<script>window.location.href = 'index.php?page=karyawan';</script>";
        
    }
    // HAPUS

// PENERIMAAN
    // KATEGORI PENERIMAAN
        // TAMBAH
        if(isset($_POST['TambahKtpnm'])){
            $nm = trim(htmlspecialchars($_POST['nm']));
            $kt = trim(htmlspecialchars($_POST['kt']));
            $nl = trim(htmlspecialchars($_POST['nl']));
            // echo $nm.$kt.$kd.$jk.$al.$kl;
            $sql=$kon->query("INSERT INTO kategori_penerimaan VALUES(NULL,'$nm','$nl','$kt')") ;  
            echo '<script>
                document.addEventListener("DOMContentLoaded", function() {
                    Swal.fire({
                        position: "top-center",
                        icon: "success",
                        title: "Data Baru Berhasil Di Simpan",
                        showConfirmButton: true,
                        timer: 2000
                    }).then((result) => {
                        // Redirect setelah notifikasi ditutup
                        window.location.href = "index.php?page=kt-penerimaan";
                    });
                });
                </script>'; 
            // echo "<script>window.location.href = 'index.php?page=kt-penerimaan';</script>";
        }
        // EDIT
        if(isset($_POST['EditKtpn'])){
            $id = trim(htmlspecialchars($_POST['id']));
            $nm = trim(htmlspecialchars($_POST['nm']));
            $kt = trim(htmlspecialchars($_POST['kt']));
            $nl = trim(htmlspecialchars($_POST['nl']));
            // echo $nm.$kt.$kd.$jk.$al.$kl;
            $sql=$kon->query("UPDATE kategori_penerimaan SET kpn_nama   = '$nm',
                                                             kpn_ket    = '$kt',
                                                             kpn_nominal= '$nl'
                                                       WHERE kpn_id     = '$id'") ;   
            echo '<script>
            document.addEventListener("DOMContentLoaded", function() {
                Swal.fire({
                    position: "top-center",
                    icon: "success",
                    title: "Data Berhasil Di Perbarui",
                    showConfirmButton: true,
                    timer: 2000
                }).then((result) => {
                    // Redirect setelah notifikasi ditutup
                    window.location.href = "index.php?page=kt-penerimaan";
                });
            });
            </script>'; 
        }
        // HAPUS
        if(isset($_POST['HapusKpn'])){
            $id = trim(htmlspecialchars($_POST['id']));
            $ck = $kon->query("SELECT * FROM penerimaan WHERE kpn_id='$id'");
            $cd = mysqli_num_rows($ck);
            if ($cd > 0) {
                echo '<script>
                document.addEventListener("DOMContentLoaded", function() {
                    Swal.fire({
                        position: "top-center",
                        icon: "warning",
                        title: "Data Tidak Boleh Di Hapus",
                        showConfirmButton: true,
                        timer: 2000
                    }).then((result) => {
                        // Redirect setelah notifikasi ditutup
                        window.location.href = "index.php?page=kt-penerimaan";
                    });
                });
                </script>';
            } else {
                $swl= $kon->query("DELETE FROM kategori_penerimaan WHERE kpn_id='$id'");
                echo '<script>
                document.addEventListener("DOMContentLoaded", function() {
                    Swal.fire({
                        position: "top-center",
                        icon: "success",
                        title: "Data Berhasil Di Hapus",
                        showConfirmButton: true,
                        timer: 2000
                    }).then((result) => {
                        // Redirect setelah notifikasi ditutup
                        window.location.href = "index.php?page=kt-penerimaan";
                    });
                });
                </script>';
            }
        }
    // TRANSAKSI
        if(isset($_POST['SimpanSPN'])){
            $swl = $kon->query("SELECT MAX(pnm_kd) as terbesar FROM penerimaan");
            $sq  = mysqli_fetch_array($swl);
            $tb  = $sq['terbesar'];
            $ur  =(int) substr($tb,7,5);
            $ur++;
            $hrf ="PNM2024";
            $kdk =sprintf("%05s",$ur);
            $kd  =$hrf.$kdk;

            $nm = mysqli_real_escape_string($kon, $_POST['nm']);
            $tg = mysqli_real_escape_string($kon, $_POST['tg']);
            $kt = mysqli_real_escape_string($kon, $_POST['kt']);
            $nl = mysqli_real_escape_string($kon, $_POST['nl']);
            $pg = mysqli_real_escape_string($kon, $_POST['pg']);
            $jn = mysqli_real_escape_string($kon, $_POST['jn']);
  
            // Memastikan tidak ada nilai kosong yang masuk ke dalam database
            if ($jn == 'Pembayaran') {
                echo'Pembayaran ';
                $sw = mysqli_real_escape_string($kon, $_POST['sw']);
                $jn = mysqli_real_escape_string($kon, $_POST['jn']);
                $kl = mysqli_real_escape_string($kon, $_POST['kl']);
                $kp = mysqli_real_escape_string($kon, $_POST['kp']);
                // CEK SUDAH BAYAR
                    $qcek = $kon->query("SELECT*FROM detailpenerimaan join penerimaan on detailpenerimaan.pnm_kd=penerimaan.pnm_kd WHERE sw_kd='$sw'AND kpn_id='$kp'");
                    $cekdata  = mysqli_num_rows($qcek);
                if ($cekdata==0) {
                    // MENYIMPAN KE PENERIMAAN
                        $sql = $kon->query("INSERT INTO penerimaan (pnm_kd, pnm_nama, pnm_tanggal, pnm_ket, pnm_nominal, kpn_id, pg_id, pnm_jenis)
                                    VALUES ('$kd', '$nm', '$tg', '$kt', '$nl', '$kp', '$pg','$jn')");
                    // Detail
                        $sq2 = $kon->query("INSERT INTO detailpenerimaan(pnm_kd,sw_kd,kl_id) values('$kd','$sw','$kl')");
                    echo '<script>
                            document.addEventListener("DOMContentLoaded", function() {
                                Swal.fire({
                                    position: "top-center",
                                    icon: "success",
                                    title: "Data Berhasil Disimpan",
                                    showConfirmButton: true,
                                    timer: 2000
                                }).then((result) => {
                                    // Redirect setelah notifikasi ditutup
                                    window.location.href = "index.php?page=penerimaan";
                                });
                            });
                        </script>';
                } else {
                    echo '<script>
                            document.addEventListener("DOMContentLoaded", function() {
                                Swal.fire({
                                    position: "top-center",
                                    icon: "warning",
                                    title: "Siswa Sudah Membayar",
                                    showConfirmButton: true,
                                    timer: 2000
                                }).then((result) => {
                                    // Redirect setelah notifikasi ditutup
                                    window.location.href = "index.php?page=penerimaan";
                                });
                            });
                        </script>';
                }
            } else {
                $sql = $kon->query("INSERT INTO penerimaan (pnm_kd, pnm_nama, pnm_tanggal, pnm_ket, pnm_nominal, pnm_jenis, pg_id)
                                    VALUES ('$kd', '$nm', '$tg', '$kt', '$nl','$jn','$pg')");
                echo '<script>
                document.addEventListener("DOMContentLoaded", function() {
                    Swal.fire({
                        position: "top-center",
                        icon: "success",
                        title: "Data Berhasil Disimpan",
                        showConfirmButton: true,
                        timer: 2000
                    }).then((result) => {
                        // Redirect setelah notifikasi ditutup
                        window.location.href = "index.php?page=penerimaan";
                    });
                });
                </script>';
            }
            // Redirect ke halaman index.php?page=penerimaan setelah menyimpan data
            
        }
// PENGAJUAN
    // TAMBAH
    if (isset($_POST['AjuPengajuan'])) {
        $sql = $kon->query("SELECT MAX(pgj_kd) as terbesar FROM pengajuan");
        $sq  = mysqli_fetch_array($sql);
        $tb  = $sq['terbesar'];
        $ur  =(int) substr($tb,7,3);
        $ur++;
        $hrf ="PGJ2024";
        $kdk =sprintf("%03s",$ur);
        $kd  =$hrf.$kdk;

        $id = trim(htmlspecialchars($_POST['id']));
        $nm = trim(htmlspecialchars($_POST['nm']));
        $tg = trim(htmlspecialchars($_POST['tg']));
        $kt = trim(htmlspecialchars($_POST['kt']));
        $nl = trim(htmlspecialchars($_POST['nl']));
        $ktr = trim(htmlspecialchars($_POST['ktr']));
        // AMBIL PJ
        $qpj= $kon->query("SELECT pg_pj FROM pengguna WHERE pg_id='$id'");
        $dpj = mysqli_fetch_assoc($qpj);
        $pj  = $dpj['pg_pj'];
        $fl = $_FILES['fl']['name'];
        // echo $kd.'Tolak';
        if (!empty($fl)) {
            // Mendapatkan ekstensi file yang diunggah
            $ext = pathinfo($fl, PATHINFO_EXTENSION);
            // Menyusun nama file yang unik berdasarkan $id dan ekstensi file
            $newFileName = $kd.'.'. $ext;
            // echo $nm.'-'.$kt.'-'.$newFileName.'-'.$id;
            // Direktory Penyimpanan
            $uploadDir = 'dist/dok/';
            // Simpan Gambar
            $uploadPath = $uploadDir . $newFileName;
            // Memindahkan file yang diunggah ke lokasi yang ditentukan
            move_uploaded_file($_FILES["fl"]["tmp_name"], $uploadPath);
            // Proses Simpan
            $sWl = $kon->query("INSERT INTO pengajuan (pgj_kd,pgj_nama,pgj_tanggal,pgj_nominal,pgj_ket,pgj_file,pgj_pj,pg_id,pgj_status,kpr_id)
                                VALUES                 ('$kd','$nm','$tg','$nl','$kt','$newFileName','$pj','$id','0','$ktr')");
        } else {
            $sWl = $kon->query("INSERT INTO pengajuan (pgj_kd,pgj_nama,pgj_tanggal,pgj_nominal,pgj_ket,pgj_pj,pg_id,pgj_status,kpr_id)
                                VALUES                 ('$kd','$nm','$tg','$nl','$kt','$pj','$id','0','$ktr')");
        }
        
        echo "<script>window.location.href = 'index.php?page=pengajuan';</script>";
    }
    // UPDATE
    if (isset($_POST['EditPengajuan'])) {
        $nm = trim(htmlspecialchars($_POST['nm']));
        $tg = trim(htmlspecialchars($_POST['tg']));
        $kt = trim(htmlspecialchars($_POST['kt']));
        $id = trim(htmlspecialchars($_POST['id']));
        $nl = trim(htmlspecialchars($_POST['nl']));
        $fl = $_FILES['fl']['name'];
        
        // echo $id.'Tolak';
        
        $sql = $kon->query("UPDATE pengajuan set    pgj_nama    ='$nm',
                                                    pgj_tanggal ='$tg',
                                                    pgj_nominal ='$nl',
                                                    pgj_ket     ='$kt'
                                            WHERE   pgj_kd      ='$id'");

        echo "<script>window.location.href = 'index.php?page=pengajuan';</script>";
    }
    if (isset($_POST['TolakPengajuan'])) {
        $id = trim(htmlspecialchars($_POST['id']));
        // echo $id.'Tolak';
        $sql = $kon->query("UPDATE pengajuan set pgj_status='3' where pgj_kd='$id'");
        echo "<script>window.location.href = 'index.php?page=pengajuan';</script>";
    }if (isset($_POST['TeruskanPengajuan'])) {
        $id = trim(htmlspecialchars($_POST['id']));
        // echo $id.'Tolak';
        $sql = $kon->query("UPDATE pengajuan set pgj_status='1' where pgj_kd='$id'");
        echo "<script>window.location.href = 'index.php?page=pengajuan';</script>";
    }if (isset($_POST['SetujuiPengajuan'])) {
        $id = trim(htmlspecialchars($_POST['id']));
        // echo $id.'Tolak';
        $sql = $kon->query("UPDATE pengajuan set pgj_status='2' where pgj_kd='$id'");
        echo "<script>window.location.href = 'index.php?page=pengajuan';</script>";
    }
// PENGELUARAN
    // KATEGORI PENGELUARAN
        // TAMBAH
        if(isset($_POST['TambahKpr'])){
            $nm = trim(htmlspecialchars($_POST['nm']));
            $kt = trim(htmlspecialchars($_POST['kt']));
            echo $nm.$kt;
            $sql=$kon->query("INSERT INTO kategori_pengeluaran (kpr_id,kpr_nama, kpr_ket) VALUES (NULL,'$nm','$kt')") ;   
            echo '<script>
            document.addEventListener("DOMContentLoaded", function() {
                Swal.fire({
                    position: "top-center",
                    icon: "success",
                    title: "Data Baru Berhasil Di Tambahkan",
                    showConfirmButton: true,
                    timer: 2000
                }).then((result) => {
                    // Redirect setelah notifikasi ditutup
                    window.location.href = "index.php?page=kt-pengeluaran";
                });
            });
            </script>'; 
        }
        // EDIT
        if(isset($_POST['EditKpr'])){
            $id = trim(htmlspecialchars($_POST['id']));
            $nm = trim(htmlspecialchars($_POST['nm']));
            $kt = trim(htmlspecialchars($_POST['kt']));
            // echo $nm.$kt.$kd.$jk.$al.$kl;
            $sql=$kon->query("UPDATE kategori_pengeluaran SET kpr_nama   = '$nm',
                                                            kpr_ket    = '$kt'
                                                    WHERE kpr_id     = '$id'") ;   
            echo '<script>
            document.addEventListener("DOMContentLoaded", function() {
                Swal.fire({
                    position: "top-center",
                    icon: "success",
                    title: "Data Berhasil Diperbaharui ",
                    showConfirmButton: true,
                    timer: 2000
                }).then((result) => {
                    // Redirect setelah notifikasi ditutup
                    window.location.href = "index.php?page=kt-pengeluaran";
                });
            });
            </script>'; 
            // echo "<script>window.location.href = 'index.php?page=kt-pengeluaran';</script>";
        }
        // HAPUS
        if(isset($_POST['HapusKpr'])){
            $id = trim(htmlspecialchars($_POST['id']));
            // CEK DATA RELASI
            $ck = $kon->query("SELECT * FROM pengeluaran WHERE kpr_id='$id'");
            $cd = mysqli_num_rows($ck);
            if ($cd > 0) {
                echo '<script>
                document.addEventListener("DOMContentLoaded", function() {
                    Swal.fire({
                        position: "top-center",
                        icon: "warning",
                        title: "Data Tidak Boleh Di Hapus",
                        showConfirmButton: true,
                        timer: 2000
                    }).then((result) => {
                        // Redirect setelah notifikasi ditutup
                        window.location.href = "index.php?page=kt-pengeluaran";
                    });
                });
                </script>';
            } else {
                 $swl= $kon->query("DELETE FROM kategori_pengeluaran WHERE kpr_id='$id'");
                echo '<script>
                document.addEventListener("DOMContentLoaded", function() {
                    Swal.fire({
                        position: "top-center",
                        icon: "success",
                        title: "Data Berhasil Di Hapus",
                        showConfirmButton: true,
                        timer: 2000
                    }).then((result) => {
                        // Redirect setelah notifikasi ditutup
                        window.location.href = "index.php?page=kt-pengeluaran";
                    });
                });
                </script>';
            }
        }
    //TRANSAKSI
    if (isset($_POST['CairkanDana'])) {
        $swl = $kon->query("SELECT MAX(pgr_kd) as terbesar FROM pengeluaran");
        $sq  = mysqli_fetch_array($swl);
        $tb  = $sq['terbesar'];
        $ur  =(int) substr($tb,7,5);
        $ur++;
        $hrf ="PGR2024";
        $kdk =sprintf("%03s",$ur);
        $kd  =$hrf.$kdk;
        $tg = trim(htmlspecialchars($_POST['tanggalcair']));
        $id = trim(htmlspecialchars($_POST['id']));
        $us = trim(htmlspecialchars($_POST['pg']));

        $qdata = mysqli_query($kon,"SELECT*FROM pengajuan WHERE pgj_kd='$id'");
        while ($data=mysqli_fetch_array($qdata)) {
            $pg = $data['pgj_kd'];
            $nl = $data['pgj_nominal'];
            $kt = $data['pgj_nama'];
        }
        // Menguji data yang diterima
        // echo "Username: " . $us . "<br>";
        // echo "Kode: " . $kd . "<br>";
        // echo "Pengajuan: " . $pg . "<br>";
        // echo "Tanggal: " . $tg . "<br>";
        // echo "Nominal: " . $nl . "<br>";
        // echo "Kategori: " . $kp . "<br>";
        // echo "Status: " . $st . "<br>";
        // echo "Nama Karyawan: " . $ky . "<br>";
        // echo "Nama Siswa: " . $sw . "<br>";
        // echo "Keterangan: " . $kt . "<br>";
        
        // #1 MENYIMPAN TRANSAKSI PENGELUARAN
            $sql1 = $kon->query("INSERT INTO pengeluaran (pgr_kd,pgr_tanggal,pgr_ket,pgr_nominal,pgj_kd,pg_id) VALUES
                                                        ('$kd','$tg','$kt','$nl','$pg','$us')");
        // #3 UPDATE STATUS PENGAJUAN
            $sql3 = $kon -> query("UPDATE pengajuan SET pgj_status='4' WHERE pgj_kd='$pg'");
            echo '<script src="dist/js/sweater.js"></script>';
            echo '<script>
                    document.addEventListener("DOMContentLoaded", function() {
                        Swal.fire({
                            position: "top-center",
                            icon: "success",
                            title: "Data Berhasil Disimpan",
                            showConfirmButton: true,
                            timer: 2000
                        }).then((result) => {
                            // Redirect setelah notifikasi ditutup
                            window.location.href = "index.php?page=pengeluaran";
                        });
                    });
                </script>';


    }

// LAPORAN

?>
