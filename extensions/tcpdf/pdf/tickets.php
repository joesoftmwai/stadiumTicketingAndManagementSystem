<?php

include '../../../includes/db.php';
include '../../../includes/functions.php';

 if (isset($_GET['order'])) {
 	$order_no  = $_GET['order'];

 	$get_order = "SELECT * FROM order_details WHERE order_no = '$order_no'";
 	$run_order = mysqli_query($conn, $get_order);

 	$row_order = mysqli_fetch_array($run_order);
 	$order_id  = $row_order['id'];
    $order_no      =$row_order['order_no'];
    $customer_id   =$row_order['customer_id'];
    $category_id   =$row_order['category_id'];
    $event_id      =$row_order['event_id'];
    $booked_seats  =$row_order['booked_seats'];
    $total         =$row_order['total'];
    $order_date    =$row_order['order_date'];
    $status        =$row_order['status'];

    $get_event   = "SELECT * FROM events WHERE event_id = $event_id";
    $run_event   = mysqli_query($conn, $get_event);
    $row_event   = mysqli_fetch_array($run_event);
    $event_name   = $row_event['event_name'];
    $event_extras = $row_event['event_extras'];
    $event_venue  = $row_event['event_venue'];
    $event_date   = $row_event['event_date'];
    

    $get_category = "SELECT * FROM categories WHERE cat_id = $category_id";
    $run_category = mysqli_query($conn, $get_category);
    $row_category = mysqli_fetch_array($run_category);
    $cat_name   =   $row_category['cat_name']; 

    $get_customer   = "SELECT * FROM customers WHERE cust_id = $customer_id";
    $run_customer   = mysqli_query($conn, $get_customer);
    $row_customer   = mysqli_fetch_array($run_customer);
    $customer_email = $row_customer['cust_email'];
    $customer_name  = $row_customer['cust_f_name'].' '.$row_customer['cust_l_name'];

    $date   = substr($row_event['event_date'], 0,10);

    $event_date = strtotime($event_date);
    $formated_date = strftime("%d %B, %Y", $event_date);

    $Kick_off = substr($row_event['event_date'], 11,8);
    $time = strtotime($Kick_off) - strtotime('03:00:00');
    $gates_open = strftime("%H:%M:%S", $time);

    

 }

// Include the main TCPDF library (search for installation path).
require_once('tcpdf_include.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// ---------------------------------------------------------

// set default font subsetting mode
$pdf->setFontSubsetting(true);

// Set font
// dejavusans is a UTF-8 Unicode font, if you only need to
// print standard ASCII chars, you can use core fonts like
// helvetica or times to reduce file size.
$pdf->SetFont('dejavusans', '', 11, '', true);

// Add a page
// This method has several options, check the source code documentation for more information.
$pdf->AddPage('P', 'A5');

// set text shadow effect
$pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));

// Set some content to print

// ---------------------------------------------------------------------------------------
$bloque1 = <<<EOF

 <table style="padding: 5px 10px">
	<tr>
	  <td style="width:230px; height: 40px; font-size: 22px;">ticketInn.net</td>
	  <td style="width:160px; height: 40px; font-size: 10px: text-align:right; line-height: 30px; color: orange;  ">
	  	ORDER #$order_no
	  	</td>
	 </tr>
 </table>
 <hr>

EOF;

$pdf->writeHTML($bloque1, false, false, false, false, '');
// -----------------------------------------------------------------------------------------

// -----------------------------------------------------------------------------------------
$bloque2 = <<<EOF

 <table style="padding: 5px">
	<tr>
	<td style="width:375px; height: 70px;">
	 	<span style="font-size: 14px;">$event_extras</span>
	 	<br>
	 	<span style="font-size: 14px;">$event_name</span>
	 	<br>
	 	<span style="font-size: 14px;">$event_venue</span>
	</td>
	</tr>
	<tr>
	<td style="width: 135px;">
	 	<span style="line-height: 18px;">Date</span>
	 	<br>
	 	<span style="line-height: 18px;">$formated_date</span>
	</td>
	<td style="border-left: 1px solid black; width: 110px;">
	 	<span style="line-height: 18px;">Kick-off time</span>
	 	<br>
	 	<span style="line-height: 18px;">$Kick_off</span>
	</td>
	<td style="border-left: 1px solid black;">
	 	<span style="line-height: 18px;">Gates Open</span>
	 	<br>
	 	<span style="line-height: 18px;">$gates_open</span>
	</td>
	</tr>
	<tr><td></td></tr>
 </table>

EOF;

$pdf->writeHTML($bloque2, false, false, false, false, '');
// -----------------------------------------------------------------------------------------

// -----------------------------------------------------------------------------------------

// -----------------------------------------------------------------------------------------
$bloque3 = <<<EOF

 <table style="padding: 5px">
	<tr>
	<td style="width:375px; height: 100px;text-align: center;">
		<img src="images/qr-code.png" alt="" width="100" height="100" style="border: 1px solid #666;">
	</td>
	</tr>
 </table>

EOF;

$pdf->writeHTML($bloque3, false, false, false, false, '');
// -----------------------------------------------------------------------------------------

// -----------------------------------------------------------------------------------------
$bloque4 = <<<EOF

 <table style="padding: 5px">
	<tr>
	<td style="width:230px; height: 40px; font-size: 9px;">
	  <br>
	  <span>TICKET HOLDER</span>
	  <br>
	  <span style="line-height: 18px;  font-size: 12px;">- $customer_name</span>
	</td>
	<td style="width:160px; height: 40px; font-size: 9px: text-align:right;">
	<br>
	  <span>ORDER</span>
	  <br>
	  <span style="line-height: 18px; font-size: 12px;">#$order_no</span>
	</td>
	</tr>
	<tr>
	<td>
	  <span>Category</span>
	  <br>
	  <span style="line-height: 18px;font-size: 12px;">- $cat_name</span>
	</td>
	</tr>
	<tr><td></td></tr>
 </table>

EOF;

$pdf->writeHTML($bloque4, false, false, false, false, '');
// -----------------------------------------------------------------------------------------

$bloque5 = <<<EOF

 <table style="padding: 5px">
	<tr>
	<td style="wwidth:375px; height: 100px;">
	  <br>
	  <span style="font-weight:bold; line-height: 18px;">Terms and condition for the ticket holder</span>
	  <br>
	  <span>The Qrcode (2 dimensional barcode ), reference code are</span>
	  <br>
	  <span>secret. You understand that you the ticket owner/ buyer</span>
	  <br>
	  <span> hold sole responsibility for the confidentiality.</span>
	</td>
	</tr>
 </table>

EOF;

$pdf->writeHTML($bloque5, false, false, false, false, '');
// -----------------------------------------------------------------------------------------




// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$pdf->Output('ticket.pdf', 'I');


//============================================================+
// END OF FILE
//============================================================+
  ?>
 