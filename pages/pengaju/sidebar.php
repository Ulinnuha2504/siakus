
<?php
 $imgkosong = "dist/img/nophoto.png";
 $imgdir    = "dist/img/";
 $squser    = $kon->query("SELECT pg_id as iduser FROM pengguna WHERE username='{$_SESSION['username']}'");
 $user      = mysqli_fetch_array($squser);
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
            <a href="index.php?page=profile" class="nav-link <?php if ($aktif == 'User') { echo 'active'; } ?>">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Profil
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="index.php?page=pengajuan" class="nav-link <?php if ($aktif == 'Pengajuan') { echo 'active'; } ?>">
              <i class="nav-icon fas fa-paper-plane"></i>
              <p>
                Pengajuan
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>