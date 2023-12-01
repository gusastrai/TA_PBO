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

	$query 	= "SELECT * FROM kamar";

	$link 	= "index.php?lihat=kamar/";
?>

<!-- start row -->
<div class="row">
	<!-- start col -->
	<div class="col-lg-12">

		<h3 class = "text-primary">Data Kamar</h3>
		<hr style = "border-top:1px dotted #000;"/>

		<a href="<?= $link.'tambah' ?>" class="btn btn-success btn-sm">
			<span class="glyphicon glyphicon-plus"></span> Tambah
		</a>
		
		<!-- start box -->
		<div class="box-body table-responsive no-padding">
			<!-- start table -->
			<table class="table table-hover table-bordered" style="margin-top: 10px">

				<tr class="info">
					<th>No</th>
					<th>Id Kamar</th>
					<th>Nama Kamar</th>
					<th>Kelas Kamar</th>
					<th>Kapasitas</th>
					<th>Harga</th>
					<th style="text-align: center;">Aksi</th>
				</tr>
				
				<!-- start if -->
				<?php if($data = mysqli_query($koneksi,$query)): ?>
					<?php $no=1 ?>
					<!-- start while -->
					<?php while($tampil = mysqli_fetch_object($data)): ?>

						<tr>
							<td><?= $no ?></td>
							<td><?= $tampil->id_kamar?></td>
							<td><?= $tampil->nama_kamar?></td>
							<td><?= $tampil->kelas ?></td>
							<td><?= $tampil->kapasitas ?></td>
							<td><?= $tampil->harga ?></td>

							<td style="text-align: center;">
								<a href="<?= $link.'edit&id_kamar='.$tampil->id_kamar?>" class="btn btn-primary btn-sm">
									<span class="glyphicon glyphicon-edit"></span>
								</a>
								<a onclick="return confirm('Apakah yakin data akan di hapus?')" href="<?= $link.'hapus&id_kamar='.$tampil->id_kamar ?>" class="btn btn-danger btn-sm">
									<span class="glyphicon glyphicon-trash"></span>
								</a>
							</td>
						</tr>
					
						<?php $no++ ?>
					<?php endwhile ?>
					<!-- end while -->
				<?php endif ?>
				<!-- end if -->

			</table>
			<!-- end table -->
		</div>
		<!-- end box -->
	</div>
	<!-- end col -->
</div>
<!-- end row -->