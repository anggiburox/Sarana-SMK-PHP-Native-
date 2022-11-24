<?php
	session_start();

	include('view/koneksi/config.php');

	$username = $_POST['username'];
	$password = $_POST['password'];

	$data = mysqli_query($db, "SELECT * FROM user 
						       WHERE user.username='".$username."' AND user.password='".$password."' ");
	$row = mysqli_fetch_array($data);
	$cek = mysqli_num_rows($data);

	if ($cek > 0) {
		$_SESSION['id_user'] = $row['id_user'];
		$_SESSION['nama'] 	 = $row['nama'];
		$_SESSION['level']   = $row['level'];
		$_SESSION['status']  = 'login';
		header("location:view/Dashboard/dashboard.php");
	}else{
		header("location:index.php?pesan=gagal");
	}
?>