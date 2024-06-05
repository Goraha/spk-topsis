<?php
session_start();

?>
<!-- Navigation -->
  <nav class="navbar navbar-inverse navbar-fixed-top" id="menu-atas" role="navigation">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index.php">
        <img style="width: 40px; height: 40px;" src="../../asset/img/logo/logo-app.png">
      </a>
    </div>

    <!-- menu Atas -->
    <ul class="nav navbar-right top-nav">          
      <li>
        <a href="#"><b><i class="fa fa-user"></i> | <?php echo $_SESSION['username'] ?></b></a>   
      </li>
    </ul>
    <!-- /Menu Atas -->

    <!-- menu samping -->
    <div class="collapse navbar-collapse navbar-ex1-collapse" >
      <ul class="nav navbar-nav side-nav" id="menu-samping">
        <li>
          <a href="../"><i class="fa fa-home"></i> Beranda</a>
        </li>
        <li>
          <a href="#" data-toggle="collapse" data-target="#submenu-1">
            <i class="fa fa-cubes"></i> Data Aset <i class="fa fa-fw fa-angle-down pull-right"></i>
          </a>
          <ul id="submenu-1" class="collapse">
            <li><a href="../aset/tambah_aset.php"><i class="fa fa-angle-double-right"></i> Tambah Data Aset</a></li>
            <li><a href="../aset/daftar_aset_admin.php"><i class="fa fa-angle-double-right"></i> Daftar Aset</a></li>
            <li><a href="../aset/cetak_aset.php"><i class="fa fa-angle-double-right"></i> Cetak Daftar Aset</a></li>
          </ul>
          <a href="#" data-toggle="collapse" data-target="#submenu-2">
            <i class="fa fa-group"></i> Data Dinas/Kel/Kec <i class="fa fa-fw fa-angle-down pull-right"></i>
          </a>
          <ul id="submenu-2" class="collapse">
            <li><a href="../dinas/daftar_dinas.php"><i class="fa fa-angle-double-right"></i> Data Dinas/SKPD</a></li>
            <li><a href="../kelurahan/daftar_kelurahan.php"><i class="fa fa-angle-double-right"></i> Data Kelurahan</a></li>
            <li><a href="../kecamatan/daftar_kecamatan.php"><i class="fa fa-angle-double-right"></i> Data Kecamatan</a></li>
          </ul>
          <li>
            <a href="../info/info.php"><i class="fa fa-info-circle"></i> Info</a>
          </li>
          <li>
            <a href="../peta/peta_admin.php"><i class="fa fa-map"></i> Lihat Peta Lokasi Aset</a>
          </li>
          <li>
            <a href="../akun/akun.php"><i class="fa fa-user-circle-o"></i> Akun</a>
          </li>
          <li>
            <a href="../logout.php"><i class="fa fa-sign-out"></i> Logout</a>
          </li>
          <li>
            <a href="#">
              <p style="font-size: 85%;">
              -ArisRamadani-1732031-
              </p>
            </a>
          </li>
        </li>
      </ul>
    </div>
    <!-- /menu samping -->
  </nav>
  <!-- /Navigation -->