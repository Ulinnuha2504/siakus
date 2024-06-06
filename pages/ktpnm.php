<?php
    $aktif="Master";
    require "koneksi.php";
    include "sidebar.php";
    $no = 1;
    $kls = $kon->query("SELECT * FROM kategori_penerimaan");
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Kategori Penerimaan</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Kategori Penerimaan</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Section Start-->
    <!-- Section -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
              <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="card-title mb-0">Data Kategori Penerimaan</h4>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-xl">Tambah Kategori Penerimaan</button>
              </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Nominal</th>
                    <th>Keterangan</th>
                    <th>Opsi</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php foreach ($kls as $kpn) :
                    $id = $kpn['kpn_id'];
                    ?>
                  <tr>
                    <td scope="row" class="text-center"><?= $no++; ?></td>
                    <td><?= $kpn['kpn_nama']; ?></td>
                    <td><?= $kpn['kpn_nominal']; ?></td>
                    <td><?= $kpn['kpn_ket']; ?></td>
                    <td>
                        <form action="proses.php" method="post">
                            <input type="hidden" name="id" value="<?= $id;?>">
                            <button type="button" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#Edit-modal-xl<?= $id; ?>"><i class="fas fa-pen"></i></button>
                            <!-- Modal Edit Pengguna -->
                            <div class="modal fade" id="Edit-modal-xl<?= $id; ?>">
                                <div class="modal-dialog modal-xs">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Edit Data Kategori Penerimaan</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <?php 
                                        $edt = $kon->query("SELECT * FROM kategori_penerimaan WHERE kpn_id='$id'");
                                        foreach ($edt as $ed) :
                                        ?>
                                        <div class="modal-body">
                                            <div class="card-body">
                                            <div class="form-group">
                                                <label for="exampleInputName">Nama</label>
                                                <input type="text" class="form-control"value="<?= $ed['kpn_nama']; ?>" id="exampleInputName"name="nm" placeholder="Masukan Nama Kategori Penerimaan" required>
                                                <input type="hidden" name="id" value="<?=$ed['kpn_id']; ?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="Nominal">Nominal</label>
                                                <input type="number" class="form-control"value="<?= $ed['kpn_nominal']; ?>" id="Nominal" name="nl" placeholder="Masukan Nominal" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="Keterangan">Keterangan</label>
                                                <input type="text" class="form-control"value="<?= $ed['kpn_ket']; ?>" id="Keterangan" name="kt" placeholder="Masukan Keterangan" required>
                                            </div>
                                            </div>
                                        </div>
                                        <?php endforeach;?>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                                            <button type="submit" name="EditKtpn" class="btn btn-primary">Simpan</button>
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                            <!-- End Modal Edit Pengguna -->
                            <button type="submit" name="HapusKpn"class="btn btn-danger btn-xs"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                  </tr>
                  <?php endforeach;?>
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Nominal</th>
                    <th>Keterangan</th>
                    <th>Opsi</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- End Section -->
</div>

<!-- Modal -->
<!-- Modal Tambah Kategori Penerimaan -->
<div class="modal fade" id="modal-xl">
  <div class="modal-dialog modal-xs">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Tambah Data Kategori Pembayaran</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="proses.php" method="POST">
        <div class="modal-body">
            <div class="card-body">
              <div class="form-group">
                <label for="exampleInputName">Nama</label>
                <input type="text" class="form-control" id="exampleInputName"name="nm" placeholder="Masukan Nama Kategori Pembayaran" required>
              </div>
              <div class="form-group">
                <label for="exampleInputName">Nominal</label>
                <input type="number" class="form-control" id="exampleInputName"name="nl" placeholder="Masukan Nominal Pemabayaran" required>
              </div>
              <div class="form-group">
                <label for="Keterangan">Keterangan</label>
                <input type="text" class="form-control" id="Keterangan"name="kt" placeholder="Masukan Keterangan" required>
              </div>
            </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
          <button type="submit" name="TambahKtpnm"class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- End Tambah Kategori Penerimaan -->
