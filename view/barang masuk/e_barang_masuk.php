<?php
include '../koneksi/config.php';

$id_barang	= $_POST['id_barang'];
$jml_masuk	= $_POST['jml_masuk'];
$tgl_masuk	= $_POST['tgl_masuk'];
$id_suplier		= $_POST['id_suplier'];
mysqli_query($db, "UPDATE barang_masuk SET id_barang='$id_barang', jml_masuk='$jml_masuk', tgl_masuk='$tgl_masuk', id_suplier='$id_suplier' WHERE id_barang='$id_barang'")or die(mysqli_error());
header('location:barang_masuk.php');
?>