<?php
$aktif="User";
require "koneksi.php";
include "sidebar.php";
$no = 1;
$pgn = $kon->query("SELECT * FROM pengguna");
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Pengguna</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Pengguna</li>
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
                    <h4 class="card-title mb-0">Data Pengguna</h4>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-xl">Tambah Pengguna</button>
              </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive">
                <table id="example1" class="table table-hover text-nowrap">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Opsi</th>
                    <th>Foto</th>
                    <th>Nama Pengguna</th>
                    <th>Email</th>
                    <th>Penanggung Jawab</th>
                    <th>Username</th>
                    <th>Level</th>
                    <th>Status</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php foreach ($pgn as $pg) :
                    $id = $pg['pg_id'];
                    ?>
                  <tr>
                    <td scope="row" class="text-center"><?= $no++; ?></td>
                    <td>
                      <form action="proses.php" method="post">
                          <input type="hidden" name="id" value="<?= $id; ?>"> <!-- Menyimpan nilai ID di dalam input hidden -->
                          <button type="button" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#Edit-modal-xs<?= $id; ?>"><i class="fas fa-pen"></i></button>
                          <!-- Modal Edit Pengguna -->
                          <div class="modal fade" id="Edit-modal-xs<?= $id; ?>">
                              <div class="modal-dialog modal-xs">
                                  <div class="modal-content">
                                      <div class="modal-header">
                                          <h4 class="modal-title">Edit Data Pengguna</h4>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                              <span aria-hidden="true">&times;</span>
                                          </button>
                                      </div>
                                      <?php 
                                      $edt = $kon->query("SELECT * FROM pengguna WHERE pg_id='$id'");
                                      foreach ($edt as $ed) :
                                      ?>
                                      <div class="modal-body">
                                          <div class="card-body">
                                              <div class="form-group">
                                                  <label for="exampleInputName">Nama</label>
                                                  <input type="text" class="form-control" id="exampleInputName" name="nm" placeholder="Masukan Nama" value="<?= $ed['pg_nama']; ?>" required>
                                              </div>
                                              <div class="form-group">
                                                  <label for="exampleInputeEmail">Email</label>
                                                  <input type="text" class="form-control" id="exampleInputEmail" name="kt" placeholder="Email" value="<?= $ed['pg_kontak']; ?>" required>
                                              </div>
                                              <div class="form-group">
                                                  <label for="Penanggungjawab">Penanggung Jawab</label>
                                                  <input type="text" class="form-control" id="Penanggungjawab" name="pj" placeholder="Penanggung Jawab" value="<?= $ed['pg_pj']; ?>" required>
                                              </div>
                                              <div class="form-group">
                                                  <label for="exampleInputUsername">Username</label>
                                                  <input type="text" class="form-control" id="exampleInputUsername" placeholder="Username" value="<?= $ed['username']; ?>" disabled>
                                              </div>
                                              <div class="form-group">
                                                  <label for="exampleInputLevel">Level</label>
                                                  <select name="lv" id="exampleInputLevel" class="form-control" required>
                                                      <option value="<?= $ed['pg_level']; ?>"><?= $ed['pg_level']; ?></option>
                                                      <option value="Administrator">Administrator</option>
                                                      <option value="Kepala Sekolah">Kepala Sekolah</option>
                                                      <option value="Keuangan">Keuangan</option>
                                                      <option value="Pengaju">Pengaju</option>
                                                  </select>
                                              </div>
                                          </div>
                                      </div>
                                      <?php endforeach;?>
                                      <div class="modal-footer">
                                          <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                                          <?php
                                          if ($pg['pg_status']=='0') {
                                            echo'<button type="submit" class="btn btn-success" name="AktifkanAkun"><i class="fas fa-power-off"></i>&nbsp Aktifkan Akun</button>';
                                          }elseif ($pg['pg_status'] == '1' || $pg['pg_status'] == '2')  {
                                            echo'<button type="submit" class="btn btn-danger" name="MatikanAkun"><i class="fas fa-power-off"></i>&nbsp Matikan Akun</button>';
                                          }
                                          ?>
                                          <button type="submit" name="submitEditPengguna" class="btn btn-primary">Simpan</button>
                                      </div>
                                  </div>
                                  <!-- /.modal-content -->
                              </div>
                              <!-- /.modal-dialog -->
                          </div>
                          <!-- End Modal Edit Pengguna -->

                          <button type="submit" name="submitResPassword" class="btn btn-success btn-xs" title="Reset Password"><i class="fas fa-key"></i></button>
                          <!-- <button type="submit" name="submitHapusData" class="btn btn-danger btn-xs" title="Hapus Data"><i class="fas fa-trash"></i></button> -->
                      </form>
                  </td>
                    <td>
                      <?php 
                      if (file_exists($imgdir . $pg['username'].'.jpg')) {
                      echo '<img width="50px"src="'.$imgdir . $pg['username'].'.jpg" alt="">';
                      } else {
                        echo'<img width="50px"src="'.$imgkosong.'" alt="">';
                      };?>
                      
                     </td>
                    <td><?= $pg['pg_nama']; ?></td>
                    <td><?= $pg['pg_kontak']; ?></td>
                    <td><?= $pg['pg_pj']; ?></td>
                    <td><?= $pg['username']; ?></td>
                    <td><?= $pg['pg_level']; ?></td>
                    <td>
                      <?php
                            if ($pg['pg_status']=='0') {
                              echo'Tidak Aktif';
                            } elseif($pg['pg_status']=='1') {
                              echo'Aktif';
                            } elseif($pg['pg_status']=='2') {
                              echo'Lupa Password';
                            }
                      ?>
                    </td>
                  </tr>
                  <?php endforeach;?>
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>No</th>
                    <th>Opsi</th>
                    <th>Foto</th>
                    <th>Nama Pengguna</th>
                    <th>Email</th>
                    <th>Penanggung Jawab</th>
                    <th>Username</th>
                    <th>Level</th>
                    <th>Status</th>
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

<!-- Modal Tambah Pengguna -->
<div class="modal fade" id="modal-xl">
  <div class="modal-dialog modal-xs">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Tambah Data Pengguna</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="proses.php" method="POST">
        <div class="modal-body">
            <div class="card-body">
              <div class="form-group">
                <label for="exampleInputName">Nama</label>
                <input type="text" class="form-control" id="exampleInputName"name="nm" placeholder="Masukan Nama" required>
              </div>
              <div class="form-group">
                <label for="exampleInputeEmail">Email</label>
                <input type="email" class="form-control" id="exampleInputEmail"name="em" placeholder="Email" required>
              </div>
              <div class="form-group">
                <label for="PenangguJawab">Email</label>
                <input type="text" class="form-control" id="PenangguJawab"name="pj" placeholder="Penanggung Jawab" required>
              </div>
              <div class="form-group">
                <label for="exampleInputUsername">Username</label>
                <input type="text" class="form-control" id="exampleInputUsername"name="us" placeholder="Username" required>
              </div>
              <div class="form-group">
                <label for="exampleInputLevel">Level</label>
                <select name="lv" id="exampleInputLevel"class="form-control" required >
                  <option value="">-- Level --</option>
                  <option value="Administrator">Administrator</option>
                  <option value="Kepala Sekolah">Kepala Sekolah</option>
                  <option value="Keuangan">Keuangan</option>
                  <option value="Pengaju">Pengaju</option>
                </select>
              </div>
            </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
          <button type="submit" name="submitAddPengguna"class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- End Tambah Pengguna -->
 
<!-- Modal script -->


