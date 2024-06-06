<?php
$aktif="Laporan";
require "koneksi.php";
include "sidebar.php";
$no = 1;
$pgn = $kon->query("SELECT * FROM pengguna");
?>

<script>
function cetakLaporan() {
    var printContents = document.getElementById('print').innerHTML;
    var originalContents = document.body.innerHTML;
    document.body.innerHTML = printContents;
    window.print();
    document.body.innerHTML = originalContents;
}
</script>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Laporan</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Laporan</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Filter Laporan</h3>
                        </div>
                        <div class="card-body">
                            <form action="" method="post">
                            <div class="row align-items-center">
                            <label for="" class="col-sm-1 col-form-label">Laporan:</label>
                            <div class="col-sm-3">
                                <select class="form-control form-control-sm" name="laporan" id="laporan" onchange="tampilkankategori()" required>
                                    <option value="">--Pilih Laporan--</option>
                                    <option value="1">Laporan Pemasukan</option>
                                    <option value="2">Laporan Pengeluaran</option>
                                </select>
                            </div>
                                <label for="" class="col-sm-1 col-form-label">Periode:</label>
                                <div class="col-sm-2">
                                    <input name="dari"class="form-control form-control-sm" type="date"required>
                                </div>
                                <div class="col-sm-2">
                                    <input name="sampai"class="form-control form-control-sm" type="date"required>
                                </div>
                                <div class="col-sm-2">
                                    <button type="submit" name="submit"class="btn btn-success btn-sm">Lihat</button>
                                    <button id='tombolprint'class="btn btn-primary btn-sm"onclick="cetakLaporan()">Cetak Laporan</button>
                                </div>
                            </div>
                            <div class="row align-items-center">
                            <label for="" class="col-sm-1 col-form-label">Kategori :</label>
                            <div class="col-sm-3" id="formKaMasuk" style="display:none;">
                                <select name="kategorimasuk" id="kategori" class="form-control-sm form-control select2 select2-success" data-dropdown-css-class="select2-success" style="width: 100%;">
                                    <option value="0">Semua Kategori</option>
                                    <?php
                                    $kpd = $kon->query("SELECT*FROM kategori_penerimaan");
                                    while ($kp=mysqli_fetch_array($kpd)) {
                                        echo'<option value="'.$kp['kpn_id'].'">'.$kp['kpn_nama'].'</option>';
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="col-sm-3" id="formKaKeluar" style="display:none;">
                                <select name="kategorikeluar" id="kategori" class="form-control-sm form-control select2 select2-success" data-dropdown-css-class="select2-success" style="width: 100%;">
                                    <option value="0">Semua Kategori</option>
                                    <?php
                                    $kpd = $kon->query("SELECT*FROM kategori_pengeluaran");
                                    while ($kp=mysqli_fetch_array($kpd)) {
                                        echo'<option value="'.$kp['kpr_id'].'">'.$kp['kpr_nama'].'</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card card-outline card-primary">
                        <div class="card-body"id="print">
                        <title>LAPORAN</title>
                        <style>
                            .judul1 {
                                    text-align: left; /* Mengubah menjadi center */
                                    font-size: 14px;
                                    line-height: 90%;
                            }
                            .judul2 {
                                text-align: left; /* Mengubah menjadi center */
                                font-weight: bold;
                                font-size: 35px;
                                line-height: 90%;
                                margin-bottom: 5px;
                            }
                            hr.new1 {
                                border-top: 2px solid;
                                margin-top: 10px;
                                margin-bottom: 1px;
                                width: 90%;
                            }
                        </style>
                        
                        <?php
                            if (isset($_POST['submit'])) {
                                $lp = trim(htmlspecialchars($_POST['laporan']));
                                $ktm = trim(htmlspecialchars($_POST['kategorimasuk']));
                                $ktk = trim(htmlspecialchars($_POST['kategorikeluar']));
                                $aw = trim(htmlspecialchars($_POST['dari']));
                                $ak = trim(htmlspecialchars($_POST['sampai']));
                                if ($lp == '1') {
                                    $no = 1;
                                    $subtotal = 0;
                                    ?>
                                    <center>
                                    <div class="row"style="width:90%; margin: 2px auto;">
                                        <!-- <div class="col-sm-1"></div> -->
                                        <div id="#logo" class="col-sm-2 text-right">
                                            <img src="dist/img/logo.png" alt="" style="width: 90px;">
                                        </div>
                                        <div id="#nama" class="col-sm-10"style="padding-top: 22px;">
                                            <div class="judul2">MA YAFALAH GINGGANGTANI</div>
                                            <div class="judul1">Jl.Perhutani No.01 Ginggangtani kec.Gubug kab.Grobogan.</div>
                                            <div class="judul1">Telp 0823-3539-5934 | Web : www.mayafalahginggatani.sch.id | Email : mayafalahginggangtani@gmail.com</div>
                                        </div>
                                    </div>
                                    <hr class="new1">
                                    </center>
                                    <div class="text-center">
                                        <h4 class="text-center mb-0">LAPORAN PENERIMAAN DANA</h4>
                                        <span>
                                            <strong>Periode</strong><br>
                                            <?= date('d F Y', strtotime($aw)).' - '.date('d F Y', strtotime($ak)); ?>
                                        </span>
                                        <hr>
                                    </div>
                                    <center>
                                        <table width="90%" border="1">
                                            <tr class="text-center">
                                                <th>No</th>
                                                <th>Kode</th>
                                                <th>Tanggal</th>
                                                <th>Keterangan</th>
                                                <th>Nominal</th>
                                            </tr>
                                            <?php 
                                            if ($ktm == 0) {
                                                $dt = $kon->query("SELECT*FROM penerimaan WHERE pnm_tanggal BETWEEN '$aw' AND '$ak'");
                                            } else {
                                                $dt = $kon->query("SELECT*FROM penerimaan WHERE kpn_id='$ktm' AND pnm_tanggal BETWEEN '$aw' AND '$ak'");
                                            }
                                            $no = 1;
                                            $subtotal = 0;
                                            foreach ($dt as $d):
                                            ?>
                                            <tr>
                                                <td class="text-center"><?= $no++ ?></td>
                                                <td class="text-center"><?=$d['pnm_kd'];?></td>
                                                <td class="text-center"><?= date('d F Y', strtotime($d['pnm_tanggal'])); ?></td>
                                                <td><?=$d['pnm_nama'].'-'.$d['pnm_ket'];?></td>
                                                <td class="text-right"><?='Rp '.number_format($d['pnm_nominal'], 0, ',', '.');?></td>
                                            
                                            </tr>
                                            <?php 
                                            $subtotal = $subtotal+$d['pnm_nominal'];
                                            endforeach;?>
                                            <tr>
                                                <th class="text-left"colspan="4">Total Pemasukan</th>
                                                <th class="text-right"><?='Rp '.number_format($subtotal, 0, ',', '.');?></th>
                                            </tr>
                                        </table>
                                    </center>
                                    <div class="row mt-5"style="width: 900px; margin: 2px auto;">
                                        <div class="col-sm-3 text-center">Mengetahui<br>Kepala Sekolah<br><br><br><br> (<?= $_SESSION["nama"];?>)</div>
                                        <div class="col-sm-6 text-center"></div>
                                        <div class="col-sm-3 text-center">Grobogan, <?= date('d F Y', strtotime($hariini)); ?> <br>Bagian Keuangan, <br><br><br><br> (.................................)</div>
                                    </div>
                            <?php }
                            elseif ($lp == '2') {
                                $dt = $kon->query("SELECT*FROM pengeluaran join kategori_pengeluaran on pengeluaran.kpr_id=kategori_pengeluaran.kpr_id WHERE pgr_tanggal BETWEEN '$aw' AND '$ak'");
                                    $no = 1;
                                    $subtotal = 0;
                                    ?>
                                    <center>
                                    <div class="row"style="width:90%; margin: 2px auto;">
                                        <!-- <div class="col-sm-1"></div> -->
                                        <div id="#logo" class="col-sm-2 text-right">
                                            <img src="dist/img/logo.png" alt="" style="width: 90px;">
                                        </div>
                                        <div id="#nama" class="col-sm-10"style="padding-top: 22px;">
                                            <div class="judul2">MA YAFALAH GINGGANGTANI</div>
                                            <div class="judul1">Jl.Perhutani No.01 Ginggangtani kec.Gubug kab.Grobogan.</div>
                                            <div class="judul1">Telp 0823-3539-5934 | Web : www.mayafalahginggatani.sch.id | Email : mayafalahginggangtani@gmail.com</div>
                                        </div>
                                    </div>
                                    <hr class="new1">
                                    </center>
                                    <div class="text-center mb-2">
                                        <h4 class="text-center mb-0">LAPORAN PENGELUARAN DANA</h4>
                                        <span>
                                            <strong>Periode</strong><br>
                                            <?= date('d F Y', strtotime($aw)).' - '.date('d F Y', strtotime($ak)); ?>
                                        </span>
                                    </div>
                                    <center>
                                        <table width="90%" border="1">
                                            <tr class="text-center">
                                                <th>No</th>
                                                <th>Kode</th>
                                                <th>Tanggal</th>
                                                <th>Kategori</th>
                                                <th>Keterangan</th>
                                                <th>Nominal</th>
                                            </tr>
                                            <?php 
                                            // $dt = $kon->query("SELECT*FROM penerimaan");
                                            $no = 1;
                                            $subtotal = 0;
                                            foreach ($dt as $d):
                                            ?>
                                            <tr>
                                                <td class="text-center"><?= $no++ ?></td>
                                                <td class="text-center"><?=$d['pgr_kd'];?></td>
                                                <td class="text-center"><?= date('d F Y', strtotime($d['pgr_tanggal'])); ?></td>
                                                <td><?=$d['kpr_nama'];?></td>
                                                <td><?=$d['pgr_ket'];?></td>
                                                <td class="text-right"><?='Rp '.number_format($d['pgr_nominal'], 0, ',', '.');?></td>
                                            
                                            </tr>
                                            <?php 
                                            $subtotal = $subtotal+$d['pgr_nominal'];
                                            endforeach;?>
                                            <tr>
                                                <th class="text-left"colspan="5">Total Pengeluaran Dana</th>
                                                <th class="text-right"><?='Rp '.number_format($subtotal, 0, ',', '.');?></th>
                                            </tr>
                                        </table>
                                    </center>
                                    <div class="row mt-5"style="width: 900px; margin: 2px auto;">
                                        <div class="col-sm-3 text-center">Mengetahui<br>Kepala Sekolah<br><br><br><br> (<?= $_SESSION["nama"];?>)</div>
                                        <div class="col-sm-6 text-center"></div>
                                        <div class="col-sm-3 text-center">Grobogan, <?= date('d F Y', strtotime($hariini)); ?> <br>Bagian Keuangan, <br><br><br><br> (.................................)</div>
                                    </div>
                            <?php
                               }
                            else{
                                echo "<script>document.getElementById('tombolprint').disabled = true;</script>";
                                echo'<div class="text-danger text-center">Silahkan Isi Filter Laporan Terlebih Dahulu</div>';
                            }
                            }else{
                                echo "<script>document.getElementById('tombolprint').disabled = true;</script>";
                                echo'<div class="text-danger text-center">Silahkan Isi Filter Laporan Terlebih Dahulu</div>';
                            }
                            
                        ?>
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>