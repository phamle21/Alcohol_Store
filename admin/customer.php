<?php
include_once "header.php";

?>
<script>
    document.title = "Customer | Admin Alcohol Store"
</script>
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row my-3">
        <div class="col">
            <h1 class="h3 mb-2 text-gray-800">Người dùng</h1>
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
            <h6 class="m-0 font-weight-bold text-primary">Danh sách người dùng</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Full Name</th>
                            <th style="max-width: 100px">Address</th>
                            <th>Phone Number</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="show_staff">
                        <?php
                        $result = $con->query("SELECT * FROM khachhang");
                        if ($result->num_rows > 0) :
                            while ($row = $result->fetch_assoc()) :
                        ?>
                                <tr>
                                    <td><?= $row['MSKH'] ?></td>
                                    <td><?= $row['HoTenKH'] ?></td>
                                    <td><?= $row['DiaChi'] ?></td>
                                    <td><?= $row['SoDienThoai'] ?></td>
                                    <td class="action_icon">
                                        <a class="mx-2" href="javasript:void();" onclick="edit_customer(<?= $row['MSKH'] ?>)" data-toggle="modal" data-target="#modalEditStaff"><i class="fa fa-edit" aria-hidden="true"></i> Edit</a>
                                        <a class="mx-2" href="javasript:;" onclick="delete_customer(<?= $row['MSKH'] ?>)"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a>
                                    </td>
                                </tr>
                        <?php
                            endwhile;
                        else :
                            echo "<tr><td colspan='6' style='text-align:center'>Không có khách hàng nào!</td></tr>";
                        endif;
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    function delete_customer(mskh) {
        Swal.fire({
            title: 'Bạn chắc chắn chứ?',
            text: "Bạn có chắc muốn xóa khách hàng này, MSKH: " + mskh + "? \n Khách hàng không thể xóa nếu có liên quan đến đơn hàng bất kỳ!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#878787',
            confirmButtonText: 'Delete!'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location = "./controller/xuly_delete_customer.php?mskh=" + mskh;
            }
        })
    }
</script>

<!-- Modal Edit Staff -->
<div class="modal fade" id="modalEditStaff" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLongTitle">Edit Staff</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="width: 400px" id="edit_show_ajax_customer">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" form="edit_staff" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>

<?php
include_once "footer.php";
?>