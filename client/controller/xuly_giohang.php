<?php
include('../../database/config.php');
session_start();

//Cộng sl sản phẩm trong giỏ hàng
if (isset($_POST['plus_sp'])) {
    $mshh = $_POST['plus_sp'];

    if ($_SESSION['cart'][$mshh]['SoLuongMua'] < $_SESSION['cart'][$mshh]['SoLuongHang']) {
        $_SESSION['cart'][$mshh]['SoLuongMua']++;
    }

    echo   $_SESSION['cart'][$mshh]['SoLuongMua'];
}

//Trừ sl sản phẩm trong giỏ hàng
if (isset($_POST['minus_sp'])) {
    $mshh = $_POST['minus_sp'];
    if ($_SESSION['cart'][$mshh]['SoLuongMua'] > 1) {
        $_SESSION['cart'][$mshh]['SoLuongMua']--;
    }

    echo $_SESSION['cart'][$mshh]['SoLuongMua'];
}

//Update thành tiền
if (isset($_POST['thanhtien'])) {
    $mshh = $_POST['thanhtien'];
    $soluong_mua = $_SESSION['cart'][$mshh]['SoLuongMua'];
    $gia_ban = $_SESSION['cart'][$mshh]['Gia'];
    echo $soluong_mua . " x " . number_format($gia_ban) . "₫ = " . number_format($soluong_mua * $gia_ban) . "₫";
}

//Update tổng thành tiền
if (isset($_POST['tongthanhtien'])) {
    $tongtien = 0;
    foreach ($_SESSION['cart'] as $cart_item) {
        $tongtien += $cart_item['SoLuongMua'] * $cart_item['Gia'];
    }
    echo "Tổng đơn hàng: " . number_format($tongtien) . "₫";
}

//Đếm số lượng giỏ hàng
if (isset($_POST['count_cart'])) {
    $count_cart = 0;
    if (isset($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $v) {
            $count_cart++;
        }
    }
    echo $count_cart;
}

//Xóa sản phẩm trong giỏ hàng
if (isset($_POST['delete_sp_cart'])) {
    $mshh = $_POST['delete_sp_cart'];
    unset($_SESSION['cart'][$mshh]);
    $count = 0;
    foreach ($_SESSION['cart'] as $v) {
        $count++;
    }
    if ($count == 0) {
        echo "Giỏ hàng trống!";
    }
    $i = 0;
    $tongtien = 0;
    foreach ($_SESSION['cart'] as $cart_item) {
        $thanhtien = $cart_item['SoLuongMua'] * $cart_item['Gia'];
        $tongtien += $thanhtien;
        $i++;
?>
        <div class="dropdown-item d-flex align-items-start" href="#">
            <div class="img hover_cart" style="background-image: url(../images/<?= $cart_item['HinhAnh']; ?>);">
                <a class="delete_sp" style="padding: 2px 8px; color: white">
                    <i class="fas fa-trash-alt" onclick="delete_sp_cart(<?= $cart_item['MSHH']; ?>)">X</i>
                </a>
            </div>
            <div class="text pl-3">
                <h4><a href="detail.php?mshh=<?= $cart_item['MSHH']; ?>"><?= $cart_item['TenHH']; ?></a></h4>
                <p class="mb-0">
                    <a class="price"><?= number_format($cart_item['Gia']); ?>₫</a>
                </p>
                <div class="soluong_sp_cart d-inline">
                    <span class="quantity d-inline">Quantity:
                        <a onclick="minus_sp(<?= $cart_item['MSHH']; ?>)"><i class="fa fa-minus fa-style" aria-hidden="true"></i></a>
                        <label id="soluong_mua_<?= $cart_item['MSHH']; ?>"><?= $cart_item['SoLuongMua']; ?></label>
                        <a onclick="plus_sp(<?= $cart_item['MSHH']; ?>)"><i class="fa fa-plus fa-style" aria-hidden="true"></i></a>
                    </span>
                </div>

            </div>
        </div>
        <?php
    }
}

// Thêm sản phẩm mới vào giỏ hàng 
if (isset($_POST['themsp_cart'])) {
    $mshh = $_GET['mshh'];
    $soluong_mua = $_GET['sl_mua'];

    $sql_sp = "SELECT * FROM hanghoa WHERE MSHH='$mshh' LIMIT 1";

    $result_sp = $con->query($sql_sp);

    $result_img = $con->query("SELECT * FROM hinhhanghoa WHERE MSHH='$mshh' LIMIT 1");
    $img = $result_img->fetch_assoc()['TenHinh'];

    while ($row = $result_sp->fetch_assoc()) {
        $tenhh = $row['TenHH'];
        $gia = $row['Gia'];
        $soluong_hang = $row['SoLuongHang'];
        $hinh_hh = $img;
    }

    $new_product = array(
        'MSHH' => $mshh,
        'TenHH' => $tenhh,
        'SoLuongMua' => $soluong_mua,
        'Gia' => $gia,
        'HinhAnh' => $hinh_hh,
        'SoLuongHang' => $soluong_hang
    );

    // session_destroy();
    // Kiểm tra xem có giỏ hàng chưa
    if (isset($_SESSION['cart'][$mshh])) {

        if ($soluong_mua <= $_SESSION['cart'][$mshh]['SoLuongHang']) {
            if ($_SESSION['cart'][$mshh]['SoLuongMua'] + $soluong_mua <= $_SESSION['cart'][$mshh]['SoLuongHang']) {
                $_SESSION['cart'][$mshh]['SoLuongMua'] += $soluong_mua;
            } else {
                $_SESSION['cart'][$mshh]['SoLuongMua'] = $_SESSION['cart'][$mshh]['SoLuongHang'];
            }
        }


        $i = 0;
        $tongtien = 0;
        foreach ($_SESSION['cart'] as $cart_item) {
            $thanhtien = $cart_item['SoLuongMua'] * $cart_item['Gia'];
            $tongtien += $thanhtien;
            $i++;
        ?>
            <div class="dropdown-item d-flex align-items-start" href="#">
                <div class="img hover_cart" style="background-image: url(../images/<?= $cart_item['HinhAnh']; ?>);">
                    <a class="delete_sp" style="padding: 2px 8px; color: white">
                        <i class="fas fa-trash-alt" onclick="delete_sp_cart(<?= $cart_item['MSHH']; ?>)">X</i>
                    </a>
                </div>
                <div class="text pl-3">
                    <h4><a href="detail.php?mshh=<?= $cart_item['MSHH']; ?>"><?= $cart_item['TenHH']; ?></a></h4>
                    <p class="mb-0">
                        <a class="price"><?= number_format($cart_item['Gia']); ?>₫</a>
                    </p>
                    <div class="soluong_sp_cart d-inline">
                        <span class="quantity d-inline">Quantity:
                            <a onclick="minus_sp(<?= $cart_item['MSHH']; ?>)"><i class="fa fa-minus fa-style" aria-hidden="true"></i></a>
                            <label id="soluong_mua_<?= $cart_item['MSHH']; ?>"><?= $cart_item['SoLuongMua']; ?></label>
                            <a onclick="plus_sp(<?= $cart_item['MSHH']; ?>)"><i class="fa fa-plus fa-style" aria-hidden="true"></i></a>
                        </span>
                    </div>

                </div>
            </div>
        <?php
        }
    } else { //Nếu chưa có giỏ hàng
        $_SESSION['cart'][$mshh] = $new_product;

        $i = 0;
        $tongtien = 0;
        foreach ($_SESSION['cart'] as $cart_item) {
            $thanhtien = $cart_item['SoLuongMua'] * $cart_item['Gia'];
            $tongtien += $thanhtien;
            $i++;
        ?>
            <div class="dropdown-item d-flex align-items-start" href="#">
                <div class="img hover_cart" style="background-image: url(../images/<?= $cart_item['HinhAnh']; ?>);">
                    <a class="delete_sp" style="padding: 2px 8px; color: white">
                        <i class="fas fa-trash-alt" onclick="delete_sp_cart(<?= $cart_item['MSHH']; ?>)">X</i>
                    </a>
                </div>
                <div class="text pl-3">
                    <h4><a href="detail.php?mshh=<?= $cart_item['MSHH']; ?>"><?= $cart_item['TenHH']; ?></a></h4>
                    <p class="mb-0">
                        <a class="price"><?= number_format($cart_item['Gia']); ?>₫</a>
                    </p>
                    <div class="soluong_sp_cart d-inline">
                        <span class="quantity d-inline">Quantity:
                            <a onclick="minus_sp(<?= $cart_item['MSHH']; ?>)"><i class="fa fa-minus fa-style" aria-hidden="true"></i></a>
                            <label id="soluong_mua_<?= $cart_item['MSHH']; ?>"><?= $cart_item['SoLuongMua']; ?></label>
                            <a onclick="plus_sp(<?= $cart_item['MSHH']; ?>)"><i class="fa fa-plus fa-style" aria-hidden="true"></i></a>
                        </span>
                    </div>

                </div>
            </div>

<?php
        }
    }
}

?>
<script>
    $('.delete_sp').on('mouseover', function() {
        $(this).addClass('bg-danger')
    });
    $('.delete_sp').on('mouseout', function() {
        $(this).removeClass('bg-danger')
    });

    $('.hover_cart').on('mouseover', function() {
        $(this).children('.delete_sp').addClass('bg-secondary')
    });
    $('.hover_cart').on('mouseout', function() {
        $(this).children('.delete_sp').removeClass('bg-secondary')
    });
</script>