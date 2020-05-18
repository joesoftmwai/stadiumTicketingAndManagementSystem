
<?php include "includes/header.php"; ?>
<!-- Navigation -->
<?php include "includes/navigation.php"; ?>

<?php 
    
    $ip_add = $ip_add = getRealUserIp();
    $check_cart = "SELECT * FROM cart WHERE ip_add='$ip_add'";
    $run_cart   = mysqli_query($conn, $check_cart);
    $count_items = mysqli_num_rows($run_cart);

    if ($count_items == 0) {
        echo "<script>window.open('customer/my_account.php?my_orders', '_self')</script>";
    } else {

 ?>

 <?php
        $login_customer_email = $_SESSION['email'];
        $select_customer = "SELECT * FROM customers WHERE cust_email = '$login_customer_email'";
        $run_customer    = mysqli_query($conn, $select_customer);

        $row_customer    = mysqli_fetch_array($run_customer);
        $login_customer_id = $row_customer['cust_id'];

        // get payment settings
        $get_payment_settings = "SELECT * FROM payment_settings";
        $run_payment_settings = mysqli_query($conn, $get_payment_settings);
        $row_payment_settings = mysqli_fetch_array($run_payment_settings);
        $processing_fee = $row_payment_settings['processing_fee'];
        $enable_paypal = $row_payment_settings['enable_paypal'];
        $paypal_email = $row_payment_settings['paypal_email'];
        $paypal_currency_code = $row_payment_settings['paypal_currency_code'];
        $paypal_sandbox = $row_payment_settings['paypal_sandbox'];
        if ($paypal_sandbox == 'on') {
            $paypal_url = 'https://www.sandbox.paypal.com/cgi-bin/webscr';
        } elseif ($paypal_sandbox == 'off') {
            $paypal_url = 'https://www.paypal.com/cgi-bin/webscr';
        }

        $enable_stripe = $row_payment_settings['enable_stripe'];

        $ip_add = getRealUserIp();
        $select_cart = "SELECT * FROM cart WHERE ip_add = '$ip_add'";
        $run_cart = mysqli_query($conn, $select_cart);
        confirm($run_cart);

        $total = 0;
        $row_cart = mysqli_fetch_array($run_cart);
        $event_id    = $row_cart['event_id'];
        $cat_id      = $row_cart['cat_id'];
        $seats_qty   = $row_cart['qty'];

        $get_event   = "SELECT * FROM events WHERE event_id = $event_id";
        $run_event   = mysqli_query($conn, $get_event);
        $row_event   = mysqli_fetch_array($run_event);
        $event_name   = $row_event['event_name'];
        $event_extras = $row_event['event_extras'];
        $event_date   = $row_event['event_date'];
        $event_venue  = $row_event['event_venue'];

        $event_date = strtotime($event_date);
        $formated_date = strftime("%d %b, %Y  %H:%M", $event_date);

        $get_category = "SELECT * FROM categories WHERE cat_id = $cat_id";
        $run_category = mysqli_query($conn, $get_category);
        $row_category = mysqli_fetch_array($run_category);
        $cat_name   =   $row_category['cat_name'];
        $cat_price  =   $row_category['cat_price'];
        $cat_fee    =   $row_category['cat_booking_fee'];

        if($seats_qty  > 0 && $seats_qty  <= 1 ) {
            $cat_fee;
        } else if($seats_qty  >= 3 && $seats_qty  <= 5) {
            $cat_fee += ceil(0.15 * $cat_fee);
        } else if($seats_qty  >= 6 && $seats_qty  <= 7  ) {
            $cat_fee += ceil(0.25 * $cat_fee);
        } else if($seats_qty  >= 8 && $seats_qty  <= 10 ) {
            $cat_fee += ceil(0.30 * $cat_fee);
        }

        $subtotal   = ($cat_price * $seats_qty)  + $cat_fee;
        $total     += $subtotal;
        $totalUSD   = $total/100;

        $cat_priceUSD = $cat_price/100;
        $cat_feeUSD = $cat_fee/100;

        ?>

<!-- Page Content -->
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <ul class="breadcrumb">
                <li>
                    <a href="index.php">Home</a>
                </li>
                <li>Checkout-payement</li>
            </ul>
        </div>     

        <!-- Fixtures Entries Column -->
        <div class="col-md-12">

            <div class="row"> <!-- row starts -->
                <div class="col-md-6"> <!-- col-md-6 starts -->

                    <div class="panel panel-default payment-options">
                        <div class="panel-heading">
                            <h4>Payements Options</h4>
                        </div>

                        <div class="panel-body">
                            <?php if($enable_paypal == 'yes'): ?>

                                <div class="row">
                                    <div class="col-xs-1">
                                        <input type="radio" id="paypal" class="form-control radio-input" name="method">
                                    </div>
                                    <div class="col-xs-11">
                                        <img src="images/paypal.png" alt="" height="50" class="ml-2 width-xs-100">
                                    </div>
                                </div>

                            <?php endif; ?>

                            <?php if($enable_stripe == 'yes'): ?>

                                <?php if($enable_paypal == 'yes'){ ?>
                                    <hr>
                                <?php } ?>

                                <div class="row">
                                    <div class="col-xs-1">
                                        <input type="radio" id="credit-card" class="form-control radio-input" name="method">
                                    </div>
                                    <div class="col-xs-11">
                                        <img src="images/credit_cards.jpg" alt="" height="50" class="ml-2 width-xs-100">
                                    </div>
                                </div>

                            <?php endif; ?>
                        </div>
                    </div>
                
                </div> <!-- col-md-6 ends -->

                <div class="col-md-6"> <!-- col-md-6 starts -->

                <div class="panel panel-default"> <!-- panel panel-default starts -->

                <div class="panel-heading">
                    <h4>Order details summary </h4>
                </div>
                <div class="panel-body checkout_details"> <!-- panel-body checkout_details starts -->

                        <h4 class="text-success"><?php echo $event_name; ?> (<small><?php echo $event_extras; ?> </small>)</h4>
                        <span class="text-danger"><?php echo $formated_date; ?></span>
                        <span class="text-warning"><?php echo $event_venue; ?></span>
                        <hr id="dash">

                        <h5>Category: 
                            <span class="pull-right"><?php echo $cat_name; ?></span>      
                        </h5>
                        <hr id="dash">

                        <h5 class="checkout_quantity">Quantity:
                            <small class="price pull-right" price="<?php echo $cat_price; ?>">
                                Each at Ksh. <?php echo $cat_price; ?>
                            </small>

                            &nbsp; &nbsp;

                            <span class="pull-right"><?php echo $seats_qty; ?></span>
                        </h5>
                        <hr id="dash">

                        <h5 class="initfee" initfee="<?php echo $cat_fee ; ?>">
                            Booking fee:
                            <span class="finalfee pull-right">Ksh. <?php echo $cat_fee; ?></span>
                        </h5>
                        <hr id="dash">


                        <div>
                            <hr id="hr_dot">
                            <h4 id="total_b">
                                Total: 
                                <span class="pull-right total_price">Ksh. <?php echo $total; ?></span>
                            </h4>
                            <hr id="hr_dot">
                        </div>

                        <div class="row"> <!-- row payment buttons starts -->
                            <div class="col-xs-6">

                                <?php if($enable_paypal == 'yes'): ?>

                                    <form action="<?php echo $paypal_url; ?>" method="post" id="paypal-form">
                                        <input type="hidden" name="cmd" value="_xclick">
                                        <input type="hidden" name="upload" value="1">
                                        <input type="hidden" name="tax" value="<?php echo $cat_feeUSD; ?>">
                                        <input type="hidden" name="business" value="<?php echo $paypal_email; ?>">
                                        <input type="hidden" name="currency_code" value="<?php echo $paypal_currency_code; ?>">
                                        <input type="hidden" name="cancel_return" value="<?php echo $site_url; ?>/checkout-payement.php">
                                        <input type="hidden" name="return" value="<?php echo $site_url; ?>/paypal_order.php?customer_id=<?php echo $login_customer_id; ?>&event_id=<?php echo $event_id; ?>&cat_id=<?php echo $cat_id; ?>&seats_qty=<?php echo $seats_qty; ?>&amount=<?php echo $total; ?>">

                                        <input type="hidden" name="item_name" value="<?php echo $event_name; ?>">
                                        <input type="hidden" name="item_number" value="1">
                                        <input type="hidden" name="amount" value="<?php echo $cat_priceUSD; ?>">
                                        <input type="hidden" name="quantity" value="<?php echo $seats_qty; ?>">


                                        <button class="btn btn-warning btn-block" id="paypal_btn"><i class="fa fa-paypal"></i>  Paypal</button>
                                    </form>

                                <?php endif; ?>

                            </div>

                            <div class="col-xs-6">
                                <?php if($enable_stripe == 'yes'): ?>

                                    <!-- includes stripe configuration files -->
                                     <?php 
                                        include 'stripe_config.php'; 
                                        $stripe_total_amount = $totalUSD*100;
                                        ?>

                                    <form action="checkout_charge.php" method="post" id="credit-card-form">
                                        <input type="hidden" name="customer_id" value="<?php echo $login_customer_id; ?>">
                                        <input type="hidden" name="event_id" value="<?php echo $event_id; ?>">
                                        <input type="hidden" name="cat_id" value="<?php echo $cat_id; ?>">
                                        <input type="hidden" name="seats_qty" value="<?php echo $seats_qty; ?>">
                                        <input type="hidden" name="amount" value="<?php echo $stripe_total_amount; ?>">
                                        <button 
                                            type="submit"
                                            id="credit_card_btn" 
                                            class="btn btn-black btn-block stripe-submit" 
                                            data-key="<?php echo $stripe['publishable_key']; ?>"
                                            data-amount="<?php echo $stripe_total_amount; ?>"
                                            data-currency="<?php echo $stripe['currency_code']; ?>"
                                            data-email="<?php echo $login_customer_email; ?>"
                                            data-name="ticketInn"
                                            data-image=""
                                            data-description="<?php echo $event_name; ?>"
                                            data-allow-remember-me="true"
                                            >
                                            <img src="images/mp_mark_circles.svg" alt="">  
                                            Credit card
                                        </button>

                                        <script>
                                            $(document).ready(function() {
                                            $('.stripe-submit').on('click', function(event) {
                                                event.preventDefault();

                                                var $button = $(this),
                                                    $form = $button.parents('form');

                                                var opts = $.extend({}, $button.data(), {
                                                    token: function(result) {
                                                        $form.append($('<input>').attr({ type: 'hidden', name: 'stripeToken', value: result.id })).submit();
                                                    }
                                                });

                                                StripeCheckout.open(opts);
                                                });
                                            });
                                        </script>

                                    </form>

                                <?php endif; ?>
                            </div>
                        </div> <!-- row payment buttons ends -->

                </div><!-- panel-body checkout_details ends -->

            </div> <!-- panel panel-default ends -->

        </div> <!-- col-md-6 ends -->

        </div> <!-- row ends -->
            
        </div><!-- /col-md-9-->
        
    </div> <!-- /.row -->
</div>

    <hr>

    

    <script>
        $('#paypal_btn').attr('disabled', 'disabled');
        $('#credit_card_btn').attr('disabled', 'disabled');

        $('#paypal').click(function() {
            $('#paypal_btn').removeAttr('disabled');
            $('#credit_card_btn').attr('disabled', 'disabled');
        });

        $('#credit-card').click(function() {
            $('#credit_card_btn').removeAttr('disabled');
            $('#paypal_btn').attr('disabled', 'disabled');
        });
        
    </script>

    <!-- Footer -->

<?php } ?>

<?php include "includes/footer.php";
