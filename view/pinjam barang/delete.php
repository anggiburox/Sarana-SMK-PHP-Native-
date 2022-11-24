<?php
include '../koneksi/config.php';

$id_barang	= $_POST['pilih'];

$jumlah_dipilih = count($id_barang);

for($x=0;$x<$jumlah_dipilih;$x++){
	mysqli_query($db, "DELETE FROM temp_detail WHERE id_barang='$id_barang[$x]'");
}
header('location:t_pinjam.php');
?>