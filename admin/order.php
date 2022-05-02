<?php
include_once "header.php";

?>
<script>
    document.title = "Order | Admin Alcohol Store"
</script>
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row my-3">
        <div class="col">
            <h1 class="h3 mb-2 text-gray-800">Đơn hàng</h1>
        </div>
    </div>
    <!-- Notify -->
    <?php

    if (isset($_COOKIE['thongbao_success'])) {
        echo "<script>Swal.fire('Success','" . $_COOKIE['thongbao_success'] . "','success')</script>";
    }
    if (isset($_COOKIE['thongbao_fail'])) {
        echo "<script>Swal.fire('Error','" . $_COOKIE['thongbao_fail'] . "','error')</script>";
    }
    ?>
    <!-- /Notify -->

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Danh sách đơn hàng</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Khách hàng</th>
                            <th>Nhân viên</th>
                            <th>Ngày đặt</th>
                            <th>Ngày giao</th>
                            <th>Địa chỉ giao</th>
                            <th>Trang thái</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $msnv_login = $_COOKIE['login_nv'];
                        $nv = $con->query("SELECT HoTenNV FROM nhanvien WHERE MSNV='$msnv_login'")->fetch_assoc();
                        $hotennv_login = $nv['HoTenNV'];
                        $result_dh = $con->query("SELECT a.*, b.HoTenKH, c.HoTenNV, b.DiaChi
                                                            FROM dathang as a
                                                            LEFT JOIN khachhang as b ON a.MSKH=b.MSKH
                                                            LEFT JOIN nhanvien as c ON a.MSNV=c.MSNV");
                        if ($result_dh->num_rows > 0) :
                            while ($row = $result_dh->fetch_assoc()) :
                        ?>
                                <tr>
                                    <td><?= $row['SoDonDH'] ?></td>
                                    <td><?= $row['HoTenKH'] ?></td>
                                    <td><?= $row['HoTenNV'] ?></td>
                                    <td><?= date("d-m-Y", strtotime($row['NgayDH'])) ?></td>
                                    <td><?php if ($row['NgayGH'] != null) echo date("d-m-Y", strtotime($row['NgayGH'])) ?></td>
                                    <td><?= $row['DiaChi'] ?></td>
                                    <td style="text-align: center">
                                        <?php
                                        if ($row['TrangThaiDH'] == 'Chưa duyệt') {
                                            echo "<a href='javasript:void();' onclick='duyetlan1(" . $row['SoDonDH'] . ")' data-toggle='modal' data-target='#modalDuyetDH'>" . $row['TrangThaiDH'] . " </a><i class='fa fa-hand-pointer'></i>";
                                        } else {
                                            if ($row['TrangThaiDH'] == 'Đang giao hàng' && $row['HoTenNV'] == $hotennv_login) {
                                                echo "<a href='javasript:void();' onclick='show_duyetlan2(" . $row['SoDonDH'] . ")'>" . $row['TrangThaiDH'] . " </a><i class='fa fa-caret-down'></i>";
                                            } else {
                                                echo $row['TrangThaiDH'];
                                            }
                                        }
                                        ?>
                                        <div class="show_form_duyet d-none" id="show_form_duyet<?= $row['SoDonDH'] ?>">
                                            <form action="./controller/xuly_duyetDH.php" id="duyetlan2Form" method="post">
                                                <input type="hidden" name="sodonDH" value="<?= $row['SoDonDH'] ?>">
                                                <select name="trangthai" class="form-control" id="" style="display: inline-block">
                                                    <option value="Đã hoàn thành">Đã hoàn thành</option>
                                                    <option value="Thất bại">Thất bại</option>
                                                </select>
                                                <button type="submit" name="duyetlan2" id="btn_duyetlan2"><i class="fa fa-check"></i></button>
                                            </form>
                                        </div>
                                    </td>
                                    <td class="action_icon">
                                        <a class="mx-2" href="javasript:void();" onclick="viewOrder(<?= $row['SoDonDH'] ?>)" data-toggle="modal" data-target="#modalViewOrderDetails"><i class="fa fa-eye" aria-hidden="true"></i> View</a>
                                    </td>
                                </tr>
                        <?php
                            endwhile;
                        else :
                            echo "<tr><td colspan='8' style='text-align:center'>Không có đơn hàng nào!</td></tr>";
                        endif;
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<!-- Modal View Order Details-->
<div class="modal fade" id="modalViewOrderDetails" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="width: fit-content;">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLongTitle">Order Details</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="edit_show_ajax_order">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Duyet DH-->
<div class="modal fade" id="modalDuyetDH" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLongTitle">Duyệt Đơn Hàng</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="./controller/xuly_duyetDH.php" id="duyetdhForm" method="post">
                    <input type="hidden" id="sodh_duyetlan1" name="sodondh">
                    <div>
                        <label for="">Chọn ngày giao hàng:</label><br>
                        <input type="date" class="form-control" name="ngayGH" id="ngayGH" min="<?= date('Y-m-d') ?>" value="<?= date('Y-m-d') ?>">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" name="duyetlan1" form="duyetdhForm" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>
<?php
include_once "footer.php";
?>