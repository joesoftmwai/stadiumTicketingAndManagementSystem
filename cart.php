
<?php include "includes/header.php"; ?>
    <!-- Navigation -->
<?php include "includes/navigation.php"; ?>


    <!-- Page Content -->
    <div class="container">
    <div class="row">
       	<!-- <div class="col-md-12">
			<ul class="breadcrumb">
				<li>
					<a href="index.php">Home</a>
				</li>
				<li>Cart</li>
			</ul>
		</div> -->
        <div class="col-md-10 col-md-offset-1">
        	<div class="box" id="cart">

				<form action="cart.php" method="post" enctype="multipart-form-data">

					<h1>Shopping Cart</h1>

					<?php 

					$ip_add = getRealUserIp();

					$select_cart = "SELECT * FROM cart WHERE ip_add = '$ip_add'";
					$run_cart = mysqli_query($conn, $select_cart);

					$count = mysqli_num_rows($run_cart);

					 ?>

					<p class="text-muted">You currently have <?php echo $count ?> item(s) in your cart</p>

					<div class="table-responsive">
						 <table class="table">
						 	<thead>
						 		<tr>
						 			<th colspan="2">Product Name</th>
						 			<th>Quantity</th>
						 			<th>Unit Price</th>
						 			<th>Fee</th>
						 			<th colspan="1">Delete</th>
						 			<th colspan="2">Sub total</th>
						 		</tr>
						 	</thead>

						 	<tbody>

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
				                    $event_image  = $row_event['event_image'];
				                    $event_url  = $row_event['event_url'];


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


				                 ?>    

						 		<tr>
						 			<td>
						 				<a href="<?php echo $event_url; ?>">
						 					<img src="<?php echo $site_url ?>/admin/images/event_files/<?php echo $event_image; ?>" alt="" class="img-responsive">
						 				</a>
						 			</td>
						 			<td>
						 				<a href="<?php echo $event_url; ?>">
						 					<?php echo $event_name; ?>
						 				</a>
						 				<p class="text-muted">-Select: <?php echo $cat_name; ?></p>	
						 			</td>
						 			
						 			<td>
						 				<input type="text" name="quantity" value="<?php echo $seats_qty; ?>" event_id="<?php echo $event_id; ?>" cat_id="<?php echo $cat_id;?>" class="quantity form-control">
						 				
						 			</td>
						 			<td>
						 				Ksh <?php echo $cat_price; ?>
						 			</td>
						 			<td>
						 				Ksh <?php echo $cat_fee; ?>
						 			</td>
						 			<td>
						 				<input type="checkbox" name="remove[]" value="<?php echo $cat_id; ?>">
						 			</td>
						 			<td>
						 				Ksh <?php echo $subtotal; ?>
						 			</td>
						 		</tr>

						 		<?php } ?>
						 	
						 	</tbody>

						 	<tfoot>
						 		<tr>
						 			<th colspan="5">Total</th>
						 			<th colspan="2">Ksh <?php echo $total; ?></th>
						 		</tr>
						 	</tfoot>
						 </table>
					</div>

					<div class="box-footer">
						<div class="pull-left">
							<a href="index.php" class="btn btn-default">
								<i class="fa fa-chevron-left"></i> Continue Shopping
							</a>
						</div>

						<div class="pull-right">
							<button type="submit" name="update" class="btn btn-default"><i class="fa fa-undo"></i> Update Cart</button>

							<?php 

							 if (!isset($_SESSION['email'])) {
							 	echo '<a href="checkout.php" class="btn btn-primary">Proceed to checkout <i class="fa fa-chevron-right"></i></a>';
							 } else {
							 	echo '<a href="checkout-payement.php" class="btn btn-primary">Proceed to checkout <i class="fa fa-chevron-right"></i></a>';
							 }

							 ?>

						</div>
					</div>
				</form>
			</div>
        </div>
        <!-- /col-md-9-->


    	<?php 
		 function update_cart() {
		 	global $conn;

		 	if (isset($_POST['update'])) {

		 		foreach($_POST['remove'] as $cat_id) {
		 			$delete_product = "DELETE FROM cart WHERE cat_id=$cat_id";
		 			$run_delete  = mysqli_query($conn, $delete_product);

		 			if ($run_delete) {
		 				redirect("cart.php");
		 			} 
		 		}
		 	}
		 }

		  echo @$up_cart = update_cart();
		 ?>



    </div>
    <!-- /.row -->

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
						window.open('cart.php', '_self');
					}
				});
			}
    	});
    </script>

    <!-- Footer -->

<?php include "includes/footer.php";




