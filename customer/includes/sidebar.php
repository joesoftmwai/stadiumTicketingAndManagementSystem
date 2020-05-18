<div class="panel panel-default sidebar-menu">
	<div class="panel-heading">

		<?php 
		 $customer_session = $_SESSION['email'];
		 $get_customer = "SELECT * FROM customers WHERE cust_email = '$customer_session'";
		 $run_customer = mysqli_query($conn, $get_customer);
		 $row_customer = mysqli_fetch_array($run_customer);

		 $customer_id    = $row_customer['cust_id'];
		 $customer_name  = $row_customer['cust_f_name'] .' '. $row_customer['cust_l_name'];

		 echo '

			<br>
			<h3 class="panel-title">Name: '. $customer_name .'</h3>
		 ';

		 ?>

	</div>
	<div class="panel-body">
		<ul class="nav nav-pills nav-stacked">
			<li class="<?php if(isset($_GET['my_orders'])) { echo 'active'; }  ?>">
				<a href="my_account.php?my_orders"> <i class="fa fa-list"></i> My Orders</a>
			</li>
			<li class="<?php if(isset($_GET['review_rate'])) { echo 'active'; }  ?>">
				<a href="my_account.php?review_rate"> <i class="fa fa-star"></i> Review & Rate</a>
			</li>
			<li class="<?php if(isset($_GET['edit_account'])) { echo 'active'; }  ?>">
				<a href="my_account.php?edit_account"><i class="fa fa-edit"></i> Edit Account</a>
			</li>
			<li class="<?php if(isset($_GET['change_pass'])) { echo 'active'; }  ?>">
				<a href="my_account.php?change_pass"><i class="fa fa-key"></i> Change Password</a>
			</li>
			<li class="<?php if(isset($_GET['delete_account'])) { echo 'active'; }  ?>">
				<a href="my_account.php?delete_account"><i class="fa fa-trash"></i> Delete Account</a>
			</li>
			<li>
				<a href="../logout.php"><i class="fa fa-sign-out"></i> Logout</a>
			</li>
		</ul>
	</div>

</div>

