<center> <!-- Center Starts -->
	<h1>My Orders</h1>
	<p class="lead">
		 Your orders on one place
	</p>
	<p class="text-muted">
		If you have any question, please free to contact us, our customer service center is working 24/7
	</p>
</center> <!-- Center Ends -->

<hr>

<div class="table-responsive">
	<table class="table table-hover table-striped">
		<thead>
			<tr>
				<th>Order No</th>
				<th>Date</th>
				<th>Details</th>
				<th>Amount</th>
				<th>Method</th>
				<th>Status</th>
			</tr>
		</thead>

		<tbody>

			<?php 
			 $customer_session = $_SESSION['email'];
			 $get_customer     = "SELECT * FROM customers WHERE cust_email = '$customer_session'";
			 $run_customer     = mysqli_query($conn, $get_customer);
			 $row_customer     = mysqli_fetch_array($run_customer);

			 $customer_id      = $row_customer ['cust_id'];
			 $get_orders       = "SELECT * FROM order_details WHERE customer_id = $customer_id";
			 $run_orders       = mysqli_query($conn, $get_orders);
			 confirm( $run_orders );

			 
			 while($row_orders     = mysqli_fetch_array($run_orders)) {

			 	$order_no    = $row_orders['order_no'];
			 	$order_date        = $row_orders['order_date'];
			 	$booked_seats= $row_orders['booked_seats'];
			 	$category_id = $row_orders['category_id'];
			 	$event_id    = $row_orders['event_id'];
			 	$amount       = $row_orders['amount'];
			 	$method      = $row_orders['method'];
			 	$status      = $row_orders['status'];

			 	$order_date = strtotime($order_date);
                $formated_date = strftime("%d %b, %Y  %H:%M", $order_date);

			 	$get_event   = "SELECT * FROM events WHERE event_id = $event_id";
			 	$run_event   = mysqli_query($conn, $get_event);
			 	$row_event   = mysqli_fetch_array($run_event);
			 	$event_name  = $row_event['event_name'];

			 	$get_category = "SELECT * FROM categories WHERE cat_id = $category_id";
			 	$run_category = mysqli_query($conn, $get_category);
			 	$row_category = mysqli_fetch_array($run_category);
			 	$category_name = $row_category['cat_name'];


			 ?>
			<tr>
				<td><?php echo $order_no ; ?></td>
				<td><?php echo $formated_date; ?></td>
				<td>
					<strong><?php echo $event_name; ?></strong>
					<p><?php echo $booked_seats; ?> x <?php echo $category_name; ?></p>	
				</td>
				<td>Ksh. <?php echo $amount; ?></td>
				<td><?php echo $method ; ?></td>
				<td><?php echo $status ; ?></td>
			</tr>
			<?php } ?>

		</tbody>
	</table>
</div>