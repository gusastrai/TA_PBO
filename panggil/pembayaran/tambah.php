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

		$pembayaran_kamar = mysqli_fetch_array($koneksi->query("SELECT bayarkamar FROM view_pembayarankamar WHERE id_inap = {$_POST['id_inap']}"));

		$pembayaran_obat = mysqli_fetch_array($koneksi->query("SELECT totalObat FROM view_pembayaranobat WHERE id_inap = {$_POST['id_inap']}"));

		$total = $pembayaran_kamar['bayarkamar'] + $pembayaran_obat['totalObat'];

		$sql = "INSERT INTO pembayaran VALUES ('','".$_POST['tanggal']."','".$_POST['id_inap']."', $total)";

		if(!$koneksi->query($sql)){
			echo $koneksi->error;
			die();
		}
	} catch (Exception $error) {
		echo $error;
		die();
	}

	header("Location: index.php?lihat=pembayaran/index");
}

?>

<!-- start row -->
<div class="row">
	<!-- start col -->
	<div class="col-lg-6">

		<h3 class = "text-primary">Tambah Data Pembayaran</h3>
		<hr style = "border-top:1px dotted #000;"/>
		<!-- start form -->
		<form action="" method="POST">	

			<div class="form-group">
				<label>Tanggal Pembayaran</label>
				<input type="date" class="form-control" name="tanggal" required>
			</div>

			<div class="form-group">
				<label>Id Inap</label>
				<select class="form-control" name="id_inap">
					<?php $result = mysqli_query($koneksi, "SELECT *FROM inap ORDER BY id_inap") ?>
					<option value="0">--pilih id inap--</option>
					<?php while($row = mysqli_fetch_assoc($result)): ?>
						<option value="<?= $row['id_inap']; ?>"><?= $row['id_inap']; ?></option>
					<?php endwhile ?>
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
