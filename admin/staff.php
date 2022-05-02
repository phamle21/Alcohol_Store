<?php
include_once "header.php";

?>
<script>
    document.title = "Staff | Admin Alcohol Store"
</script>
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row my-3">
        <div class="col">
            <h1 class="h3 mb-2 text-gray-800">Nhân viên</h1>
        </div>
        <div class="col d-flex justify-content-end">
            <button class="btn btn-primary" data-toggle="modal" data-target="#modalAddStaff">Add <i class="fa fa-plus"></i></button>
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
            <h6 class="m-0 font-weight-bold text-primary">Danh sách nhân viên</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Full Name</th>
                            <th>Position</th>
                            <th style="max-width: 100px">Address</th>
                            <th>Phone Number</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="show_staff">
                        <?php
                        $result = $con->query("SELECT * FROM nhanvien WHERE MSNV<>1");
                        if ($result->num_rows > 0) :
                            while ($row = $result->fetch_assoc()) :
                        ?>
                                <tr>
                                    <td><?= $row['MSNV'] ?></td>
                                    <td><?= $row['HoTenNV'] ?></td>
                                    <td><?= $row['ChucVu'] ?></td>
                                    <td><?= $row['DiaChi'] ?></td>
                                    <td><?= $row['SoDienThoai'] ?></td>
                                    <td class="action_icon">
                                        <a class="mx-2" href="javasript:void();" onclick="edit_staff(<?= $row['MSNV'] ?>)" data-toggle="modal" data-target="#modalEditStaff"><i class="fa fa-edit" aria-hidden="true"></i> Edit</a>
                                        <a class="mx-2" href="javasript:;" onclick="delete_staff(<?= $row['MSNV'] ?>)"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a>
                                    </td>
                                </tr>
                        <?php
                            endwhile;
                        else :
                            echo "<tr><td colspan='6' style='text-align:center'>Không có nhân viên nào!</td></tr>";
                        endif;
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<script>
    function delete_staff(msnv) {
        Swal.fire({
            title: 'Bạn chắc chắn chứ?',
            text: "Bạn có chắc muốn xóa nhân viên này, MSNV: " + msnv + "? \n Nhân viên không thể xóa nếu có liên quan đến đơn hàng bất kỳ!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#878787',
            confirmButtonText: 'Delete!'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location = "./controller/xuly_delete_staff.php?msnv=" + msnv;
            }
        })
    }
</script>

<!-- Modal Add Staff -->
<div class="modal fade" id="modalAddStaff" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLongTitle">New Staff</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="width:400px">
                <!--Body Modal Content-->
                <form action="./controller/xuly_addStaff.php" id="register_staff" method="post" onsubmit="check_submit_staff()">
                    <div class="form-group">
                        <label for="exampleInputName" class="sr-only">Name</label>
                        <div class="position-relative has-icon-right">
                            <input type="text" id="exampleInputName" name="hoten" class="form-control input-shadow" placeholder="Nhập Name" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputName" class="sr-only">Chức vụ</label>
                        <div class="position-relative has-icon-right">
                            <input type="text" id="exampleInputChucVu" name="chucvu" class="form-control input-shadow" placeholder="Nhập Chức vụ" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputName" class="sr-only">Địa Chỉ</label>
                        <div class="position-relative has-icon-right">
                            <input type="text" id="exampleInputDiaChi" name="diachi" class="form-control input-shadow" placeholder="Nhập Địa Chỉ" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputName" class="sr-only">Số điện thoại</label>
                        <div class="position-relative has-icon-right">
                            <input type="text" id="inputSdt_staff" name="sdt" class="form-control input-shadow" placeholder="Nhập Số Điện Thoại" required>
                        </div>
                        <div id="check_sdt_staff"></div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword" class="sr-only">Password</label>
                        <div class="position-relative has-icon-right">
                            <input type="password" id="pass_staff" name="matkhau" class="form-control input-shadow" placeholder="Nhập Mật Khẩu" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword" class="sr-only">Confirm Password</label>
                        <div class="position-relative has-icon-right">
                            <input type="password" id="repass_staff" class="form-control input-shadow" placeholder="Xác nhận Mật Khẩu" required>
                        </div>
                        <p id="error_repass_staff" style="color:red"></p>
                    </div>
                    <button type="submit" form="register_staff" class="btn btn-light btn-block waves-effect waves-light">Sign Up</button>
                </form>
            </div>
            <!--//END Body Modal Content-->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

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
            <div class="modal-body" style="width: 400px" id="edit_show_ajax_staff">

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