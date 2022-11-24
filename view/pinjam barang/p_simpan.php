<?php
include '../koneksi/config.php';
$id_pinjam		= $_POST['id_pinjam'];
$id_peminjam	= $_POST['id_peminjam'];
$tgl_pinjam		= $_POST['tgl_pinjam'];
$tgl_kembali	= $_POST['tgl_kembali'];
$status			= $_POST['status'];
$id_barang		= $_POST['id_barang'];
$jumlah			= $_POST['jumlah'];

$query =mysqli_query($db, "SELECT * FROM barang WHERE id_barang='$id_barang'");
$row = mysqli_fetch_array($query);
if ($jumlah > $row['jumlah_barang']) {
?>
			<script type="text/javascript">
			alert("Jumlah barang tidak tercukupi");
			</script>
<?php
echo "<meta http-equiv='refresh' content='0; url=tambah.php?id_peminjam=$id_peminjam'>";	
}else {
	$query1 		= mysqli_query($db, "SELECT max(id_detail) as detail FROM detail_pinjam_barang");
	$data 		= mysqli_fetch_array($query1);
	$id 		= $data['detail'];

	$nourut 	= (int)substr($id,2, 3);

	$nourut++;

	$char 		= 'ID';
	$id 		= $char . sprintf("%03s", $nourut);

mysqli_query($db, "INSERT INTO detail_pinjam_barang VALUES('".$id."','".$id_pinjam."', '".$id_peminjam."', '".$id_barang."', '".$jumlah."')");

$dt=mysqli_query($db, "SELECT * FROM peminjam WHERE id_peminjam='$id_peminjam'");
	$data=mysqli_fetch_array($dt);

$query3 	= "INSERT INTO pinjam_barang VALUES('".$id_pinjam."', '".$id_peminjam."', '".$tgl_pinjam."', '".$tgl_kembali."', '".$status."')";
	$sql 		= mysqli_query($db, $query3);

	if ($sql) {
			header("location:tambah.php?id_peminjam=$id_peminjam");
		}
		else{
			echo "Data Gagal Disimpan";
			echo "<a href='../peminjam/t_peminjam.php'>Kembali</a";
		}	
	}
?>