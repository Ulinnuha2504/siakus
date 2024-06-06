<?php
$aktif="Pengajuan";
require "koneksi.php";
include "sidebar.php";
$no = 1;
$pgn = $kon->query("SELECT * FROM pengajuan inner join pengguna on pengajuan.pg_id=pengguna.pg_id");
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
              </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive">
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
                    } elseif ($pg['pgj_status']=='4') {
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
                    <form action="proses.php" method="post">
                          <input type="hidden" name="id" value="<?= $id; ?>"> <!-- Menyimpan nilai ID di dalam input hidden -->
                          <?php
                          if (!empty($pg['pgj_file'])) {
                            echo'<a href="dist/dok/'.$pg['pgj_file'].'" class="btn btn-primary btn-xs"><i class="fas fa-copy"></i></a>';
                          } else {
                            
                          }
                          if ($pg['pgj_status'] == 4) {
                            echo '<button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#Edit-modal-xl'.$id.'" disabled><i class="fas fa-edit"></i></button>';
                          } else {
                            echo '<button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#Edit-modal-xl'.$id.'"><i class="fas fa-edit"></i></button>';
                          }
                          ?>
                          <!-- <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#Edit-modal-xl<?= $id; ?>"><i class="fas fa-edit"></i></button> -->
                          <!-- Modal Edit Pengguna -->  
                          <div class="modal fade" id="Edit-modal-xl<?= $id; ?>">
                              <div class="modal-dialog modal-xs">
                                  <div class="modal-content">
                                      <div class="modal-header">
                                          <h4 class="modal-title">Update Data Pengajuan | <?= $id; ?></h4>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                              <span aria-hidden="true">&times;</span>
                                          </button>
                                      </div>
                                      <?php 
                                      $edt = $kon->query("SELECT * FROM pengajuan inner join pengguna on pengajuan.pg_id=pengguna.pg_id WHERE pgj_kd='$id'");
                                      foreach ($edt as $ed) :
                                      ?>
                                      <div class="modal-body">
                                          <div class="card-body">
                                             <?= $ed['pgj_nama'].' Sebesar <strong> Rp '.number_format($ed['pgj_nominal'], 2, ',', '.').'</strong> Yang diajukan oleh <strong>'.$ed['pg_nama'].'</strong>';?>
                                          </div>
                                      </div>
                                      <?php endforeach;?>
                                      <div class="modal-footer">
                                          <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                                          <button type="submit" name="TolakPengajuan" class="btn btn-danger">Tolak</button>
                                          <button type="submit" name="SetujuiPengajuan" class="btn btn-success">Setujui</button>
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