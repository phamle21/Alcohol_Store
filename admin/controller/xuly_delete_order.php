<?php
    require_once('../../database/config.php');
    $sodondh = $_GET['sodonDH'];

    $result_del_details = $con->query("DELETE FROM chitietdathang WHERE SoDonDH='$sodondh'");
    $result_del_order = $con->query("DELETE FROM dathang WHERE SoDonDH='$sodondh'");
    
    if($result_del_details === TRUE && $result_del_order === TRUE){
        setcookie('thongbao_success', 'Xóa đơn hàng thành công', time()+1, '/');
        header('Location: ../donhang.php');
    }else{
        setcookie('thongbao_fail', 'Xóa đơn hàng thất bại', time()+1, '/');
        header('Location: ../donhang.php');
    }
?>