<?php
include '../koneksi/config.php';

$id_barang		= $_POST['id_barang'];
$nama_barang	= $_POST['nama_barang'];
$jml_masuk	= $_POST['jml_masuk'];
$jml_keluar	= $_POST['jml_keluar'];
$total_barang	= $_POST['total_barang'];

mysqli_query($db, "INSERT INTO stok VALUES('$id_barang','$nama_barang','$jml_masuk','$jml_keluar','$total_barang')")or die(mysqli_error());
header('location:stok.php');
?>