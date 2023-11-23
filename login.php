<?php

	session_start();
	include_once 'include/class.user.php';
	$user = new User();

	$error = "";

	if (isset($_POST['submit'])) { 
		extract($_POST);
		if (!empty($username) && !empty($password)) {
			$login = $user->check_login($username, $password);
			if ($login) {
				header("location:index.php");
			} else {
				$error = "Username atau Password salah";
			}
		} else {
			$error = "Username atau Password tidak boleh kosong";
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
		<p class="tulisan_login">login</p>
		<p style="color:red;"><?= $error; ?></p>
		<form method="post" action="login.php">
			<label>Username</label>
			<input type="text" name="username" class="form_login" placeholder="Username .." value="<?php echo $_POST["username"] ?? '' ?>">

			<label>Password</label>
			<input type="password" name="password" class="form_login" placeholder="Password .." value="<?php echo $_POST["password"] ?? '' ?>">

			<input type="submit" class="tombol_login" value="LOGIN" name="submit">
				
		</form>
		
	</div>
 
 
</body>
</html>