<?php  

 if (isset($_GET['edit_customer'])) {

    $edit_id  = $_GET['edit_customer'];
    $get_customer     = "SELECT * FROM customers WHERE cust_id = '$edit_id'";
    $run_customer     = mysqli_query($conn, $get_customer);
    $row_customer     = mysqli_fetch_array($run_customer);

    $customer_id      = $row_customer['cust_id'];
    $f_name      = $row_customer['cust_f_name'];
    $l_name      = $row_customer['cust_l_name'];
    $email       = $row_customer['cust_email'];
    $password    = $row_customer['cust_password'];
    $phone       = $row_customer['cust_phone'];
    $city        = $row_customer['cust_city'];
    $street      = $row_customer['cust_street'];
    $postal_code = $row_customer['cust_postal_code'];

 }
 
 ?>


 <div class="row">
    <div class="col-lg-12 content-header">
        <h1>Customers</h1>
        <ol class="breadcrumb">
            <li><a href="index.php?dashboard"><i class="fa fa-fw fa-dashboard"></i> Dashboard </a></li>
            <li class="active">Customers</li>
        </ol>
    </div>
</div>



<div class="row">
    <div class="col-lg-12">

        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <i class="fa fa-money"></i> Edit Customer
                </h3>
            </div>

            <div class="panel-body">

                <form action="" method="post" autocomplete="off" class="form-horizontal">

                    <div class="form-group">
                        <label for="f_name" class="col-md-3 control-label">First Name</label>
                        <div class="col-md-6">
                            <input type="text" name="f_name" id="f_name" class="form-control" required
                        value="<?php echo isset($f_name) ? $f_name : ''; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="l_name" class="col-md-3 control-label">Last Name</label>
                        <div class="col-md-6">
                            <input type="text" name="l_name" id="l_name" class="form-control" required
                        value="<?php echo isset($l_name) ? $l_name : ''; ?>">
                        </div>
                    </div>
                     <div class="form-group">
                        <label for="email" class="col-md-3 control-label">Email</label>
                        <div class="col-md-6">
                            <input type="email" name="email" id="email" class="form-control" required
                         value="<?php echo isset($email) ? $email : ''; ?>">
                        </div>
                    </div>
                    
                     <div class="form-group">
                        <label for="phone" class="col-md-3 control-label">Phone</label>
                        <div class="col-md-6">
                            <input type="number" name="phone" id="phone" class="form-control" required 
                        value="<?php echo isset($phone) ? $phone : '' ;?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="city" class="col-md-3 control-label">City</label>
                        <div class="col-md-6">
                            <input type="text" name="city" id="city" class="form-control"
                        value="<?php echo isset($city) ? $city : ''; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="street" class="col-md-3 control-label">Street</label>
                        <div class="col-md-6">
                            <input type="text" name="street" id="street" class="form-control"
                        value="<?php echo isset($street) ? $street : ''; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="postal_code" class="col-md-3 control-label">Postal Code</label>
                        <div class="col-md-6">
                            <input type="text" name="postal_code" id="postal_code" class="form-control"
                        value="<?php echo isset($postal_code) ? $postal_code : ''; ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="update" class="col-md-3 control-label"></label>
                        <div class="col-md-6">
                            <input type="submit" name="update" id="update" value="Update" class="btn btn-primary form-control">
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>


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
    
    
 	$update_customer  = "UPDATE customers SET cust_email='$email', cust_f_name='$f_name', cust_l_name='$l_name', cust_phone={$phone}, cust_city='{$city}', cust_street='{$street}', cust_postal_code=$postal_code  WHERE cust_id = $edit_id";
 	$run_customer     = mysqli_query($conn, $update_customer);
 	confirm($run_customer);

 	if ($run_customer) 

         echo "<script>
                    Swal.fire({
                        type: 'success',
                        title: 'Customer account updtated successfully',
                        showConfirmButton: true,
                        confirmButtonText: 'Close',
                        closeOnConfirm: false
                        }).then((result) => {
                           if (result.value) {
                               window.location = 'index.php?view_customers'
                           }
                        });

                </script>";
 	}



 ?>