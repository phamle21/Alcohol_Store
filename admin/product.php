<?php
include_once "header.php";

?>
<script>
    document.title = "Product | Admin Alcohol Store"
</script>
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row my-3">
        <div class="col">
            <h1 class="h3 mb-2 text-gray-800">Hàng hóa</h1>
        </div>
        <div class="col d-flex justify-content-end">
            <button class="btn btn-primary" data-toggle="modal" data-target="#modalAddProduct">Add <i class="fa fa-plus"></i></button>
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
            <h6 class="m-0 font-weight-bold text-primary">Danh sách hàng hóa</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>MSHH</th>
                            <th>Tên hàng hóa</th>
                            <th>Số lượng</th>
                            <th>Giá</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $result_hh = $con->query("SELECT * FROM hanghoa ORDER BY MSHH DESC");
                        if ($result_hh->num_rows > 0) :
                            while ($row = $result_hh->fetch_assoc()) :
                        ?>
                                <tr>
                                    <td><?= $row['MSHH'] ?></td>
                                    <td style="width:300px;white-space:break-spaces"><?= $row['TenHH'] ?></td>
                                    <td><?= number_format($row['Gia']) ?></td>
                                    <td style="text-align:center"><?= $row['SoLuongHang'] ?></td>
                                    <td class="action_icon">
                                        <a class="mx-2" href="javasript:;" onclick="viewProductDetails(<?= $row['MSHH'] ?>)" data-toggle="modal" data-target="#modalViewProductDetails"><i class="fa fa-eye" aria-hidden="true"></i> View</a>
                                        <a class="mx-2" href="javasript:;" onclick="edit_product(<?= $row['MSHH'] ?>)" data-toggle="modal" data-target="#modalEditProduct"><i class="fa fa-edit" aria-hidden="true"></i> Edit</a>
                                        <a class="mx-2" href="javasript:;" onclick="delete_product(<?= $row['MSHH'] ?>)"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a>
                                    </td>
                                </tr>
                        <?php
                            endwhile;
                        else :
                            echo "<tr><td colspan='7' style='text-align:center'>Không có hàng hóa!</td></tr>";
                        endif;
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<script>
    function delete_product(mshh) {
        Swal.fire({
            title: 'Bạn chắc chắn chứ?',
            text: "Bạn có chắc muốn xóa sản phẩm này, MSHH: "+mshh+"? \n Sản phẩm không thể xóa nếu đã có trong đơn hàng bất kỳ!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#878787',
            confirmButtonText: 'Delete!'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location = "./controller/xuly_delete_product.php?mshh="+mshh;
            }
        })
    }
</script>

<!-- Modal Add Product -->
<div class="modal fade" id="modalAddProduct" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="min-width: 600px;">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLongTitle">New Product</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="./controller/xuly_addProduct.php" id="addProductForm" method="post" enctype="multipart/form-data">
                    <div>
                        <label for="">ID:</label>
                        <input type="text" class="form-control" disabled placeholder="Auto">
                    </div>
                    <div>
                        <label for="">Product Name:</label>
                        <input type="text" name="tenhh" class="form-control" placeholder="Product Name" required>
                    </div>
                    <div>
                        <label for="">Description:</label>
                        <textarea type="text" name="mota" class="form-control" placeholder="Desscription" required></textarea>
                    </div>
                    <div>
                        <label for="">Product Price: <a id="price_demo"></a></label>
                        <input type="text" name="gia" id="giasp" class="form-control" placeholder="Product Price" required>
                    </div>
                    <div>
                        <label for="">Product Quantity:</label>
                        <input type="text" name="soluong" class="form-control" placeholder="Product Quantity" required>
                    </div>
                    <div>
                        <label class="img_product" for="">Product Images:</label> <br>
                        <input type="file" name="images_product[]" accept='image/*' multiple required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" form="addProductForm" class="btn btn-primary">Add product</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit Product -->
<div class="modal fade" id="modalEditProduct" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLongTitle">Edit Product</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="edit_show_ajax">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" form="editProductForm" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>

<style>
    h5,
    label,
    .modal-content {
        color: black;
    }

    .form-control {
        color: black;
    }

    .form-control:focus {
        border: 1px solid gray;
    }

    .img_product {
        display: block;
    }

    select option {
        background-color: white;
        color: black;
    }

    ::placeholder {
        color: black;
    }

    .modal-dialog {
        max-width: max-content !important;
    }
</style>
<!-- Modal View Product Details-->
<div class="modal fade " id="modalViewProductDetails" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="max-width: 600px;">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLongTitle">Product Details</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-dark" id="edit_show_ajax_product">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<?php
include_once "footer.php";
?>