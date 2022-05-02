<?php
include('../../database/config.php');
$mskh = $_GET['mskh'];

$dathang = $con->query("SELECT * FROM dathang WHERE MSKH='$mskh'");

if ($dathang->num_rows > 0) {
    setcookie('thongbao_fail', 'Xóa khách hàng thất bại vì khách hàng có liên quan đến 1 đơn hàng.', time() + 1, '/');
    header('Location: ../customer.php');
} else {

    $result_del = $con->query("DELETE FROM khachhang WHERE MSKH='$mskh'");

    if ($result_del === TRUE) {
        setcookie('thongbao_success', 'Xóa khách hàng thành công', time() + 1, '/');
        header('Location: ../customer.php');
    } else {
        setcookie('thongbao_fail', 'Xóa khách hàng thất bại', time() + 1, '/');
        header('Location: ../customer.php');
    }
}
