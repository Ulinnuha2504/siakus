<?php
$aktif = 'Mutasi';
require 'koneksi.php';
include 'sidebar.php';
$no = 1;

$dm = $kon->query("SELECT pgr_tanggal AS tanggal, pgr_ket AS keterangan, NULL AS masuk,pgr_nominal AS keluar 
FROM pengeluaran 
UNION 
SELECT pnm_tanggal AS tanggal, pnm_ket AS keterangan, pnm_nominal AS masuk, NULL AS keluar
FROM penerimaan 
ORDER BY tanggal ASC");
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Mutasi Keuangan</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Mutasi</li>
                </ol>
            </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <section class="content">
    <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
              <div class="d-flex justify-content-between align-items-center mb-3">
                    <h3 class="card-title mb-0">MUTASI KEUANGAN</h3>
              </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped table-sm ">
                  <thead>
                  <tr class="text-center">
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Keterangan</th>
                    <th>Masuk</th>
                    <th>Keluar</th>
                    <th>Saldo</th>
                  </tr>
                  </thead>
                <tbody>
                  
                  <?php
                    foreach($dm as $d):
                      $tanggal = DateTime::createFromFormat('Y-m-d', $d['tanggal'])->format('d-m-Y');
                      if (!empty($d['masuk'])) {
                        $mutasi += $d['masuk'];
                        $tb ='table-success';
                    }
                    if (!empty($d['keluar'])) {
                        $mutasi -= $d['keluar'];
                        $tb ='table-danger';
                    }
                      echo'<tr class="'.$tb.'">
                      <td>'.$no++.'</td>
                      <td class="text-center">'.$tanggal.'</td>
                      <td>'.$d['keterangan'].'</td>
                      <td class="text-center">Rp '.number_format($d['masuk'], 0, ',', '.').'</td>
                      <td class="text-center">Rp '.number_format($d['keluar'], 0, ',', '.').'</td>
                      <td class="text-center">Rp '.number_format($mutasi, 0, ',', '.').'</td>
                      
                      </tr>
                      ';
                    endforeach;
                  ?>
                  </tr>
                </tbody>
                  <tfoot>
                  <tr class="text-center">
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Keterangan</th>
                    <th>Masuk</th>
                    <th>Keluar</th>
                    <th>Saldo</th>
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
    </section>
</div>