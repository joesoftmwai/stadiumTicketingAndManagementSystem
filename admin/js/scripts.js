/**
 * :: DATE-TIME PICKER
 */

(function($){
    $(function(){
        $('#id_0').datetimepicker({
            "allowInputToggle": true,
            "showClose": true,
            "showClear": true,
            "showTodayButton": true,
            "format": "MM/DD/YYYY hh:mm:ss A",
        });
        $('#id_1').datetimepicker({
            "allowInputToggle": true,
            "showClose": true,
            "showClear": true,
            "showTodayButton": true,
            "format": "MM/DD/YYYY HH:mm:ss",
        });
        $('#id_2').datetimepicker({
            "allowInputToggle": true,
            "showClose": true,
            "showClear": true,
            "showTodayButton": true,
            "format": "hh:mm:ss A",
        });
        $('#id_3').datetimepicker({
            "allowInputToggle": true,
            "showClose": true,
            "showClear": true,
            "showTodayButton": true,
            "format": "HH:mm:ss",
        });
        $('#id_4').datetimepicker({
            "allowInputToggle": true,
            "showClose": true,
            "showClear": true,
            "showTodayButton": true,
            "format": "MM/DD/YYYY",
        });
    });
})(jQuery);


/**
 * :: DELETE EVENT
 */

$(".btn_delete_event").click(function() {

     var event_id = $(this).attr("event_id");

    Swal.fire({
       title: 'Are you sure you want to delete this event',
        text: 'If you are not sure you can cancel the action',
        type: 'warning',
        showCancelButton: true,
        cancelButtonText: 'Cancel',
        confirmButtonText: 'Ok'
    }).then(result => {
       if (result.value) {
           window.location = "index.php?delete_event="+event_id;
       }
    });
})


/**
 * :: DELETE EVENT
 */

$(".btn_delete_category").click(function() {

     var cat_id = $(this).attr("cat_id");

    Swal.fire({
       title: 'Are you sure you want to delete this category',
        text: 'If you are not sure you can cancel the action',
        type: 'warning',
        showCancelButton: true,
        cancelButtonText: 'Cancel',
        confirmButtonText: 'Ok'
    }).then(result => {
       if (result.value) {
           window.location = "index.php?delete_category="+cat_id;
       }
    });
})

/**
 * :: DELETE USER
 */

 $(".btn_delete_user").click(function() {
    var user_id = $(this).attr("user_id");

    Swal.fire({
       title: 'Are you sure you want to delete this user',
        text: 'If you are not sure you can cancel the action',
        type: 'warning',
        showCancelButton: true,
        cancelButtonText: 'Cancel',
        confirmButtonText: 'Ok'
    }).then(result => {
       if (result.value) {
           window.location = "index.php?delete_user="+user_id;
       }
    });

 })


 /**
 * :: DELETE CUSTOMER
 */

 $(".btn_delete_customer").click(function() {
    var cust_id = $(this).attr("cust_id");

    Swal.fire({
       title: 'Are you sure you want to delete this customer',
        text: 'If you are not sure you can cancel the action',
        type: 'warning',
        showCancelButton: true,
        cancelButtonText: 'Cancel',
        confirmButtonText: 'Ok'
    }).then(result => {
       if (result.value) {
           window.location = "index.php?delete_customer="+cust_id;
       }
    });

 })


 
  /**
 * :: DELETE ORDER
 */

 $(".btn_delete_order").click(function() {
    var order_id = $(this).attr("order_id");

    Swal.fire({
       title: 'Are you sure you want to delete this customer',
        text: 'If you are not sure you can cancel the action',
        type: 'warning',
        showCancelButton: true,
        cancelButtonText: 'Cancel',
        confirmButtonText: 'Ok'
    }).then(result => {
       if (result.value) {
           window.location = "index.php?delete_order="+order_id;
       }
    });

 })


/**
 * :: DELETE ORDER
 */

 $(".btn_delete_payement").click(function() {
    var payement_id = $(this).attr("payement_id");

    Swal.fire({
       title: 'Are you sure you want to delete this payment',
        text: 'If you are not sure you can cancel the action',
        type: 'warning',
        showCancelButton: true,
        cancelButtonText: 'Cancel',
        confirmButtonText: 'Ok'
    }).then(result => {
       if (result.value) {
           window.location = "index.php?delete_payement="+payement_id;
       }
    });

 })


 /**
 * :: DELETE SLIDER IMAGE
 */

 $(".btn_delete_slider").click(function() {
    var  $slider_id = $(this).attr("slider_id");

    Swal.fire({
       title: 'Are you sure you want to delete this slider',
        text: 'If you are not sure you can cancel the action',
        type: 'warning',
        showCancelButton: true,
        cancelButtonText: 'Cancel',
        confirmButtonText: 'Ok'
    }).then(result => {
       if (result.value) {
           window.location = "index.php?delete_slider="+ $slider_id;
       }
    });

 })


  /**
 * :: DELETE SLIDER IMAGE
 */

 $(".btn_print_bill").click(function() {
    var order = $(this).attr('order');
    window.open("../extensions/tcpdf/pdf/tickets.php?order="+order, "_blank");
 })









