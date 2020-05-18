<?php 
	session_start();
 	include 'includes/db.php';

 	include 'stripe_config.php';

 	$customer_session = $_SESSION['email'];
 	//select login customer
	$get_customer = "SELECT * FROM customers WHERE cust_email = '$customer_session'";
	$run_customer = mysqli_query($conn, $get_customer);
	$row_customer = mysqli_fetch_array($run_customer);

	$login_customer_email  = $row_customer['cust_email'];

	// get payment settings
 	$get_payment_settings = "SELECT * FROM payment_settings";
 	$run_payment_settings = mysqli_query($conn, $get_payment_settings);
 	$row_payment_settings = mysqli_fetch_array($run_payment_settings);
 	$stripe_currency_code = $row_payment_settings['stripe_currency_code'];

 	$customer_id = $_POST['customer_id'];
 	$event_id = $_POST['event_id'];
 	$cat_id = $_POST['cat_id'];
 	$seats_qty = $_POST['seats_qty'];
 	$amount = $_POST['amount'];
 	$token = $_POST['stripeToken'];

 	$customer = \Stripe\Customer::create([
	      'email' => $login_customer_email,
	      'card'  => $token,
	  ]);

	  $charge = \Stripe\Charge::create([
	      'customer' => $customer->id,
	      'amount'   => $amount,
	      'currency' => $stripe_currency_code,
	  ]);

	  $_SESSION['customer_id'] = $customer_id;
	  $_SESSION['event_id'] = $event_id;
	  $_SESSION['cat_id'] = $cat_id;
	  $_SESSION['seats_qty'] = $seats_qty;
	  $_SESSION['amount'] = $amount;
	  $_SESSION['method'] = 'stripe';

	  echo "<script>window.open('order.php', '_self')</script>";
 ?>