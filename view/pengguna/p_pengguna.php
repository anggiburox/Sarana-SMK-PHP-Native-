
<?php
include '../koneksi/config.php';

$id_user	= $_POST['id_user'];
$nama		= $_POST['nama'];
$username	= $_POST['username'];
$password	= $_POST['password'];
$level		= $_POST['level'];

mysqli_query($db, "INSERT INTO user VALUES('$id_user','$nama','$username','$password','$level')");
header('location:pengguna.php');
?>