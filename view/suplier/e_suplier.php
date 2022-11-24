<?php
include '../koneksi/config.php';

$id_suplier 	= $_POST['id_suplier'];
$nama_suplier	= $_POST['nama_suplier'];
$alamat_suplier	= $_POST['alamat_suplier'];
$telp_suplier	= $_POST['telp_suplier'];

mysqli_query($db, "UPDATE suplier SET id_suplier='$id_suplier', nama_suplier='$nama_suplier', alamat_suplier='$alamat_suplier', telp_suplier='$telp_suplier' WHERE id_suplier='$id_suplier'")or die(mysqli_error());
header('location:suplier.php');
?>