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
                  $sql = mysqli_query($db, "SELECT MAX(id_pinjam)as newid FROM pinjam_barang");
                  $data = mysqli_fetch_array($sql);
                  $kode = $data['newid'];

                  $no = (int) substr($kode, 2);
                  $no++;
                  $char = 'IP';
                  $newid = $char.sprintf("%003s",$no);

                  $id_peminjam   = $_GET['id_peminjam'];
                $query2 = "SELECT * FROM peminjam
                       WHERE id_peminjam='$id_peminjam'";
                $sql  = mysqli_query($db, $query2);
                $data   = mysqli_fetch_array($sql);
                ?>
                    <form action="p_simpan.php" method="POST" class="form-horizontal form-label-left input_mask">
                      <div class="form-group">
                        <label class="control-label col-md-2 col-sm-3 col-xs-12">ID Pinjam Barang :</label>
                        <div class="col-md-4 col-sm-9 col-xs-12">
                          <input name="id_pinjam" type="text" value="<?php echo $newid ?>" required readonly class="form-control" style="background-color: #e6e6fa; width: 40%;">
                        </div>
                      <label class="control-label col-md-2 col-sm-3 col-xs-12">ID Barang:</label>
                        <div class="col-md-4 col-sm-9 col-xs-12">
                          <select onchange="cek_database()" name="id_barang" id="id_barang" class="form-control">
                            <option value='' selected>- Pilih -</option>
                            <?php
                            $id_barang  = mysqli_query($db, "SELECT * FROM barang");
                            while ($row = mysqli_fetch_array($id_barang)) {
                              echo "<option value='$row[id_barang]'>$row[id_barang]</option>";
                            }
                            ?>
                          </select>                        
                        </div>
                        </div>
                        <div class="form-group">                        
                        <label class="control-label col-md-2 col-sm-3 col-xs-12">ID Peminjam :</label>
                        <div class="col-md-4 col-sm-9 col-xs-12">
                          <input type="text" name="id_peminjam" value="<?php echo$data['id_peminjam']?>" readonly required class="form-control">
                        </div>
                        <label class="control-label col-md-2 col-sm-3 col-xs-12">Nama Barang :</label>
                        <div class="col-md-4 col-sm-9 col-xs-12">
                          <input type="text" name="nama_barang" id="nama_barang" readonly required class="form-control">
                      </div>
                      </div>
                      <div class="form-group">
                       <label class="control-label col-md-2 col-sm-3 col-xs-12">Nama Peminjam :</label>
                        <div class="col-md-4 col-sm-9 col-xs-12">
                          <input type="text" value="<?php echo $data['nama_peminjam']?>" readonly required class="form-control">
                        </div>
                        <label class="control-label col-md-2 col-sm-3 col-xs-12">Kondisi Barang :</label>
                        <div class="col-md-4 col-sm-9 col-xs-12">
                          <input type="text" id="kondisi" readonly required class="form-control">
                        </div>
                      </div>
                      <div class="form-group">
                       <label class="control-label col-md-2 col-sm-3 col-xs-12">Lokasi barang pinjam :</label>
                        <div class="col-md-4 col-sm-9 col-xs-12">
                          <input type="text" value="<?php echo $data['lokasi']?>" readonly required class="form-control">
                        </div>
                        <label class="control-label col-md-2 col-sm-3 col-xs-12">Jumlah Barang :</label>
                        <div class="col-md-4 col-sm-9 col-xs-12">
                          <input type="text" id="jumlah_barang" readonly required class="form-control">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-2 col-sm-3 col-xs-12">Tanggal Pinjam :</label>
                        <div class="col-md-4 col-sm-9 col-xs-12">
                          <input type="text" class="form-control" name="tgl_pinjam" value="<?= date('y-m-d')?>" required readonly>
                        </div>
                      <label class="control-label col-md-2 col-sm-3 col-xs-12">Jumlah Pinjam :</label>
                        <div class="col-md-4 col-sm-9 col-xs-12">
                          <input type="number" min="1" name="jumlah" required class="form-control">
                        </div>
                    </div>
                      <div class="form-group">
                        <label class="control-label col-md-2 col-sm-3 col-xs-12">Tanggal Kembali :</label>
                        <div class="col-md-4 col-sm-9 col-xs-12">
                           <div class='input-group date' id='myDatepicker3'>
                            <input type='text' name="tgl_kembali" class="form-control" readonly="readonly" style="background-color: white;" />
                            <span class="input-group-addon">
                               <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                        </div>
                        <label class="control-label col-md-2 col-sm-3 col-xs-12">Status :</label>
                        <div class="col-md-4 col-sm-9 col-xs-12">
                          <input type="text" name="status" class="form-control" readonly value="<?php echo 'Dipinjam'?>" required>
                      </div>
                        <div class="form-group">
                          <button type="submit" class="btn btn-success" name="simpan" style="margin-right: 955px;">Simpan</button>
                      </div>
              </form>
                                  <table id="datatable" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>ID Pinjam Barang</th>
                          <th>ID Peminjam</th>
                          <th>Nama Peminjam</th>
                          <th>Nama Barang</th>
                          <th>Jumlah Barang</th>
                          <th>Jumlah Pinjam</th>
                          <th>Tanggal Pinjam</th>
                          <th>Tanggal Kembali</th>
                          <th width="160"><center>Action</center></th>
                        </tr>
                      </thead>
                      <tbody>

<?php
$sql  = "SELECT * FROM pinjam_barang
    INNER JOIN peminjam on pinjam_barang.id_peminjam = peminjam.id_peminjam
    INNER JOIN detail_pinjam_barang on pinjam_barang.id_pinjam = detail_pinjam_barang.id_pinjam
    INNER JOIN barang on detail_pinjam_barang.id_barang = barang.id_barang WHERE peminjam.id_peminjam = '$id_peminjam'";
$query = mysqli_query($db, $sql);
$no = 1;
  while ($data=mysqli_fetch_array($query)){
?>
                 <tr>
                          <td><?php echo $no ?></td>
                          <td><?php echo $data['id_pinjam']?></td>
                          <td><?php echo $data['id_peminjam']?></td>
                          <td><?php echo $data['nama_peminjam']?></td>
                          <td><?php echo $data['nama_barang']?></td>
                          <td><?php echo $data['jumlah_barang']?></td>
                          <td><?php echo $data['jumlah']?></td>
                          <td><?php echo $data['tgl_pinjam']?></td>
                          <td><?php echo $data['tgl_kembali']?></td>
                          <td><a href="pengembalian.php?id_pinjam=<?php echo $data['id_pinjam'] ?>" class="btn btn-primary"><?php echo $data['status']?></td>
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
    <!-- bootstrap-daterangepicker -->
    <script src="../../vendors/moment/min/moment.min.js"></script>
    <script src="../../vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
    <!-- bootstrap-datetimepicker -->    
    <script src="../../vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
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
        $('#jumlah_barang').val(obj.jumlah_barang);
        $('#kondisi').val(obj.kondisi);
      })
    }
    </script>
<script> 
    $('#myDatepicker3').datetimepicker({
        ignoreReadonly: true,    
        allowInputToggle: true,
        format: 'DD.MM.YYYY'
    });
</script>
<!-- mengambil data nama peminjam -->
  <script type="text/javascript"> 
    <?php echo $jsps3; ?>
    function changeValue(id_peminjam){
    document.getElementById('nama_peminjam').value  = did3[id_peminjam].nama_peminjam;
    };
  </script>
  </body>
</html>