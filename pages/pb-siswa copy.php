<?php
$aktif = "Transaksi";
require "koneksi.php";
include "sidebar.php";
$us =  $_SESSION["username"];
$pgn = $kon->query("SELECT * FROM pengguna WHERE username='$us'");
$kpn = $kon->query("SELECT*FROM kategori_penerimaan");
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Penerimaan Baru</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item"><a href="index.php?page=penerimaan">Penerimaan</a></li>
                        <li class="breadcrumb-item active">Baru</li>
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
                <div class="col-md-12">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Formulir Penerimaan Dana Baru</h3>
                        </div>
                        <div class="card-body">
                            <form action="" method="post" class="form-horizontal">
                                <div class="form-group row">
                                <label for="namadonatur" class="col-sm-2 col-form-label">Kategori Penerimaan</label>
                                <div class="col-sm-8">
                                    <select name="kategori" id="kategori" class="form-control">
                                        <option value="">-- Pilih Kategori Penerimaan --</option>
                                        <?php
                                        foreach ($kpn as $kp):
                                            echo'<option value="'.$kp['kpn_id'].'">'.$kp['kpn_nama'].'</option>';
                                        endforeach;
                                        ?>
                                    </select>
                                </div>
                                <input type="submit" value="Lanjutkan" name="lanjut" class="col-sm-2 btn btn-success">
                            </div>
                            </form>
                            <hr>
                            <?php
                               if (isset($_POST['lanjut'])) {
                                $kpn = trim(htmlspecialchars($_POST['kategori']));
                                }
                            ?>
                            <form action="" method="post" class="form-horizontal">
                            <div class="form-group row">
                                <label for="namadonatur" class="col-sm-2 col-form-label">Nama Donatur</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="nm" name="nm"placeholder="Nama Donatur / Pemberi"required >
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="nominal" class="col-sm-2 col-form-label">Nominal</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" id="nl" name="nl"placeholder="Nominal Penerimaan"required >
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="keterangan" class="col-sm-2 col-form-label">Keterangan</label>
                                <div class="col-sm-10">
                                    <textarea  class="form-control" id="kt" name="kt"placeholder="Keterangan Singkat" cols="30" rows="4" required></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="tanggal" class="col-sm-2 col-form-label">Tanggal Penerimaan</label>
                                <div class="col-sm-10">
                                    <input type="date" class="form-control" id="tg" name="tg"required >
                                </div>
                            </div>
                            <div class="form-group-row">
                                <input type="submit" value="Simpan" class="col-sm-2 btn btn-primary">
                                <input type="reset" value="Batal" class="col-sm-2 btn btn-danger">
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- End Section -->
</div>




