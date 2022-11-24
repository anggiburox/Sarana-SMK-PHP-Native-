<?php
include '../koneksi/config.php';

$id_peminjam	= $_POST['id_peminjam'];
$nama_peminjam	= $_POST['nama_peminjam'];
$no_tlp			= $_POST['no_tlp'];
$lokasi			= $_POST['lokasi'];
mysqli_query($db, "INSERT INTO peminjam VALUES('$id_peminjam','$nama_peminjam','$no_tlp','$lokasi')");
header('location:t_peminjam.php');
?>