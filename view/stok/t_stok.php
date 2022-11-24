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
                    <h2>Tambah Data Stok</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <form action="p_stok.php" method="POST" class="form-horizontal form-label-left input_mask">
                      <div class="form-group">
                        <label class="control-label col-md-2 col-sm-3 col-xs-12">ID Barang :</label>
                        <div class="col-md-4 col-sm-9 col-xs-12">
                          <?php
                          $result3 = mysqli_query($db, "select * from barang"); 
                          $jsps3 = "var did3 = new Array();\n"; 
                          echo '<select name="id_barang" class="form-control" style="width:40%;" onchange="changeValue(this.value)">'; 
                            echo '<option>Silakan Pilih</option>'; 
                            while ($row3 = mysqli_fetch_array($result3)) { 
                                echo '<option value="' . $row3['id_barang'] . '">' . $row3['id_barang'] . '</option>'; 
                                $jsps3 .= "did3['" . $row3['id_barang'] . "'] = {nama_barang:'" . addslashes($row3['nama_barang']) .  "'};\n"; 
                            } 
                          echo '</select></br>'; 
                          ?>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-2 col-sm-3 col-xs-12">Nama Barang :</label>
                        <div class="col-md-4 col-sm-9 col-xs-12">
                          <input name="nama_barang" type="text" id="nama_barang" required readonly class="form-control">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-2 col-sm-3 col-xs-12">Jumlah Masuk :</label>
                        <div class="col-md-4 col-sm-9 col-xs-12">
                          <input name="jml_masuk" type="number" min="0" required class="form-control">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-2 col-sm-3 col-xs-12">Junlah Keluar :</label>
                        <div class="col-md-4 col-sm-9 col-xs-12">
                          <input name="jml_keluar" required type="number" min="0" class="form-control">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-2 col-sm-3 col-xs-12">Total Barang :</label>
                        <div class="col-md-4 col-sm-9 col-xs-12">
                          <input name="total_barang" min="0" type="number" class="form-control">
                        </div>
                      </div>
                      <div class="form-group">
                          <button type="submit" class="btn btn-success" name="submit" style="margin-right: 955px;">Submit</button>
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
          <div class="clearfix"></div>
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

<!-- mengambil data nama barang -->
  <script type="text/javascript"> 
    <?php echo $jsps3; ?>
    function changeValue(id_barang){
    document.getElementById('nama_barang').value  = did3[id_barang].nama_barang;
    };
  </script>
  </body>
</html>