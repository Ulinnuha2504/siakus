<?php
session_start(); // Memulai session

// Cek apakah user sudah login
if(!isset($_SESSION['username'])) {
    // Jika belum login, redirect ke halaman login
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <!-- <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div> -->

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-success navbar-dark">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
      <form id="logoutForm" action="proses.php" method="post">
        <input type="hidden" id="Logout"name="Logout">
        <button type="button" onclick="showConfirmationAlert()" class="btn btn-danger" title="Logout">
          <i class="fas fa-power-off"></i> Log Out
        </button>
      </form>

      
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  
  <?php
      if ($_SESSION['level']== 'Pengaju') {
        if (!isset($_GET['page'])) {
          include 'pages/pengaju/home.php';
      }elseif ($_GET['page'] == 'profile' && file_exists('pages/pengaju/profile.php')) {
        include 'pages/pengaju/profile.php';
      }elseif ($_GET['page'] == 'pengajuan' && file_exists('pages/pengaju/pengajuan.php')) {
        include 'pages/pengaju/pengajuan.php';
      }else {
        // Penanganan kesalahan jika file yang diminta tidak ditemukan
        include 'pages/pengaju/404.php';
      }}
      elseif ($_SESSION['level']== 'Kepala Sekolah') {
        if (!isset($_GET['page'])) {
          include 'pages/kepsek/home.php';
      }elseif ($_GET['page'] == 'profile' && file_exists('pages/kepsek/profile.php')) {
        include 'pages/kepsek/profile.php';
      }elseif ($_GET['page'] == 'pengajuan' && file_exists('pages/kepsek/pengajuan.php')) {
        include 'pages/kepsek/pengajuan.php';
      }elseif ($_GET['page'] == 'laporan' && file_exists('pages/kepsek/laporan.php')) {
        include 'pages/kepsek/laporan.php';
      }else {
        // Penanganan kesalahan jika file yang diminta tidak ditemukan
        include 'pages/kepsek/404.php';
      }}
      else { if (!isset($_GET['page'])) {
          include 'pages/home.php';
      } elseif ($_GET['page'] == 'datapengguna' && file_exists('pages/pengguna.php')) {
          include 'pages/pengguna.php';
      } elseif ($_GET['page'] == 'penerimaan' && file_exists('pages/penerimaan.php')) {
          include 'pages/penerimaan.php';
      } elseif ($_GET['page'] == 'pengeluaran' && file_exists('pages/pengeluaran.php')) {
          include 'pages/pengeluaran.php';
      }elseif ($_GET['page'] == 'uji' && file_exists('pages/test.php')) {
        include 'pages/test.php';
      }elseif ($_GET['page'] == 'profile' && file_exists('pages/profile.php')) {
        include 'pages/profile.php';
      }elseif ($_GET['page'] == 'kelas' && file_exists('pages/kelas.php')) {
        include 'pages/kelas.php';
      }elseif ($_GET['page'] == 'siswa' && file_exists('pages/siswa.php')) {
        include 'pages/siswa.php';
      } elseif ($_GET['page'] == 'karyawan' && file_exists('pages/karyawan.php')) {
        include 'pages/karyawan.php';
      } elseif ($_GET['page'] == 'kt-penerimaan' && file_exists('pages/ktpnm.php')) {
        include 'pages/ktpnm.php';
      } elseif ($_GET['page'] == 'kt-pengeluaran' && file_exists('pages/ktprn.php')) {
        include 'pages/ktprn.php';
      }elseif ($_GET['page'] == 'pengajuan' && file_exists('pages/pengajuan.php')) {
        include 'pages/pengajuan.php';
      }elseif ($_GET['page'] == 'pembayaran-siswa' && file_exists('pages/pb-siswa.php')) {
        include 'pages/pb-siswa.php';
      }elseif ($_GET['page'] == 'pengeluaran-dana' && file_exists('pages/pg-dana.php')) {
        include 'pages/pg-dana.php';
      }elseif ($_GET['page'] == 'laporan' && file_exists('pages/laporan.php')) {
        include 'pages/laporan.php';
      }elseif ($_GET['page'] == 'mutasi' && file_exists('pages/mutasi.php')) {
        include 'pages/mutasi.php';
      }else {
          // Penanganan kesalahan jika file yang diminta tidak ditemukan
          include 'pages/404.php';
      }}
  ?>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2024 <a href="http://mauliannurzaidani.com">SIAKUS</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 1.0.0
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Select2 -->
<script src="plugins/select2/js/select2.full.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<!-- <script src="dist/js/demo.js"></script> -->
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>
<!-- DataTables  & Plugins -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="plugins/jszip/jszip.min.js"></script>
<script src="plugins/pdfmake/pdfmake.min.js"></script>
<script src="plugins/pdfmake/vfs_fonts.js"></script>
<script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- ALERT -->
<script src="dist/js/sweater.js"></script>

<script>
// Function to show the confirmation alert
function showConfirmationAlert() {
  Swal.fire({
    title: "Apakah Kamu Yakin?",
    text: "Kamu ingin keluar!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Iya, Saya ingin Keluar!"
  }).then((result) => {
    if (result.isConfirmed) {
      // If user confirms, submit the form
      document.getElementById("Logout").value = "true"; 
      document.getElementById("logoutForm").submit();
    }
  });
}
</script>
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      // "buttons": ["copy", "pdf", "print", "colvis"]
      "buttons": ["colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
<script>
    $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })
    })
</script>
<script>
        $(document).ready(function(){
            $("#kategori").change(function(){
                var idkt = $("#kategori").val();
                $.ajax({
                    type: "get",
                    url: "nominal.php",
                    data: "idkt="+idkt,
                    dataType: 'json',
                    success:function(data){
                        var nominal = data[2];
                        var kpnnama = data[1];
                        $("#nominal").val(nominal);
                        $("#keterangan").val(kpnnama);
                        // $("#jumlahpesan").focus();
                    }
                });
            });
        });
    </script>
    <script>
    function tampilkanForm() {
      var jenis = document.getElementById("jenis").value;
      var formKaryawan = document.getElementById("formKaryawan");
      var formSiswa = document.getElementById("formSiswa");

      if (jenis === "karyawan") {
        formKaryawan.style.display = "block";
        formSiswa.style.display = "none";
      } else if (jenis === "siswa") {
        formKaryawan.style.display = "none";
        formSiswa.style.display = "block";
      } else {
        formKaryawan.style.display = "none";
        formSiswa.style.display = "none";
      }
    }
  </script>
  <script>
    function tampilkankategori() {
        var laporan = document.getElementById("laporan").value;
        var formKaMasuk = document.getElementById("formKaMasuk");
        var formKaKeluar = document.getElementById("formKaKeluar");

        if (laporan === "1") {
            formKaMasuk.style.display = "block";
            formKaKeluar.style.display = "none";
        } else if (laporan === "2") {
            formKaMasuk.style.display = "none";
            formKaKeluar.style.display = "block";
        } else {
            formKaMasuk.style.display = "none";
            formKaKeluar.style.display = "none";
        }
    }
</script>
  <script language="javascript">
    var popupJendela=null;

    function center(url,winName,w,h,scroll) {
        LeftPosition=(screen.width) ? (screen.width - w) / 2 : 0;
        TopPosition =(screen.height) ? (screen.height - h) / 2 : 0;

        settings='height='+h+',width='+w+',top='+TopPosition+',left='+LeftPosition+',scrollbars='+scroll+'resizeable'
        popupJendela=window.open(url,winName,settings);
    }
</script>
</body>
</html>
