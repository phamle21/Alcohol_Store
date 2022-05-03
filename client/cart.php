<?php

include_once "header.php";

?>
<script>
	document.title = "Cart | Alcohol Store"
	$('.btn-cart').addClass('d-none')
</script>

<?php
if (isset($_COOKIE['thongbao_success'])) {
	echo "<script>Swal.fire('Success','" . $_COOKIE['thongbao_success'] . "','success')</script>";
}
if (isset($_COOKIE['thongbao_fail'])) {
	echo "<script>Swal.fire('Error','" . $_COOKIE['thongbao_fail'] . "','error')</script>";
}
?>

<section class="hero-wrap hero-wrap-2" style="background-image: url('build/images/bg_2.jpg');" data-stellar-background-ratio="0.5">
	<div class="overlay"></div>
	<div class="container">
		<div class="row no-gutters slider-text align-items-end justify-content-center">
			<div class="col-md-9 ftco-animate mb-5 text-center">
				<p class="breadcrumbs mb-0"><span class="mr-2"><a href="index.php">Home <i class="fa fa-chevron-right"></i></a></span> <span>Cart <i class="fa fa-chevron-right"></i></span></p>
				<h2 class="mb-0 bread">My Cart</h2>
			</div>
		</div>
	</div>
</section>

<section class="ftco-section">
	<div class="container-fuild">
		<div class="row justify-content-center">
			<div class="col-8 row">
				<div class="col table-wrap">
					<table class="table" style="min-width: 500px !important;">
						<thead class="thead-primary">
							<tr>
								<th>Images</th>
								<th>Product</th>
								<th>Price</th>
								<th>Quantity</th>
								<th>Total</th>
								<th>&nbsp;</th>
								<th>&nbsp;</th>
							</tr>
						</thead>
						<tbody>
							<?php

							if (isset($_SESSION['cart'])) {
								$i = 0;
								$tongtien = 0;
								foreach ($_SESSION['cart'] as $cart_item) {
									$thanhtien = $cart_item['SoLuongMua'] * $cart_item['Gia'];
									$tongtien += $thanhtien;
									$i++;
							?>
									<tr class="alert" role="alert">
										<td>
											<div class="img" style="background-image: url(../images/<?= $cart_item['HinhAnh'] ?>);"></div>
										</td>
										<td>
											<div class="email">
												<span><?= $cart_item['TenHH'] ?></span>
											</div>
										</td>
										<td><?= number_format($cart_item['Gia']) ?>₫</td>
										<td class="quantity">
											<div class="input-group flex-nowrap">
												<span class="input-group-btn">
													<button type="button" class="quantity-left-minus minus_cart btn" onclick="minus_sp(<?= $cart_item['MSHH']; ?>)" data-type="minus" data-field="">
														<i class="fa fa-minus"></i>
													</button>
												</span>
												<input type="text" id="quantity" name="quantity" style="height: auto !important; width: 55px !important" class="quantity quantity-cart form-control input-number px-3" value="<?= $cart_item['SoLuongMua'] ?>" readonly min="1" max="<?= $cart_item['SoLuongHang'] ?>">
												<span class="input-group-btn">
													<button type="button" class="quantity-right-plus plus_cart btn" onclick="plus_sp(<?= $cart_item['MSHH']; ?>)" data-type="plus" data-field="">
														<i class="fa fa-plus"></i>
													</button>
												</span>
											</div>
										</td>
										<td><?= number_format($thanhtien) ?>₫</td>
										<td>
											<button type="button" class="close" onclick="delete_sp_cart(<?= $cart_item['MSHH']; ?>)" data-dismiss="alert" aria-label="Close">
												<span aria-hidden="true"><i class="fa fa-close"></i></span>
											</button>
										</td>
									</tr>
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
						</tbody>
					</table>
				</div>
			</div>
			<div class="col-4 row justify-content-center">
				<div class="col cart-wrap ftco-animate">
					<form action="controller/xuly_dathang.php" method="POST">
						<div class="cart-total mb-3">
							<h3>Thông tin cá nhân</h3>
							<hr>
							<p class="d-flex total-price">
								<span>Họ tên</span>
								<span><?= $ten_kh ?></span>
							</p>
							<p class="d-flex total-price">
								<span>Số điện thoại</span>
								<span><?= $sdt_kh ?></span>
							</p>
							<p class="d-flex total-price">
								<span>Địa chỉ</span>
								<span><?= $diachi_kh ?></span>
							</p>
						</div>
						<div class="cart-total mb-3">
							<h3>Cart Totals</h3>
							<hr>
							<p class="d-flex total-price">
								<span>Total</span>
								<span><?= number_format($tongtien) ?>₫</span>
							</p>
						</div>
						<p class="text-center">
							<?php if (isset($_COOKIE['login_kh']) && $tongtien != 0) : ?>
								<button type="submit" class="btn btn-primary py-3 px-4">Thanh toán</button>
							<?php endif; ?>
						</p>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>

<script>
	$(document).ready(function() {

		var quantitiy = 0;
		$('.plus_cart').click(function(i) {

			var index = $('.plus_cart').index($(this))

			// Get the field name
			var quantity = parseInt($('.quantity-cart').eq(index).val());

			// If is not undefined

			if (quantity < $('.quantity-cart').eq(index).attr("max")) {
				$('.quantity-cart').eq(index).val(quantity + 1);
			}

			// Increment

		});

		$('.minus_cart').click(function(i) {
			var index = $('.minus_cart').index($(this))

			// Get the field name
			var quantity = parseInt($('.quantity-cart').eq(index).val());

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