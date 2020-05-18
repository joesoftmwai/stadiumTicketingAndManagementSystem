<h3 align="center">Change Password</h3>

<form action="" method="post">
	<div class="form-group">
		<label for="">Enter Your Current Password</label>
		<input type="password" name="old_pass" class="form-control" required>
	</div>

	<div class="form-group">
		<label for="">Enter Your New Password</label>
		<input type="password" name="new_pass" class="form-control" required>
	</div>

	<div class="form-group">
		<label for="">Enter Your New Password Again</label>
		<input type="password" name="new_pass_again" class="form-control" required>
	</div>

	<div class="text-center">
		<button type="submit" class="btn btn-info" name="submit"><i class="fa fa-user"></i> Change Password</button>
	</div>
</form>

<?php 

 if (isset($_POST['submit'])) {


 	$c_email  = $_SESSION['email'];
 	$old_pass = $_POST['old_pass'];
 	$new_pass = $_POST['new_pass'];
 	$new_pass_again = $_POST['new_pass_again'];
 	$new_pass = password_hash($new_pass, PASSWORD_BCRYPT, array('cost' => 05));


 	$sel_old_pass  = "SELECT * FROM customers WHERE cust_email = '$c_email'";
 	$run_old_pass  = mysqli_query($conn, $sel_old_pass);
 	$row_old_pass = mysqli_fetch_array($run_old_pass);
 	$db_pass = $row_old_pass['cust_password'];

 	if (!password_verify($old_pass, $db_pass)) {
 		echo "<script>alert('Your current password in not valid try again')</script>";
 		exit();
 	}

 	// if ($new_pass != $new_pass_again) {
 	// 	echo "<script>alert('Your New password does not match try again')</script>";
 	// 	exit();
 	// } 

 	$update_pass = "UPDATE customers SET cust_password = '$new_pass' WHERE cust_email='$c_email'";
 	$run_pass    = mysqli_query($conn, $update_pass);
 	confirm($run_pass);

 	if ($run_pass) {
 		echo "<script>alert('Your password has been changed successfully')</script>";
 		echo "<script>window.open('my_account.php?my_orders', '_self')</script>";
 	}
 }
 ?>