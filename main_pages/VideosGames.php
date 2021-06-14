<?php session_start(); ?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>DNA: VideosGames</title>
    <?php include('../includes/bootstrap.php'); ?>
  </head>
  <body>
    <?php
  		if (isset($_SESSION['id_account'])) {
  			include('../profile/includes/header_members.php');

  		}else{
  	 ?>
    <?php include('../includes/header.php'); }?>


  </body>
</html>
