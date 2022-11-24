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
            <div class="row">
              <div class="col-md-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Tambah Data Peminjam</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                <?php
                  $sql = mysqli_query($db, "SELECT MAX(id_peminjam)as newid FROM peminjam");
                  $data = mysqli_fetch_array($sql);
                  $kode = $data['newid'];

                  $no = (int) substr($kode, 2);
                  $no++;
                  $char = 'PM';
                  $newid = $char.sprintf("%003s",$no);
                ?>
                    <form action="p_peminjam.php" method="post" class="form-horizontal form-label-left input_mask">
                      <div class="form-group">
                        <label class="control-label col-md-2 col-sm-3 col-xs-12">ID Peminjam :</label>
                        <div class="col-md-4 col-sm-9 col-xs-12">
                          <input name="id_peminjam" type="text" value="<?php echo $newid ?>" required readonly class="form-control" style="background-color: #e6e6fa; width: 40%;">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-2 col-sm-3 col-xs-12">Nama Peminjam :</label>
                        <div class="col-md-4 col-sm-9 col-xs-12">
                          <input type="text" name="nama_peminjam" required class="form-control">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-2 col-sm-3 col-xs-12">Telepon :</label>
                        <div class="col-md-4 col-sm-9 col-xs-12">
                        <input type="text" name="no_tlp" required class="form-control" data-inputmask="'mask' : '9999-9999-9999'">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-2 col-sm-3 col-xs-12">Lokasi :</label>
                        <div class="col-md-4 col-sm-9 col-xs-12">
                          <?php
                          $result3 = mysqli_query($db, "select * from lokasi"); 
                          $jsps3 = "var did3 = new Array();\n"; 
                          echo '<select name="lokasi" class="form-control" style="width:40%;" onchange="changeValue(this.value)">'; 
                            echo '<option>- Pilih -</option>'; 
                            while ($row3 = mysqli_fetch_array($result3)) { 
                                echo '<option value="' . $row3['lokasi'] . '">' . $row3['lokasi'] . '</option>'; 
                                $jsps3 .= "did3['" . $row3['lokasi'] . "'] = {lokasi:'" . addslashes($row3['lokasi']) .  "'};\n"; 
                            } 
                          echo '</select></br>'; 
                          ?>
                        </div>
                      </div>
                      <div class="form-group">
                          <button type="submit" class="btn btn-success" name="submit">Simpan</button>
                      </div>
                    </form>

                    <table id="datatable" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>ID Peminjam</th>
                          <th>Nama Peminjam</th>
                          <th>Telepon</th>
                          <th>Lokasi</th>
                          <th width="75">Action</th>
                        </tr>
                      </thead>


                      <tbody>
<?php

$sql  = "SELECT * FROM peminjam";
$query = mysqli_query($db, $sql);
$no = 1;
  while ($data=mysqli_fetch_array($query)){
?>
                      <tr>
                          <td><?php echo $no ?></td>
                          <td><a class="btn-link" href="../pinjam barang/tambah.php?id_peminjam=<?php echo $data['id_peminjam'] ?>"><?php echo $data['id_peminjam']; ?></a></td>
                          <td><?php echo $data['nama_peminjam'] ?></td>
                          <td><?php echo $data['no_tlp'] ?></td>
                          <td><?php echo $data['lokasi'] ?></td>
                          <td>
                            <a href="edit.php?id_peminjam=<?php echo $data['id_peminjam'] ?>" class="btn btn-success"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
                            <a onclick="return confirm('Anda yakin ingin menghapus data ?')"; href="delete.php?id_peminjam=<?php echo $data['id_peminjam'] ?>" class="btn btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
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
    <!-- jquery.inputmask -->
    <script src="../../vendors/jquery.inputmask/dist/min/jquery.inputmask.bundle.min.js"></script>
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
  <script type="text/javascript"> 
    <?php echo $jsps3; ?>
    function changeValue(lokasi){
    document.getElementById('lokasi').value  = did3[lokasi].lokasi;
    };
  </script>
  </body>
</html>