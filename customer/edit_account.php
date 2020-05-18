<?php  

 $customer_session = $_SESSION['email'];
 $get_customer     = "SELECT * FROM customers WHERE cust_email = '$customer_session'";
 $run_customer     = mysqli_query($conn, $get_customer);
 $row_customer     = mysqli_fetch_array($run_customer);

 $customer_id      = $row_customer['cust_id'];
 $f_name      = $row_customer['cust_f_name'];
 $l_name      = $row_customer['cust_l_name'];
 $email       = $row_customer['cust_email'];
 $phone       = $row_customer['cust_phone'];
 $city        = $row_customer['cust_city'];
 $street      = $row_customer['cust_street'];
 $postal_code = $row_customer['cust_postal_code'];
 

 ?>


<h3 align="center">
  Edit Your Account	
</h3>


<form action="" method="post" autocomplete="off">

    <div class="form-group">
        <label for="f_name">First Name</label>
        <input type="text" name="f_name" id="f_name" class="form-control" required
        value="<?php echo $f_name; ?>">
    </div>
    <div class="form-group">
        <label for="l_name">Last Name</label>
        <input type="text" name="l_name" id="l_name" class="form-control" required
        value="<?php echo $l_name; ?>">
    </div>
     <div class="form-group">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" class="form-control" required
         value="<?php echo $email; ?>">
    </div>
     <div class="form-group">
        <label for="phone">Phone</label>
        <input type="number" name="phone" id="phone" class="form-control" required 
        value="<?php echo $phone;?>">
    </div>
    <div class="form-group">
        <label for="city">City</label>
        <input type="text" name="city" id="city" class="form-control"
        value="<?php echo $city; ?>">
    </div>
    <div class="form-group">
        <label for="street">Street</label>
        <input type="text" name="street" id="street" class="form-control"
        value="<?php echo $street; ?>">
    </div>
    <div class="form-group">
        <label for="postal_code">Postal Code</label>
        <input type="text" name="postal_code" id="postal_code" class="form-control"
        value="<?php echo $postal_code; ?>">
    </div>

	<div class="text-center">
		<button type="submit" name="update" class="btn btn-info"><i class="fa fa-user-md"></i>
			Update Now
		</button>
	</div>
</form>


<?php 
 
 if (isset($_POST['update'])) {
 	$update_id  = $customer_id;
	$f_name 	= escape($_POST['f_name']);
	$l_name 	= escape($_POST['l_name']);
	$email 		= escape($_POST['email']);
	$phone 		= escape($_POST['phone']);
	$city 		= escape($_POST['city']);
	$street 	= escape($_POST['street']);
	$postal_code = escape($_POST['postal_code']);


 	$update_customer  = "UPDATE customers SET cust_email='$email', cust_f_name='$f_name', cust_l_name='$l_name', cust_phone={$phone}, cust_city='{$city}', cust_street='{$street}', cust_postal_code=$postal_code  WHERE cust_id = $update_id ";
 	$run_customer     = mysqli_query($conn, $update_customer);
 	confirm($run_customer);

 	if ($run_customer) {
 		echo "<script>alert('Your account has been updtated, plaese  login again')</script>";
 		echo "<script>window.open('../logout.php', '_self')</script>";
 	}


 }


 ?>