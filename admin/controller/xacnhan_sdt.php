<?php
    include('../../database/config.php');

    if(isset($_POST['sdt'])){
        $sdt = $_POST['sdt'];
    }else{
        $sdt = "nulllllll";
    }

    $result = $con->query("SELECT * FROM nhanvien WHERE SoDienThoai='$sdt'");

    if($result->num_rows > 0 ){
        echo "<p id='comfirm_sdt_staff' style='color: red'>Số điện thoại đã tồn tại!</p>";
    }else if(strlen($sdt) <10 || !preg_match("/(84|0[3|5|7|8|9])+([0-9]{8})\b/", $sdt)){
        echo "<p id='comfirm_sdt_staff' style='color: red'>Số điện thoại sai định dạng!</p>";

    }else{
        echo "<p id='comfirm_sdt_staff' style='color: green'>Số điện thoại có thể sử dụng</p>";
    }
?>
