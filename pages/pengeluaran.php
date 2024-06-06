<?php
    $aktif="Transaksi";
    require "koneksi.php";
    include "sidebar.php";
    $no = 1;
    $dt =$kon->query("SELECT pengeluaran.pgr_kd,pengeluaran.pgr_tanggal, pengeluaran.pgr_ket, pengeluaran.pgr_nominal, kategori_pengeluaran.kpr_nama, pengguna.pg_pj FROM pengeluaran JOIN pengguna ON pengeluaran.pg_id = pengguna.pg_id JOIN pengajuan ON pengeluaran.pgj_kd = pengajuan.pgj_kd JOIN kategori_pengeluaran ON pengajuan.kpr_id = kategori_pengeluaran.kpr_id");
    ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Pengeluaran</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Pengeluaran</li>
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
                <h3 class="card-title">Data Pengeluaran</h3>
                
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped table-sm">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Kode</th>
                    <th>Kategori</th>
                    <th>Keterangan</th>
                    <th>Nominal</th>
                    <th>Petugas</th>
                    <th>Opsi</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php foreach ($dt as $d) :
                      //  $kd = $d['pgr_kd'];
                  ?>
                  <tr>
                    <td><?= $no++;?></td>
                    <td class="text-nowrap"><?= $d['pgr_tanggal'];?></td>
                    <td><?= $d['pgr_kd'];?></td>
                    <td><?= $d['kpr_nama'];?></td>
                    <td><?= $d['pgr_ket'];?></td>
                    <td><?= $d['pgr_nominal'];?></td>
                    <td><?= $d['pg_pj'];?></td>
                    <td>
                    <a href= "<?php echo 'bkpg.php?kode='.$d['pgr_kd']; ?>"class="btn btn-primary btn-xs" onclick="center(this.href,'jendela','900','500','yes');return false"><i class="fas fa-print"></i></a>
                    <!-- <button type="submit" name="" class="btn btn-danger btn-xs" title="Hapus"><i class="fas fa-trash"></i></button> -->
                    </td>
                  </tr>
                  <?php endforeach;?>
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Kode</th>
                    <th>Kategori</th>
                    <th>Keterangan</th>
                    <th>Nominal</th>
                    <th>Petugas</th>
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


