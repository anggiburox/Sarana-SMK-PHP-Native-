<?php
include '../koneksi/config.php';

$nip 		= $_POST['nip'];
$nama 		= $_POST['nama'];

mysqli_query($db, "UPDATE pegawai SET nip='$nip', nama='$nama' WHERE nip='$nip'")or die(mysqli_error());
header('location:pegawai.php');
?>