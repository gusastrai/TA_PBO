<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style type="text/css">
		form, table{
			border: 3px solid #f1f1f1;
			background-color: white;
			font-family: arial;
			font-size: 15px;
			padding: 10px;
			border-radius: 30px;
		}
	</style>
</head>
<body>

</body>
</html>
<?php
	require_once('koneksi.php');

	$query 	= "SELECT * FROM pasien p JOIN users u ON p.id_user = u.uid JOIN inap i ON i.id_pasien = p.id_pasien JOIN kamar k ON i.id_kamar = k.id_kamar JOIN pembayaran pb ON i.id_inap = pb.id_inap JOIN detail_obat do ON i.id_inap = do.id_inap JOIN obat o ON do.id_obat = o.id_obat";

	$link 	= "index.php?lihat=pasien/";
?>

<!-- start row -->
<div class="row">
	<!-- start col -->
	<div class="col-lg-12">

		<h3 class = "text-primary">Data Pasien</h3>
		<hr style = "border-top:1px dotted #000;"/>
		<!-- start box -->
		<div class="box-body table-responsive no-padding">
			<!-- start table -->
			<table class="table table-hover table-bordered" style="margin-top: 10px">

				<tr class="info">
					<th>No</th>
					<th>Id Pasien</th>
					<th>Username</th>
					<th>Nama Pasien</th>
					<th>Jenis Kelamin</th>
					<th>No Telp</th>
					<th>Alamat</th>
				</tr>
				
				<!-- start if -->
				<?php if($data = mysqli_query($koneksi,$query)): ?>
					<?php $no=1 ?>
					<!-- start while -->
					<?php while($tampil = mysqli_fetch_object($data)): ?>

						<tr>
							<td><?= $no ?></td>
							<td><?= $tampil->id_pasien ?></td>
							<td><?= $tampil->uname ?></td>
							<td><?= $tampil->nama_pasien?></td>
							<td><?= $tampil->jk ?></td>
							<td><?= $tampil->no_telp ?></td>
							<td><?= $tampil->alamat ?></td>
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