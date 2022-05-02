<?php
require_once('../database/config.php');

if(isset($_COOKIE['login_nv'])){
    header("Location: ./");
}

if (isset($_POST['submit_login'])) {
    $sdt = $_POST['sdt'];
    $matkhau = md5($_POST['matkhau']);

    $login = $con->query("SELECT * FROM nhanvien WHERE SoDienThoai='$sdt' AND Password='$matkhau'");
    if ($login->num_rows > 0) {
        $row = $login->fetch_assoc();

        if(isset($_POST['rememberme'])){
            setcookie('login_nv', $row['MSNV'], 7*24*60*60, '/');
        }else{
            setcookie('login_nv', $row['MSNV'], 0, '/');
        }
        
        header("Location: ./");
    } else {
        setcookie('thongbao_login', 'Bạn đã nhập sai tài khoản hoặc mật khẩu', time() + 3, '/');
        header('Location: ./login_admin.php');
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Login | Alcohol Store</title>

    <!-- Custom fonts for this template-->
    <link href="build/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="build/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">L O G I N</h1>
                                    </div>
                                    <form class="user" action="" method="post">
                                        <div class="form-group">
                                            <input type="text" name="sdt" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Nhập Số Điện Thoại">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="matkhau" class="form-control form-control-user" id="exampleInputPassword" placeholder="Mật Khẩu">
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" name="rememberme" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Remember
                                                    Me</label>
                                            </div>
                                        </div>
                                        <button type="submit" name="submit_login" value="true" class="btn btn-primary btn-user btn-block">
                                            Login
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="build/vendor/jquery/jquery.min.js"></script>
    <script src="build/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="build/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="build/js/sb-admin-2.min.js"></script>

</body>

</html>