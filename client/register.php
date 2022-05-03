<?php
require_once('../database/config.php');

if (isset($_POST['submit_register'])) {
    $hoten = $_POST['hoten'];
    $diachi = $_POST['diachi'];
    $sdt = $_POST['sdt'];
    $matkhau = md5($_POST['matkhau']);

    $result = $con->query("INSERT INTO khachhang(HoTenKH, DiaChi, SoDienThoai, Password) 
                        VALUES ('$hoten', '$diachi', '$sdt', '$matkhau' )");

    if ($result === TRUE) {
        setcookie('thongbao_success', 'Đăng ký tài khoản thành công', time() + 1, '/');
        header('Location: ./login.php');
    } else {
        setcookie('thongbao_fail', 'Đăng ký tài khoản thất bại', time() + 1, '/');
        header('Location: ./register.php');
    }
}
include_once "header.php";

?>

<script>
    document.title = "Register | Alcohol Store"
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
                <p class="breadcrumbs mb-0"><span class="mr-2"><a href="index.php">Home <i class="fa fa-chevron-right"></i></a></span> <span>Register <i class="fa fa-chevron-right"></i></span></p>
                <h2 class="mb-0 bread">Register</h2>
            </div>
        </div>
    </div>
</section>

<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-10 ftco-animate">
                <form action="" id="frmRegister" class="billing-form" method="post" onsubmit="return check_dky()">
                    <h3 class="mb-4 billing-heading">Đăng ký</h3>
                    <div class="row align-items-end">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="hoten">Họ tên</label>
                                <input type="text" name="hoten" id="hoten" class="form-control text-dark" required placeholder="Nhập họ tên...">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="diachi">Địa chỉ</label>
                                <input type="text" name="diachi" id="diachi" class="form-control text-dark" required placeholder="Nhập địa chỉ...">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="sdt">Số điện thoại</label>
                                <input type="text" name="sdt" id="sdt" class="form-control text-dark" required placeholder="Nhập số điện thoại...">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="matkhau">Mật khẩu</label>
                                <input type="password" name="matkhau" id="matkhau" class="form-control text-dark" required placeholder="Nhập mật khẩu...">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="rematkhau">Xác nhận mật khẩu</label>
                                <input type="password" name="rematkhau" id="rematkhau" class="form-control text-dark" required placeholder="Nhập lại mật khẩu...">
                                <p id="error_repass" class="text-danger"></p>
                            </div>
                        </div>
                        <div class="col-12 mt-3">
                            <button type="submit" name="submit_register" value="true" form="frmRegister" class="btn btn-primary py-3 px-4 w-100">Đăng ký</button>
                        </div>
                    </div>
                    <script>
                        function check_dky() {
                            if ($('#matkhau').val() != $('#rematkhau').val()) {
                                $('#error_repass').html('Mật khẩu xác nhận sai!');
                                return false;
                            } else {
                                return true;
                            }
                        }
                    </script>
                </form>
            </div>
        </div>
    </div>
</section>

<?php

include_once "footer.php";

?>