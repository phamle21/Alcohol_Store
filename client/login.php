<?php
	require_once "../database/config.php";

if (isset($_COOKIE['login_kh'])) {
	header("Location: ./");
}

if (isset($_POST['submit_login'])) {
	$sdt = $_POST['sdt'];
	$matkhau = md5($_POST['matkhau']);
	
	$login = $con->query("SELECT * FROM khachhang WHERE SoDienThoai='$sdt' AND Password='$matkhau'");
	if ($login->num_rows > 0) {
		$row = $login->fetch_assoc();

		if (isset($_POST['rememberme'])) {
			setcookie('login_kh', $row['MSKH'], 7 * 24 * 60 * 60, '/');
		} else {
			setcookie('login_kh', $row['MSKH'], 0, '/');
		}
		
		header("Location: ./");
	} else {
		setcookie('thongbao_fail', 'Bạn đã nhập sai tài khoản hoặc mật khẩu', time() + 3, '/');
		header('Location: ./login.php');
	}
}

include_once "header.php";
?>

<script>
	document.title = "Login | Alcohol Store"
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
				<p class="breadcrumbs mb-0"><span class="mr-2"><a href="index.php">Home <i class="fa fa-chevron-right"></i></a></span> <span>Login <i class="fa fa-chevron-right"></i></span></p>
				<h2 class="mb-0 bread">Login</h2>
			</div>
		</div>
	</div>
</section>

<section class="ftco-section">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-xl-10 ftco-animate">
				<form action="" class="billing-form" id="frmLoginClient" method="post">
					<h3 class="mb-4 billing-heading">Login</h3>
					<div class="row align-items-end">
						<div class="col-12">
							<div class="form-group">
								<label for="sdt">Số điện thoại</label>
								<input type="text" id="sdt" name="sdt" class="form-control" placeholder="Nhập số điện thoại..." required>
							</div>
						</div>
						<div class="col-12">
							<div class="form-group">
								<label for="matkhau">Mật khẩu</label>
								<input type="text" id="matkhau" name="matkhau" class="form-control" placeholder="Nhập mật khẩu..." required>
							</div>
						</div>
						<div class="col-12">
							<div class="form-group">
								<input type="checkbox" id="rememberme" name="rememberme" value="true">
								<label for="rememberme">Ghi nhớ đăng nhập (7 ngày)</label>
							</div>
						</div>
						<div class="col-12 mt-3">
							<button type="submit" name="submit_login" form="frmLoginClient" class="btn btn-primary py-3 px-4 w-100">Sign in</button>
						</div>
						<div class="col-12 mt-3">
							Bạn chưa có tài khoản?<a href="register.php">Đăng ký ngay</a>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</section>

<?php

include_once "footer.php";

?>