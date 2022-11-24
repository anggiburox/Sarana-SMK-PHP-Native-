<?php
include '../koneksi/config.php';
$id_barang = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM barang WHERE id_barang='$_GET[id_barang]'"));
$barang 	= array('nama_barang' => $id_barang['nama_barang'],
					'jumlah_barang' => $id_barang['jumlah_barang'],
					'kondisi' => $id_barang['kondisi'],);
echo json_encode($barang);
?>