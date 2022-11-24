<?php 
  include'../koneksi/config.php';
session_start();
if ($_SESSION['status']!="login") {
  header("location:../../index.php?pesan=belum_login");
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Inventaris</title>

    <!-- Bootstrap -->
    <link href="../../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../../vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- jQuery custom content scroller -->
    <link href="../../vendors/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.min.css" rel="stylesheet"/>
     <!-- Datatables -->
    <link href="../../vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="../../vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="../../vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="../../vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="../../vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="../../build/css/custom.min.css" rel="stylesheet">
  </head>

  <body class="nav-md">
    
        <!-- page navigation -->
          <?php  
            include'../menu/menu.php';
          ?>
        <!-- page navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Data Barang Keluar</h3>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                     <a href="t_barang_keluar.php" type="button" class="btn btn-success">Tambah Data</a>
                  </div>
                  <div class="x_content">
<form action="" method="get">
    <input type="submit" value="Cari" style="background: #26B99A; border-radius: 5px; width: 50px; color: white; height: 40px; float: left; margin:0px 0px 15px 0px;">
    <input type="text" name="cari" style="width: 160px; float: left; margin: 10px 0px 0px 10px;">
    <br>
</form>
  <?php
  if(isset($_GET['cari'])){
    $cari = $_GET['cari'];
    echo "<b>Hasil pencarian : ".$cari."</b>";
  }
  ?>

                    <table id="datatable" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>ID Barang</th>
                          <th>Nama Barang</th>
                          <th>Tanggal Keluar</th>
                          <th>Jumlah Keluar</th>
                          <th>Lokasi</th>
                          <th>Penerima</th>
                          <th width="75">Action</th>
                        </tr>
                      </thead>


                      <tbody>
<?php
if(isset($_GET['cari'])){
  $cari = $_GET['cari'];
  $sql = mysqli_query($db, "SELECT * FROM barang_keluar 
    INNER JOIN barang on barang_keluar.id_barang = barang.id_barang
    where id_barang like '%$cari%' or nama_barang like '%$cari%' or tgl_keluar like '%$cari%' or jml_keluar like '%$cari%'");
}else{
  $sql = mysqli_query($db, "SELECT * FROM barang_keluar 
    INNER JOIN barang on barang_keluar.id_barang = barang.id_barang");
}
  $no = 1;
  while ($data=mysqli_fetch_array($sql)){
?>
                      <tr>
                          <td><?php echo $no ?></td>
                          <td><?php echo $data['id_barang'] ?></td>
                          <td><?php echo $data['nama_barang'] ?></td>
                          <td><?php echo $data['tgl_keluar'] ?></td>
                          <td><?php echo $data['jml_keluar'] ?></td>
                          <td><?php echo $data['lokasi']?></td>
                          <td><?php echo $data['penerima']?></td>
                          <td>
                            <a onclick="return confirm('Anda yakin ingin menghapus data ?')"; href="delete.php?id_barang=<?php echo $data['id_barang'] ?>" class="btn btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
                          </td>
                        </tr>
                        <?php  
                              $no++;
                            }
                        ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
         </footer>
        <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->
    <script src="../../vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="../../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="../../vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="../../vendors/nprogress/nprogress.js"></script>
    <!-- jQuery custom content scroller -->
    <script src="../../vendors/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js"></script>
    <!-- Custom Theme Scripts -->
    <script src="../../build/js/custom.min.js"></script>
  </body>
</html>