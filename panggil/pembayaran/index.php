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
		}
	</style>
</head>
<body>

</body>
</html>

<?php
	require_once('koneksi.php');

	$query 	= "SELECT pb.*, vp.nama_pasien, vpbo.totalObat, vpbk.bayarkamar FROM pembayaran pb 
	JOIN view_passien vp ON pb.id_inap = vp.id_inap 
	JOIN view_pembayaranobat vpbo ON pb.id_inap = vpbo.id_inap 
	JOIN view_pembayarankamar vpbk ON pb.id_inap = vpbk.id_inap";

	$link 	= "index.php?lihat=pembayaran/";
?>

<!-- start row -->
<div class="row">
	<!-- start col -->
	<div class="col-lg-12">

		<h3 class = "text-primary">Data Pembayaran</h3>
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
					<th>Kode Pembayaran</th>
					<th>Tanggal Pembayaran</th>
					<th>Id Inap</th>
					<th>Nama Pasien</th>
					<th>Harga Kamar</th>
					<th>Total Obat</th>
					<th>Total Bayar</th>
					<th style="text-align: center;">Aksi</th>	
				</tr>

				<?php if($data = mysqli_query($koneksi,$query)): ?>
					<?php $no=1 ?>
					<?php while($tampil = mysqli_fetch_object($data)): ?>

						<tr>
							<td><?= $no ?></td>
							<td><?= $tampil->id_pembayaran?></td>
							<td><?= $tampil->tanggal?></td>
							<td><?= $tampil->id_inap?></td>
							<td><?= $tampil->nama_pasien?></td>
							<td><?= $tampil->bayarkamar?></td>
							<td><?= $tampil->totalObat?></td>
							<td><?= $tampil->total?></td>

							<td style="text-align: center;">
								<a href="<?= $link.'edit&id_pembayaran='.$tampil->id_pembayaran ?>" class="btn btn-primary btn-sm">
									<span class="glyphicon glyphicon-edit"></span>
								</a>
								<a onclick="return confirm('Apakah yakin data akan di hapus?')" href="<?= $link.'hapus&id_pembayaran='.$tampil->id_pembayaran ?>" class="btn btn-danger btn-sm">
									<span class="glyphicon glyphicon-trash"></span>
								</a>
							</td>
						</tr>
					
						<?php $no++ ?>
					<?php endwhile ?>
				<?php endif ?>

			</table>
			<!-- end table -->
		</div>
		<!-- end box -->
	</div>
	<!-- end col -->
</div>
<!-- end row -->