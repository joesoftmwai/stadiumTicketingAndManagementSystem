
// Adding the preloager
$(window).load(function() {
   $('.loader').fadeOut('slow');
   $('.status').fadeOut('slow');
});



$(document).ready(function () {

    $('#tooltip').tooltip();


    $(".pov_link").on("click", function () {
        var pov_img = $(this).attr("rel");
        var pov_img_url = "./images/" + pov_img;
        $(".modal_pov_img").attr("src", pov_img_url);
        $("#myModal").modal('show');
    });

    $(".cat_img_link").on("mouseover", function () {
        var cat_img = $(this).attr("rel");
        var cat_img_url = "./images/" + cat_img;
        $(".cat_img_well").attr("src", cat_img_url);
        $("#myWell").show();
    });

    $(".cat_img_link").on("mouseout", function () {
        var default_url = "./images/seating_plan1.jpg";
        $(".cat_img_well").attr("src", default_url);
        $("#myWell").show();
    });

    setSelected();

});

/**
 * :: store the number of seats selected
 */

$('.categories_details').on('change', 'select.my_select', function() {
    var number_of_seats = $(this).val();
    //localStorage.setItem("number_of_seats", number_of_seats);
});

/**
 * :: set selected attribute
 */
function setSelected() {
    let seats = $('.seats_quantity').attr('seats');
    $('.seats_quantity').val(seats).attr('selected','selected');
}


/**
 * :: calculate updated totals
 */

$('.checkout_quantity').on('change', 'select.seats_quantity', function() {
    let order_id = $('.order_id').attr('order_id');
    let seats = $(this).val();
    let price = $('.price').attr('price');
    let fee = $('.initfee').attr('initfee');
    let booking_fee = Number(fee);

    if(seats > 0 && seats <= 1 ) {
        booking_fee;
    } else if(seats >= 3 && seats <= 5) {
        booking_fee += (0.15 * booking_fee);
    } else if(seats >= 6 && seats <= 7  ) {
        booking_fee += (0.25 * booking_fee);
    } else if(seats >= 8 && seats <= 10 ) {
        booking_fee += (0.30 * booking_fee);
    }
    
    let subtotal = Math.ceil(Number(seats) * Number(price));
    let total = Math.ceil( Number(subtotal) + Number(booking_fee));
    $('.total_price').html(total);
    $('.finalfee').html(booking_fee);
    $('._subtotal').html(subtotal);


});


$('.link-register-customer').on('click', function() {

    $('.link-sigin-customer').removeClass('active');
    $('.link-register-customer').addClass('active');

    $('.panel-register-customer').css('display', 'block');
    $('.panel-signin-customer').css('display', 'none');

    
})

$('.link-sigin-customer').on('click', function() {

    $('.link-sigin-customer').addClass('active');
    $('.link-register-customer').removeClass('active');

    $('.panel-register-customer').css('display', 'none');
    $('.panel-signin-customer').css('display', 'block');
})



