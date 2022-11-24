<?php
include '../koneksi/config.php';

$id_barang 		= $_POST['id_barang'];
$nama_barang 	= $_POST['nama_barang'];
$spesifikasi 	= $_POST['spesifikasi'];
$lokasi			= $_POST['lokasi'];
$kondisi		= $_POST['kondisi'];
$jumlah_barang	= $_POST['jumlah_barang'];
$sumber_dana	= $_POST['sumber_dana'];

mysqli_query($db, "INSERT INTO barang VALUES('$id_barang','$nama_barang','$spesifikasi','$lokasi','$kondisi','$jumlah_barang','$sumber_dana')");
header("location:barang.php");
?>