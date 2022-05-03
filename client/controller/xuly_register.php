<?php
    require_once('../../database/config.php');

    $hoten = $_POST['hoten'];
    $diachi = $_POST['diachi'];
    $sdt = $_POST['sdt'];
    $matkhau = md5($_POST['matkhau']);

    if(isset($_POST['tencty'])){
        $tencty = $_POST['tencty'];
    }else{
        $tencty = null;
    }

    if(isset($_POST['sofax'])){
        $sofax = $_POST['sofax'];
    }else{
        $sofax = null;
    }

    $sql_check = "SELECT * FROM khachhang WHERE SoDienThoai='$sdt'";
    $result_check = $con->query($sql_check);

    if($result_check->num_rows > 0){
        setcookie('thongbao_dky_KH','Tài khoản này đã tồn tại!', time()+5, '/');
        header('Location: '.$_SERVER['HTTP_REFERER']);
    }else{
        $sql = "INSERT INTO khachhang(HoTenKH, TenCongTy, SoDienThoai, SoFax, MatKhau)
            VALUES ('$hoten', '$tencty', '$sdt', '$sofax', '$matkhau')";
        $result = $con->query($sql);
        $last_id = $con->insert_id;

        $add_dc = $con->query("INSERT INTO diachikh(DiaChi, MSKH) VALUES ('$diachi', '$last_id')");
        
        if($result===TRUE && $add_dc===TRUE){
            setcookie('thongbao_dky_KH','Tạo tài khoản thành công!', time()+5, '/');
            header('Location: '.$_SERVER['HTTP_REFERER']);
        }else{
            setcookie('thongbao_dky_KH','Tạo tài khoản thất bại!', time()+5, '/');
            header('Location: '.$_SERVER['HTTP_REFERER']);
        }
    }
?>