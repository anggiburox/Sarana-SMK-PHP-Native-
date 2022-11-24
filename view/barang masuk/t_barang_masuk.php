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
                    <h2>Tambah Data Barang Masuk</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                    <form action="p_barang_masuk.php" method="post" class="form-horizontal form-label-left input_mask">
                      <div class="form-group">
                        <label class="control-label col-md-2 col-sm-3 col-xs-12">ID Barang:</label>
                        <div class="col-md-4 col-sm-9 col-xs-12">
                          <select onchange="cek_database()" name="id_barang" id="id_barang" class="form-control" style="width: 40%;">
                            <option value='' selected>- Pilih -</option>
                            <?php
                            $id_barang  = mysqli_query($db, "SELECT * FROM barang");
                            while ($row = mysqli_fetch_array($id_barang)) {
                              echo "<option value='$row[id_barang]'>$row[id_barang]</option>";
                            }
                            ?>
                          </select>                        
                        </div>
                        <label class="control-label col-md-2 col-sm-3 col-xs-12">ID Suplier :</label>
                        <div class="col-md-4 col-sm-9 col-xs-12">
                          <?php
                          $result3 = mysqli_query($db, "select * from suplier"); 
                          $jsps3 = "var did3 = new Array();\n"; 
                          echo '<select name="id_suplier" style="width:40%;" class="form-control" onchange="changeValue(this.value)">'; 
                            echo '<option>- Pilih -</option>'; 
                            while ($row3 = mysqli_fetch_array($result3)) { 
                                echo '<option value="' . $row3['id_suplier'] . '">' . $row3['id_suplier'] . '</option>'; 
                                $jsps3 .= "did3['" . $row3['id_suplier'] . "'] = {nama_suplier:'" . addslashes($row3['nama_suplier']) .  "', alamat_suplier:'" . addslashes($row3['alamat_suplier']) .  "'};\n"; 
                            } 
                          echo '</select></br>'; 
                          ?>
                      </div>
                    </div>
                      <div class="form-group">
                        <label class="control-label col-md-2 col-sm-3 col-xs-12">Nama Barang :</label>
                        <div class="col-md-4 col-sm-9 col-xs-12">
                          <input type="text" name="nama_barang" id="nama_barang" readonly required class="form-control">
                        </div>
                          <label class="control-label col-md-2 col-sm-3 col-xs-12">Nama Suplier :</label>
                        <div class="col-md-4 col-sm-9 col-xs-12">
                          <input type="text" id="nama_suplier" readonly required class="form-control">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-2 col-sm-3 col-xs-12">Jumlah Masuk :</label>
                        <div class="col-md-4 col-sm-9 col-xs-12">
                          <input name="jml_masuk" required type="number" min="0" class="form-control">
                        </div>
                        <label class="control-label col-md-2 col-sm-3 col-xs-12">Alamat Suplier :</label>
                        <div class="col-md-4 col-sm-9 col-xs-12">
                          <textarea id="alamat_suplier" class="form-control" readonly></textarea>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-2 col-sm-3 col-xs-12">Tanggal Masuk :</label>
                        <div class="col-md-4 col-sm-9 col-xs-12">
                          <input name="tgl_masuk" required type="date" value="<?= date('y-m-d') ?>" readonly class="form-control">
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
                          <th>ID Barang</th>
                          <th>Nama Barang</th>
                          <th>Tanggal Masuk</th>
                          <th>Jumlah Masuk</th>
                          <th>ID Suplier</th>
                          <th>Nama Suplier</th>
                          <th>Alamat Suplier</th>
                          <th width="75">Action</th>
                        </tr>
                      </thead>


                      <tbody>
<?php
$sql = "SELECT * FROM barang_masuk
        INNER JOIN barang on barang_masuk.id_barang = barang.id_barang
        INNER JOIN suplier on barang_masuk.id_suplier = suplier.id_suplier";
$query=mysqli_query($db, $sql);
$no=1;
while ($data=mysqli_fetch_array($query)){
?>
                      <tr>
                          <td><?php echo $no ?></td>
                          <td><?php echo $data['id_barang'] ?></td>
                          <td><?php echo $data['nama_barang'] ?></td>
                          <td><?php echo $data['tgl_masuk'] ?></td>
                          <td><?php echo $data['jml_masuk'] ?></td>
                          <td><?php echo $data['id_suplier']?></td>
                          <td><?php echo $data['nama_suplier']?></td>
                          <td><?php echo $data['alamat_suplier']?></td>
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

<!-- mengambil data nama barang -->
  <script type="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script type="text/javascript"> 
    function cek_database(){
      var id_barang = $("#id_barang").val();
      $.ajax({
        url: 'ajax_cek.php' ,
        data : "id_barang="+id_barang ,
      }).success(function (data) {
        var json = data,
        obj = JSON.parse(json);
        $('#nama_barang').val(obj.nama_barang);
      })
    }
    </script>
    <script type="text/javascript"> 
    <?php echo $jsps3; ?>
    function changeValue(id_suplier){
    document.getElementById('nama_suplier').value  = did3[id_suplier].nama_suplier;
    document.getElementById('alamat_suplier').value  = did3[id_suplier].alamat_suplier;
    };
  </script>
  
  </body>
</html>