<?php
	require_once('koneksi.php');
	
	try {
		$sql = "DELETE FROM inap WHERE id_inap = {$_GET['id_inap']}";
		$koneksi->query($sql);
	} catch (Exception $error) {
		echo $error;
		die();
	}
	
	header("Location: index.php?lihat=inap/index");
?>