<?php
include '../koneksi/config.php';
$id_suplier	= $_GET['id_suplier'];
mysqli_query($db, "DELETE FROM suplier WHERE id_suplier='$id_suplier'")or die(mysqli_error());
header('location:suplier.php'); 
?>