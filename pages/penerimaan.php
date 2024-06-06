<?php
    $aktif="Transaksi";
    require "koneksi.php";
    include "sidebar.php";
    $no = 1;
    $dt =$kon->query("select * from penerimaan join pengguna on penerimaan.pg_id=pengguna.pg_id ORDER BY pnm_kd DESC;");
    $us =  $_SESSION["username"];
  $pgn = $kon->query("SELECT * FROM pengguna WHERE username='$us'");
   
    ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Penerimaan</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Penerimaan</li>
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
                    <h4 class="card-title mb-0">Daftar Penerimaan</h4>
                    <div>
                    <button type="button" class="btn  btn-outline-info" data-toggle="modal" data-target="#modal-xl"><i class="far fa-plus-square"></i> Hibah/Bantuan</button>
                      <a href="index.php?page=pembayaran-siswa" class="btn  btn-outline-info" ><i class="far fa-plus-square"></i> Pembayaran Siswa</a>
                    </div>
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
                    <th>Jenis</th>
                    <th>Keterangan</th>
                    <th>Nominal</th>
                    <th>Dari</th>
                    <th>Penerima</th>
                    <th>Opsi</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php foreach ($dt as $d) :
                  ?>
                  <tr>
                    <td><?= $no++;?></td>
                    <td class="text-nowrap"><?= $d['pnm_tanggal'];?></td>
                    <td><?= $d['pnm_kd'];?></td>
                    <td><?= $d['pnm_jenis'];?></td>
                    <td><?= $d['pnm_ket'];?></td>
                    <td><?= $d['pnm_nominal'];?></td>
                    <td><?php 
                      if (empty($d['kpn_id'])) 
                        {echo $d['pnm_nama'];} 
                      else {
                          $cek = $kon -> query("SELECT*FROM detailpenerimaan WHERE pnm_kd='{$d['pnm_kd']}'");
                          foreach ($cek as $ce):
                          echo $ce['sw_kd'].' | '.$d['pnm_nama'].'';
                          endforeach;}?>
                    </td>
                    <td><?= $d['pg_nama'];?></td>
                    <td>
                    <?php
                      if (!empty($d['kpn_id'])) {
                        $bk = "bkpb.php?kode=";
                      } else {
                        $bk = "bkpd.php?kode=";
                      }
                    ?>
                    <a href= "<?php echo $bk.$d['pnm_kd']; ?>"class="btn btn-primary btn-xs" onclick="center(this.href,'jendela','900','500','yes');return false"><i class="fas fa-print"></i></a>
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
                    <th>Dari</th>
                    <th>Penerima</th>
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
<!-- Modal Tambah Pengguna -->
<div class="modal fade" id="modal-xl">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Penerimaan Hibah / Bantuan</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="proses.php" method="POST" enctype="multipart/form-data" class="form-horizontal">
            <div class="modal-body">
                <div class="card-body">
                <div class="form-group row">
                  <label class="col-sm-2">Tanggal</label>
                  <div class="col-sm-10">
                      <input type="date" class="form-control" name="tg" placeholder="Tanggal" required>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2">Pembayaran</label>
                  <div class="col-sm-10">
                  <select name="jn"id="kategori"class="form-control" required>
                      <option value="">Pilih Jenis Penerimaan</option>
                      <option value="Sumbangan">Sumbangan</option>
                      <option value="Hibah">Hibah</option>
                      <option value="Bantuan">Bantuan</option>
                      <option value="Lain-lain">Lain-lain</option>
                      
                  </select>
                  <?php foreach ($pgn as $pg) : $id=$pg['pg_id'];?>
                   <input type="hidden" name="pg" id="pg" value="<?=$id;?>">
                  <?php endforeach;?>
                  </div>
              </div>
              <div class="form-group row">
                  <label class="col-sm-2">Nominal</label>
                  <div class="col-sm-10">
                      <input type="number" class="form-control " name="nl" placeholder="Nominal Hibah / Bantuan" required>
                  </div>
              </div>
              <div class="form-group row">
                  <label class="col-sm-2">Donatur</label>
                  <div class="col-sm-10">
                      <input type="text" class="form-control" name="nm" placeholder="Nama Donatur / Pemberi" required>
                  </div>
              </div>
              <div class="form-group row">
                  <label class="col-sm-2">Keterangan</label>
                  <div class="col-sm-10">
                    <textarea  class="form-control" name="kt" placeholder="Keterangan Singkat" required cols="30" rows="5"></textarea>  
                  </div>
              </div>
              </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                <button type="submit" name="SimpanSPN" class="btn btn-primary">Simpan</button>
            </div>
        </form>

    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- End Tambah Pengguna -->