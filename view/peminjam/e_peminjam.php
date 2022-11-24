<?php
include '../koneksi/config.php';

$id_peminjam 	= $_POST['id_peminjam'];
$nama_peminjam	= $_POST['nama_peminjam'];
$no_tlp			= $_POST['no_tlp'];
$lokasi	  		= $_POST['lokasi'];

mysqli_query($db, "UPDATE peminjam SET id_peminjam='$id_peminjam', nama_peminjam='$nama_peminjam', no_tlp='$no_tlp', lokasi='$lokasi' WHERE id_peminjam='$id_peminjam'")or die(mysqli_error());
header('location:t_peminjam.php');
?>