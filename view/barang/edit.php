<?php 
  include'../koneksi/config.php';
session_start();
if ($_SESSION['status']!="login") {
  header("location:../../index.php?pesan=belum_login");
}
?><!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Iventaris</title>

    <!-- Bootstrap -->
    <link href="../../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../../vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- jQuery custom content scroller -->
    <link href="../../vendors/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.min.css" rel="stylesheet"/>

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
            <div class="row">
              <div class="col-md-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Edit Barang</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                    <?php
                    include '../koneksi/config.php';
                    $data=mysqli_fetch_array(mysqli_query($db, "SELECT * FROM barang WHERE id_barang = '$_GET[id_barang]'"));
                    ?>
                    <form action="e_barang.php" method="POST" class="form-horizontal form-label-left input_mask">
                      <div class="form-group">
                        <label class="control-label col-md-2 col-sm-3 col-xs-12">ID Barang :</label>
                        <div class="col-md-4 col-sm-9 col-xs-12">
                          <input name="id_barang" type="text" value="<?php echo $data['id_barang'] ?>" readonly class="form-control" style="background-color: #e6e6fa; width: 40%;">
                        </div>
                        <label class="control-label col-md-2 col-sm-3 col-xs-12">Kondisi :</label>
                        <div class="col-md-4 col-sm-9 col-xs-12">
                          <select name="kondisi" class="form-control" required>
                            <option value="">Pilih</option>
                            <option <?php if($data['kondisi'] == 'Baik'){ echo 'selected';} ?>>Baik</option>
                            <option <?php if($data['kondisi'] == 'Rusak'){ echo 'selected';} ?>>Rusak</option>
                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-2 col-sm-3 col-xs-12">Nama Barang :</label>
                        <div class="col-md-4 col-sm-9 col-xs-12">
                          <input name="nama_barang" type="text" value="<?php echo$data['nama_barang']?>" required class="form-control">
                        </div>
                        <label class="control-label col-md-2 col-sm-3 col-xs-12">Jumlah Barang :</label>
                        <div class="col-md-4 col-sm-9 col-xs-12">
                          <input name="jumlah_barang" type="number" min="0" value="<?php echo$data['jumlah_barang']?>" required class="form-control">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-2 col-sm-3 col-xs-12">Spesifikasi :</label>
                        <div class="col-md-4 col-sm-9 col-xs-12">
                          <input name="spesifikasi" required type="text" value="<?php echo$data['spesifikasi']?>" class="form-control">
                        </div>
                        <label class="control-label col-md-2 col-sm-3 col-xs-12">Sumber Dana :</label>
                        <div class="col-md-4 col-sm-9 col-xs-12">
                          <input name="sumber_dana" type="text" value="<?php echo$data['sumber_dana']?>" class="form-control">
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-md-4 col-sm-9 col-xs-12">
                          <input type="hidden" name="lokasi" value="Gudang">
                        </div>
                      </div>
                      <div class="form-group">
                          <a href="barang.php" class="btn btn-dark">Kembali</a>
                          <button type="submit" onclick="return confirm('Anda yakin ingin mengubah data ?')" class="btn btn-success" name="submit" style="margin-left: 5px;">Submit</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->
        
        <!-- footer content -->
        <footer>
          <div class="pull-right">
            Sarana dan Prasarana SMK
          </div>
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