<?php
include '../koneksi/config.php';

$id_pinjam	= $_GET['id_pinjam'];

mysqli_query($db, "DELETE FROM pinjam_barang WHERE id_pinjam='$id_pinjam'");
header('location:pinjam_barang.php');
?>