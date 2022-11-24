<?php
	include '../koneksi/config.php';

	$id_pinjam	 		= $_POST['id_pinjam'];
	$tgl_pinjam	 		= $_POST['tgl_pinjam'];
	$tgl_kembali 		= $_POST['tgl_kembali'];
	$status_peminjam	= $_POST['status_peminjam'];
	$nip		 		= $_POST['nip'];
	$id_barang			= $_POST['id_barang'];
	$jumlah_pinjam		= $_POST['jumlah_pinjam'];

	$query =mysqli_query($db, "SELECT * FROM barang WHERE id_barang='$id_barang'");
	$row = mysqli_fetch_array($query);

	if ($jumlah_pinjam > $row['jumlah_barang']) {
?>
	<script type="text/javascript">
		alert("Stok barang tidak tercukupi");
	</script>
<?php
	echo "<meta http-equiv='refresh' content='0; url=t_pinjam.php'>";	
}else {

$query1 		= mysqli_query($db, "SELECT max(id_detail) as detail FROM detail_pinjam_barang");
	$data 		= mysqli_fetch_array($query1);
	$id 		= $data['detail'];

	$nourut 	= (int)substr($id,2, 3);

	$nourut++;

	$char 		= 'ID';
	$id 		= $char . sprintf("%03s", $nourut);

mysqli_query($db, "INSERT INTO detail_pinjam_barang VALUES('".$id."','".$id_pinjam."', '".$id_barang."', '".$jumlah_pinjam."', '".$nip."')");

mysqli_query($db, "INSERT INTO pinjam_barang VALUES
	('$id_pinjam','$tgl_pinjam','$tgl_kembali','$status_peminjam','$nip')");
header('location:pinjam_barang.php');
}
?>