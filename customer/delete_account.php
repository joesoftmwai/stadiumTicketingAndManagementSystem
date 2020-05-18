
<center>
	<h3>Do You Really Want To delete Your account</h3>
	<form action="" method="post">
		<button class="btn btn-danger" type="submit" name="yes">
			Yes I want to delete
		</button>

		<button class="btn btn-primary" type="submit" name="no">
			No, I do not want to delete
		</button>
	</form>
</center>

<?php 
 $c_email = $_SESSION['email'];
 if (isset($_POST['yes'])) {
 	$delete_customer   = "DELETE FROM customers WHERE cust_email='$c_email '";
 	$run_delete        = mysqli_query($conn, $delete_customer);

 	if ($run_delete) {
 		session_destroy();
 		echo "<script>alert('Your account has been deleted! Good Bye')</script>";
 		echo "<script>window.open('../index.php', '_self')</script>";
 	}
 }

 if (isset($_POST['no'])) {
 	echo "<script>window.open('my_account.php?my_orders', '_self')</script>";
 
 }
 ?>