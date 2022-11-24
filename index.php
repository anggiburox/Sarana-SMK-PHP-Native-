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
    <link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="vendors/animate.css/animate.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="build/css/custom.min.css" rel="stylesheet">
  </head>

  <body class="login">
       <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <form method="POST" action="login.php">
              <h1>Login Form</h1>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3">Username</label>
                        <div class="col-md-9 col-sm-9 col-xs-9">
                          <input type="text" class="form-control" name="username" required>
                          <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3">Password</label>
                        <div class="col-md-9 col-sm-9 col-xs-9">
                          <input type="password" name="password" id="myInput" class="form-control" required>
                          <span class="fa fa-unlock-alt form-control-feedback right" aria-hidden="true"></span>
                          <input type="checkbox" name="checkbox" onclick="myFunction()" style="margin-left: -50%;">&nbsp; Show Password</br>
                        </div>
                      </div>
              <div>
                <button type="submit" class="btn btn-success" value="Login">Log in</button>
               </div>
            </form>
            <?php 
          if(isset($_GET['pesan'])){
            echo '<div class="msg">';
          if($_GET['pesan'] == "gagal"){
            echo "<span class='message'>Login gagal! username dan password salah!</sapan>";
          }else if($_GET['pesan'] == "logout"){
            echo "<span class='message'>Anda telah berhasil logout</span>";
          }else if($_GET['pesan'] == "belum_login"){
            echo "<span class='message'>Anda harus login untuk mengakses halaman yang lain</span>";
          }
            echo '</div>';
          }
        ?>
          </section>
        </div>
      </div>

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
