<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style type="text/css">
		form, table{
			border: 3px solid #f1f1f1;
			background-color: white;
			font-family: arial;
			width: 500px;
			margin: auto;
			padding: 20px;
		}
	</style>
</head>
<body>

</body>
</html>

<?php 

require_once('koneksi.php'); 

if($_POST){
	try {
		$sql = "INSERT INTO detail_obat (id_detail, id_inap, id_obat) VALUES (null, {$_POST['id_inap']}, {$_POST['id_obat']})";

		if(!$koneksi->query($sql)){
			echo $koneksi->error;
			die();
		}
	} catch (Exception $error) {
		echo $error;
		die();
	}

	header("Location: index.php?lihat=detail_obat/index");
}

?>

<!-- start row -->
<div class="row">
	<!-- start col -->
	<div class="col-lg-6">

		<h3 class = "text-primary">Tambah Data Detail Obat</h3>
		<hr style = "border-top:1px dotted #000;"/>
		<!-- start form -->
		<form action="" method="POST">

			<div class="form-group">
				<label>Id Inap</label>
				<select class="form-control" name="id_inap">
					<?php $result = mysqli_query($koneksi, "SELECT * FROM inap ORDER BY id_inap"); ?>
					<option value="0">--pilih id inap--</option>
					<?php while ($row = mysqli_fetch_assoc($result)): ?>
						<option value="<?= $row['id_inap']; ?>"><?= $row['id_inap']; ?></option>
					<?php endwhile; ?>
				</select>
			</div>
			
			<div class="form-group">
				<label>Nama Obat</label>
				<select class="form-control" name="id_obat">
					<?php $result = mysqli_query($koneksi, "SELECT * FROM obat ORDER BY id_obat"); ?>
					<option value="0">--pilih nama obat--</option>
					<?php while ($row = mysqli_fetch_assoc($result)): ?>
						<option value="<?= $row['id_obat']; ?>"><?= $row['nama_obat']; ?></option>
					<?php endwhile; ?>
				</select>
			</div>

			<button type="submit" class="btn btn-success">
				<span class="glyphicon glyphicon-floppy-disk"></span> Simpan
			</button>

		</form>
		<!-- end form -->
	</div>
	<!-- end col -->
</div>
<!-- end row -->