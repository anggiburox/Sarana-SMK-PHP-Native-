<?php
include '../koneksi/config.php';
$id_barang     = $_POST['id_barang'];
$tgl_keluar    = $_POST['tgl_keluar'];
$jml_keluar    = $_POST['jml_keluar'];
$lokasi        = $_POST['lokasi'];
	$query =mysqli_query($db, "SELECT * FROM barang WHERE id_barang='$id_barang'");
	$row = mysqli_fetch_array($query);

	if ($jml_keluar > $row['jumlah_barang']){
?>
	<script type="text/javascript">
		alert("Jumlah barang tidak tercukupi");
	</script>
<?php 
	echo "<meta http-equiv='refresh' content='0; url=t_barang_keluar.php'>";		
	}else{
mysqli_query($db, "INSERT INTO barang_keluar VALUES ('','$id_barang','$tgl_keluar','$jml_keluar','$lokasi')");
header('location:t_barang_keluar.php');
}
?>