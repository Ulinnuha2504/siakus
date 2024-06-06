    <?php
    $aktif="Dashboard";
    require "koneksi.php";
    include "sidebar.php";
    $jaa = $kon->query("SELECT COUNT(*) AS semua FROM pengajuan WHERE pg_id='{$user['iduser']}'");
    $jjj = $kon->query("SELECT COUNT(*) AS semua FROM pengajuan WHERE pg_id='{$user['iduser']}' AND pgj_status='0'");
    $jss = $kon->query("SELECT COUNT(*) AS semua FROM pengajuan WHERE pg_id='{$user['iduser']}' AND (pgj_status='1' OR pgj_status='4')");
    $jpp = $kon->query("SELECT COUNT(*) AS semua FROM pengajuan WHERE pg_id='{$user['iduser']}' AND pgj_status='2'");
    $jtt = $kon->query("SELECT COUNT(*) AS semua FROM pengajuan WHERE pg_id='{$user['iduser']}' AND pgj_status='3'");
    $ja  =mysqli_fetch_array($jaa);
    $jj  =mysqli_fetch_array($jjj);
    $js  =mysqli_fetch_array($jss);
    $jp  =mysqli_fetch_array($jpp);
    $jt  =mysqli_fetch_array($jtt);
    ?>
    
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
            <?= $aktif;?>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v1</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-primary">
              <div class="inner">
                <h3><?=$ja['semua'];?></h3>
                <p>Semua Pengajuan</p>
              </div>
              <div class="icon">
                <i class="nav-icon fas fa-copy"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?=$jj['semua'];?></h3>
                <p>Baru Diajukan</p>
              </div>
              <div class="icon">
                <i class="nav-icon fas fa-paper-plane"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?=$js['semua'];?></h3>

                <p>Disetujui</p>
              </div>
              <div class="icon">
                <i class="nav-icon fas fa-check"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><?=$jp['semua'];?></h3>

                <p>Diproses</p>
              </div>
              <div class="icon">
                <i class="nav-icon fas fa-sync-alt"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3><?=$jt['semua'];?></h3>

                <p>Ditolak</p>
              </div>
              <div class="icon">
                  <i class="nav-icon fas fa-times"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-9 col-6">
            <!-- small box -->
            <div class="small-box bg-light">
                <div class="inner">
                    <h3 style="font-size: 2.5vw;">SELAMAT DATANG DI SIAKUS V.1</h3>
                    <p style="font-size: 1.2vw;"><strong><?=$_SESSION['nama'];?></strong>, Anda masuk sebagai pengaju</p>
                </div>
                <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    </div>