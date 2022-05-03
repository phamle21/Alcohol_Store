
function search() {
    var content = $('#content_search').val();
    if (content.length == 0) {
        var html = "<p style='color: red; margin-left:-25px ; '>Bạn chưa nhập nội dung tìm kiếm.</p>";
        $('#livesearch').html(html);
        document.getElementById('show_sanpham').style.display = "flex";
    } else {
        $.ajax({
            url: "xuly_searchsp.php",
            type: "post",
            dataType: "text",
            data: {
                content_search: $('#content_search').val()
            },
            success: function (result) {
                $('#livesearch').html(result);
                document.getElementById('show_sanpham').style.display = "none";
            }

        });
    }

}

function clear_inputsearch() {
    document.getElementById('content_search').value = "";
}

/// Dropdown người dùng 

$('#btn_dropdown').on('click', function () {
    $('#dropdown_user').toggle("show");
});
$.ajax({
    type: "POST",
    url: './controller/xuly_giohang.php',
    data: {
        count_cart: "add",
    },
    success: function (count) {
        $('#count_cart').html(count);
    }
});


function add_cart(mshh_submit) {
    var dataForm = $("#addCartForm" + mshh_submit).serialize();
    $.ajax({
        type: "POST",
        url: './controller/xuly_giohang.php?mshh=' + mshh_submit + '&' + dataForm,
        data: {
            themsp_cart: "true",
        },
        success: function (result) {
            $('#ajax_addcart').html(result);
            Swal.fire('Success!','Đã thêm vào giỏ hàng','success')
        }
    });
    $.ajax({
        type: "POST",
        url: './controller/xuly_giohang.php',
        data: {
            count_cart: "add",
        },
        success: function (count) {
            $('#count_cart').html(count);
        }
    });
    $.ajax({
        type: "POST",
        url: './controller/xuly_giohang.php',
        data: {
            tongthanhtien: "true",
        },
        success: function (count) {
            $('#tongdonhang').html(count);
        }
    });
    return false;
}

function plus_sp(mshh) {
    $.ajax({
        type: "POST",
        url: './controller/xuly_giohang.php',
        data: {
            plus_sp: mshh,
        },
        success: function (result) {
            $('#soluong_mua_' + mshh).html(result);
        }
    });
    $.ajax({
        type: "POST",
        url: './controller/xuly_giohang.php',
        data: {
            thanhtien: mshh,
        },
        success: function (result) {
            $('#thanhtien_sp_' + mshh).html(result);
        }
    });
    $.ajax({
        type: "POST",
        url: './controller/xuly_giohang.php',
        data: {
            tongthanhtien: "true",
        },
        success: function (count) {
            $('#tongdonhang').html(count);
        }
    });
}

function minus_sp(mshh) {
    $.ajax({
        type: "POST",
        url: './controller/xuly_giohang.php',
        data: {
            minus_sp: mshh,
        },
        success: function (result) {
            $('#soluong_mua_' + mshh).html(result);
        }
    });
    $.ajax({
        type: "POST",
        url: './controller/xuly_giohang.php',
        data: {
            thanhtien: mshh,
        },
        success: function (result) {
            $('#thanhtien_sp_' + mshh).html(result);
        }
    });
    $.ajax({
        type: "POST",
        url: './controller/xuly_giohang.php',
        data: {
            tongthanhtien: "true",
        },
        success: function (count) {
            $('#tongdonhang').html(count);
        }
    });
}

function delete_sp_cart(mshh) {
    $.ajax({
        type: "POST",
        url: './controller/xuly_giohang.php',
        data: {
            delete_sp_cart: mshh,
        },
        success: function (result) {
            $('#ajax_addcart').html(result);
            Swal.fire('Xóa thành công!','Đã xóa sản phẩm khỏi giỏ hàng','success')
        }
    });
    $.ajax({
        type: "POST",
        url: './controller/xuly_giohang.php',
        data: {
            count_cart: "delete",
        },
        success: function (count) {
            $('#count_cart').html(count);
        }
    });
    $.ajax({
        type: "POST",
        url: './controller/xuly_giohang.php',
        data: {
            tongthanhtien: "true",
        },
        success: function (count) {
            $('#tongdonhang').html(count);
        }
    });
}
$('.btn-cart').on('click', function(){
    $('.drop-menu-cart').toggle('d-block')
})

function close_cart() {
    $('#show_cart').css({ "display": "none" });
}

function open_cart() {
    $('#show_cart').css({ "display": "block" });
}


$('.delete_sp').on('mouseover', function () {
    $(this).addClass('bg-danger')
});
$('.delete_sp').on('mouseout', function () {
    $(this).removeClass('bg-danger')
});

$('.hover_cart').on('mouseover', function () {
    $(this).children('.delete_sp').addClass('bg-secondary')
});
$('.hover_cart').on('mouseout', function () {
    $(this).children('.delete_sp').removeClass('bg-secondary')
});

function check_dky() {
    var pass = document.dky_kh.password.value;
    var repass = document.dky_kh.repassword.value;

    if (pass != repass) {
        $('#thongbao_repass').html('Mật khẩu xác nhận không khớp!');
        return false;
    } else {
        $('#thongbao_repass').htm();
    }
}