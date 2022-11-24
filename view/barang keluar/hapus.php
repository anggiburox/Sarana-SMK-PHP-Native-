<?php
include '../koneksi/config.php';
$id_barang	= $_GET['id_barang'];
mysqli_query($db, "DELETE FROM barang_keluar_sementara WHERE id_barang='$id_barang'")or die(mysqli_error());
header('location:t_barang_keluar.php'); 
?>