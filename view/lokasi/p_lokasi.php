<?php
include '../koneksi/config.php';
$lokasi	= $_POST['lokasi'];

mysqli_query($db, "INSERT INTO lokasi VALUES('$lokasi')");
header('location:lokasi.php');
?>