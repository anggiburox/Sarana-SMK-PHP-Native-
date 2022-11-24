<?php  
	include '../Koneksi/config.php';

	$id_pinjam 		= $_GET['id_pinjam'];
	$status			= 2;

	$query 	= "UPDATE pinjam_barang SET status='".$status."' WHERE id_pinjam='".$id_pinjam."'";
	$sql	= mysqli_query($db, $query);

	if ($sql) {
		header("location:../pengembalian/pengembalian.php");
	}
	else{
		echo "Data Gagal Diubah";
		echo "<a href='../pengembalian/pengembalian.php'>Kembali</a";
	}
?>