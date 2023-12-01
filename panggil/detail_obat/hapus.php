<?php
	require_once('koneksi.php');
	
	try {
		$sql = "DELETE FROM detail_obat WHERE id_detail = {$_GET['id_detail']}";
		$koneksi->query($sql);
	} catch (Exception $error) {
		echo $error;
		die();
	}

	header("Location: index.php?lihat=detail_obat/index");
?>