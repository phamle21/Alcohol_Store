<?php
    require_once('../../database/config.php');
    $mshh = $_POST['mshh'];
    $result_hh = $con->query("SELECT a.*
                                FROM hanghoa as a 
                                WHERE a.MSHH='$mshh'");
    $row = $result_hh->fetch_assoc();
    $tenhh = $row['TenHH'];
    $gia = $row['Gia'];
    $sl = $row['SoLuongHang'];
    $mota = $row['MoTaHH'];
?>
<form action="./controller/xuly_editProduct.php" id="editProductForm" method="post" enctype="multipart/form-data">
    <div class="mb-2">
        <label for="">ID:</label>
        <input type="text" value="<?=$mshh?>" name="mshh" class="form-control" readonly placeholder="Auto">
    </div>
    <div class="mb-2">
        <label for="">Product Name:</label>
        <input type="text" value="<?=$tenhh?>" name="tenhh" class="form-control" placeholder="Product Name" required>
    </div>
    <div class="mb-2">
        <label for="">Description:</label>
        <textarea type="text" name="mota" rows="5" class="form-control" placeholder="Desscription" required><?=$mota?></textarea>
    </div>
    <div class="mb-2">
        <label for="">Product Price: <a id="price_demo_edit"></a></label>
        <input type="text" onkeyup="format_price(this.value)" value="<?=$gia?>" name="gia" id="giasp" class="form-control" placeholder="Product Price" required>
    </div>
    <div class="mb-2">
        <label for="">Product Quantity:</label>
        <input type="text" value="<?=$sl?>" name="soluong" class="form-control" placeholder="Product Quantity" required>
    </div>
    <div class="mb-2">
        <label class="img_product" for="">Product Images: (Thay đổi tất cả ảnh hàng hóa này)</label><br>
        <input type="file" name="images_product[]" accept='image/*' multiple>
    </div>
</form>