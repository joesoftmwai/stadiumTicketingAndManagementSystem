<?php include "db.php"; ?>
<?php

function redirect($new_location) {
    header("Location:".$new_location);
    exit;
}

function confirm($results) {
    global $conn;
    if (!$results) {
        die("QUERY FAILED".mysqli_error($conn));
    }


}

function escape($string) {
    global $conn;
    return mysqli_real_escape_string($conn, $string);
}


function email_exists($email="") {
 	global $conn;
 	$sql = "SELECT cust_email FROM customers WHERE cust_email ='$email'";
 	$exec = mysqli_query($conn, $sql);

 	if (mysqli_num_rows($exec) > 0) {
 		return true;
 	} else {
 		return false;
 	}
 }

  function items() {
    global $conn;

    $ip_add = getRealUserIp();

    $get_items = "SELECT * FROM cart WHERE ip_add = '$ip_add' ";
    $run_items = mysqli_query($conn, $get_items);

    $count_items =  mysqli_num_rows($run_items);

    echo $count_items;
 }




function register_customer($fname, $lname, $email, $password, $phone, $city, $street, $postal_code) {
	global $conn;

	$f_name 	= escape($_POST['f_name']);
	$l_name 	= escape($_POST['l_name']);
	$email 		= escape($_POST['email']);
	$password 	= escape($_POST['password']);
	$phone 		= escape($_POST['phone']);
	$city 		= escape($_POST['city']);
	$street 	= escape($_POST['street']);
	$postal_code = escape($_POST['postal_code']);
	$password 	= password_hash($password, PASSWORD_BCRYPT, array('cost' => 05));
    $cust_ip    = getRealUserIp();


    $_SESSION['email'] = $email;

	$sql = "INSERT INTO customers (cust_f_name, cust_l_name, cust_email, cust_password, 
	        cust_phone, cust_city, cust_street, cust_postal_code, cust_ip) 
	     VALUES ('{$f_name}', '{$l_name}', '{$email}', '{$password}', 
	         {$phone}, '{$city}', '{$street}', '{$postal_code}', '{cust_ip}')";
	$exec = mysqli_query($conn, $sql);
	confirm($exec);

    if ($exec) {

    echo "<script>
            Swal.fire({
                type: 'success',
                title: 'New Customer Registered successfully',
                showConfirmButton: true,
                confirmButtonText: 'Close',
                closeOnConfirm: false
                }).then((result) => {
                   if (result.value) {
                       window.location = 'checkout-payement.php'
                   }
                });

        </script>";

    } else {

    echo "<script>
                Swal.fire({
                    type: 'error',
                    title: 'Error occurred while processing your request',
                    text:  'Please fix the errors and try again',
                    showConfirmButton: true,
                    confirmButtonText: 'Close',
                    closeOnConfirm: false
                    }).then((result) => {
                       if (result.value) {
                           window.location = 'index.php'
                       }
                    });

            </script>";
    }

	

}


function login_customer($email, $password) {
	global $conn;

    $cat_items = items();

	$email    = trim(escape($_POST['signin-email']));
    $password = trim(escape($_POST['signin-password']));
    $eventId = 1;

    $sql  = "SELECT * FROM customers WHERE cust_email = '{$email}'";
    $exec = mysqli_query($conn, $sql);
    confirm($exec);

    while($rows = mysqli_fetch_array($exec)) {
    	$db_f_name   = $rows['cust_f_name'];
    	$db_email	 = $rows['cust_email'];
    	$db_password = $rows['cust_password'];

    	if(password_verify($password, $db_password)) {
    		$_SESSION['firstname'] = $db_f_name;
    		$_SESSION['email']     = $db_email;

           
            echo "<script>
                Swal.fire({
                    type: 'success',
                    title: 'Login successfully',
                    showConfirmButton: true,
                    confirmButtonText: 'Close',
                    closeOnConfirm: false
                    }).then((result) => {
                       if (result.value) {
                           window.location = 'checkout-payement.php'
                       }
                    });

            </script>";

    		

     	} else {

     		echo "<script>
                    Swal.fire({
                        type: 'error',
                        title: 'Login Failed',
                        text:  'Please ensure your email and password are correct',
                        showConfirmButton: true,
                        confirmButtonText: 'Close',
                        closeOnConfirm: false
                        }).then((result) => {
                           if (result.value) {
                               window.location = 'index.php'
                           }
                        });

                </script>";
     	}
     }
     return true;
}


 function getRealUserIp() {
    global $conn;

    switch (true) {
        case (!empty($_SERVER['HTTP_X_REAL_IP'])): return $_SERVER['HTTP_X_REAL_IP'];
        case (!empty($_SERVER['HTTP_CLIENT_IP'])): return $_SERVER['HTTP_CLIENT_IP'];
        case (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])): return $_SERVER['HTTP_X_FORWARDED_FOR'];
        default: return $_SERVER['REMOTE_ADDR'];
    }
 }



  function add_cart() {
    global $conn;


    if (isset($_POST['submit_order'])) {
        $ip_add   =  getRealUserIp();
        $event_id = $_POST['event_id'];
        $cat_id   = $_POST['cat_id'];
        $seats    = $_POST['no_of_seats'];

        $get_cart = "SELECT * FROM cart WHERE event_id='$event_id' OR cat_id='$cat_id' ";
        $run_cart = mysqli_query($conn, $get_cart);
        $count_cart = mysqli_num_rows($run_cart);

        if ($count_cart > 0) {
           
        } else {

            $sql_order = "INSERT INTO cart(event_id, cat_id, qty, ip_add) VALUES ($event_id, $cat_id, $seats, '$ip_add')";
            $exec_order = mysqli_query($conn, $sql_order);
            confirm($exec_order);

            redirect("checkout.php");

        }

        

        

    }
}


function delete_event() {

    global $conn;
     if (isset($_GET['event_id']) && isset($_GET['cat_id'])) {
    $event_id    = $_GET['event_id'];
    $cat_id      = $_GET['cat_id'];

    $delete_event = "DELETE FROM cart WHERE event_id = $event_id AND cat_id = $cat_id";
    $run_delete   = mysqli_query($conn, $delete_event);

    $check_cart   = "SELECT * FROM cart";
    $run_cart     = mysqli_query($conn, $check_cart);
    $count        = mysqli_num_rows($run_cart);

    if ($count == 0) {
        redirect("index.php");
    } else {
        redirect("checkout.php");
    }
    
 }
}


