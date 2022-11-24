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
    <!-- bootstrap-daterangepicker -->
    <link href="../../vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
    <!-- bootstrap-datetimepicker -->
    <link href="../../vendors/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css" rel="stylesheet">

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
                    <h2>Tambah Data Pinjam Barang</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                <?php
                  $sql = mysqli_query($db, "SELECT MAX(id_detail)as newid FROM detail_pinjam_barang");
                  $data = mysqli_fetch_array($sql);
                  $kode = $data['newid'];

                  $no = (int) substr($kode, 2);
                  $no++;
                  $char = 'ID';
                  $newid = $char.sprintf("%003s",$no);
                ?>
                <?php
                    $id_pinjam  = $_GET['id_pinjam'];
                    $data=mysqli_fetch_array(mysqli_query($db, "SELECT * FROM pinjam_barang
                    INNER JOIN pegawai on pinjam_barang.nip = pegawai.nip   
                    WHERE id_pinjam = '$_GET[id_pinjam]'"));
                ?>
                    <form action="p_pinjam.php" method="POST" class="form-horizontal form-label-left input_mask">
                      <div class="form-group">
                        <label class="control-label col-md-2 col-sm-3 col-xs-12">ID Detail :</label>
                        <div class="col-md-4 col-sm-9 col-xs-12">
                          <input name="id_detail" type="text" value="<?php echo $newid ?>" required readonly class="form-control" style="background-color: #e6e6fa; width: 40%;">
                        </div>                        
                        <label class="control-label col-md-2 col-sm-3 col-xs-12">ID Pinjam :</label>
                        <div class="col-md-4 col-sm-9 col-xs-12">
                          <input name="id_pinjam" type="text" value="<?php echo $data['id_pinjam'] ?>" required readonly class="form-control" style="background-color: #e6e6fa; width: 40%;">
                        </div>
                      </div>
                      <div class="form-control">
                        <label class="control-label col-md-2 col-sm-3 col-xs-12">NIP :</label>
                        <div class="col-md-4 col-sm-9 col-xs-12">
                          <?php
                          $result3 = mysqli_query($db, "select * from pegawai"); 
                          $jsps3 = "var did3 = new Array();\n"; 
                          echo '<select name="nip" class="form-control" style="width:40%;" onchange="changeValue(this.value)">'; 
                            echo '<option>- Pilih -</option>'; 
                            while ($row3 = mysqli_fetch_array($result3)) { 
                                echo '<option value="' . $row3['nip'] . '">' . $row3['nip'] . '</option>'; 
                                $jsps3 .= "did3['" . $row3['nip'] . "'] = {nama:'" . addslashes($row3['nama']) .  "'};\n"; 
                            } 
                          echo '</select></br>'; 
                          ?>                        
                        </div>

                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-2 col-sm-3 col-xs-12">Tanggal Pinjam :</label>
                        <div class="col-md-4 col-sm-9 col-xs-12">
                           <div class='input-group date' id='myDatepicker2'>
                            <input type='text' name="tgl_pinjam" value="<?php echo$data['tgl_pinjam']?>" class="form-control" readonly="readonly" />
                            <span class="input-group-addon">
                               <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                      </div>
                       <label class="control-label col-md-2 col-sm-3 col-xs-12">Nama Pegawai :</label>
                        <div class="col-md-4 col-sm-9 col-xs-12">
                          <input type="text" id="nama" readonly required class="form-control">
                        </div>
                    </div>
                      <div class="form-group">
                        <label class="control-label col-md-2 col-sm-3 col-xs-12">Tanggal Kembali :</label>
                        <div class="col-md-4 col-sm-9 col-xs-12">
                           <div class='input-group date' id='myDatepicker3'>
                            <input type='text' name="tgl_kembali" class="form-control" readonly="readonly" />
                            <span class="input-group-addon">
                               <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                        </div>
                        <label class="control-label col-md-2 col-sm-3 col-xs-12">Status Peminjam :</label>
                        <div class="col-md-4 col-sm-9 col-xs-12">
                          <select name="status_peminjam" class="form-control" required>
                            <option value="">- Pilih -</option>
                            <option value="Tersedia">Tersedia</option>
                            <option value="Tidak tersedia">Tidak tersedia</option>
                            </option>
                          </select>
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
    <!-- bootstrap-daterangepicker -->
    <script src="../../vendors/moment/min/moment.min.js"></script>
    <script src="../../vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
    <!-- bootstrap-datetimepicker -->    
    <script src="../../vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="../../build/js/custom.min.js"></script>

<script> 
    $('#myDatepicker2').datetimepicker({
        ignoreReadonly: true,    
        allowInputToggle: true,
        format: 'DD.MM.YYYY'
    });
    $('#myDatepicker3').datetimepicker({
        ignoreReadonly: true,    
        allowInputToggle: true,
        format: 'DD.MM.YYYY'
    });
</script>
<!-- mengambil data nama pegawai -->
  <script type="text/javascript"> 
    <?php echo $jsps3; ?>
    function changeValue(nip){
    document.getElementById('nama').value  = did3[nip].nama;
    };
  </script>
  </body>
</html>