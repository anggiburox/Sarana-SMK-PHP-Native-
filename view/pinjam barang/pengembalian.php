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
                    <h2>Tambah Data Pengembalian</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                 <?php
                $id_pinjam   = $_GET['id_pinjam'];
                $query2 = "SELECT * FROM detail_pinjam_barang 
                          INNER JOIN barang on detail_pinjam_barang.id_barang = barang.id_barang
                          WHERE id_pinjam ='$id_pinjam'";
                $sql  = mysqli_query($db, $query2);
                $data   = mysqli_fetch_array($sql);
                
                $query3 = "SELECT * FROM pinjam_barang
                           INNER JOIN peminjam on pinjam_barang.id_peminjam = peminjam.id_peminjam
                           WHERE id_pinjam='$id_pinjam'";
                $sql3  = mysqli_query($db, $query3);
                $data2   = mysqli_fetch_array($sql3);
                ?>
                    <form action="p_pengembalian.php" method="POST" class="form-horizontal form-label-left input_mask">
                      <div class="form-group">
                        <label class="control-label col-md-2 col-sm-3 col-xs-12">ID Pinjam Barang :</label>
                        <div class="col-md-4 col-sm-9 col-xs-12">
                          <input name="id_pinjam" type="text" value="<?php echo $data['id_pinjam'] ?>" required readonly class="form-control" style="background-color: #e6e6fa; width: 40%;">
                        </div>
                      <label class="control-label col-md-2 col-sm-3 col-xs-12">ID Barang:</label>
                        <div class="col-md-4 col-sm-9 col-xs-12">
                          <input type="text" name="id_barang" value="<?php echo$data['id_barang']?>" required readonly class="form-control" style="background-color: #e6e6fa; width: 40%;">
                        </div>
                        </div>
                        <div class="form-group">                        
                        <label class="control-label col-md-2 col-sm-3 col-xs-12">ID Peminjam :</label>
                        <div class="col-md-4 col-sm-9 col-xs-12">
                          <input type="text" name="id_peminjam" value="<?php echo$data2['id_peminjam']?>" readonly required class="form-control">
                        </div>
                        <label class="control-label col-md-2 col-sm-3 col-xs-12">Nama Barang :</label>
                        <div class="col-md-4 col-sm-9 col-xs-12">
                          <input type="text" value="<?php echo$data['nama_barang']?>" readonly required class="form-control">
                      </div>
                      </div>
                      <div class="form-group">
                       <label class="control-label col-md-2 col-sm-3 col-xs-12">Nama Peminjam :</label>
                        <div class="col-md-4 col-sm-9 col-xs-12">
                          <input type="text" value="<?php echo $data2['nama_peminjam']?>" readonly required class="form-control">
                        </div>
                        <label class="control-label col-md-2 col-sm-3 col-xs-12">Jumlah Barang :</label>
                        <div class="col-md-4 col-sm-9 col-xs-12">
                          <input type="text" value="<?php echo$data['jumlah_barang']?>" readonly required class="form-control">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-2 col-sm-3 col-xs-12">Tanggal Pinjam :</label>
                        <div class="col-md-4 col-sm-9 col-xs-12">
                          <input type="text" class="form-control" name="tgl_pinjam" value="<?php echo$data2['tgl_pinjam']?>" required readonly>
                        </div>
                      <label class="control-label col-md-2 col-sm-3 col-xs-12">Jumlah Pinjam :</label>
                        <div class="col-md-4 col-sm-9 col-xs-12">
                          <input type="text" value="<?php echo$data['jumlah']?>" name="jumlah" required class="form-control" readonly>
                        </div>
                    </div>
                      <div class="form-group">
                        <label class="control-label col-md-2 col-sm-3 col-xs-12">Tanggal Kembali :</label>
                        <div class="col-md-4 col-sm-9 col-xs-12">
                           <input type="date" name="tgl_kembali" value="<?php echo$data2['tgl_kembali']?>" class="form-control" readonly>
                        </div>
                        <label class="control-label col-md-2 col-sm-3 col-xs-12">Kondisi Barang :</label>
                        <div class="col-md-4 col-sm-9 col-xs-12">
                          <input type="text" name="kondisi" value="<?php echo$data['kondisi']?>" required readonly class="form-control">
                        </div>
                      </div>
                        <input type="hidden" name="status">
                      <div class="form-group">
                          <button type="submit" class="btn btn-success" name="simpan" style="margin-right: 955px;">Simpan</button>
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