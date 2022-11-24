<?php
include '../koneksi/config.php';

$id_pinjam			= $_POST['id_pinjam'];
$id_barang			= $_POST['id_barang'];
$tgl_pinjam			= $_POST['tgl_pinjam'];
$tgl_kembali		= $_POST['tgl_kembali'];
$tgl_pengembalian	= $_POST['tgl_pengembalian'];
$status				= $_POST['status'];
$denda				= $_POST['denda'];
$kondisi_barang		= $_POST['kondisi_barang'];
$query =mysqli_query($db, "SELECT * FROM barang WHERE id_barang='$id_barang'");
$row = mysqli_fetch_array($query);

$query2 =mysqli_query($db, "SELECT * FROM pinjam_barang WHERE id_pinjam='$id_pinjam'");
$row2 = mysqli_fetch_array($query2);

			$cekin				= date_create($_POST['tgl_kembali']);
			$cekout				= date_create($_POST['tgl_pengembalian']);
			$interval			= date_diff($cekin, $cekout);

			$denda				= $harga * $interval->d;

$query3	= "INSERT INTO pengembalian VALUES('".$id_pinjam."', '".$id_barang."', '".$tgl_pengembalian."', '".$denda."')";
$sql 	= mysqli_query($db, $query3);

mysqli_query($db, "UPDATE pinjam_barang SET status='$status', kondisi_barang='$kondisi_barang' WHERE id_pinjam='$id_pinjam'");
header('location:../pinjam barang/pinjam_barang.php');
?>