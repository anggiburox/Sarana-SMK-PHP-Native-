<?php
include '../koneksi/config.php';
$id	= $_GET['id'];
mysqli_query($db, "DELETE FROM barang_masuk WHERE id='$id'")or die(mysqli_error());
header('location:t_barang_masuk.php'); 
?>