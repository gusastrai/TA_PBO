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
		$date1 = $_POST['tgl_masuk'];
		$date2 = $_POST['tgl_keluar'];

		$lama = ((abs(strtotime ($date2) - strtotime ($date1)))/(60*60*24));

		$sql = "UPDATE inap SET tgl_masuk = '$date1', tgl_keluar = '$date2', lama = $lama, id_pasien = {$_POST['id_pasien']}, id_kamar = {$_POST['id_kamar']} WHERE id_inap = {$_POST['id_inap']}";

		if ($koneksi->query($sql) === TRUE) {
			header("Location: index.php?lihat=inap/index");
		} else {
			echo "Gagal: " . $koneksi->error;
		}

		$koneksi->close();
		
	} else{
		$query = $koneksi->query("SELECT * FROM inap WHERE id_inap = {$_GET['id_inap']}");

		if($query->num_rows > 0){
			$data = mysqli_fetch_object($query);
		}else{
			echo "Data tidak tersedia";
			die();
		}
	}
?>

<!-- start row -->
<div class="row">
	<!-- start col -->
	<div class="col-lg-6">

		<h3 class = "text-primary">Edit Data Rawat Inap</h3>
		<hr style = "border-top:1px dotted #000;"/>
		<!-- start form -->
		<form action="" method="POST">
			<input type="hidden" name="id_inap" value="<?= $data->id_inap ?>">

			<div class="form-group">
				<label>Nama Pasien</label>
				<select class="form-control" name="id_pasien">
					<?php $result = mysqli_query($koneksi, "SELECT * FROM pasien ORDER BY id_pasien"); ?>
					<option value="0">--pilih pasien--</option>
					<?php while ($row = mysqli_fetch_assoc($result)): ?>
						<option value="<?= $row['id_pasien']; ?>"><?= $row['nama_pasien']; ?></option>
					<?php endwhile; ?>
				</select>
			</div>

			<div class="form-group">
				<label>Tanggal Masuk</label>
				<input type="date" value="<?= $data->tgl_masuk ?>" class="form-control" name="tgl_masuk">
			</div>

			<div class="form-group">
				<label>Tanggal Keluar</label>
				<input type="date" value="<?= $data->tgl_keluar ?>" class="form-control" name="tgl_keluar">
			</div>

			<div class="form-group">
				<label>Kamar</label>
				<select class="form-control" name="id_kamar">
					<?php $result= mysqli_query($koneksi, "SELECT * FROM kamar ORDER BY id_kamar"); ?>
					<option value="0">--pilih kamar--</option>
					<?php while ($row = mysqli_fetch_assoc($result)): ?>
						<option value="<?= $row['id_kamar']; ?>"><?= $row['nama_kamar']; ?></option>
					<?php endwhile; ?>
				</select>
			</div>
			
			<button type="submit" class="btn btn-success">
				<span class="glyphicon glyphicon-pencil"></span> Ubah
        	</button>

		</form>
		<!-- end form -->
	</div>
	<!-- end col -->
</div>
<!-- end row -->

