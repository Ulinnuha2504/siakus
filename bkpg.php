<?php
    require "koneksi.php";
    $kd  = $_GET['kode'];
    $prefix = substr($kd, 0, 3); // Kode 1
    $tahun = substr($kd, 3, 4); // Tahun
    $nomor = substr($kd, 7); // Kode 2
    $pnm = $kon->query("SELECT pengeluaran.pgr_nominal,pengeluaran.pgr_ket,pengeluaran.pgr_tanggal,pengajuan.pgj_pj,pengajuan.pgj_kd,pengajuan.pgj_tanggal,pengguna.pg_pj, kategori_pengeluaran.kpr_nama FROM pengeluaran join pengajuan on pengeluaran.pgj_kd=pengajuan.pgj_kd join kategori_pengeluaran on pengajuan.kpr_id=kategori_pengeluaran.kpr_id join pengguna on pengeluaran.pg_id=pengguna.pg_id WHERE pgr_kd='$kd'");
   
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BUKTI PENGELUARAN DANA <?= $kd;?></title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <style>
        body, td, th {
            max-width: 210mm;
            max-height: 290mm;
            font-size: 14px;
        }
        th, td {
            padding: 4px 4px 4px 4px;
        }
        th {
            border-top: 1px solid #333333;
            border-bottom: 1px solid #333333;
        }
        tfoot td {
            border-top: 2px solid #333333;
            padding-top: 2px;
            border-bottom: 2px solid #333333;
        }
        @media screen{
            .noprint{display:block;}
            .noshow{display:none;}
        }
        @media print{
            .noprint{display:none;}
            .noshow{display:block;}
        }
        .judul1 {
            text-align: left; /* Mengubah menjadi center */
            font-size: 14px;
            line-height: 90%;
            margin-bottom: 3px;
        }
        .judul2 {
            text-align: left; /* Mengubah menjadi center */
            font-weight: bold;
            font-size: 35px;
            line-height: 90%;
            margin-bottom: 5px;
        }
        body {
            margin: 0 auto; /* Menengahkan konten */
            text-align: center; /* Menengahkan konten */
        }
        .hilang {
            border: 0;
        }
        hr.new1 {
            border-top: 2px solid;
            margin-top: 10px;
            margin-bottom: 1px;
            width: 210mm;
        }
        hr.new2 {
            border-top: 1px solid;
            margin-top: 1px;
            margin-bottom: 1px;
            width: 210mm;
        }
    </style>
</head>
<body>
    <span class="noprint text-center">
        <a href="javascript:window.print();" class="btn btn-outline-primary"><i class="fas fa-print"></i></a>
        <a href="javascript:window.close();" class="btn btn-outline-danger"><i class="fas fa-power-off"></i></a>
    </span>
    <div class="row" style="width: 750px; margin: 2px auto;"> <!-- Menambahkan style untuk menengahkan konten -->
        <div id="#logo" style="width: 110px;">
            <img src="dist/img/logo.png" alt="" style="width: 90px;">
        </div>
        <div id="#nama" style="padding-top: 25px;">
            <div class="judul2">MA YAFALAH GINGGANGTANI</div>
            <div class="judul1">Jl.Perhutani No.01 Ginggangtani kec.Gubug kab.Grobogan.</div>
            <div class="judul1">Telp 0823-3539-5934 | Web : www.mayafalahginggatani.sch.id | Email : mayafalahginggangtani@gmail.com</div>
        </div>
    </div>
    <hr class="new1">
    <?php foreach ($pnm as $dt):?>
    <strong>KWITANSI / BUKTI PENCAIRAN DANA</strong>
    <div class="judul1 text-center mb-4">Nomor : <?= $prefix.'/'.$tahun.'/'.$nomor.'.'.date("d/m/Y", strtotime($dt['pgr_tanggal']));?></div>
    
    <div class="row mb-2"style="width: 750px; margin: 2px auto;">
        <div class="col-sm-5 text-left">Yang bertanda tangan dibawah ini :</div>
    </div>
    <div class="row"style="width: 750px; margin: 2px auto;">
        <div class="col-sm-2 text-left row">
            <div class="col-sm-3"></div>
            <div class="col-sm-9">Nama</div>
        </div>
        <div class="col-sm-10 text-left">: <?=$dt['pgj_pj'];?></div>
    </div>
    <div class="row"style="width: 750px; margin: 2px auto;">
        <div class="col-sm-2 text-left row">
            <div class="col-sm-3"></div>
            <div class="col-sm-9">Penanggung Jawab</div>
        </div>
        <div class="col-sm-10 text-left">: <?=$dt['kpr_nama'];?></div>
    </div>
    <div class="row mb-2"style="width: 750px; margin: 2px auto;">
        <div class="col-sm-12 text-left">Telah menerima uang dari Bagian Keuangan Sekolah sejumlah <strong><?= 'Rp '.number_format($dt['pgr_nominal'], 0, ',', '.'); ?> ( <?= ucwords(terbilang($dt['pgr_nominal']));?> Rupiah)</strong> untuk <?= $dt['pgr_ket'];?> berdasarkan Pengajuan Dana Nomor <?php $pgj=$dt['pgj_kd'];$a = substr($kd, 0, 3);    $b = substr($kd, 3, 4);$c = substr($kd, 7); echo $a.'/'.$b.'/'.$c.'.'.date("d/m/Y", strtotime($dt['pgj_tanggal']));?></div>
    </div>
    <div class="row"style="width: 750px; margin: 2px auto;">
        <div class="col-sm-12 text-left">Surat tanda terima ini merupakan bukti yang sah sesuai dengan hukum berdasarkan perjanjian yang sudah dilakukan.</div>
    </div>
    
    <div class="row mt-5"style="width: 750px; margin: 2px auto;">
        <div class="col-sm-3 text-center"><br>Penerima, <br><br><br><br> (<?= $dt['pgj_pj'];?>)</div>
        <div class="col-sm-6 text-center"></div>
        <div class="col-sm-3 text-center">Grobogan, <?= date('d F Y', strtotime($dt['pgr_tanggal'])); ?> <br>Bagian Keuangan, <br><br><br><br> (<?= $dt['pg_pj'];?>)</div>
    </div>
    <?php endforeach; ?>
    <!-- Script -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <script src="plugins/jquery-ui/jquery-ui.min.js"></script>
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="plugins/jqvmap/jquery.vmap.min.js"></script>
    <script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <script src="dist/js/adminlte.js"></script>
</body>
</html>
