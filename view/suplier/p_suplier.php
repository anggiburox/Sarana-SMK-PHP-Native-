<?php
include '../koneksi/config.php';

$id_suplier		= $_POST['id_suplier'];
$nama_suplier	= $_POST['nama_suplier'];
$alamat_suplier			= $_POST['alamat_suplier'];
$telp_suplier	= $_POST['telp_suplier'];
mysqli_query($db, "INSERT INTO suplier VALUES('$id_suplier','$nama_suplier','$alamat_suplier','$telp_suplier')");
header('location:suplier.php');
?>