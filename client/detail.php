<?php

include_once "header.php";

$mshh = $_GET['mshh'];
$result_hh = $con->query("SELECT a.*
							FROM hanghoa as a 
							WHERE a.MSHH='$mshh'")->fetch_assoc();

$tenhh = $result_hh['TenHH'];
$mota = $result_hh['MoTaHH'];
$soluong = $result_hh['SoLuongHang'];
$gia = number_format($result_hh['Gia']);

$res_img = $con->query("SELECT * FROM hinhhanghoa WHERE MSHH='$mshh' LIMIT 1");
$img_demo = $res_img->fetch_assoc()['TenHinh'];

?>

<section class="hero-wrap hero-wrap-2" style="background-image: url('build/images/bg_2.jpg');" data-stellar-background-ratio="0.5">
	<div class="overlay"></div>
	<div class="container">
		<div class="row no-gutters slider-text align-items-end justify-content-center">
			<div class="col-md-9 ftco-animate mb-5 text-center">
				<p class="breadcrumbs mb-0"><span class="mr-2"><a href="index.html">Home <i class="fa fa-chevron-right"></i></a></span> <span><a href="product.html">Products <i class="fa fa-chevron-right"></i></a></span> <span>Products Single <i class="fa fa-chevron-right"></i></span></p>
				<h2 class="mb-0 bread">Products Single</h2>
			</div>
		</div>
	</div>
</section>

<section class="ftco-section">
	<div class="container">
		<div class="row">
			<div class="col-lg-6 mb-5 ftco-animate d-flex flex-column align-items-center">
				<div class="row">
					<a href="../images/<?= $img_demo ?>" class="image-popup ">
						<img src="../images/<?= $img_demo ?>" class="img-fluid img_demo" alt="Colorlib Template">
					</a>
				</div>
				<div class="row">
					<?php
					$hinh = $con->query("SELECT * FROM hinhhanghoa WHERE MSHH='$mshh'");
					while ($img = $hinh->fetch_assoc()) {
					?>
						<div class="col-3 m-3 d-flex justify-content-center">
							<img src="../images/<?= $img['TenHinh'] ?>" width="100px" class="border border-secondary img_more_detail" alt="">
						</div>
					<?php
					}
					?>
				</div>
			</div>

			<div class="col-lg-6 product-details pl-md-5 ftco-animate">
				<form id="addCartForm<?= $mshh; ?>" class="product ftco-animate" onsubmit="return add_cart(<?= $mshh; ?>)">

					<h3><?= $tenhh ?></h3>
					<p class="price"><span><?= $gia ?>đ</span></p>
					<p><?= $mota ?></p>
					<div class="row mt-4">
						<div class="input-group col-md-6 d-flex mb-3">
							<span class="input-group-btn mr-2">
								<button type="button" class="quantity-left-minus minus_detail btn" data-type="minus" data-field="">
									<i class="fa fa-minus"></i>
								</button>
							</span>
							<input type="text" id="quantity_detail" name="sl_mua" class="quantity-detail quantity form-control input-number" value="1" min="1" max="<?= $soluong?>">
							<span class="input-group-btn ml-2">
								<button type="button" class="quantity-right-plus plus_detail btn" data-type="plus" data-field="">
									<i class="fa fa-plus"></i>
								</button>
							</span>
						</div>
						<div class="w-100"></div>
						<div class="col-md-12">
							<p style="color: #000;"><?= $soluong; ?> sản phẩm còn lại</p>
						</div>
					</div>
					<p>
						<button type="submit" form="addCartForm<?= $mshh; ?>" class="btn btn-primary py-3 px-5 mr-2">Add to Cart</button>
					</p>
				</form>
			</div>
		</div>
	</div>
</section>
<script>
	$('.img_more_detail').click(function(){
		var src = $(this).attr("src")
		$('.image-popup').attr("href", src)
		$('.img_demo').attr("src", src)
	})
</script>
<script>
	$(document).ready(function() {

		var quantitiy = 0;
		$('.plus_detail').click(function(i) {

			var index = $('.plus_detail').index($(this))

			// Get the field name
			var quantity = parseInt($('.quantity-detail').eq(index).val());

			// If is not undefined

			if (quantity < $('.quantity-detail').eq(index).attr("max")) {
				$('.quantity-detail').eq(index).val(quantity + 1);
			}

			// Increment

		});

		$('.minus_detail').click(function(i) {
			var index = $('.minus_detail').index($(this))

			// Get the field name
			var quantity = parseInt($('.quantity-detail').eq(index).val());

			// If is not undefined

			// Increment
			if (quantity > 1) {
				$('.quantity-cart').eq(index).val(quantity - 1);
			}
		});

	});
</script>
<?php

include_once "footer.php";

?>