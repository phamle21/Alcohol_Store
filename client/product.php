<?php

include_once "header.php";

?>

<script>
	document.title = "Home | Alcohol Store"
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
				<p class="breadcrumbs mb-0"><span class="mr-2"><a href="index.php">Home <i class="fa fa-chevron-right"></i></a></span> <span>Products <i class="fa fa-chevron-right"></i></span></p>
				<h2 class="mb-0 bread">Products</h2>
			</div>
		</div>
	</div>
</section>

<section class="ftco-section">
	<div class="container">
		<div class="row">
			<div class="col">
				<div class="row mb-4">
					<div class="col-md-12 d-flex justify-content-between align-items-center">
						<h4 class="product-select">Danh sách sản phẩm</h4>
						<div class="">
							<input type="text" class="rounded p-1" style="width: 300px;" id="search_product" placeholder="Tìm kiếm...">
						</div>
					</div>
				</div>
				<div class="row">
					<?php
					$result_hh = $con->query("SELECT * FROM hanghoa");
					while ($row = $result_hh->fetch_assoc()) :
						$mshh = $row['MSHH'];
						$result_img = $con->query("SELECT * FROM hinhhanghoa WHERE MSHH='$mshh' LIMIT 1");
						$img = $result_img->fetch_assoc()['TenHinh'];
					?>
						<div class="col-md-3 d-flex">
							<form id="addCartForm<?=$row['MSHH'] ?>" class="product ftco-animate" onsubmit="return add_cart(<?= $mshh; ?>)">
								<div class="img d-flex align-items-center justify-content-center" style="background-image: url(../images/<?= $img ?>);">
									<div class="desc">
										<p class="meta-prod d-flex">
											<input type="hidden" name="sl_mua" value="1">
											<button type="submit" form="addCartForm<?=$row['MSHH'] ?>" class="d-flex align-items-center justify-content-center btn-product cursor-pointer" style="cursor: pointer;"><span class="flaticon-shopping-bag"></span></button>
											<a href="detail.php?mshh=<?=$row['MSHH'] ?>" class="d-flex align-items-center justify-content-center btn-product"><span class="flaticon-visibility"></span></a>
										</p>
									</div>
								</div>
								<div class="text text-center">
									<span class="category"><?= $row['GhiChu'] ?></span>
									<h2><?= $row['TenHH'] ?></h2>
									<p class="mb-0"><span class="price"><?= number_format($row['Gia']) ?> VNĐ</span></p>
								</div>
							</form>
						</div>
					<?php endwhile; ?>
				</div>
				<!-- <div class="row mt-5">
					<div class="col text-center">
						<div class="block-27">
							<ul>
								<li><a href="#">&lt;</a></li>
								<li class="active"><span>1</span></li>
								<li><a href="#">2</a></li>
								<li><a href="#">3</a></li>
								<li><a href="#">4</a></li>
								<li><a href="#">5</a></li>
								<li><a href="#">&gt;</a></li>
							</ul>
						</div>
					</div>
				</div> -->
			</div>
		</div>
	</div>
</section>

<?php

include_once "footer.php";

?>