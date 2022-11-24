<?php
include '../koneksi/config.php';

$id_pinjam			= $_POST['id_pinjam'];
$id_peminjam		= $_POST['id_peminjam'];
$tgl_pinjam			= $_POST['tgl_pinjam'];
$tgl_kembali		= $_POST['tgl_kembali'];
$status				= 'Sudah dikembalikan';
$id_detail			= $_POST['id_detail'];
$id_barang 			= $_POST['id_barang'];
$kondisi_barang		= $_POST['kondisi_barang'];
$jumlah				= $_POST['jumlah'];

$query =mysqli_query($db, "SELECT * FROM barang WHERE id_barang='$id_barang'");
$row = mysqli_fetch_array($query);
$jumlah_barang=$row['jumlah_barang'] + $_POST['jumlah'];


$query3 =mysqli_query($db, "SELECT * FROM detail_pinjam_barang");
$row3 = mysqli_fetch_array($query3);

mysqli_query($db, "UPDATE pinjam_barang SET id_pinjam='$id_pinjam', id_peminjam='$id_peminjam', tgl_pinjam='$tgl_pinjam', tgl_kembali='$tgl_kembali', status='$status' WHERE id_pinjam='$id_pinjam'");

mysqli_query($db, "UPDATE barang SET jumlah_barang='$jumlah_barang' WHERE id_barang='$id_barang'");

mysqli_query($db, "UPDATE detail_pinjam_barang SET id_detail='$id_detail', id_pinjam='$id_pinjam', id_barang='$id_barang', jumlah='$jumlah', kondisi_barang='$kondisi_barang' WHERE id_detail='$id_detail'");
header('location:../pengembalian/pengembalian.php');
?>