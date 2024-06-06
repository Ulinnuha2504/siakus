<?php
$aktif = 'Pengajuan';
require 'koneksi.php';
include 'sidebar.php';
$no = 1;
$pgn = $kon->query("SELECT * FROM pengajuan inner join pengguna on pengajuan.pg_id=pengguna.pg_id WHERE pengajuan.pg_id='{$user['iduser']}'");
$kpr = $kon->query("SELECT * FROM kategori_pengeluaran");
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Pengajuan</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Pengajuan</li>
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
          <div class="col-12">
            <div class="card">
              <div class="card-header">
              <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="card-title mb-0">Daftar Pengajuan</h4>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-xl">Tambah Pengajuan</button>
              </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped table-sm ">
                  <thead>
                  <tr class="text-center">
                    <th>No</th>
                    <th>Tanggal Pengajuan</th>
                    <th>Kode</th>
                    <th>Pengajuan</th>
                    <th>Keterangan</th>
                    <th>Oleh</th>
                    <th>Nominal</th>
                    <th>Status</th>
                    <th>Opsi</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php foreach ($pgn as $pg) :
                    $id = $pg['pgj_kd'];
                    if ($pg['pgj_status']=='0') {
                      $status = 'Diajukan';
                      $tb ='table-secondary';
                    } elseif ($pg['pgj_status']=='1') {
                      $status = 'Diperiksa';
                      $tb ='table-warning';
                    } elseif ($pg['pgj_status']=='2') {
                      $status = 'Disetujui';
                      $tb ='table-success';
                    } elseif ($pg['pgj_status']=='3') {
                      $status = 'Ditolak';
                      $tb ='table-danger';
                    }elseif ($pg['pgj_status']=='4') {
                      $status = 'Dicairkan';
                      $tb ='table-primary';
                    }
                    
                    ?>
                  <tr class="<?=$tb;?>">
                    <td scope="row" class="text-center"><?= $no++; ?></td>
                    <td><?= $pg['pgj_tanggal']; ?></td>
                    <td><?= $id; ?></td>
                    <td><?= $pg['pgj_nama']; ?></td>
                    <td><?= $pg['pgj_ket']; ?></td>
                    <td><?= $pg['pg_nama']; ?></td>
                    <td><?= $pg['pgj_nominal']; ?></td>
                    <td><?= $status; ?></td>
                    <td>
                    <form action="proses.php" method="post"enctype="multipart/form-data">
                          <input type="hidden" name="id" value="<?php echo $id; ?>"> <!-- Menyimpan nilai ID di dalam input hidden -->
                          <?php
                            if (!empty($pg['pgj_file'])) {
                              echo'<a href="dist/dok/'.$pg['pgj_file'].'" class="btn btn-primary btn-xs"><i class="fas fa-copy"></i></a>  ';
                            } else {
                              
                            }
                            if ($pg['pgj_status'] == 0) {
                                echo '<button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#Edit-modal-xl'.$id.'"><i class="fas fa-edit"></i></button>';
                            } else {
                                echo '<button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#Edit-modal-xl'.$id.'" disabled><i class="fas fa-edit"></i></button>';
                            }

                      ?>
                          <!-- Modal Edit Pengguna -->
                          <div class="modal fade" id="Edit-modal-xl<?= $id; ?>">
                              <div class="modal-dialog modal-lg">
                                  <div class="modal-content">
                                      <div class="modal-header">
                                          <h4 class="modal-title">Edit Data Pengajuan | <?= $id; ?></h4>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                              <span aria-hidden="true">&times;</span>
                                          </button>
                                      </div>
                                      <?php
                                     $edt = $kon->query("SELECT * FROM pengajuan inner join kategori_pengeluaran on pengajuan.kpr_id=kategori_pengeluaran.kpr_id WHERE pgj_kd='$id'");
                                    foreach ($edt as $ed) {
                                     
                                        ?>
                                      <div class="modal-body">
                                          <div class="card-body">
                                            <div class="form-group row">
                                              <label for="Judul"class="col-sm-2 col-form-label">Judul</label>
                                              <div class="col-sm-10">
                                                <input type="text" class="form-control" id="Judul"name="nm" placeholder="Masukan Judul" value="<?php echo $ed['pgj_nama']; ?>"required>
                                                <input type="hidden" class="form-control" id="Judul"name="id" placeholder="Masukan Judul" value="<?php echo $id; ?>">
                                              </div>
                                            </div>
                                            <div class="form-group row">
                                              <label for="Tanggal"class="col-sm-2 col-form-label">Tanggal</label>
                                              <div class="col-sm-10">
                                              <input type="date" class="form-control" id="Tanggal"name="tg" placeholder="Tanggal" value="<?php echo $ed['pgj_tanggal']; ?>"required>
                                            </div>
                                            </div>
                                            <div class="form-group row">
                                              <label for="Keterangan"class="col-sm-2 col-form-label">Keterangan</label>
                                              <div class="col-sm-10">
                                              <textarea name="kt" id="ket"class="form-control" placeholder="Masukan Keterangan Singkat Pengajuan"value="<?php echo $ed['pgj_ket']; ?>"required><?php echo $ed['pgj_ket']; ?></textarea>
                                              </div>
                                            </div>
                                            <div class="form-group row">
                                              <label for="Nominal"class="col-sm-2 col-form-label">Nominal</label>
                                              <div class="col-sm-10">
                                              <input type="number" class="form-control" id="Nominal"name="nl" placeholder="Nominal" value="<?php echo $ed['pgj_nominal']; ?>"required>
                                              </div>
                                            </div>
                                            <div class="form-group row">
                                              <label for="Nominal"class="col-sm-2 col-form-label">Kategori</label>
                                              <div class="col-sm-10">
                                              <select name="ktr" id="ktr" class="form-control">

                                                <option value="<?php echo $ed['kpr_nama']; ?>" selected><?php echo $ed['kpr_nama']; ?></option>
                                                <?php
                                                foreach ($kpr as $kp) :
                                                  echo'<option value="'.$kp['kpr_id'].'">'.$kp['kpr_nama'].'</option>';
                                                endforeach;
                                                ?>
                                              </select>
                                              </div>
                                            </div>
                                            <div class="form-group row">
                                              <label for="File"class="col-sm-2 col-form-label">Pendukung</label>
                                              <div class="col-sm-10">
                                              <input type="file" class="form-control" id="fl"name="fl"accept=".pdf" value="">
                                              </div>
                                            </div>
                                          </div>
                                      </div>
                                      <?php }?>
                                      <div class="modal-footer">
                                          <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                                          <button type="submit" name="EditPengajuan" class="btn btn-primary">Simpan</button>
                                      </div>
                                  </div>
                                  <!-- /.modal-content -->
                              </div>
                              <!-- /.modal-dialog -->
                          </div>
                          <!-- End Modal Edit Pengguna -->
                      </form>
                    </td>
                  </tr>
                  <?php endforeach;?>
                  </tbody>
                  <tfoot>
                  <tr class="text-center">
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Kode</th>
                    <th>Pengajuan</th>
                    <th>Keterangan</th>
                    <th>Oleh</th>
                    <th>Nominal</th>
                    <th>Status</th>
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
<!-- Modal script -->

<!-- Modal Tambah Pengguna -->
<div class="modal fade" id="modal-xl">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Formulir Pengajuan Dana</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="proses.php" method="POST"enctype="multipart/form-data" class="form-horizontal">
        <div class="modal-body">
            <div class="card-body">
              <div class="form-group row">
                <label for="Judul"class="col-sm-2 col-form-label">Judul</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="Judul"name="nm" placeholder="Masukan Judul" required>
                  <input type="hidden" class="form-control" id="Judul"name="id" placeholder="Masukan Judul" value="<?php echo $user['iduser']; ?>">
                </div>
              </div>
              <div class="form-group row">
                <label for="Tanggal"class="col-sm-2 col-form-label">Tanggal</label>
                <div class="col-sm-10">
                <input type="date" class="form-control" id="Tanggal"name="tg" placeholder="Tanggal" required>
              </div>
              </div>
              <div class="form-group row">
                <label for="Keterangan"class="col-sm-2 col-form-label">Keterangan</label>
                <div class="col-sm-10">
                <textarea name="kt" id="ket"class="form-control" placeholder="Masukan Keterangan Singkat Pengajuan"required></textarea>
                </div>
              </div>
              <div class="form-group row">
                <label for="Nominal"class="col-sm-2 col-form-label">Nominal</label>
                <div class="col-sm-10">
                <input type="number" class="form-control" id="Nominal"name="nl" placeholder="Nominal" required>
                </div>
              </div>
              <div class="form-group row">
                <label for="Nominal"class="col-sm-2 col-form-label">Kategori</label>
                <div class="col-sm-10">
                <select name="ktr" id="ktr" class="form-control">
                  <option value="">-- Pilih Kategori --</option>
                  <?php
                  foreach ($kpr as $kp) :
                    echo'<option value="'.$kp['kpr_id'].'">'.$kp['kpr_nama'].'</option>';
                  endforeach;
                  ?>
                </select>
                </div>
              </div>
              <div class="form-group row">
                <label for="File"class="col-sm-2 col-form-label">Pendukung</label>
                <div class="col-sm-10">
                <input type="file" class="form-control" id="fl"name="fl"accept=".pdf">
                </div>
              </div>
            </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
          <button type="submit" name="AjuPengajuan"class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- End Tambah Pengguna -->

