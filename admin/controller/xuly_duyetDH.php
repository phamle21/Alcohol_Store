<?php
    include('../../database/config.php');

    //Duyệt lần 1
    if(isset($_POST['duyetlan1'])){
        $sodondh = $_POST['sodondh'];
        $ngayGH = $_POST['ngayGH'];
        $msnv = $_COOKIE['login_nv'];
        $result = $con->query("UPDATE dathang 
                            SET TrangThaiDH='Đang giao hàng',
                                MSNV='$msnv',
                                NgayGH='$ngayGH'
                            WHERE SoDonDH='$sodondh'");
        if($result === TRUE){
            setcookie('thongbao_success','Duyệt đơn hàng thành công', time() + 1, '/');
            header('Location: ../order.php');
        }else{
            setcookie('thongbao_fail','Duyệt đơn hàng thất bại', time() + 1, '/');
            header('Location: ../order.php');
        }
    }

    //Duyệt lần 2
    if(isset($_POST['duyetlan2'])){
        $sodondh = $_POST['sodonDH'];
        $trangthai = $_POST['trangthai'];

        $result = $con->query("UPDATE dathang 
                            SET TrangThaiDH='$trangthai'
                            WHERE SoDonDH='$sodondh'");
        if($result === TRUE){
            setcookie('thongbao_success','Duyệt đơn hàng thành công', time() + 3, '/');
            header('Location: ../order.php');
        }else{
            setcookie('thongbao_fail','Duyệt đơn hàng thất bại', time() + 3, '/');
            header('Location: ../order.php');
        }
    }

?>