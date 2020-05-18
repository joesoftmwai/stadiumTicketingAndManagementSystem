<?php

  include("includes/header.php");

  use PHPMailer\PHPMailer\PHPMailer; 
	require 'vendor/autoload.php';
  require 'classes/Config.php';

  $customer_session = $_SESSION['email'];
  //select login customer
  $get_customer = "SELECT * FROM customers WHERE cust_email = '$customer_session'";
  $run_customer = mysqli_query($conn, $get_customer);
  $row_customer = mysqli_fetch_array($run_customer);

  $login_customer_email  = $row_customer['cust_email'];

  // get site settings
  $get_general_settings = "SELECT * FROM general_settings";
  $run_general_settings = mysqli_query($conn, $get_general_settings);
  $row_general_settings = mysqli_fetch_array($run_general_settings);
  $site_url       = $row_general_settings['site_url'];

  if (isset($_SESSION['customer_id'])) {
    $customer_id  = $_SESSION['customer_id'];
    $event_id  = $_SESSION['event_id'];
    $cat_id  = $_SESSION['cat_id'];
    $seats_qty  = $_SESSION['seats_qty'];
    $amount  = $_SESSION['amount'];
    $payment_method = $_SESSION['method'];

    $get_event   = "SELECT * FROM events WHERE event_id = $event_id";
    $run_event   = mysqli_query($conn, $get_event);
    $row_event   = mysqli_fetch_array($run_event);
    $event_name   = $row_event['event_name'];

    $status = 'complete';
    $order_no = mt_rand(); 
    $token = substr(uniqid(true), 9,2);
    $ip_add = getRealUserIp();

    //Insert new order
    $insert_order = "INSERT INTO order_details(order_no, customer_id, category_id, event_id, booked_seats, amount, method, status) VALUES ({$order_no}, {$customer_id}, {$cat_id}, {$event_id}, {$seats_qty}, {$amount}, '$payment_method', '$status')";
    $run_order    = mysqli_query($conn, $insert_order);
    confirm($run_order);

    // send an email after sending order
    $mail = new PHPMailer();

    $mail->isMail();                                            // Set mailer to use SMTP
    $mail->Host = Config::SMTP_HOST;                            // Specify main and backup SMTP servers
    $mail->Username = Config::SMTP_USER;                        // SMTP username
    $mail->Password = Config::SMTP_PASSWORD;                    // SMTP password
    $mail->Port = Config::SMTP_PORT;                            // TCP port to connect to
    $mail->SMTPAuth = true;                                     // Enable SMTP authentication
    $mail->SMTPSecure = 'tls';                                  // Enable TLS encryption, `ssl` also accepted
    $mail->CharSet = 'UTF-8';                                   // Sets the character set
    $mail->isHTML(true);
    //$mail->SMTPDebug = 2;                                     // Enable verbose debug output

    $mail->setFrom("joesoftmwai@gmail.com", "ticketInn");
    $mail->addAddress($login_customer_email);                                  //receives address from the form
    $mail->Subject = "You purchased ticket on ".$event_name .' '.$token;


    $mail->Body    = '
            <html lang="en">
      <head>
        <meta charset="UTF-8">
        <style>

          .mail-body {
            background-color: #eee;
            padding: 30px 15px;
            font-size: 20px;
          }

          .btn-ticket {
            text-decoration: none;
            background-color: #5bc0de;
            padding: 12px;
            color: #fff !important;
            font-size: 23px;
            border-radius: 5px;
          }

          .text-success {
            color: #00a65a;
          }

          .token {
            display: none;
          }

          .container {
            background-color: white;
            padding: 2px;
            margin: 20px;
          }

          
        </style>
      </head>
      <body>
      

      <div class="mail-body">
          <center>
            <div class="container">
              <h2 class="text-success"><span></span>Thank you for purchasing Tickets with us</h2>
              <p>Click the button below to print your ticket</p>
              <br>
              <a href="'.$site_url.'/extensions/tcpdf/pdf/tickets.php?order='.$order_no.'" class="btn-ticket"> Print ticket</a>
              
              <br><br><br>
              <p>Incase of any enquiries feel free to contact us via this link <a href="'.$site_url.'/index.php">contact us</a></p>
              </div>
          </center>
      </div> 

      <span class="token">'.$token.'</span>
      </body>
      </html>
    ';


    if ($mail->send()) {

    	
      echo "<script>
            Swal.fire({
                type: 'success',
                title: 'Ticket purchased successfully',
                text: 'please check your email to download your e-ticket',
                showConfirmButton: true,
                confirmButtonText: 'Close',
                closeOnConfirm: false
                }).then((result) => {
                   if (result.value) {
                       window.location = 'index.php'
                   }
                });

        </script>";


    } else {
    
    	echo "<script>
                Swal.fire({
                    type: 'error',
                    title: 'Error occured while processing your request',
                    text:  'Please contact our customer care, incase an you do not receive an e-ticket',
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


    // insert into payments
    $insert_payment = "INSERT INTO `payements`(`invoice`, `customer_id`, `amount`, `payment_method`) VALUES ('$order_no', '$customer_id','$amount', '$payment_method ')";
    $run_payment = mysqli_query($conn, $insert_payment);


    // update number of seats bought in a particular category
    $update_booked_seats = "UPDATE categories SET cat_booked_seats = cat_booked_seats+$seats_qty WHERE cat_id = $cat_id";
    $run_update = mysqli_query($conn, $update_booked_seats);

    $delete_cart = "DELETE FROM cart WHERE ip_add = '$ip_add'";
    $run_delete  = mysqli_query($conn, $delete_cart);
    confirm($run_delete);

    unset($_SESSION['customer_id']);
    unset($_SESSION['event_id']);
    unset($_SESSION['cat_id']);
    unset($_SESSION['seats_qty']);
    unset($_SESSION['amount']);
    unset($_SESSION['method']);
       

	}


	
  ?>
