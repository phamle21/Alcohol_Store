<?php
    include('../../database/config.php');
    session_start();

    $mskh = $_COOKIE['login_kh'];

    $sql_donhang = "INSERT INTO dathang(MSKH, TrangThaiDH) VALUES ('$mskh', 'Chưa xác nhận')";
    $result_donhang = $con->query($sql_donhang);
    $last_id_donhang = $con->insert_id;

    if($result_donhang === TRUE){

        foreach($_SESSION['cart'] as $cart_item){
            $mshh = $cart_item['MSHH'];
            $slmua = $cart_item['SoLuongMua'];
            $gia = $cart_item['Gia'];

            $sql_chitietdathang = "INSERT INTO chitietdathang(SoDonDH, MSHH, SoLuong, GiaDatHang) 
                        VALUES ('$last_id_donhang', '$mshh', '$slmua', '$gia')";
                        
            $result_chitiet = $con->query($sql_chitietdathang);
        }

        if($result_chitiet === TRUE){
            unset($_SESSION['cart']);
            setcookie('thongbao_success', 'Bạn đã đặt hàng thành công!', time()+3, '/');
            header('Location: '. $_SERVER['HTTP_REFERER']);
        }else{
            setcookie('thongbao_fail', 'Bạn đã đặt hàng thất bại!', time()+3, '/');
            header('Location: '. $_SERVER['HTTP_REFERER']);
        }
        
    }else{
        setcookie('thongbao_fail', 'Bạn đã đặt hàng thất bại!', time()+3, '/');
        header('Location: '. $_SERVER['HTTP_REFERER']);
    }
?>
