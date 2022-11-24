<?php
include '../koneksi/config.php';
$nip	= $_GET['nip'];
mysqli_query($db, "DELETE FROM pegawai WHERE nip='$nip'");
header('location:pegawai.php');
?>