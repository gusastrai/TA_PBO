<?php
session_start();

if(empty($_SESSION['login'])){
  header("location:login.php");
}
include("include/class.user.php");

if (isset($_SESSION['user'])) {
  $user = unserialize($_SESSION['user']);
} 

$info = $user->get_info();

?>
<!DOCTYPE html>
<html>

<head>
  <title>Rumah Sakit Umum</title>

  <!-- Panggil Bootstrap -->
  <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
</head>

<body background="gambar/background.jpg">
  <nav class="navbar navbar-default navbar-static-top">
    <div class="container">
      <div class="navbar-header">
       <a class="navbar-brand" href="index.php">Rumah Sakit Umum</a>
     </div>
     <div id="navbar" class="navbar-collapse collapse">
      <ul class="nav navbar-nav">

        <li role="presentation" class="dropdown">
          <a href="pasien.php">
            <span class="glyphicon glyphicon-home"></span> Beranda
          </a>
        </li>
        <li role="presentation" class="dropdown">
          <a href="pasien.php?lihat=user/index">
            <span class="glyphicon glyphicon-bed"></span> Rekam Medis
          </a>
        </li>
            <li>
              <a href="logout.php">
                <span class=" glyphicon glyphicon-off"></span> Logout
              </a>
            </li>

          </ul>
        </div>
      </div>
    </nav>


    <div class="container">

      <?php if(!empty($_GET['lihat'])){
        include('panggil/'.$_GET['lihat'].'.php');
      } else{ ?>
        <div class="jumbotron">
            <h2><center>Welcome, <?= $info['nama']; ?></center></h2>
        </div>
      <?php } ?>

    </div> <!-- .container -->


  </body>

  </html>
