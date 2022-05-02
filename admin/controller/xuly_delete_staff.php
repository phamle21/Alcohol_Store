<?php
include('../../database/config.php');
$msnv = $_GET['msnv'];

$dathang = $con->query("SELECT * FROM dathang WHERE MSNV='$msnv'");

if ($dathang->num_rows > 0) {
    setcookie('thongbao_fail', 'Xóa nhân viên thất bại vì nhân viên có liên quan đến 1 đơn hàng.', time() + 1, '/');
    header('Location: ../staff.php');
} else {

    $result_del = $con->query("DELETE FROM nhanvien WHERE MSNV='$msnv'");

    if ($result_del === TRUE) {
        setcookie('thongbao_success', 'Xóa nhân viên thành công', time() + 1, '/');
        header('Location: ../staff.php');
    } else {
        setcookie('thongbao_fail', 'Xóa nhân viên thất bại', time() + 1, '/');
        header('Location: ../staff.php');
    }
}
