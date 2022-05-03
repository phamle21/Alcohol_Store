<?php
    require_once('../../database/config.php');
    $mshh = $_POST['mshh'];

    $result_hinh = $con->query("SELECT TenHinh FROM hinhhanghoa WHERE MSHH='$mshh'");

    
?>
<div class="img_show_hh">
    <div class="select_img">
        <ul>
            <?php while($row = $result_hinh->fetch_assoc()): 
                $tenhinh= $row['TenHinh'];
            ?>
                <li ><img onclick="pick_img(this.src)" src="../img/product/<?=$row['TenHinh']?>" alt=""></li>
            <?php endwhile; ?>
        </ul>
    </div>
    
    <div class="img_show">
        <img id="img_show_main" src="../img/product/<?=$tenhinh?>" alt="IMG-PRODUCT">
    </div>  
</div>


