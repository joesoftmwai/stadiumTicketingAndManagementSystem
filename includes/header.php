<?php include "db.php"; ?>
<?php include "functions.php"; ?>
<?php
    session_start();
    ob_start();

    


    $get_general_settings = "SELECT * FROM general_settings";
    $run_general_settings = mysqli_query($conn, $get_general_settings);
    $row_general_settings = mysqli_fetch_array($run_general_settings);

    $site_title     = $row_general_settings['site_title'];
    $site_desc      = $row_general_settings['site_desc'];
    $site_url       = $row_general_settings['site_url'];
    $site_author    = $row_general_settings['site_author'];

 
   
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="author" content="<?php echo $site_author; ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo $site_title; ?></title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo $site_url; ?>/css/bootstrap.min.css" rel="stylesheet">

    

    <!-- Custom CSS -->
    <link href="<?php echo $site_url; ?>/css/styles.css" rel="stylesheet">


    <!-- Font awesome master -->
    <!-- Font awesome CDN -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <!-- Font awesome local -->
    <!-- <link rel="stylesheet" href="<?php //echo $site_url; ?>/font-awesome/css/font-awesome.min.css">  -->

    <!-- Font-awesome-stars -->
    <link rel="stylesheet" href="<?php echo $site_url; ?>/css/fontawesome-stars.css">

    <!-- Font awesome CDN -->
    <!--<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">-->

    <!-- jQuery -->
     <script src="<?php  echo $site_url; ?>/js/jquery.js"></script> 
     
    <!-- jquery bar rating -->
    <script src="<?php echo $site_url; ?>/js/jquery.barrating.min.js"></script>

    <!-- Stripe  -->
    <!-- <script src="https://checkout.stripe.com/checkout.js"></script>
 -->
    <!--Sweet alert 2 js-->
    <script src="<?php echo $site_url; ?>/js/sweetalert2.js"></script>

</head>

<body>

<!-- pre-loading goes here-->
<div class="loader">
    <p class="status">loading...</p>
</div>

<div id="top"><!-- top Starts -->
    <div class="container">

    <div class="row">
    <div class="col-md-6 offer">
        <a href="#" class="pull-left link d-lg-block d-md-block d-none btn btn-success btn-xs" >
            <?php
              if (!isset($_SESSION['email'])) {
                echo "Welcome: Guest";
              } else {
                echo "Welcome: ".$_SESSION['email']."";
              }
             ?>
        </a>


    </div>

    <div class="col-md-6">
        <ul class="menu pull-right top-ul">
            <li>
                <a href="<?php echo $site_url; ?>/cart.php" class="btn btn-success btn-xs">
                   <i class="fa fa-shopping-cart"></i> Go To Cart
                </a>
            </li>
            <li>
                <?php
                  if (!isset($_SESSION['email'])) {
                    echo '
                        <a href="#" data-toggle="modal" data-target="#login_modal" class="btn btn-info btn-xs"><i class="fa fa-sign-in"></i> Login</a> <li>
                        <a class="btn btn-primary btn-xs" href="#" data-toggle="modal" data-target="#register_modal"><i class="fa fa-edit"></i> Register</a></li>';
                  } else {
                    echo '
                        <a href="'.$site_url.'/customer/my_account.php?my_orders" class="btn btn-info btn-xs"><i class="fa fa-envelope"></i> My Account</a><li></li>
                        <a href="'.$site_url.'/logout.php" class="btn btn-primary btn-xs"><i class="fa fa-sign-out"></i> Logout</a>
                        ';
                  }
                 ?>
            </li>
        </ul>
    </div>
    </div>

    </div>
</div><!-- top Ends -->


<!--user_modals(login, register, forgot) modals-->
<?php include "user_modals(login, register,forgot).php";?>