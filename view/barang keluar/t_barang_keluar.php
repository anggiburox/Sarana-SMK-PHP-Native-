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
          <?php  
            include'../menu/menu.php';
          ?>
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="row">
              <div class="col-md-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Tambah Data Barang Keluar</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <form action="p_barang.php" method="post" class="form-horizontal form-label-left input_mask">
                      <div class="form-group">
                        <label class="control-label col-md-2 col-sm-3 col-xs-12">ID Barang :</label>
                        <div class="col-md-4 col-sm-9 col-xs-12">
                          <?php
                          $result3 = mysqli_query($db, "select * from barang"); 
                          $jsps3 = "var did3 = new Array();\n"; 
                          echo '<select name="id_barang" class="form-control" style="width:40%;" onchange="changeValue(this.value)">'; 
                            echo '<option>- Pilih -</option>'; 
                            while ($row3 = mysqli_fetch_array($result3)) { 
                                echo '<option value="' . $row3['id_barang'] . '">' . $row3['id_barang'] . '</option>'; 
                                $jsps3 .= "did3['" . $row3['id_barang'] . "'] = {nama_barang:'" . addslashes($row3['nama_barang']) .  "', jumlah_barang:'" . addslashes($row3['jumlah_barang']) .  "'};\n"; 
                            } 
                          echo '</select></br>'; 
                          ?>
                        </div>
                        <label class="control-label col-md-2 col-sm-3 col-xs-12">Jumlah Keluar :</label>
                        <div class="col-md-4 col-sm-9 col-xs-12">
                          <input name="jml_keluar" required type="number" min="0" class="form-control">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-2 col-sm-3 col-xs-12">Nama Barang :</label>
                        <div class="col-md-4 col-sm-9 col-xs-12">
                          <input type="text" id="nama_barang" required readonly class="form-control">
                        </div>
                        <label class="control-label col-md-2 col-sm-3 col-xs-12">Tanggal Keluar :</label>
                        <div class="col-md-4 col-sm-9 col-xs-12">
                        <input name="tgl_keluar" required type="date" value="<?= date('y-m-d') ?>" readonly class="form-control">    
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-2 col-sm-3 col-xs-12">Jumlah Barang :</label>
                        <div class="col-md-4 col-sm-9 col-xs-12">
                          <input type="text" id="jumlah_barang" required readonly class="form-control">
                        </div>
                        <label class="control-label col-md-2 col-sm-3 col-xs-12">Lokasi :</label>
                        <div class="col-md-4 col-sm-9 col-xs-12">
                          <select multiple size="7" onchange="cek_database()" name="lokasi" id="lokasi" class="form-control">
                            <?php
                            $lokasi  = mysqli_query($db, "SELECT * FROM lokasi");
                            while ($row = mysqli_fetch_array($lokasi)) {
                              echo "<option value='$row[lokasi]'>$row[lokasi]</option>";
                            }
                            ?>
                          </select>                        
                        </div>
                      </div>
                      <div class="form-group">
                              <button type="submit" class="btn btn-success" name="submit">Simpan</button>
                      </div>

                    <table id="datatable" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>ID Barang</th>
                          <th>Nama Barang</th>
                          <th>Jumlah Barang</th>
                          <th>Jumlah Keluar</th>
                          <th>Tanggal Keluar</th>
                          <th>Lokasi</th>
                          <th width="75">Action</th>
                        </tr>
                      </thead>


                      <tbody>
<?php
$sql = "SELECT * FROM barang_keluar
    INNER JOIN barang on barang_keluar.id_barang = barang.id_barang
    INNER JOIN lokasi on barang_keluar.lokasi = lokasi.lokasi";
$query = mysqli_query($db, $sql);
$no = 1;
while ($data=mysqli_fetch_array($query)){
?>
                      <tr>
                          <td><?php echo $no ?></td>
                          <td><?php echo $data['id_barang'] ?></td>
                          <td><?php echo $data['nama_barang'] ?></td>
                          <td><?php echo $data['jumlah_barang'] ?></td>
                          <td><?php echo $data['jml_keluar'] ?></td>
                          <td><?php echo $data['tgl_keluar'] ?></td>
                          <td><?php echo $data['lokasi']?></td>
                          <td>
                            <a onclick="return confirm('Anda yakin ingin menghapus data ?')"; href="delete.php?id=<?php echo $data['id'] ?>" class="btn btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
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
    <!-- Datatables -->
    <script src="../../vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="../../vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="../../vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="../../vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
    <script src="../../vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="../../vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="../../vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="../../vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
    <script src="../../vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="../../vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="../../vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
    <script src="../../vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
    <script src="../../vendors/jszip/dist/jszip.min.js"></script>
    <script src="../../vendors/pdfmake/build/pdfmake.min.js"></script>
    <script src="../../vendors/pdfmake/build/vfs_fonts.js"></script>
    
    <!-- Custom Theme Scripts -->
    <script src="../../build/js/custom.min.js"></script>
<!-- mengambil data lokasi -->
  <script type="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script type="text/javascript"> 
    function cek_database(){
      var lokasi = $("#lokasi").val();
      $.ajax({
        url: 'ajax_cek.php' ,
        data : "lokasi="+lokasi ,
      }).success(function (data) {
        var json = data,
        obj = JSON.parse(json);
        $('#lokasi').val(obj.lokasi);
      })
    }
    </script>
<!-- mengambil data nama barang -->
  <script type="text/javascript"> 
    <?php echo $jsps3; ?>
    function changeValue(id_barang){
    document.getElementById('nama_barang').value  = did3[id_barang].nama_barang;
    document.getElementById('jumlah_barang').value  = did3[id_barang].jumlah_barang;
    };
  </script>
  </body>
</html>