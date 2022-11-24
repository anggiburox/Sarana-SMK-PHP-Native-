<?php
include '../koneksi/config.php';

$id_barang 	= $_POST['id_barang'];
$tgl_masuk 	= $_POST['tgl_masuk'];
$jml_masuk 	= $_POST['jml_masuk'];
$id_suplier	= $_POST['id_suplier'];

mysqli_query($db, "INSERT INTO barang_masuk VALUES('','$id_barang','$tgl_masuk','$jml_masuk','$id_suplier')");
header("location:t_barang_masuk.php");
?>