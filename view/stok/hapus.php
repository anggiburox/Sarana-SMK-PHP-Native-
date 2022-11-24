<?php
include '../koneksi/config.php';
$id_barang	= $_GET['id_barang'];
mysqli_query($db, "DELETE FROM stok WHERE id_barang='$id_barang'")or die(mysqli_error());
header('location:stok.php'); 
?>