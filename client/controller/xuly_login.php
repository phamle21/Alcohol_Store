<?php
    require_once('../../database/config.php');

    $sdt = $_POST['sdt'];
    $matkhau = md5($_POST['matkhau']);

    $result_login = $con->query("SELECT * FROM khachhang WHERE SoDienThoai='$sdt' AND MatKHau='$matkhau'");
    if($result_login->num_rows > 0){
        $row = $result_login->fetch_assoc();
        
        setcookie('login_kh', $row['MSKH'], 0, '/');
        header('Location: '.$_SERVER['HTTP_REFERER']);
    }else{
        setcookie('thongbao_login', 'Sai tài khoản hoặc mật khẩu', time()+3, '/');
        header('Location: ../');
    }
?>