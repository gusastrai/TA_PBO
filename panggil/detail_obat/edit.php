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

		$sql = "UPDATE detail_obat SET id_inap = {$_POST['id_inap']}, id_obat = {$_POST['id_obat']} WHERE id_detail = {$_POST['id_detail']}";

		if ($koneksi->query($sql) === TRUE) {
		    header("Location: index.php?lihat=detail_obat/index");
		} else {
		    echo "Gagal: " . $koneksi->error;
		}

		$koneksi->close();
		
	} else{
		$query = $koneksi->query("SELECT * FROM detail_obat WHERE id_detail = {$_GET['id_detail']}");

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

		<h3 class = "text-primary">Edit Data Detail Obat</h3>
		<hr style = "border-top:1px dotted #000;"/>
		<!-- start form -->
		<form action="" method="POST">
			<input type="hidden" name="id_detail" value="<?= $data->id_detail ?>">
			
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
				<span class="glyphicon glyphicon-pencil"></span> Ubah
			</button>
			
		</form>
		<!-- end form -->
	</div>
	<!-- end col -->
</div>
<!-- end row -->

