<?php
require_once('../../database/config.php');
$mshh = $_GET['mshh'];

$chitiet = $con->query("SELECT * FROM chitietdathang WHERE MSHH='$mshh'");

if ($chitiet->num_rows > 0) {
    setcookie('thongbao_fail', 'Xóa sản phẩm thất bại vì sản phẩm đang tồn tại trong 1 đơn hàng. Bạn có thể chỉnh sửa số lượng nếu ngừng bán sản phẩm!', time() + 1, '/');
    header('Location: ../product.php');
} else {

    $result_img = $con->query("SELECT TenHinh FROM hinhhanghoa WHERE MSHH='$mshh'");

    while ($row = $result_img->fetch_assoc()) {
        $path_del = "../../images/" . $row['TenHinh'];
        unlink($path_del);
    }

    $del_img = $con->query("DELETE FROM hinhhanghoa WHERE MSHH='$mshh'");
    $result_del_hh = $con->query("DELETE FROM hanghoa WHERE MSHH='$mshh'");

    setcookie('thongbao_success', 'Xóa sản phẩm thành công', time() + 1, '/');
    header('Location: ../product.php');
}

