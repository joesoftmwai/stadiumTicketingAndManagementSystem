<?php include "includes/header.php"; ?>
    <!-- Navigation -->
<?php include "includes/navigation.php"; ?>


    <!-- Page Content -->
    <div class="container">
    <div class="row">
        <div class="col-md-12">
            <ul class="breadcrumb">
                <li>
                    <a href="index.php">Home</a>
                </li>
                <li>Checkout</li>
            </ul>
        </div>


        <!-- Fixtures Entries Column -->
        <div class="col-md-9">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3>Your Order Details</h3>
                </div>
                <div class="panel-body checkout_details">


                    <?php

                     $ip_add = getRealUserIp();

                     $select_cart = "SELECT * FROM cart WHERE ip_add = '$ip_add'";
                     $run_cart = mysqli_query($conn, $select_cart);
                     confirm($run_cart);

                     $total = 0;
                     while($row_cart = mysqli_fetch_array($run_cart)) {
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
                        $cat_qty    =   $row_category['cat_quantity'];
                        $cat_price  =   $row_category['cat_price'];
                        $cat_fee    =   $row_category['cat_booking_fee'];


                        if($seats_qty  > 0 && $seats_qty  <= 1 ) {
                            $cat_fee;
                        } else if($seats_qty  >= 3 && $seats_qty  <= 5) {
                            $cat_fee += (0.15 * $cat_fee);
                        } else if($seats_qty  >= 6 && $seats_qty  <= 7  ) {
                            $cat_fee += (0.25 * $cat_fee);
                        } else if($seats_qty  >= 8 && $seats_qty  <= 10 ) {
                            $cat_fee += (0.30 * $cat_fee);
                        }

                        $subtotal   = ($cat_price * $seats_qty)  + $cat_fee;
                        $total     += $subtotal; 


                     ?>      <?php delete_event(); ?>
                            <span class="pull-right e_delete">
                                <a href="checkout.php?event_id=<?php echo $event_id; ?>&cat_id=<?php echo $cat_id; ?>"><i class="fa fa-times 4x"></i> Delete Ticket</a>
                            </span>
                            <h4 class="text-success"><?php echo $event_name; ?> (<small><?php echo $event_extras; ?> </small>)</h4>
                            <span class="text-danger"><?php echo $formated_date; ?></span>
                            <span class="text-warning"><?php echo $event_venue; ?></span>

                            <h5>Category: <?php echo $cat_name; ?></h5>

                            <h5 class="checkout_quantity form-inline">Quantity: 
                                <input type="text" name="quantity" value="<?php echo $seats_qty; ?>" event_id="<?php echo $event_id; ?>" cat_id="<?php echo $cat_id;?>" class="quantity form-control">

                                <span class="price" price="<?php echo $cat_price; ?>">
                                    each at Ksh. <?php echo $cat_price; ?>
                                </span> 
                            </h5>

                            <h5 class="initfee" initfee="<?php echo $cat_booking_fee ; ?>"> 
                                Booking fee:  Ksh. 
                                <span class="finalfee"><?php echo $cat_fee; ?></span>
                            </h5>

                            <hr id="hr_dot">


                             <?php } ?>


                            <h4 class="text-danger"> 
                               Total will be calculated in the next step
                            </h4>


                </div>
            </div>




            <?php /***** Register customer *****/
             if (isset($_POST['register-submit'])){

                 $f_name      = escape($_POST['f_name']);
                 $l_name      = escape($_POST['l_name']);
                 $email       = escape($_POST['email']);
                 $password    = escape($_POST['password']);
                 $confirmpass = escape($_POST['confirm-password']);
                 $phone       = escape($_POST['phone']);
                 $city        = escape($_POST['city']);
                 $street      = escape($_POST['street']);
                 $postal_code = escape($_POST['postal_code']);

                 $error = [
                    'email' => '',
                    'password' => '',
                    'confirmpass' => '',
                    'phone' => ''
                 ];

                if (email_exists($email)) {
                    $error['email'] = '* Email already exists';
                }
                if (strlen($password) < 6) {
                    $error['password'] = '* Password cannot be less than 6 characters';
                }
                if ($password !== $confirmpass) {
                    $error['confirmpass'] = '* Password do not match';
                }
                if (strlen($phone) < 10) {
                    $error['phone'] = '* Invalid phone number';
                }

                foreach ($error as $key => $value) {
                    if (empty($value)) {
                        unset($error[$key]);
                    }
                }

                if (empty($error)) {
                    register_customer($f_name, $l_name, $email, $password, $phone, $city, $street, $postal_code);
                   
                }

             }
            ?>



            <?php /***** login customer *****/

                require "vendor/autoload.php";

               if (isset($_POST['signin-submit'])) {
                   $email    = escape($_POST['signin-email']);
                   $password = escape($_POST['signin-password']);

                   $error = [
                        '_email' => '',
                        '_password' => ''
                   ];

                   if (!email_exists($email)) {
                       $error['_email'] = '* Email does not exists';
                   } 

                   foreach ($error as $key => $value) {
                      if (empty($value)) {
                        unset($error[$key]);
                    }
                }

                if (empty($error)) {
                   login_customer($email, $password);

                }
    
               }

             ?>


            <div class="panel panel-default ">
                <div class="panel-heading">
                    <h3 style="text-align: center;">Billing Information</h3>
                </div>
                <div class="row panel-extras">
                    <div class="col-xs-6">
                        <span class="link-register-customer active">Register</span>
                    </div>
                    <div class="col-xs-6">
                        <span class="link-sigin-customer">Sign In</span>
                    </div>
                    <hr>
                </div>


                <div class="panel-body panel-signin-customer" style="display: none;">
                
                    <form action="" method="post" autocomplete="off">
                        <div class="row">
                            <div class="col-sm-6">
                                 <div class="form-group">
                                    <label for="signin-email">Email</label>
                                    <input type="signin-email" name="signin-email" id="signin-email" class="form-control" required value="<?php echo isset($email) ? $email : '' ?>">
                                    <p class="text-danger"><?php echo isset($error['_email']) ? $error['_email'] : '' ?></p>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="signin-password">Password</label>
                                    <input type="password" name="signin-password" id="signin-password" class="form-control" required value="<?php echo isset($password) ? $password : '' ?>">
                                    <p class="text-danger"><?php echo isset($error['_password']) ? $error['_password'] : '' ?></p>
                                </div>
                            </div>

                            
                        </div>
                        
                        <input type="submit" name="signin-submit" value="Sign In" class="btn btn-success signin-btn">
                        
                    </form>

                </div>
                
                <div class="panel-body panel-register-customer" style="display: block;">
                
                    <form action="" method="post" autocomplete="off">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="f_name">First Name</label>
                                    <input type="text" name="f_name" id="f_name" class="form-control" required
                                    value="<?php echo isset($f_name) ? $f_name : '' ?>">
                                </div>
                                <div class="form-group">
                                    <label for="l_name">Last Name</label>
                                    <input type="text" name="l_name" id="l_name" class="form-control" required
                                    value="<?php echo isset($l_name) ? $l_name : '' ?>">
                                </div>
                                 <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" id="email" class="form-control" required
                                     value="<?php echo isset($email) ? $email : '' ?>">
                                      <p class="text-danger"><?php echo isset($error['email']) ? $error['email'] : '' ?></p>
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" name="password" id="password" class="form-control" required 
                                     value="<?php echo isset($password) ? $password : '' ?>">
                                    <p class="text-danger"><?php echo isset($error['password']) ? $error['password'] : ''?></p>
                                </div>
                                <div class="form-group">
                                    <label for="confirm-password">Confirm Password</label>
                                    <input type="password" name="confirm-password" id="confirm-password" class="form-control" required value="<?php echo isset($confirmpass) ? $confirmpass : '' ?>">
                                    <p class="text-danger"><?php echo isset($error['confirmpass']) ? $error['confirmpass'] : '' ?></p>
                                </div>

                            </div>

                            <div class="col-sm-6">
                                 <div class="form-group">
                                    <label for="phone">Phone</label>
                                    <input type="number" name="phone" id="phone" class="form-control" required 
                                    value="<?php echo isset($phone) ? $phone : '' ;?>">
                                    <p class="text-danger"><?php echo isset($error['phone']) ? $error['phone'] : '' ?></p>
                                </div>
                                <div class="form-group">
                                    <label for="city">City</label>
                                    <input type="text" name="city" id="city" class="form-control"
                                    value="<?php echo isset($city) ? $city : '' ?>">
                                </div>
                                <div class="form-group">
                                    <label for="street">Street</label>
                                    <input type="text" name="street" id="street" class="form-control"
                                    value="<?php echo isset($street) ? $street : '' ?>">
                                </div>
                                <div class="form-group">
                                    <label for="postal_code">Postal Code</label>
                                    <input type="text" name="postal_code" id="postal_code" class="form-control"
                                    value="<?php echo isset($postal_code) ? $postal_code : '' ?>">
                                </div>
                                <div>
                                    <strong>
                                        <p><span class="text-danger">*</span> 
                                            Please note the e-tickets will be sent to the email address you provide
                                        </p>
                                         <p><span class="text-danger">*</span>
                                            Provide authentic email
                                         </p>  
                                    </strong>
                                </div>
                            </div>
                        </div>
                        <input type="submit" name="register-submit" value="Proceed" class="btn btn-success btn-block">
                    </form>

                </div>

            </div>


        </div>
        <!-- /col-md-9-->

        <!-- Sidebar Widgets Column -->
        <div class="col-md-3">
            <!--advert panel-->
            <?php include 'includes/widgets/advert.php'; ?>

        </div>


    </div>
    <!-- /.row -->

    <hr>

    <script>
        $(document).on('keyup', '.quantity', function() { 
            var event_id = $(this).attr("event_id");
            var cat_id = $(this).attr("cat_id");
            var quantity = $(this).val();

            if (quantity != '') {
                $.ajax({
                    url: 'change.seatsquantity.ajax.php',
                    method: 'POST',
                    data: {event_id:event_id, cat_id:cat_id, quantity:quantity},
                    success:function(data) {
                        window.open('checkout.php', '_self');
                    }
                });
            }
        });
    </script>


    <!-- Footer -->
<?php include "includes/footer.php";


