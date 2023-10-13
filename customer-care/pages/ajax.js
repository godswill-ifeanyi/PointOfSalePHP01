$(document).on('submit', '#editPass', function (e) {
    e.preventDefault();

    var formData = new FormData(this);
    formData.append("edit_pass", true);

    $.ajax({
        type: "POST",
        url: "code.php",
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
            var res = $.parseJSON(response);
            if (res.status == 422) {
                $("#editPass")[0].reset();
                alert(res.message);
            }
            else if(res.status == 200) {
                $("#editPass")[0].reset();
                alert(res.message);
            } 
            else if (res.status == 500) {
                $("#editPass")[0].reset();
                alert(res.message);
            }
            else if (res.status == 403) {
                $("#editPass")[0].reset();
                alert(res.message);
            }
            else if (res.status == 405) {
                $("#editPass")[0].reset();
                alert(res.message);
            }
        }
    });
});


$(document).on('submit', '#addProduct', function (e) {
    e.preventDefault();

    var formData = new FormData(this);
    formData.append("add_product", true);

    $.ajax({
        type: "POST",
        url: "code.php",
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
            var res = $.parseJSON(response);
            if (res.status == 422) {
                alert(res.message);
            }
            else if(res.status == 200) {
                $("#addProduct")[0].reset();
                alert(res.message);
            } 
            else if (res.status == 500) {
                alert(res.message);
            }
            else if (res.status == 403) {
                alert(res.message);
            }
        }
    });
});

$(document).on('click', '.deleteProductBtn', function () {
            

    if (confirm('Are you sure to delete this product?')) {
        var product_id = $(this).val();

        $.ajax({
            type: "POST",
            url: "code.php",
            data: {
                'delete_product' : true,
                'product_id' : product_id
            },
            success: function (response) {
                var res = $.parseJSON(response);

                if (res.status == 500) {
                    alertify.set('notifier','position', 'top-right');
                    alertify.success(res.message);
                }
                else if (res.status == 200) {
                    alertify.set('notifier','position', 'top-right');
                    alertify.success(res.message);

                    $('#myTable').load(location.href + " #myTable"); 
                }
            }
        });
    }
});

$(document).on('submit', '#editProduct', function (e) {
    e.preventDefault();

    var formData = new FormData(this);
    formData.append("edit_product", true);

    $.ajax({
        type: "POST",
        url: "code.php",
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
            var res = $.parseJSON(response);
            if (res.status == 422) {
                alert(res.message);
            }
            else if(res.status == 200) {
                $('#editProduct').load(location.href + " #editProduct");
                alert(res.message);
            } 
            else if (res.status == 500) {
                alert(res.message);
            }
        }
    });
});

$(document).on('submit', '#changeProfile', function (e) {
    e.preventDefault();

    var formData = new FormData(this);
    formData.append("change_profile", true);

    $.ajax({
        type: "POST",
        url: "code.php",
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
            var res = $.parseJSON(response);
            if (res.status == 422) {
                alert(res.message);
            }
            else if(res.status == 200) {
                alert(res.message);
            } 
            else if (res.status == 500) {
                alert(res.message);
            }
        }
    });

});

$(document).on('change', '#products', function () {
            
    var product_id = $(this).val();
    $.ajax({
        type: "POST",
        url: "code.php",
        data: {
            'product_id': product_id,
            'fetch_price' : true,
        },
        cache: false,
        success: function(response){
            $("#price").val(response);
        }
    });
});

$(document).on('submit', '#changePassword', function (e) {
    e.preventDefault();

    var formData = new FormData(this);
    formData.append("change_password", true);

    $.ajax({
        type: "POST",
        url: "code.php",
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
            var res = $.parseJSON(response);
            if (res.status == 422) {
                $("#changePassword")[0].reset();
                alert(res.message);
            }
            else if(res.status == 200) {
                $("#changePassword")[0].reset();
                alert(res.message);
            } 
            else if (res.status == 500) {
                $("#changePassword")[0].reset();
                alert(res.message);
            }
            else if (res.status == 403) {
                $("#changePassword")[0].reset();
                alert(res.message);
            }
            else if (res.status == 405) {
                $("#changePassword")[0].reset();
                alert(res.message);
            }
        }
    });
});

$(document).on('click', '.increment-btn', function () {
            

    var qty = $(this).closest('.product_data').find('.qty-input').val();

    var value = parseInt(qty,10);
    value = isNaN(value) ? 0 : value;

    if (value < 100) {
        value++;
        $(this).closest('.product_data').find('.qty-input').val(value);
    }

});

$(document).on('click', '.decrement-btn', function () {
            

    var qty = $(this).closest('.product_data').find('.qty-input').val();

    var value = parseInt(qty,10);
    value = isNaN(value) ? 0 : value;

    if (value > 1) {
        value--;
        $(this).closest('.product_data').find('.qty-input').val(value);
    }

});

$(document).on('click', '.addOrderBtn', function () {
            

    var qty = $(this).closest('.product_data').find('.qty-input').val();
    var discount = $(this).closest('.product_data').find('#discount').val();

    var prod_id = $(this).closest('.product_data').find('#products').val();

    $.ajax({
        type: "POST",
        url: "handleorder.php",
        data: {
            'prod_id' : prod_id,
            'discount' : discount,
            'prod_qty' : qty,
            'scope' : 'add'
        },
        success: function (response) {
            if (response == 201) {
                $('.order_data').load(location.href + " .order_data");
                $('#myTable').load(location.href + " #myTable");
                $('.total').load(location.href + " .total");
                window.location.reload(true);
            } else if (response == 500) {
                alert("SQL error");
            }
        }
    });

});

$(document).on('click', '.deleteOrderItemBtn', function () {
            

    if (confirm('Are you sure to delete this order item?')) {
        var order_item_id = $(this).val();

        $.ajax({
            type: "POST",
            url: "code.php",
            data: {
                'delete_order_item' : true,
                'order_item_id' : order_item_id
            },
            success: function (response) {
                var res = $.parseJSON(response);

                if (res.status == 500) {
                    alertify.set('notifier','position', 'top-right');
                    alertify.success(res.message);
                }
                else if (res.status == 200) {
                    alertify.set('notifier','position', 'top-right');
                    alertify.success(res.message);

                    $('#myTable').load(location.href + " #myTable");
                    $('.total').load(location.href + " .total"); 
                }
            }
        });
    }
});

$(document).on('submit', '#editTrans', function (e) {
    e.preventDefault();

    var formData = new FormData(this);
    formData.append("edit_trans", true);

    $.ajax({
        type: "POST",
        url: "code.php",
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
            var res = $.parseJSON(response);
            if (res.status == 422) {
                alert(res.message);
            }
            else if(res.status == 200) {
                alert(res.message);
            } 
            else if (res.status == 500) {
                alert(res.message);
            }
        }
    });
});

$(document).on('keyup', '#search', function () {
            
    var searchText = $(this).val();

    if (searchText != "") {
        $.ajax({
            method: "POST",
            url: "code.php",
            data: {
                'query' : searchText,
                'invoice_search' : true
            },
            success: function (response) {
                $("#show-list").html(response);
              },
        });
    } else {
        $("#show-list").html("");
    }
});

$(document).on('keyup', '#search2', function () {
            
    var searchText = $(this).val();

    if (searchText != "") {
        $.ajax({
            method: "POST",
            url: "code.php",
            data: {
                'query' : searchText,
                'contact_search' : true
            },
            success: function (response) {
                $("#show-list").html(response);
              },
        });
    } else {
        $("#show-list").html("");
    }
});

$(document).on('keyup', '#search3', function () {
            
    var searchText = $(this).val();

    if (searchText != "") {
        $.ajax({
            method: "POST",
            url: "code.php",
            data: {
                'query' : searchText,
                'product_search' : true
            },
            success: function (response) {
                $("#show-list").html(response);
              },
        });
    } else {
        $("#show-list").html("");
    }
});

$(document).on('click', '.list-group-item', function () {
    $("#search").val($(this).text());
    $("#show-list").html("");
});
$(document).on('click', '.list-group-item', function () {
    $("#search2").val($(this).text());
    $("#show-list").html("");
});
$(document).on('click', '.list-group-item', function () {
    $("#search3").val($(this).text());
    $("#show-list").html("");
});
