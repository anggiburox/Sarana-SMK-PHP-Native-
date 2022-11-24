<?php
include '../koneksi/config.php';

$id_pinjam		= $_POST['id_pinjam'];
$id_barang		= $_POST['id_barang'];
$jumlah			= $_POST['jumlah'];
$kondisi_barang	= $_POST['kondisi_barang'];
$query =mysqli_query($db, "SELECT * FROM barang WHERE id_barang='$id_barang'");
$row = mysqli_fetch_array($query);

if ($jumlah > $row['jumlah_barang']) {
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

mysqli_query($db, "INSERT INTO detail_pinjam_barang VALUES('".$id."','".$id_pinjam."', '".$id_barang."', '".$jumlah."', '".$kondisi_barang."')");

$query2 	= "INSERT INTO temp_detail VALUES('".$id."', '".$id_pinjam."', '".$id_barang."', '".$jumlah."', '".$kondisi_barang."')";
	$sql 		= mysql_query($query2);
	
header('location:t_pinjam.php');
} 	
?>