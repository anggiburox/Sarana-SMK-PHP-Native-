<?php
include '../koneksi/config.php';
$id_peminjam	= $_GET['id_peminjam'];
mysqli_query($db, "DELETE FROM peminjam WHERE id_peminjam='$id_peminjam'")or die(mysqli_error());
header('location:t_peminjam.php'); 
?>