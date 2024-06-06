<?php
    $aktif="Master";
    require "koneksi.php";
    include "sidebar.php";
    $no= 1;
    $sql = $kon->query("SELECT MAX(kyw_kd) as terbesar FROM karyawan");
    $sq  = mysqli_fetch_array($sql);
    $tb  = $sq['terbesar'];
    $ur  =(int) substr($tb,3,4);
    $ur++;
    $hrf ="KYW";
    $kdk =sprintf("%04s",$ur);
    $kd  =$hrf.$kdk;
    $dt  =$kon->query("SELECT * FROM karyawan");
?>
<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Karyawan</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Karyawan</li>
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
                    <h4 class="card-title mb-0">Data Karyawan</h4>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-xl">Tambah Karyawan</button>
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
                    <th>Jabatan</th>
                    <th>Opsi</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php foreach ($dt as $d) :
                    $id = $d['kyw_kd'];
                    ?>
                  <tr>
                    <td scope="row" class="text-center"><?= $no++; ?></td>
                    <td><?= $id; ?></td>
                    <td><?= $d['kyw_nama']; ?></td>
                    <td><?= $d['kyw_jk']; ?></td>
                    <td><?= $d['kyw_kontak']; ?></td>
                    <td><?= $d['kyw_alamat']; ?></td>
                    <td><?= $d['kyw_jabatan']; ?></td>
                    <td>
                        <form action="proses.php" method="post">
                            <input type="hidden" name="id" value="<?= $id;?>">
                            <button type="button" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#Edit-modal-xs<?= $id; ?>"><i class="fas fa-pen"></i></button>
                            <!-- Modal Edit Pengguna -->
                            <div class="modal fade" id="Edit-modal-xs<?= $id; ?>">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Edit Data Karyawan</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <?php 
                                        $edt = $kon->query("SELECT * FROM karyawan WHERE kyw_kd='$id'");
                                        foreach ($edt as $ed) :
                                        ?>
                                        <div class="modal-body">
                                            <div class="card-body">
                                                <div class="form-group row">
                                                    <label for="exampleInputName"class="col-sm-2 col-form-label">Kode</label>
                                                    <div class="col-sm-10">
                                                      <input type="text" name="kd"class="form-control"value="<?= $ed['kyw_kd']; ?>" id="exampleInputName"name="kd" readonly>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="exampleInputName"class="col-sm-2 col-form-label">Nama</label>
                                                    <div class="col-sm-10">
                                                      <input type="text" class="form-control"value="<?= $ed['kyw_nama']; ?>" id="exampleInputName"name="nm" required>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="exampleInputName"class="col-sm-2 col-form-label">Jenis Kelamin</label>
                                                    <div class="col-sm-10">
                                                      <select name="jk" class="form-control"required>
                                                          <option value="Laki-laki" <?php if($ed['kyw_jk'] == "Laki-laki") echo "selected"; ?>>Laki-laki</option>
                                                          <option value="Perempuan" <?php if($ed['kyw_jk'] == "Perempuan") echo "selected"; ?>>Perempuan</option>
                                                      </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="exampleInputName"class="col-sm-2 col-form-label">Alamat</label>
                                                    <div class="col-sm-10">
                                                      <textarea name="al" class="form-control" required><?= $ed['kyw_alamat']; ?></textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="exampleInputName"class="col-sm-2 col-form-label">Kontak</label>
                                                    <div class="col-sm-10">
                                                      <input type="text" class="form-control"value="<?= $ed['kyw_kontak']; ?>" id="exampleInputName"name="kt" required>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="exampleInputName"class="col-sm-2 col-form-label">Jabatan</label>
                                                    <div class="col-sm-10">
                                                      <select name="jb" class="form-control"required>
                                                          <option value="Guru" <?php if($ed['kyw_jabatan'] == "Guru") echo "selected"; ?>>Guru</option>
                                                          <option value="Staff" <?php if($ed['kyw_jabatan'] == "Staff") echo "selected"; ?>>Staff</option>
                                                          <option value="Tata Usaha" <?php if($ed['kyw_jabatan'] == "Tata Usaha") echo "selected"; ?>>Tata Usaha</option>
                                                          <option value="Kepala Sekolah" <?php if($ed['kyw_jabatan'] == "Kepala Sekolah") echo "selected"; ?>>Kepala Sekolah</option>
                                                      </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php endforeach;?>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                                            <button type="submit" name="EditKaryawan" class="btn btn-primary">Simpan</button>
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
                    <th>Jabatan</th>
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
<!-- Modal Tambah Karyawan -->
<div class="modal fade" id="modal-xl">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Tambah Data Karyawan</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="proses.php" method="POST">
        <div class="modal-body">
          <div class="card-body">
            <div class="form-group row">
                <label for="exampleInputName"class="col-sm-2 col-form-label">Kode</label>
                <div class="col-sm-10">
                  <input type="text" name="kd"class="form-control"id="exampleInputName" value="<?= $kd;?>" readonly>
                </div>
            </div>
            <div class="form-group row">
                <label for="NamaKaryawan"class="col-sm-2 col-form-label">Nama</label>
                <div class="col-sm-10">
                  <input type="text" name="nm"class="form-control"id="NamaKaryawan" placeholder="Masukan Nama Karyawan"required>
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
                  <textarea name="al" id="Alamat" class="form-control" placeholder="Masukan Alamat Karyawan"required></textarea>
                </div>
            </div>
            <div class="form-group row">
                <label for="Kontak"class="col-sm-2 col-form-label">Kontak</label>
                <div class="col-sm-10">
                  <input type="text" name="kt"class="form-control"id="Kontak" placeholder="Masukan Kontak Karyawan"required>
                </div>
            </div>
            <div class="form-group row">
              <label for="jabatan"class="col-sm-2 col-form-label">Jabatan</label>
              <div class="col-sm-10">
                <select name="jb" id="jabatan"class="form-control" required>
                  <option value="">-- Pilih Jabatan --</option>
                  <option value="Guru">Guru</option>
                  <option value="Kepala Sekolah">Kepala Sekolah</option>
                  <option value="Tata Usaha">Tata Usaha</option>
                  <option value="Staff">Staff</option>
                </select>
              </div>
            </div>
            
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
          <button type="submit" name="TambahKaryawan"class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- End Tambah Karyawan -->