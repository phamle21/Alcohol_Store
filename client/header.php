<?php

require_once "../database/config.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<title>Alcohol Store</title>

	<meta charset="utf-8">

	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link rel="shortcut icon" href="./build/images/prod-5.jpg" type="image/x-icon">

	<link href="https://fonts.googleapis.com/css2?family=Spectral:ital,wght@0,200;0,300;0,400;0,500;0,700;0,800;1,200;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

	<link rel="stylesheet" href="build/css/animate.css">

	<link rel="stylesheet" href="build/css/owl.carousel.min.css">
	<link rel="stylesheet" href="build/css/owl.theme.default.min.css">
	<link rel="stylesheet" href="build/css/magnific-popup.css">

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.min.css">

	<link rel="stylesheet" href="build/css/flaticon.css">
	<link rel="stylesheet" href="build/css/style.css">

	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>

<body>

	<div class="wrap">
		<div class="container">
			<div class="row">
				<div class="col-md-6 d-flex align-items-center">
					<p class="mb-0 phone pl-md-2">
						<a href="#" class="mr-2"><span class="fa fa-phone mr-1"></span> +00 1234 567</a>
						<a href="#"><span class="fa fa-paper-plane mr-1"></span> youremail@email.com</a>
					</p>
				</div>
				<div class="col-md-6 d-flex justify-content-md-end">
					<div class="social-media mr-4">
						<!-- <p class="mb-0 d-flex">
							<a href="#" class="d-flex align-items-center justify-content-center"><span class="fa fa-facebook"><i class="sr-only">Facebook</i></span></a>
							<a href="#" class="d-flex align-items-center justify-content-center"><span class="fa fa-twitter"><i class="sr-only">Twitter</i></span></a>
							<a href="#" class="d-flex align-items-center justify-content-center"><span class="fa fa-instagram"><i class="sr-only">Instagram</i></span></a>
							<a href="#" class="d-flex align-items-center justify-content-center"><span class="fa fa-dribbble"><i class="sr-only">Dribbble</i></span></a>
						</p> -->
					</div>
					<div class="reg">
						<p class="mb-0"><a href="#" class="mr-2">Sign Up</a> <a href="#">Log In</a></p>
					</div>
				</div>
			</div>
		</div>
	</div>

	<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
		<div class="container">
			<a class="navbar-brand" href="index.html">Liquor <span>store</span></a>
			<!-- Cart -->
			<div class="order-lg-last btn-group">
				<a href="#" class="btn-cart dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<span class="flaticon-shopping-bag"></span>
					<div class="d-flex justify-content-center align-items-center"><small>3</small></div>
				</a>
				<div class="dropdown-menu dropdown-menu-right">
					<div class="dropdown-item d-flex align-items-start" href="#">
						<div class="img" style="background-image: url(../build/images/prod-1.jpg);"></div>
						<div class="text pl-3">
							<h4>Bacardi 151</h4>
							<p class="mb-0"><a href="#" class="price">$25.99</a><span class="quantity ml-3">Quantity: 01</span></p>
						</div>
					</div>
					<div class="dropdown-item d-flex align-items-start" href="#">
						<div class="img" style="background-image: url(../build/images/prod-2.jpg);"></div>
						<div class="text pl-3">
							<h4>Jim Beam Kentucky Straight</h4>
							<p class="mb-0"><a href="#" class="price">$30.89</a><span class="quantity ml-3">Quantity: 02</span></p>
						</div>
					</div>
					<div class="dropdown-item d-flex align-items-start" href="#">
						<div class="img" style="background-image: url(../build/images/prod-3.jpg);"></div>
						<div class="text pl-3">
							<h4>Citadelle</h4>
							<p class="mb-0"><a href="#" class="price">$22.50</a><span class="quantity ml-3">Quantity: 01</span></p>
						</div>
					</div>
					<a class="dropdown-item text-center btn-link d-block w-100" href="cart.html">
						View All
						<span class="ion-ios-arrow-round-forward"></span>
					</a>
				</div>
			</div>
			<!-- /Cart -->

			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
				<span class="oi oi-menu"></span> Menu
			</button>

			<div class="collapse navbar-collapse" id="ftco-nav">
				<ul class="navbar-nav ml-auto">
					<li class="nav-item">
						<a href="index.php" class="nav-link client-link">Home</a>
					</li>
					<li class="nav-item">
						<a href="about.php" class="nav-link client-link">About</a>
					</li>
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Products</a>
						<div class="dropdown-menu" aria-labelledby="dropdown04">
							<a class="dropdown-item client-link" href="product.php">Products</a>
							<a class="dropdown-item client-link" href="cart.php">Cart</a>
							<a class="dropdown-item client-link" href="checkout.php">Checkout</a>
						</div>
					</li>
					<li class="nav-item">
						<a href="contact.php" class="nav-link client-link">Contact</a>
					</li>
				</ul>
				<script>
					$('.client-link').each(function(i) {
						if (window.location == this.href) {
							$('.client-link').eq(i).addClass('active')
							$('.client-link').eq(i).parent('.nav-item').addClass('active')
							$('.client-link').eq(i).parent().parent('.nav-item').addClass('active')
						}
					})
				</script>
			</div>
		</div>
	</nav>
	<!-- END nav -->