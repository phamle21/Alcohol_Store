<?php
include('../../database/config.php');

$ten_sp = $_POST['tenhh'];
$mota = $_POST['mota'];
$gia_sp = $_POST['gia'];
$soluong = $_POST['soluong'];

$total_img = count($_FILES['images_product']['name']);

$sql = "INSERT INTO hanghoa(TenHH, MoTaHH, Gia, SoLuongHang)
            VALUES ('$ten_sp', '$mota', '$gia_sp', '$soluong')";

if ($con->query($sql) === TRUE) {
    $last_mshh = $con->insert_id;

    for ($i = 0; $i < $total_img; $i++) {

        $tmpFilePath = $_FILES['images_product']['tmp_name'][$i];
    
        if ($tmpFilePath != "") {
            //New name file 
            $nameFile = $i.'_'.time() . '_' . rand(100, 999) . '.' . end(explode(".", $_FILES["images_product"]["name"][$i]));
            //Setup our new file path
            $newFilePath = "../../images/" . $nameFile;
            //File is uploaded to temp dir
            if (move_uploaded_file($tmpFilePath, $newFilePath)) {
                //Other code goes here
                $sql_hinhanhsp = "INSERT INTO hinhhanghoa(TenHinh, MSHH)
                                      VALUES ('$nameFile', '$last_mshh')";
                $con->query($sql_hinhanhsp);
            }
        }
    }

    setcookie('thongbao_success', 'Thêm sản phẩm thành công', time() + 1, '/');
    header('Location: ../product.php');
} else {
    setcookie('thongbao_fail', 'Thêm sản phẩm thất bại', time() + 1, '/');
    header('Location: ../product.php');
}
