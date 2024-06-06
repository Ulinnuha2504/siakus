<?php
    $aktif="Master";
    require "koneksi.php";
    include "sidebar.php";
    $no  = 1;
    $sql = $kon->query("SELECT MAX(sw_kd) as terbesar FROM siswa");
    $sq  = mysqli_fetch_array($sql);
    $bs  = $sq['terbesar'] + 1;
    $sw  = $kon->query("SELECT * FROM siswa");
    
?>
<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Siswa</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Siswa</li>
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
                    <h4 class="card-title mb-0">Data Siswa</h4>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-xl">Tambah Siswa</button>
              </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-sm table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Kode</th>
                    <th>Nama</th>
                    <th>Jenis Kelamin</th>
                    <th>Alamat</th>
                    <th>Kontak</th>
                    <th>Kelas</th>
                    <th>Opsi</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php foreach ($sw as $s) :
                    $id = $s['sw_kd'];
                    $kl= $kon->query("SELECT kl_nama FROM kelas WHERE kl_id='{$s['kl_id']}'");
                    $k = $kl->fetch_assoc();
                    ?>
                  <tr>
                    <td scope="row" class="text-center"><?= $no++; ?></td>
                    <td><?= $s['sw_kd']; ?></td>
                    <td><?= $s['sw_nama']; ?></td>
                    <td><?= $s['sw_jk']; ?></td>
                    <td><?= $s['sw_alamat']; ?></td>
                    <td><?= $s['sw_kontak']; ?></td>
                    <td><?= $k['kl_nama']; ?></td>
                    <td>
                        <form action="proses.php" method="post">
                            <input type="hidden" name="id" value="<?= $id;?>">
                            <button type="button" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#Edit-modal-xs<?= $id; ?>"><i class="fas fa-pen"></i></button>
                            <!-- Modal Edit Pengguna -->
                            <div class="modal fade" id="Edit-modal-xs<?= $id; ?>">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Edit Data Siswa</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <?php 
                                        $edt = $kon->query("SELECT * FROM siswa inner join kelas on siswa.kl_id=kelas.kl_id WHERE sw_kd='$id'");
                                        foreach ($edt as $ed) :
                                        ?>
                                        <div class="modal-body">
                                            <div class="card-body">
                                                <div class="form-group row">
                                                    <label for="exampleInputName"class="col-sm-2 col-form-label">Kode Siswa</label>
                                                    <div class="col-sm-10">
                                                      <input type="text" name="kd"class="form-control"value="<?= $ed['sw_kd']; ?>" id="exampleInputName"name="kd" readonly>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="exampleInputName"class="col-sm-2 col-form-label">Nama Siswa</label>
                                                    <div class="col-sm-10">
                                                      <input type="text" class="form-control"value="<?= $ed['sw_nama']; ?>" id="exampleInputName"name="nm" required>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="exampleInputName"class="col-sm-2 col-form-label">Jenis Kelamin</label>
                                                    <div class="col-sm-10">
                                                      <select name="jk" class="form-control"required>
                                                          <option value="Laki-laki" <?php if($ed['sw_jk'] == "Laki-laki") echo "selected"; ?>>Laki-laki</option>
                                                          <option value="Perempuan" <?php if($ed['sw_jk'] == "Perempuan") echo "selected"; ?>>Perempuan</option>
                                                      </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="exampleInputName"class="col-sm-2 col-form-label">Alamat</label>
                                                    <div class="col-sm-10">
                                                      <textarea name="al" class="form-control" required><?= $ed['sw_alamat']; ?></textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="exampleInputName"class="col-sm-2 col-form-label">Kontak</label>
                                                    <div class="col-sm-10">
                                                      <input type="text" class="form-control"value="<?= $ed['sw_kontak']; ?>" id="exampleInputName"name="kt" required>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="exampleInputName"class="col-sm-2 col-form-label">Kelas</label>
                                                    <div class="col-sm-10">
                                                      <select name="kl" id="kelas" class="form-control">
                                                      <?php 
                                                      $kl = $kon->query("SELECT * FROM kelas");
                                                      foreach ($kl as $k): ?>
                                                          <option value="<?= $k['kl_id']; ?>" <?php if($ed['kl_id'] == $k['kl_id']) echo "selected"; ?>>
                                                              <?= $k['kl_nama']; ?> 
                                                          </option>
                                                      <?php endforeach; ?>
                                                      </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php endforeach;?>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                                            <button type="submit" name="EditSiswa" class="btn btn-primary">Simpan</button>
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                            <!-- End Modal Edit Pengguna -->
                            <!-- <button type="submit" name="HapusKelas"class="btn btn-danger btn-xs"><i class="fas fa-trash"></i></button> -->
                        </form>
                    </td>
                  </tr>
                  <?php endforeach;?>
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>No</th>
                    <th>Kode</th>
                    <th>Nama</th>
                    <th>Jenis Kelamin</th>
                    <th>Alamat</th>
                    <th>Kontak</th>
                    <th>Kelas</th>
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
<!-- Modal Tambah Siswa -->
<div class="modal fade" id="modal-xl">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Tambah Data Siswa</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="proses.php" method="POST">
        <div class="modal-body">
          <div class="card-body">
            <div class="form-group row">
                <label for="exampleInputName"class="col-sm-2 col-form-label">Kode Siswa</label>
                <div class="col-sm-10">
                  <input type="text" name="kd"class="form-control"id="exampleInputName" value="<?= $bs;?>" readonly>
                </div>
            </div>
            <div class="form-group row">
                <label for="NamaSiswa"class="col-sm-2 col-form-label">Nama Siswa</label>
                <div class="col-sm-10">
                  <input type="text" name="nm"class="form-control"id="NamaSiswa" placeholder="Masukan Nama Siswa"required>
                </div>
            </div>
            <div class="form-group row">
                <label for="JenisKelamin"class="col-sm-2 col-form-label">Jenis Kelamin</label>
                <div class="col-sm-10">
                  <select name="jk" id="jeniskelamin"class="form-control" required>
                    <option value="">-- Pilih Jenis Kelamin --</option>
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                  </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="Alamat"class="col-sm-2 col-form-label">Alamat</label>
                <div class="col-sm-10">
                  <textarea name="al" id="Alamat" class="form-control" placeholder="Masukan Alamat Siswa"required></textarea>
                </div>
            </div>
            <div class="form-group row">
                <label for="Kontak"class="col-sm-2 col-form-label">Kontak</label>
                <div class="col-sm-10">
                  <input type="text" name="kt"class="form-control"id="Kontak" placeholder="Masukan Kontak Siswa / Orang Tua Wali Siswa"required>
                </div>
            </div>
            <div class="form-group row">
              <label for="Kelas"class="col-sm-2 col-form-label">Kelas</label>
              <div class="col-sm-10">
                <select name="kl" id="kelas"class="form-control" required>
                  <option value="">-- Pilih Kelas --</option>
                  <?php foreach ($kl as $k): 
                    echo'<option value="'.$k['kl_id'].'">'.$k['kl_nama'].'</option>';
                  endforeach;
                  ?>
                </select>
              </div>
            </div>
            
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
          <button type="submit" name="TambahSiswa"class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- End Tambah Siswa -->