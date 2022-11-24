<?php
include '../koneksi/config.php';
$lokasi = $_GET['lokasi'];
mysqli_query($db, "DELETE FROM lokasi WHERE lokasi='$lokasi'")or die(mysql_error());
header('location:lokasi.php');
?>