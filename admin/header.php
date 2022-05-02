<?php
require_once "../Database/config.php";
if (!isset($_COOKIE['login_nv'])) {
    header("Location: ./login.php");
}

$msnv = $_COOKIE['login_nv'];
$info_nv = $con->query("SELECT * FROM nhanvien WHERE MSNV='$msnv'")->fetch_assoc();

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin | Alcohol Store</title>

    <link rel="shortcut icon" href="../client/build/images/prod-5.jpg" type="image/x-icon">
    <!-- Custom fonts for this template -->
    <link href="build/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="build/css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="build/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

    <!-- sweetalert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="./">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-wine-bottle"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Alcohol Store </div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-2 mb-4">

            <!-- Heading -->
            <div class="sidebar-heading">
                Quản lí
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link" href="#" data-toggle="collapse" data-target="#item-product" aria-expanded="true" aria-controls="item-product">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Hàng hóa</span>
                </a>
                <div id="item-product" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="product.php">Danh sách hàng hóa</a>
                    </div>
                </div>
            </li>
            <?php if (isset($info_nv['ChucVu']) && $info_nv['ChucVu'] == "Admin") : ?>
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#item-user" aria-expanded="true" aria-controls="item-user">
                        <i class="fas fa-fw fa-cog"></i>
                        <span>Tài khoản</span>
                    </a>
                    <div id="item-user" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item" href="staff.php">Nhân viên</a>
                            <a class="collapse-item" href="customer.php">Người dùng</a>
                        </div>
                    </div>
                </li>
            <?php endif; ?>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#item-order" aria-expanded="true" aria-controls="item-order">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Đơn hàng</span>
                </a>
                <div id="item-order" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="order.php">Danh sách đơn hàng</a>
                    </div>
                </div>
            </li>

            <script>
                $('.collapse-item').each(function(i) {
                    if (window.location == this.href) {
                        $('.collapse-item').eq(i).addClass('active')
                        $('.collapse-item').eq(i).parent().parent().addClass('show')
                        $('.collapse-item').eq(i).parent().parent().parent().addClass('active')
                    }
                })
            </script>
            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <form class="form-inline">
                        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                            <i class="fa fa-bars"></i>
                        </button>
                    </form>


                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $info_nv['HoTenNV'] ?></span>
                                <img class="img-profile rounded-circle" src="build/img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="javascript:void(){};" data-toggle="modal" data-target="#modalEditProfile">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="javascript:void(){};" onclick="logout()">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                                <script>
                                    function logout() {
                                        Swal.fire({
                                            title: 'Logout?',
                                            text: "Bạn muốn đăng xuất?",
                                            icon: 'warning',
                                            showCancelButton: true,
                                            confirmButtonColor: '#d33',
                                            cancelButtonColor: '#878787',
                                            confirmButtonText: 'Logout!'
                                        }).then((result) => {
                                            if (result.isConfirmed) {
                                                window.location = "./controller/logout.php";
                                            }
                                        })
                                    }
                                </script>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- MODAL -->
                <div class="modal fade" id="modalEditProfile" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="exampleModalLongTitle">Edit Profile</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body" style="width: 400px">
                                <?php
                                $msnv = $_COOKIE['login_nv'];
                                $result = $con->query("SELECT * FROM nhanvien WHERE MSNV='$msnv'");
                                $row = $result->fetch_assoc();

                                $hoten = $row['HoTenNV'];
                                $chucvu = $row['ChucVu'];
                                $diachi = $row['DiaChi'];
                                $sdt = $row['SoDienThoai'];
                                ?>
                                <style>
                                    form {
                                        color: black;
                                    }
                                </style>
                                <form action="./controller/xuly_editStaff.php" id="edit_me" method="post" onsubmit="return check_submit_edit()">
                                    <input type="hidden" name='msnv' value="<?= $msnv ?>">
                                    <div class="form-group">
                                        <label for="exampleInputName" class="form-label">Họ Tên</label>
                                        <div class="position-relative has-icon-right">
                                            <input type="text" id="exampleInputName" value="<?= $hoten ?>" name="hoten" class="form-control input-shadow" placeholder="Enter Your Name" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputName" class="form-label">Chức vụ</label>
                                        <div class="position-relative has-icon-right">
                                            <input type="text" id="exampleInputChucVu" value="<?= $chucvu ?>" readonly name="chucvu" class="form-control input-shadow" placeholder="Enter Your Chức vụ" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputName" class="form-label">Địa Chỉ</label>
                                        <div class="position-relative has-icon-right">
                                            <input type="text" id="exampleInputDiaChi" value="<?= $diachi ?>" name="diachi" class="form-control input-shadow" placeholder="Enter Your Địa Chỉ" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputName" class="form-label">Số điện thoại</label>
                                        <div class="position-relative has-icon-right">
                                            <input type="text" id="inputSdt" name="sdt" disabled value="<?= $sdt ?>" class="form-control input-shadow" placeholder="Enter Your Phone" required>
                                        </div>
                                        <div id="check_sdt"></div>
                                    </div>
                                    <p>Bỏ trống nếu không cần đổi mật khẩu</p>
                                    <div class="form-group">
                                        <label for="exampleInputPassword" class="form-label">Password</label>
                                        <div class="position-relative has-icon-right">
                                            <input type="password" id="pass_me" name="matkhau_moi" value="" class="form-control input-shadow" placeholder="Choose Password">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword" class="form-label">Confirm Password</label>
                                        <div class="position-relative has-icon-right">
                                            <input type="password" id="repass_me" class="form-control input-shadow" placeholder="Confirm Your Password">
                                        </div>
                                        <p id="error_repass_me" style="color:#fff700;"></p>
                                    </div>
                                </form>

                                <script>
                                    function check_submit_edit() {
                                        var pass = document.getElementById('pass_me').value;
                                        var repass = document.getElementById('repass_me').value;
                                        if (pass.length > 0) {
                                            if (pass != repass) {
                                                document.getElementById('error_repass_me').innerHTML = "Mật khẩu xác nhận sai";
                                                return false;
                                            } else {
                                                return true;
                                            }
                                        } else {
                                            return true;
                                        }
                                    }
                                </script>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" form="edit_me" class="btn btn-primary">Save</button>
                            </div>
                        </div>
                    </div>
                </div>