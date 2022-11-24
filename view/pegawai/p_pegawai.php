<?php
include '../koneksi/config.php';
$nip	= $_POST['nip'];
$nama	= $_POST['nama'];
mysqli_query($db, "INSERT INTO pegawai VALUES('$nip','$nama')");
header('location:pegawai.php');
?>