<?php
include('../../database/config.php');

$mshh = $_POST['mshh'];
$ten_sp = $_POST['tenhh'];
$mota = $_POST['mota'];
$gia_sp = $_POST['gia'];
$soluong = $_POST['soluong'];

$total_img = count($_FILES['images_product']['name']);

if ($total_img > 0) {
    //Xóa hình cũ
    $result_img = $con->query("SELECT TenHinh FROM hinhhanghoa WHERE MSHH='$mshh'");
    while ($row = $result_img->fetch_assoc()) {
        $path_del = "../../images/" . $row['TenHinh'];
        unlink($path_del);
    }
    $result_del_img = $con->query("DELETE FROM hinhhanghoa WHERE MSHH='$mshh'");
    //Thêm hình mới
    for ($i = 0; $i < $total_img; $i++) {

        $tmpFilePath = $_FILES['images_product']['tmp_name'][$i];

        if ($tmpFilePath != "") {
            //New name file 
            $nameFile = $i . '_' . time() . '_' . rand(100, 999) . '.' . end(explode(".", $_FILES["images_product"]["name"][$i]));
            //Setup our new file path
            $newFilePath = "../../images/" . $nameFile;
            //File is uploaded to temp dir
            if (move_uploaded_file($tmpFilePath, $newFilePath)) {
                //Other code goes here
                $sql_hinhanhsp = "INSERT INTO hinhhanghoa(TenHinh, MSHH)
                                      VALUES ('$nameFile', '$mshh')";
                $con->query($sql_hinhanhsp);
            }
        }
    }
}

$sql = "UPDATE hanghoa
        SET TenHH='$ten_sp', MoTaHH='$mota', Gia='$gia_sp', SoLuongHang='$soluong'
        WHERE MSHH='$mshh'";

if ($con->query($sql) === TRUE) {

    setcookie('thongbao_success', 'Chỉnh sửa sản phẩm thành công', time() + 1, '/');
    header('Location: ../product.php');
} else {
    setcookie('thongbao_fail', 'Chỉnh sửa sản phẩm thất bại', time() + 1, '/');
    header('Location: ../product.php');
}
