<?php
$aktif = "Transaksi";
require "koneksi.php";
include "sidebar.php";
$us =  $_SESSION["username"];
$pgn = $kon->query("SELECT * FROM pengguna WHERE username='$us'");
$dky    = $kon->query("SELECT * FROM karyawan");
$dsw    = $kon->query("SELECT * FROM siswa");
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Pencairan Dana</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item"><a href="index.php?page=pengeluaran">Pengeluaran</a></li>
                        <li class="breadcrumb-item active">Pencairan Dana</li>
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
                <div class="col-md-3">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Cek Data Pengajuan</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="" class="form-horizontal" method="post">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="Inputkodesiswa" class="">Kode Pengajuan</label>
                                    <input type="text" class="form-control" id="Inputkodesiswa" name="kds"placeholder="Masukkan Kode Pengajuan">
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" name="Submit" class="form-control btn btn-success">Cek Data</button>
                            </div>
                            <!-- /.card-footer -->
                        </form>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Detail Pengajuan</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <?php
                            // cek data
                            if (isset($_POST['Submit'])) {
                                $id = trim(htmlspecialchars($_POST['kds']));
                                // Pastikan koneksi sukses
                                if ($kon) {
                                    $sqd = $kon->query("SELECT * FROM pengajuan inner join pengguna on pengajuan.pg_id=pengguna.pg_id WHERE pgj_kd='$id' AND pgj_status='2'");
                                    if ($sqd && $sqd->num_rows > 0) {
                                        $sq = mysqli_fetch_array($sqd);
                                        ?>
                                        <div class="row">
                                            <div class="col-sm-2">Kode</div><div class="col-sm-5">: <?= $sq['pgj_kd']?></div>
                                            <div class="col-sm-2"> Diajukan</div><div class="col-sm-3">: <?= $sq['pg_nama']?></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-2">Pengajuan</div><div class="col-sm-5">: <?= $sq['pgj_nama']?></div>
                                            <div class="col-sm-2">Pada Tanggal</div><div class="col-sm-3">: <?= $sq['pgj_tanggal']?></div>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col-sm-2">Keterangan</div>
                                            <textarea class="form-control col-sm-10 bg-white" cols="50" rows="3" readonly><?= $sq['pgj_ket']?></textarea>
                                            <!-- <div class="col-sm-10">: <?= $sq['pgj_ket']?></div> -->
                                        </div>
                                        <br>
                                        <form action="proses.php" class="form-horizontal" method="post">
                                            <div class="form-group row mb-0">
                                                <label class="col-sm-3 form-control-sm">Tanggal Pencairan</label>
                                                <div class="col-sm-3">
                                                    <input type="date" class="form-control-sm form-control " id="tanggal" name="tg" required>
                                                    <?php foreach ($pgn as $pg) : $idp=$pg['pg_id'];?>
                                                    <input type="hidden" name="pg" id="pg" value="<?=$idp;?>">
                                                    <?php endforeach;?>
                                                </div>
                                            </div>
                                            <div class="form-group row mb-0">
                                                <label class="col-sm-3 form-control-sm">Kategori </label>
                                                <div class="col-sm-7">
                                                <select name="kp" id="kpr"class="form-control-sm form-control select2 select2-success" data-dropdown-css-class="select2-success" style="width: 100%;" required>
                                                    <option value="">Pilih Kategori Pengeluaran</option>
                                                    <?php
                                                    $sqk = $kon->query("SELECT*FROM kategori_pengeluaran");
                                                    while ($kt=mysqli_fetch_array($sqk)) {
                                                        echo'<option value="'.$kt['kpr_id'].'">'.$kt['kpr_nama'].'</option>';
                                                    }
                                                    ?>
                                                </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3 form-control-sm">Nominal</label>
                                                <div class="col-sm-5">
                                                    <input type="text" class="form-control-sm form-control " id="nominal-keluar" name="nl" placeholder="Nominal" value="<?= $sq['pgj_nominal']?>">
                                                    <input type="hidden" name="kd" value="<?= $sq['pgj_kd']?>">
                                                    <input type="hidden" name="kt" value="<?= $sq['pgj_nama']?>">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                            <button type="button" class="btn btn-success form-control" data-toggle="modal" data-target="#Edit-modal-xl<?= $id; ?>">Simpan</button>
                                            </div>
                                            <!-- Modal Konfirmasi -->
                                            <div class="modal fade" id="Edit-modal-xl<?= $id; ?>">
                                                <div class="modal-dialog modal-xs">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Konfirmasi Pencairan <?= $id; ?></h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="card-body">
                                                                <div class="form-group row">
                                                                    <label for="" class="col-sm-4 col-form-label">Status Penerima</label>
                                                                    <div class="col-sm-8">
                                                                    <select name="stpn"class="form-control form-control"id="jenis" onchange="tampilkanForm()">
                                                                        <option value="">Pilih Status Penerima</option>
                                                                        <option value="karyawan">Karyawan</option>
                                                                        <option value="siswa">Siswa</option>
                                                                    </select>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <div class="col-sm-12">
                                                                        <div id="formKaryawan"style="display:none;" >
                                                                            <select name="nmky"id="karyawan"  class="select2bs4">
                                                                                <option value="">Nama Penerima</option>
                                                                                <?php foreach ($dky as $ky) :?>
                                                                                <option value="<?=$ky['kyw_kd'];?>"><?=$ky['kyw_kd'].' | '.$ky['kyw_nama'];?></option>
                                                                                <?php endforeach;?>
                                                                            </select>
                                                                        </div>
                                                                        <div id="formSiswa" style="display:none;">
                                                                            <select name="nmsw"id="siswa"class="select2bs4">
                                                                                <option value="">Nama Penerima</option>
                                                                                <?php foreach ($dsw as $sw) :?>
                                                                                <option value="<?=$sw['sw_kd'];?>"><?=$sw['sw_kd'].' | '.$sw['sw_nama'];?></option>
                                                                                <?php endforeach;?>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                                                            <button type="submit" name="SimpanPengeluaran" class="btn btn-success">Konfirmasi Penerima</button>
                                                        </div>
                                                    </div>
                                                    <!-- /.modal-content -->
                                                </div>
                                                <!-- /.modal-dialog -->
                                            </div>
                                            <!-- End Modal Konfirmasi -->
                                        </form>
                                        <?php
                                    } elseif ($kon) {
                                        $sqd = $kon->query("SELECT * FROM pengajuan inner join pengguna on pengajuan.pg_id=pengguna.pg_id WHERE pgj_kd='$id' AND pgj_status='4'");
                                        if ($sqd && $sqd->num_rows > 0){
                                        echo '<div class="text-success">Mohon Maaf Dana Pengajuan sudah dicairkan atau diambil.</div>';
                                        }
                                        else {
                                            echo '<div class="text-danger">Mohon maaf data tidak ditemukan atau belum disetujui.</div>';
                                        }
                                    }
                                    else {
                                        echo '<div class="text-danger">Mohon maaf data tidak ditemukan atau belum disetujui.</div>';
                                    }
                                } else {
                                    echo "Koneksi ke database gagal.";
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- End Section -->
</div>




