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
                    <h2>Edit Barang Masuk</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <?php
                    include '../koneksi/config.php';
                    $data=mysqli_fetch_array(mysqli_query($db, "SELECT * FROM barang_masuk WHERE id_barang = '$_GET[id_barang]'"));
                    ?>
                    ?>
                    <form action="e_barang_masuk.php" method="POST" class="form-horizontal form-label-left input_mask">
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
                          <input name="nama_barang" type="text" id="nama_barang" readonly value="<?php echo$data['nama_barang']?>" required class="form-control">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-2 col-sm-3 col-xs-12">Jumlah Masuk :</label>
                        <div class="col-md-4 col-sm-9 col-xs-12">
                          <input name="jml_masuk" type="number" min="0" value="<?php echo$data['jml_masuk']?>" required class="form-control">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-2 col-sm-3 col-xs-12">Tanggal Masuk :</label>
                        <div class="col-md-4 col-sm-9 col-xs-12">
                          <input name="tgl_masuk" required type="date" value="<?php echo$data['tgl_masuk']?>" class="form-control">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-2 col-sm-3 col-xs-12">ID Suplier</label>
                        <div class="col-md-4 col-sm-9 col-xs-12">
                          <select name="id_suplier" class="form-control" required><option value="">Pilih</option>
                          <?php
                            $result = mysqli_query($db, "SELECT * FROM suplier");
                            while ($row=mysqli_fetch_array($result)) 
                          {
                            echo "<option value='".$row['id_suplier']."'>".$row['id_suplier']." - ".$row['nama_suplier']." - ".$row['alamat_suplier']."</option>";
                          }
                          ?>
                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                          <a href="barang_masuk.php" class="btn btn-dark" type="submit">Kembali</a>
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
<!-- mengambil data nama barang -->
  <script type="text/javascript"> 
    <?php echo $jsps3; ?>
    function changeValue(id_barang){
    document.getElementById('nama_barang').value  = did3[id_barang].nama_barang;
    };
  </script>

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