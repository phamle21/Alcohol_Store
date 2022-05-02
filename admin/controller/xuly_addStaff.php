<?php
    include('../../database/config.php');
    $hoten = $_POST['hoten'];
    $chucvu = $_POST['chucvu'];
    $diachi = $_POST['diachi'];
    $sdt = $_POST['sdt'];
    $matkhau = md5($_POST['matkhau']);

    $result = $con->query("INSERT INTO nhanvien(HoTenNV, ChucVu, DiaChi, SoDienThoai, Password) 
                            VALUES ('$hoten', '$chucvu', '$diachi', '$sdt', '$matkhau' )");

    if($result === TRUE){
        setcookie('thongbao_success','Thêm nhân viên thành công', time() + 1, '/');
        header('Location: ../staff.php');
    }else{
        setcookie('thongbao_fail','Thêm nhân viên thất bại', time() + 1, '/');
        header('Location: ../staff.php');
    }
?>