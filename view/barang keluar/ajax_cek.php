<?php
include '../koneksi/config.php';
$lokasi = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM lokasi WHERE lokasi='$_GET[lokasi]'"));
$lokasi 	= array('lokasi' => $lokasi['lokasi'],);
echo json_encode($lokasi);
?>