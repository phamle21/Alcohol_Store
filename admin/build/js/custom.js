

function edit_product(mshh){
    $.ajax({
        type: "POST",
        url: './controller/edit_product.php',
        data: {
            mshh: mshh,
        }, 
        success: function(result){
            $('#edit_show_ajax').html(result);
        }
    });
}

$('#giasp').on('keyup', function(){
    var x = parseFloat($('#giasp').val());
    x = x.toLocaleString('it-IT', {style : 'currency', currency : 'VND'});
    $('#price_demo').html(x);
});
function format_price(number){
    // var x = parseFloat($('#giasp').val());
    x = parseFloat(number).toLocaleString('it-IT', {style : 'currency', currency : 'VND'});
    $('#price_demo_edit').html(x);
}

function viewOrder(sodondh){
    $.ajax({
        type: "POST",
        url: './controller/order_details.php',
        data: {
            sodondh: sodondh,
        }, 
        success: function(result){
            $('#edit_show_ajax_order').html(result);
        }
    });
}
function viewProductDetails(mshh){
    $.ajax({
        type: "POST",
        url: './controller/product_details.php',
        data: {
            mshh: mshh,
        }, 
        success: function(result){
            $('#edit_show_ajax_product').html(result);
        }
    });
}


$('#inputSdt_staff').on('keyup', function() {
    var sdt = $('#inputSdt_staff').val();
    $.ajax({
        type: "post",
        url: "./controller/xacnhan_sdt.php",
        data: {
            sdt: sdt,
        },
        success: function(result){
            $('#check_sdt_staff').html(result);
        }
    });
    
});

$('#register_staff').submit(function() {
    var check_submit = true;

    if($('#pass_staff').val() != $('#repass_staff').val()){
        $('#error_repass_staff').html('Mật khẩu xác nhận chưa đúng!');
        check_submit = false;
    }else{
        check_submit = true;
    }

    if($('#check_sdt_staff').html() == 'Số điện thoại có thể sử dụng'){
        check_submit = false;
    }else{
        check_submit = true;
    }

    return check_submit;
});

function edit_staff(msnv){
    $.ajax({
        type: "POST",
        url: './controller/edit_staff.php',
        data: {
            msnv: msnv,
        }, 
        success: function(result){
            $('#edit_show_ajax_staff').html(result);
        }
    });
}

function edit_customer(mskh){
    $.ajax({
        type: "POST",
        url: './controller/edit_customer.php',
        data: {
            mskh: mskh,
        }, 
        success: function(result){
            $('#edit_show_ajax_customer').html(result);
        }
    });
}

function duyetlan1(sodon){
    $('#sodh_duyetlan1').attr("value", sodon);
}
function show_duyetlan2(sodon){
    $('#show_form_duyet'+sodon).removeClass("d-none");
}