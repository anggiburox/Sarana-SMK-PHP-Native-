<?php
include '../koneksi/config.php';

$id_barang 		= $_POST['id_barang'];
$nama_barang 	= $_POST['nama_barang'];
$spesifikasi 	= $_POST['spesifikasi'];
$lokasi			= $_POST['lokasi'];
$kondisi		= $_POST['kondisi'];
$jumlah_barang	= $_POST['jumlah_barang'];
$sumber_dana	= $_POST['sumber_dana'];

mysqli_query($db, "UPDATE barang SET id_barang='$id_barang', nama_barang='$nama_barang', spesifikasi='$spesifikasi', lokasi='$lokasi', kondisi='$kondisi', jumlah_barang='$jumlah_barang', sumber_dana='$sumber_dana' WHERE id_barang='$id_barang'")or die(mysqli_error());
header('location:barang.php');
?>