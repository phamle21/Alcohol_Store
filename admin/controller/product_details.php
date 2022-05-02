<?php
require_once('../../database/config.php');
$mshh = $_POST['mshh'];
$result_hh = $con->query("SELECT a.*
                                FROM hanghoa as a 
                                WHERE a.MSHH='$mshh'")->fetch_assoc();
$tenhh = $result_hh['TenHH'];
$mota = $result_hh['MoTaHH'];
$soluong = $result_hh['SoLuongHang'];
$gia = number_format($result_hh['Gia']);

?>
<style>
    p {
        color: black;
    }

    .hinhhanghoa img {
        border-radius: 10px;
    }

    .info_product {
        color: black;
    }

    .info_product table tr td {
        /* max-width: 400px; */
        white-space: break-spaces;
    }

    .info_product textarea {
        background-color: transparent !important;
        color: black;
        /* border: none; */
        resize: vertical;
        width: 100%;
        max-width: 100%;
        overflow: hidden;
    }
    .info_product textarea:focus{
        outline: none;
        box-shadow: none;
        color: black;
        border-color: #bac8f3;
    }
</style>
<div class="container">
    <div class="hinhhanghoa">
        <div class="row">
            <?php
            $hinh = $con->query("SELECT * FROM hinhhanghoa WHERE MSHH='$mshh'");
            while ($img = $hinh->fetch_assoc()) {
            ?>
                <div class="col-3 m-3 d-flex justify-content-center">
                    <img src="../images/<?= $img['TenHinh']?>" width="100px" class="border border-secondary" alt="">
                </div>
            <?php
            }
            ?>
        </div>
    </div>
    <div class="info_product">
        <div class="form-group">
            <label for="" class="form-label">MSHH</label>
            <p class="form-control"><?= $mshh ?></p>
        </div>
        <div class="form-group">
            <label for="" class="form-label">Tên hàng hóa</label>
            <p class="form-control"><?= $tenhh ?></p>
        </div>
        <div class="form-group">
            <label for="" class="form-label">Số lượng</label>
            <p class="form-control"><?= $soluong ?></p>
        </div>
        <div class="form-group">
            <label for="" class="form-label">Giá</label>
            <p class="form-control"><?= $gia ?></p>
        </div>
        <div class="form-group">
            <label for="" class="form-label">Mô tả</label><br>
            <textarea rows="6" class="form-control" readonly><?= $mota ?></textarea>
        </div>

    </div>
</div>