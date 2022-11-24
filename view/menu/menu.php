<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<link href='../../assets/images/images.png' rel='SHORTCUT ICON'/>
    <title>Inventaris</title>

  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col menu_fixed">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="#" class="site_title"><i class="fa fa-institution"></i> <span>Inventaris SMK</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <ul class="nav side-menu">
                  <li><a href="../dashboard/dashboard.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>  
                  <?php  
                    if ($_SESSION['level'] == 'Admin') {
                  ?>
                  <li><a href="../pengguna/pengguna.php"><i class="fa fa-users"></i> Pengguna</a></li>
                  <li><a href="../suplier/suplier.php"><i class="fa fa-truck"></i> Suplier</a></li>
                  <li><a href="../barang/barang.php"><i class="fa fa-archive"></i> Barang</a></li>
                  <li><a href="../peminjam/t_peminjam.php"><i class="fa fa-users"></i> Peminjam</a></li>
                  <li><a href="../detail/detail.php"><i class="fa fa-shopping-cart"></i>Detail Peminjaman Barang</a></li>
                  <?php
                   }
                  ?>
                  <?php  
                    if ($_SESSION['level'] == 'Petugas') {
                  ?>
                  <li><a href="../suplier/suplier.php"><i class="fa fa-truck"></i> Suplier</a></li>  
                  <li><a href="../peminjam/t_peminjam.php"><i class="fa fa-users"></i> Peminjam</a></li>
                  <li><a href="../lokasi/lokasi.php"><i class="fa fa-map-marker"></i> Lokasi</a></li>
                  <li><a href="../barang/barang.php"><i class="fa fa-archive"></i> Barang</a></li>
                  <li><a href="../barang masuk/t_barang_masuk.php"><i class="fa fa-archive"></i> Barang Masuk</a></li>
                  <li><a href="../barang keluar/t_barang_keluar.php"><i class="fa fa-archive"></i> Barang Keluar</a></li>
                  <li><a href="../pinjam barang/pinjam_barang.php"><i class="fa fa-shopping-cart"></i>Pinjam Barang</a>
                  <li><a href="../detail/detail.php"><i class="fa fa-shopping-cart"></i>Detail Peminjaman Barang</a></li>
                  <li><a href="../pengembalian/pengembalian.php"><i class="fa fa-shopping-cart"></i>Pengembalian Barang</a>
                  <li><a href="../laporan/laporan.php"><i class="fa fa-file-pdf-o"></i> Laporan</a></li>
                  <?php
                    }
                  ?>
                </ul>
              </div>

            </div>
            <!-- /sidebar menu -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <?php echo $_SESSION['nama']; ?>
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="../pengguna/edit.php?id_user='<?php echo $_SESSION['id_user'] ?>'"><i class="fa fa-user pull-right"></i> Edit</a></li>
                    <li><a href="../../logout.php"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                  </ul>
                </li>
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->
  </body>
</html>