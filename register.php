<?php

	session_start();
	include_once 'include/class.user.php';
	$user = new Pasien();

	$error = "";

	if (isset($_POST['submit'])) { 
		extract($_POST);

		if (!empty($username) && !empty($password) && !empty($nama) && !empty($gender) && !empty($tel) && !empty($alamat)) {
			$cek = $user->reg_user($error, $_POST);
			if ($cek) {
				header("Location: login.php");
			}
		} else {
			$error = "data tidak boleh ada yang kosong";
		}
	}

?>


<!DOCTYPE html>
<html>
<head>
	<title>Umum Hospital</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body background="gambar/background.jpg">

	<h1>Rumah Sakit Umum</h1>

	<div class="kotak_login">
		<p class="tulisan_login">register</p>
		<p style="color:red;"><?= $error; ?></p>
		<!-- start form -->
		<form method="post" action="register.php">
			<!-- username -->
			<label>Username</label>
			<input type="text" name="username" class="form_login" placeholder="Username .." value="<?php echo htmlspecialchars($_POST["username"] ?? '') ?>">
			<!-- password -->
			<label>Password</label>
			<input type="password" name="password" class="form_login" placeholder="Password .." value="<?php echo htmlspecialchars($_POST["password"] ?? '') ?>">
			<!-- nama -->
			<label>Nama</label>
			<input type="nama" name="nama" class="form_login" placeholder="nama .." value="<?php echo htmlspecialchars($_POST["nama"] ?? '') ?>">
			<!-- jenis kelamin -->
            <label>Jenis Kelamin</label>
            <div class="gender-box" style="margin-bottom: 10px;">
                <label for="male" class="gen">Laki-Laki</label>
                <input type="radio" name="gender" id="male" value="laki-laki" <?php echo (isset($_POST["gender"]) && $_POST["gender"] === "cowo") ? "checked" : ''?>>
                <label for="female" class="gen">Perempuan</label>
                <input type="radio" name="gender" id="female" value="perempuan" <?php echo (isset($_POST["gender"]) && $_POST["gender"] === "cewe") ? "checked" : ''?>>
            </div>
			<!-- nomor telepon -->
			<label>Nomor Telepon</label>
			<input type="tel" name="tel" class="form_login" placeholder="nomor telepon .." value="<?php echo htmlspecialchars($_POST["tel"] ?? '') ?>">
			<!-- alamat -->
			<label>Alamat</label>
			<input type="text" name="alamat" class="form_login" placeholder="Alamat .." value="<?php echo htmlspecialchars($_POST["alamat"] ?? '') ?>">
			<!-- submit -->
			<input type="submit" class="tombol_login" value="REGISTER" name="submit">
				
		</form>
		<!-- end form -->
        <a href="login.php" style="margin-top:10px; display:inline-block;">Kembali</a>
	</div>


</body>
</html>