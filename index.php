<?php session_start(); ?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
<head>
	<meta charset="utf-8">

	<title>DNA: Home</title>

	<?php include('includes/bootstrap.php'); ?>
<style>
	@font-face{
		font-family: "Spider-man";
		src: url("includes/fonts/Spider-Man.woff2");
	}
	@font-face {
		font-family: "Little-nightmares";
		src: url("includes/fonts/AmaticSC-Bold.woff2");
	}
	.bg{
		background: #2F669C;
	}
	.bg_card{
		background: #20517B !important;
	}
	.spider-man{
		font-family: "Spider-man";
	}
	.little-nightmares{
		font-family: "Little-nightmares";
	}
</style>
</head>
<body class="bg mw-100 mh-100">
	<?php
		if (isset($_SESSION['id_account'])) {
			include('profile/includes/header_members.php');

		}else{
	 ?>
  <?php include('includes/header.php'); }?>

	<!--Carousel -->
	<div id="carouselIndicators" class="carousel slide" data-bs-ride="carousel">
		<ol class="carousel-indicators">
			<li data-bs-target="#carouselIndicators" data-bs-slide-to="0" class="active"></li>
			<li data-bs-target="#carouselIndicators" data-bs-slide-to="1"></li>
			<li data-bs-target="#carouselIndicators" data-bs-slide-to="2"></li>
			<li data-bs-target="#carouselIndicators" data-bs-slide-to="3"></li>
		</ol>
		<div class="carousel-inner img-fluid">
			<div class="carousel-item active" data-bs-interval="3000">
				<img src="https://my-test-11.slatic.net/shop/32f33c3f26f1044ff2ab5ebda5132b3e.jpeg" height="848px" class="d-block img-fluid">
			</div>
			<div class="carousel-item" data-bs-interval="3000">
				<img src="https://jeuxvideo.rds.ca/wp-content/uploads/sites/2/2021/01/hogwarts-legacy-2.jpg" height="848px" class="d-block img-fluid">
			</div>
			<div class="carousel-item" data-bs-interval="3000">
				<img src="https://i1.wp.com/bunnygaming.com/wp-content/uploads/2020/09/nightmares-2.jpg?resize=1920%2C1080&ssl=1" height="848px" class="d-block img-fluid">
			</div>
			<div class="carousel-item" data-bs-interval="3000">
				<img src="https://www.actugaming.net/wp-content/uploads/2020/06/spider-man-miles-morales-3.jpg" height="848px" class="d-block img-fluid">
			</div>

		</div>
		<a class="carousel-control-prev" href="#carouselIndicators" role="button" data-bs-slide="prev">
			<span class="carousel-control-prev-icon" aria-hidden="true"></span>
			<span class="visually-hidden">Previous</span>
		</a>
		<a class="carousel-control-next" href="#carouselIndicators" role="button" data-bs-slide="next">
			<span class="carousel-control-next-icon" aria-hidden="true"></span>
			<span class="visually-hidden">Next</span>
		</a>
	</div>
	<!--Fin Carousel -->
	<br>
	<div class="row container mx-auto">
		<div class="mb-3 col-sm-3">
			<div class="card bg_card">
			  <img src="https://i.pinimg.com/originals/b7/e3/22/b7e322cf32093d262990cb7cd2447903.jpg" class="card-img-top" alt="">
			  <div class="card-body">
			    <h2 class="card-title text-center"><strong>Assassin's Creed Valhalla</strong></h2>
			    <p class="card-text"></p>
			    <a href="https://dna-esgi.fr/pages/videos_games/ac_valhalla.php" class="btn btn-primary">See more...</a>
	  		</div>
			</div>
		</div>
			<div class="mb-3 col-sm-3">
				<div class="card bg_card">
				  <img src="https://d3isma7snj3lcx.cloudfront.net/images/gallery/35/353079/hogwarts-legacy-l-heritage-de-poudlard-ps5-ps4-xbox-x-s-xone-pc-d9a65a03.jpg" class="card-img-top" alt="">
				  <div class="card-body">
				    <h2 class="card-title text-center"><strong>Hogwarts<br>Legacy</strong></h2>
				    <p class="card-text"></p>
				    <a href="#" class="btn btn-primary">See more...</a>
		  		</div>
				</div>
			</div>
			<div class="mb-3 col-sm-3">
				<div class="card bg_card">
				  <img src="https://as.com/meristation/imagenes/2020/11/07/avances/1604731931_828097_1604739668_noticia_normal.jpg" class="card-img-top" alt="">
				  <div class="card-body">
				    <h1 class="card-title text-center little-nightmares">Little Nightmares 2</h1>
				    <p class="card-text"></p>
				    <a href="#" class="btn btn-primary">See more...</a>
		  		</div>
				</div>
			</div>
			<div class="mb-3 col-sm-3">
				<div class="card bg_card">
				  <img src="https://image.api.playstation.com/vulcan/ap/rnd/202008/1420/HcLcfeQBXd2RiQaCeWQDCIFN.jpg" class="card-img-top" alt="">
				  <div class="card-body">
				    <h1 class="card-title text-center spider-man">Spider-Man, Miles Morales</h1>
						<a href="#" class="btn btn-primary">See more...</a>
				</div>
			</div>
		</div>
		</div>

</body>
</html>
