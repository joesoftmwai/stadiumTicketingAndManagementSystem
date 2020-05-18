<?php 
 session_start();
 include 'includes/db.php';
 include 'includes/functions.php';
 ?>

 <?php 

  $ip_add = getRealUserIp();

  if (isset($_POST['event_id']) && isset($_POST['cat_id'])) {
  	$event_id = $_POST['event_id'];
  	$cat_id = $_POST['cat_id'];
  	$quantity = $_POST['quantity'];

  	$change_qty = "UPDATE cart SET qty = '$quantity' WHERE event_id = '$event_id' AND cat_id='$cat_id' AND ip_add = '$ip_add'";
  	$run_cahnge_qty = mysqli_query($conn, $change_qty);
  }

  ?>