<!DOCTYPE html>
<html>

<head>
    <title>Medical Records</title>
    <style type="text/css">
        form,
        table {
            border: 3px solid #f1f1f1;
            background-color: white;
            font-family: arial;
            font-size: 15px;
            padding: 10px;
            border-radius: 30px;
        }

        .record-container {
            border: 1px solid #f1f1f1;
            background-color: white;
            margin-top: 10px;
            padding: 15px;
            border-radius: 10px;
        }

        .record-heading {
            font-size: 18px;
            font-weight: bold;
            color: #333;
        }

        .record-info {
            margin-top: 8px;
            font-size: 16px;
            color: #555;
        }
    </style>
</head>

<body>
    <?php
    require_once('koneksi.php');

    $uname = $info['username'];

    $data_pasien = "SELECT * FROM pasien p 
    JOIN users u ON p.id_user = u.uid
    WHERE uname = '$uname'";

    $data_inap = "SELECT * FROM inap i 
    JOIN pasien p ON p.id_pasien = i.id_pasien
    JOIN kamar k ON k.id_kamar = i.id_kamar
    JOIN users u ON u.uid = p.id_user
    WHERE uname = '$uname'";

    $data_obat = "SELECT * FROM inap i 
    JOIN pasien p ON p.id_pasien = i.id_pasien
    JOIN users u ON u.uid = p.id_user
    JOIN detail_obat do ON do.id_inap = i.id_inap
    JOIN obat o ON do.id_obat = o.id_obat
    WHERE uname = '$uname'";

    $data_pembayaran = "SELECT * FROM inap i 
    JOIN pasien p ON p.id_pasien = i.id_pasien
    JOIN users u ON u.uid = p.id_user
    JOIN pembayaran pb ON pb.id_inap = i.id_inap
    WHERE uname = '$uname'";

    $link = "index.php?lihat=rekam_medis/";
    ?>

<!-- Menampilkan Data Rekam Medis -->
<?php if ($data = mysqli_query($koneksi, $data_pasien)):?>
    <?php while ($tampil = mysqli_fetch_object($data)): ?>
        <div class="row">
            <div class="col-lg-12">
                <h3 class="text-primary">Data Pasien</h3>
                <hr style="border-top:1px dotted #000;" />
                <div class="record-container">
                    <div class="record-info"><strong>Nama Pasien:</strong> <?= $tampil->nama_pasien ?></div>
                    <div class="record-info"><strong>Jenis Kelamin:</strong> <?= $tampil->jk ?></div>
                    <div class="record-info"><strong>Nomor Telepon:</strong> <?= $tampil->no_telp ?></div>
                    <div class="record-info"><strong>Alamat:</strong> <?= $tampil->alamat ?></div>
                </div>
            </div>
        </div>
    <?php endwhile; ?>
<?php endif;  ?>

<?php if ($data = mysqli_query($koneksi, $data_inap)):?>
    <?php while ($tampil = mysqli_fetch_object($data)): ?>
        <div class="row">
            <div class="col-lg-12">
                <h3 class="text-primary">Data Inap</h3>
                <hr style="border-top:1px dotted #000;" />
                <div class="record-container">
                    <div class="record-info"><strong>Tanggal Masuk : </strong> <?= $tampil->tgl_masuk ?></div>
                    <div class="record-info"><strong>Tanggal Keluar : </strong> <?= $tampil->tgl_keluar ?></div>
                    <div class="record-info"><strong>Lama : </strong> <?= $tampil->lama ?> Hari</div>
                    <div class="record-info"><strong>ID Kamar : </strong> <?= $tampil->id_kamar ?></div>
                    <div class="record-info"><strong>Nama Kamar : </strong> <?= $tampil->nama_kamar ?></div>
                    <div class="record-info"><strong>Kelas : </strong> <?= $tampil->kelas ?></div>
                    <div class="record-info"><strong>Harga : </strong> <?= $tampil->harga ?></div>
                </div>
            </div>
        </div>
    <?php endwhile; ?>
<?php endif;  ?>

<h3 class="text-primary">Data Obat</h3>
<hr style="border-top:1px dotted #000;" />
<?php if ($data = mysqli_query($koneksi, $data_obat)):?>
    <?php while ($tampil = mysqli_fetch_object($data)): ?>
        <div class="row">
            <div class="col-lg-12">
                <div class="record-container">
                    <div class="record-info"><strong>Nama Obat : </strong> <?= $tampil->nama_obat ?></div>
                    <div class="record-info"><strong>Harga : </strong> <?= $tampil->harga ?></div>
                </div>
            </div>
        </div>
    <?php endwhile; ?>
<?php endif;  ?>

<?php if ($data = mysqli_query($koneksi, $data_pembayaran)):?>
    <?php while ($tampil = mysqli_fetch_object($data)): ?>
        <div class="row">
            <div class="col-lg-12">
                <h3 class="text-primary">Data Pembayaran</h3>
                <hr style="border-top:1px dotted #000;" />
                <div class="record-container">
                    <div class="record-info"><strong>Tanggal Pembayaran : </strong> <?= $tampil->tanggal ?></div>
                    <div class="record-info"><strong>Total Pembayaran : </strong> <?= $tampil->total ?></div>
                </div>
            </div>
        </div>
    <?php endwhile; ?>
<?php endif;  ?>
            
</body>

</html>
