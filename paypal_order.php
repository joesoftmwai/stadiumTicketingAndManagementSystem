<?php 
	session_start();
 	include 'includes/db.php';

	if (isset($_GET['customer_id'])) {
 		$customer_id = $_GET['customer_id'];
 		$event_id = $_GET['event_id'];
 		$cat_id = $_GET['cat_id'];
 		$seats_qty = $_GET['seats_qty'];
 		$amount = $_GET['amount'];
 		
 		$_SESSION['customer_id'] = $customer_id;
 		$_SESSION['event_id'] = $event_id;
 		$_SESSION['cat_id'] = $cat_id;
 		$_SESSION['seats_qty'] = $seats_qty;
 		$_SESSION['amount'] = $amount;
 		$_SESSION['method'] = 'paypal';

 		echo "<script>
 			window.open('order.php', '_self')
 		</script>";
 	}
 ?>