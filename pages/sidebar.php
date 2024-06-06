
<?php
 $imgkosong = "dist/img/nophoto.png";
 $imgdir    = "dist/img/";
?>
<title>SIAKUS | <?= $aktif; ?></title>
<aside class="main-sidebar sidebar-dark-warning bg-success disabled elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="dist/img/Yafalah_1.png" alt="YPI Al-Falahiyah" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">SIAKUS V 1.0</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
        <img class="profile-user-img img-fluid img-circle"
          src="<?php 
          if (file_exists($imgdir . $_SESSION['username'].'.jpg')) {
          echo $imgdir . $_SESSION['username'].'.jpg';
          } else {
          echo $imgkosong;
          };?>"
          alt="User profile picture">
        </div>
        <div class="info">
          <a href="index.php?page=profile" class="d-block"><?= $_SESSION['nama']?></a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="index.php" class="nav-link <?php if ($aktif == 'Dashboard') { echo 'active'; } ?>">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="index.php?page=profile" class="nav-link <?php if ($aktif == 'Profil') { echo 'active'; } ?>">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Profil
              </p>
            </a>
          </li>
          <?php 
          if ($_SESSION["level"] == "Administrator") {
              echo '<li class="nav-item">';
              echo '<a href="index.php?page=datapengguna" class="nav-link ' . ($aktif == 'User' ? 'active' : '') . '">';
              echo '<i class="nav-icon fas fa-users"></i>';
              echo '<p>Pengguna</p>';
              echo '</a>';
              echo '</li>';
          }
          ?>
          <li class="nav-item">
            <a href="#" class="nav-link <?php if ($aktif == 'Master') { echo 'active'; } ?>">
              <i class="nav-icon fas fa-database"></i>
              <p>
                Master Data
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="index.php?page=kelas" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Kelas</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?page=siswa" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Siswa</p>
                </a>
              </li>
              <!-- <li class="nav-item">
                <a href="index.php?page=karyawan" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Karyawan</p>
                </a>
              </li> -->
              <li class="nav-item">
                <a href="index.php?page=kt-penerimaan" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Kategori Penerimaan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?page=kt-pengeluaran" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Kategori Pengeluaran</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="index.php?page=pengajuan" class="nav-link <?php if ($aktif == 'Pengajuan') { echo 'active'; } ?>">
              <i class="nav-icon fas fa-paper-plane"></i>
              <p>
                Pengajuan
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link <?php if ($aktif == 'Transaksi') { echo 'active'; } ?>">
              <i class="nav-icon fas fa-money-bill"></i>
              <p>
                Transaksi
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="index.php?page=penerimaan" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Penerimaan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?page=pengeluaran" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pengeluaran</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="index.php?page=laporan" class="nav-link <?php if ($aktif == 'Laporan') { echo 'active'; } ?>">
            <i class="nav-icon fas fa-copy"></i>
              <p>
                Laporan
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="index.php?page=mutasi" class="nav-link <?php if ($aktif == 'Mutasi') { echo 'active'; } ?>">
            <i class="nav-icon fas fa-sync-alt"></i>
              <p>
                Mutasi
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>