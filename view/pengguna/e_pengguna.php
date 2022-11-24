<?php
include '../koneksi/config.php';

$id_user	= $_POST['id_user'];
$nama		= $_POST['nama'];
$username	= $_POST['username'];
$password	= $_POST['password'];
$level		= $_POST['level'];
mysqli_query($db, "UPDATE user SET id_user='$id_user', nama='$nama', username='$username', password='$password', level='$level' WHERE id_user='$id_user'")or die(mysqli_error());
header('location:pengguna.php');
?>