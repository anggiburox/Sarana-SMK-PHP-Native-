<?php
include '../koneksi/config.php';
$id_barang = $_GET['id_barang'];
mysqli_query($db, "DELETE FROM barang WHERE id_barang='$id_barang'")or die(mysql_error());
header('location:barang.php');
?>