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
                    <h2>Edit Pengguna</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                    <?php
                    include '../koneksi/config.php';
                    $id_user   = $_GET['id_user'];
                $query2 = "SELECT * FROM user WHERE id_user=$id_user";
                $sql  = mysqli_query($db, $query2);
                $data   = mysqli_fetch_array($sql);
                    ?>
                    <form action="e_pengguna.php" method="POST" class="form-horizontal form-label-left input_mask">
                      <div class="form-group">
                        <label class="control-label col-md-2 col-sm-3 col-xs-12">ID User :</label>
                        <div class="col-md-4 col-sm-9 col-xs-12">
                          <input name="id_user" type="text" value="<?php echo $data['id_user'] ?>" readonly class="form-control" style="background-color: #e6e6fa; width: 40%;">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-2 col-sm-3 col-xs-12">Nama :</label>
                        <div class="col-md-4 col-sm-9 col-xs-12">
                          <input name="nama" type="text" value="<?php echo$data['nama']?>" required class="form-control">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-2 col-sm-3 col-xs-12">Username :</label>
                        <div class="col-md-4 col-sm-9 col-xs-12">
                          <input name="username" type="text" value="<?php echo$data['username']?>" required class="form-control">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-2 col-sm-3 col-xs-12">Password :</label>
                        <div class="col-md-4 col-sm-9 col-xs-12">
                        <div class="input-group demo2">
                          <input name="password" type="password" value="<?php echo$data['password']?>" id="myInput" required class="form-control">
                          <span class="input-group-addon" onclick="myFunction()"><i class="fa fa-eye" style="cursor: pointer;"></i></span>
                        </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-2 col-sm-3 col-xs-12">Level :</label>
                        <div class="col-md-4 col-sm-9 col-xs-12">
                          <select name="level" class="form-control" required>
                            <option value="">Pilih</option>
                            <option <?php if($data['level'] == 'Admin'){ echo 'selected';} ?>>Admin</option>
                            <option <?php if($data['level'] == 'Petugas'){ echo 'selected';} ?>>Petugas</option>
                          </select>
                        </div>
                      </div>
                      <div class="form-group">
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
<!--show password-->
<script type="text/javascript">
function myFunction() {
    var x = document.getElementById("myInput");
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
} 
</script>

  </body>
</html>