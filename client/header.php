<?php

require_once "../database/config.php";

if (isset($_COOKIE['login_kh'])) {
	$mskh = $_COOKIE['login_kh'];
	$sql_login_kh = "SELECT * FROM khachhang WHERE MSKH = '$mskh'";
	$result_loginkh = $con->query($sql_login_kh);
	$row = $result_loginkh->fetch_assoc();

	$ten_kh = $row['HoTenKH'];
	$sdt_kh = $row['SoDienThoai'];
	$diachi_kh = $row['DiaChi'];
}
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
	<link rel="stylesheet" href="build/css/my_style.css">

	<!-- sweetalert2 -->
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
					<?php if (isset($_COOKIE['login_kh'])) : ?>
						<div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 ">
							<a id="btn_dropdown" class="text-white"><i class="fa fa-user"></i> <?= $ten_kh ?></a>
						</div>
						<div class="user_dropdown text-white mx-3" id="user_dropdown">
							<i class="fa fa-sign-out"></i><a href="./controller/xuly_logout.php" class="text-white"> Logout</a>
						</div>
					<?php else : ?>
						<div class="reg">
							<p class="mb-0"><a href="register.php" class="mr-2">Sign Up</a> <a href="login.php">Log In</a></p>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>

	<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
		<div class="container">
			<a class="navbar-brand" href="index.php">Liquor <span>store</span></a>
			<!-- Cart -->
			<div class="order-lg-last btn-group">
				<a href="#" class="btn-cart dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-auto-close="false">
					<span class="flaticon-shopping-bag"></span>
					<div class="d-flex justify-content-center align-items-center"><small id="count_cart">0</small></div>
				</a>
				<div class="dropdown-menu dropdown-menu-right drop-menu-cart" aria-labelledby="dropdownMenuClickable">
					<div id="ajax_addcart">

						<?php
						session_start();
						
						if (isset($_SESSION['cart'])) {
							$i = 0;
							$tongtien = 0;
							foreach ($_SESSION['cart'] as $cart_item) {
								$thanhtien = $cart_item['SoLuongMua'] * $cart_item['Gia'];
								$tongtien += $thanhtien;
								$i++;
						?>
								<div class="dropdown-item d-flex align-items-start" href="#">
									<div class="img hover_cart" style="background-image: url(../images/<?= $cart_item['HinhAnh']; ?>);">
										<a class="delete_sp" style="padding: 2px 8px; color: white">
											<i class="fas fa-trash-alt" onclick="delete_sp_cart(<?= $cart_item['MSHH']; ?>)">X</i>
										</a>
									</div>
									<div class="text pl-3">
										<h4><a href="detail.php?mshh=<?= $cart_item['MSHH']; ?>"><?= $cart_item['TenHH']; ?></a></h4>
										<p class="mb-0">
											<a class="price"><?= number_format($cart_item['Gia']); ?>₫</a>
										</p>
										<div class="soluong_sp_cart d-inline">
											<span class="quantity d-inline">Quantity:
												<a onclick="minus_sp(<?= $cart_item['MSHH']; ?>)"><i class="fa fa-minus fa-style" aria-hidden="true"></i></a>
												<label id="soluong_mua_<?= $cart_item['MSHH']; ?>"><?= $cart_item['SoLuongMua']; ?></label>
												<a onclick="plus_sp(<?= $cart_item['MSHH']; ?>)"><i class="fa fa-plus fa-style" aria-hidden="true"></i></a>
											</span>
										</div>

									</div>
								</div>
						<?php
							}
							if ($i == 0) {
								echo "Giỏ hàng trống!";
							}
						} else { //Không có giỏ hàng
							$i = 0;
							echo "Giỏ hàng trống!";
							$tongtien = 0;
						}

						$count_cart = $i;
						?>
					</div>

					<a class="dropdown-item text-center btn-link d-block w-100" href="cart.php">
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
						<div class="dropdown-menu" style="margin-top: -20px !important;" aria-labelledby="dropdown04">
							<a class="dropdown-item client-link" href="product.php">Products</a>
							<a class="dropdown-item client-link" href="cart.php">Cart</a>
							<!-- <a class="dropdown-item client-link" href="checkout.php">Checkout</a> -->
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