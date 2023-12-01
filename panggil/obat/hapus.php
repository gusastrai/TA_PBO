<?php
	require_once('koneksi.php');
	
	try {
		$sql = "DELETE FROM obat WHERE id_obat = {$_GET['id_obat']}";
		$koneksi->query($sql);
	} catch (Exception $error) {
		echo $error;
		die();
	}

	header("Location: index.php?lihat=obat/index");
?>