<?php
    include('../../database/config.php');

    $mskh = $_POST['mskh'];
    $hoten = $_POST['hoten'];
    $chucvu = $_POST['chucvu'];
    $diachi = $_POST['diachi'];
    
    if(isset($_POST['matkhau_moi']) && strlen($_POST['matkhau_moi'])>0){
        $new_pass = md5($_POST['matkhau_moi']);
        $sql = "UPDATE khachhang
                SET HoTenKH='$hoten', DiaChi='$diachi', Password='$new_pass'
                WHERE MSKH='$mskh'";
    }else{
        $sql = "UPDATE khachhang
                SET HoTenKH='$hoten', DiaChi='$diachi'
                WHERE MSKH='$mskh'";
    }
    
    if($con->query($sql) === TRUE){
        setcookie('thongbao_success','Chỉnh sửa thành công', time() + 1, '/');
        header('Location: ../customer.php');
    }else{
        setcookie('thongbao_fail','Chỉnh sửa thất bại', time() + 1, '/');
        header('Location: ../customer.php');
    }

?>