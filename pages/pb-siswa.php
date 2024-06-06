<?php
$aktif = "Transaksi";
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
                    <h1 class="m-0">Pembayaran Siswa</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item"><a href="index.php?page=penerimaan">Penerimaan</a></li>
                        <li class="breadcrumb-item active">Pembayaran</li>
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
                <div class="col-md-4">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Cek Data Siswa</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="" class="form-horizontal" method="post">
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="Inputkodesiswa" class="col-sm-4 col-form-label">Kode Siswa</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="Inputkodesiswa" name="kds"
                                            placeholder="Masukkan Kode Siswa">
                                    </div>
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
                <div class="col-md-8">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Data Pembayaran</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <?php
                            // cek data
                            if (isset($_POST['Submit'])) {
                                $id = trim(htmlspecialchars($_POST['kds']));
                                // Pastikan koneksi sukses
                                if ($kon) {
                                    $sqd = $kon->query("SELECT * FROM siswa inner join kelas on siswa.kl_id=kelas.kl_id WHERE sw_kd='$id'");
                                    if ($sqd && $sqd->num_rows > 0) {
                                        $sq = mysqli_fetch_array($sqd);
                                        ?>
                                        <div class="row">
                                            <div class="col-sm-2">Kode</div><div class="col-sm-4">: <?= $sq['sw_kd']?></div>
                                            <div class="col-sm-2">Kelas</div><div class="col-sm-4">: <?= $sq['kl_nama']?></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-2">Nama</div><div class="col-sm-4">: <?= $sq['sw_nama']?></div>
                                            <div class="col-sm-2">Kontak</div><div class="col-sm-4">: <?= $sq['sw_kontak']?></div>
                                        </div>
                                        <br>
                                        <form action="proses.php" class="form-horizontal" method="post">
                                            <div class="form-group row mb-0">
                                                <label class="col-sm-2 form-control-sm">Tanggal</label>
                                                <div class="col-sm-10">
                                                    <input type="date" class="form-control-sm form-control " id="tanggal" name="tg" required>
                                                    <input type="hidden" name="nm" id="nm" value="<?=$sq['sw_nama'] ;?>">
                                                    <input type="hidden" name="jn" id="jn" value="Pembayaran">
                                                    <input type="hidden" name="sw" id="sw" value="<?=$sq['sw_kd'] ;?>">
                                                    <input type="hidden" name="kl" id="kl" value="<?=$sq['kl_id'] ;?>">
                                                    <input type="hidden" name="kt" id="keterangan">
                                                    <?php foreach ($pgn as $pg) : $id=$pg['pg_id'];?>
                                                    <input type="hidden" name="pg" id="pg" value="<?=$id;?>">
                                                    <?php endforeach;?>
                                                </div>
                                            </div>
                                            <div class="form-group row mb-0">
                                                <label class="col-sm-2 form-control-sm">Pembayaran</label>
                                                <div class="col-sm-10">
                                                <select name="kp"id="kategori"class="form-control-sm form-control select2 select2-success" data-dropdown-css-class="select2-success" style="width: 100%;" required>
                                                    <option value="">Pilih Pembayaran</option>
                                                    <?php
                                                    $sqk = $kon->query("SELECT*FROM kategori_penerimaan");
                                                    while ($kt=mysqli_fetch_array($sqk)) {
                                                        echo'<option value="'.$kt['kpn_id'].'">'.$kt['kpn_nama'].'</option>';
                                                    }
                                                    ?>
                                                </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 form-control-sm">Nominal</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control-sm form-control " id="nominal" name="nl" placeholder="Nominal"readonly>
                                                </div>
                                                <div class="col-sm-2">
                                                    <button type="submit" name="SimpanSPN" class="btn btn-success btn-sm form-control-sm form-control" >Bayar</button>
                                                </div>
                                            </div>
                                        </form>
                                        <table class="table table-sm table-bordered">
                                            <thead class="text-center">
                                                <th>No</th>
                                                <th>Tanggal</th>
                                                <th>Pembayaran</th>
                                                <th>Nominal</th>
                                            </thead>
                                                <?php
                                                $no = 1; 
                                                // $pnm = $kon->query("SELECT * FROM penerimaan WHERE sw_kd='{$sq['sw_kd']}'");
                                                $pnm = $kon->query("SELECT * FROM detailpenerimaan join penerimaan on detailpenerimaan.pnm_kd=penerimaan.pnm_kd join kelas on detailpenerimaan.kl_id=kelas.kl_id WHERE sw_kd='{$sq['sw_kd']}'");
                                                foreach ($pnm as $pn) :
                                                ?>
                                                <tbody class="text-center">
                                                <td><?= $no++;?></td>
                                                <td><?= $pn['pnm_tanggal'];?></td>
                                                <td><?= $pn['pnm_ket'];?></td>
                                                <td><?= $pn['pnm_nominal'];?></td>
                                            </tbody>
                                            <?php endforeach;?>
                                        </table>
                                        <?php
                                    } else {
                                        echo '<div class="text-danger">Data tidak ditemukan atau kode salah.</div>';
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




