<?php 

require_once '../../../controllers/sales.controller.php';
require_once '../../../models/sales.model.php';

require_once '../../../controllers/clients.controller.php';
require_once '../../../models/clients.model.php';

require_once '../../../controllers/users.controller.php';
require_once '../../../models/users.model.php';

require_once '../../../controllers/products.controller.php';
require_once '../../../models/products.model.php';

class printBill {

	public $code;

	public function getBillPrinting() {

		$itemSale = 'code';
		$valueSale = $this->code;

		// bring information of the sale
		$responseSale = SalesController::ctrShowSales($itemSale, $valueSale);

		$code     = $responseSale['code'];
		$date 	  = substr($responseSale['date'], 0, 10);
		$products = json_decode($responseSale['products'], true);
		$netPrice = number_format($responseSale['net_price'], 2);
		$tax 	  = number_format($responseSale['tax'], 2);
		$totalPrice	  = number_format($responseSale['total'], 2);

		// bring information of the client
		$itemClient = 'id';
		$valueClient = $responseSale['client_id'];
		$responseClient = ClientController::ctrShowClients($itemClient, $valueClient);

		$client = $responseClient['name'];

		// bring information of the seller
		$itemSeller = 'id';
		$valueSeller = $responseSale['seller_id'];
		$responseSeller = UserController::ctrShowUsers($itemSeller, $valueSeller);

		$seller = $responseSeller['name'];

	
require_once('tcpdf_include.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// allows multiple pages to be added
$pdf->startPageGroup();

// add a page
$pdf->AddPage();

// set content to print
// ----------------------------------------------------------------------------------------
$bloque1 = <<<EOF
	<table>
		<tr>
		  <td style="width:150px"><img src="images/logo-negro-bloque.png"></td>
		  <td style="background-color: white; width:140px">
		  	<div style="font-size: 9.5px; text-align: right; line-height: 11px;">
			 	<br>
			 	NIT: 71.15942-1
			 	<br>
			 	Adress: Main Sreet, d5 
		  	</div>
		  </td>
		  <td style="background-color: white; width:140px">
		  	<div style="font-size: 9.5px; text-align: right; line-height: 11px;">
			 	<br>
			 	Phone: 0798221939
			 	<br>
			 	sales@inventorysystem.com 
		  	</div>
		  </td>
		  <td style="background-color: white; width:110px; text-align: center; color:orange">
		  <br><br>BILL NO. <br>$code
		  </td>
		</tr>

		<hr>
		<tr><td></td></tr>
		 
	</table>

EOF;

$pdf->writeHTML($bloque1, false, false, false, false, '');

// ----------------------------------------------------------------------------------------

// ----------------------------------------------------------------------------------------
$bloque2 = <<<EOF
	<table style="font-size: 10px; padding: 5px 10px;">
		<tr>
			<td style="border: 1px solid #666; background-color: white; width: 390px">
				Client: $client
			</td>
			<td style="border: 1px solid #666; background-color: white; width: 150px">
				Date: $date
			</td>
		</tr>
		<tr>
			<td style="border: 1px solid #666; background-color: white; width: 540px">
				Seller: $seller
			</td>
		</tr>

		<tr><td></td></tr>
	</table>

EOF;

$pdf->writeHTML($bloque2, false, false, false, false, '');

// ----------------------------------------------------------------------------------------

// ----------------------------------------------------------------------------------------
$bloque3 = <<<EOF
	<table style="font-size: 10px; padding: 5px 10px;">
		<tr>
		<td style="border: 1px solid #666; background-color: white; width: 240px">Product</td>
		<td style="border: 1px solid #666; background-color: white; width: 100px">Quantity</td>
		<td style="border: 1px solid #666; background-color: white; width: 100px">Price</td>
		<td style="border: 1px solid #666; background-color: white; width: 100px">Total</td>
		</tr>
	</table>	
EOF;

$pdf->writeHTML($bloque3, false, false, false, false, '');
// ----------------------------------------------------------------------------------------

// ----------------------------------------------------------------------------------------

// brings the products first

foreach($products as $key => $value) {

	$itemProduct = 'description';
	$itemValue = $value['description'];

	$responseProducts = ProductsController::ctrShowProducts($itemProduct, $itemValue);

	$productName = $value['description'];
	$quantity = $value['quantity'];
	$price = number_format($value['price'], 2);
	$total = number_format($value['total'], 2);


$bloque4 = <<<EOF
	<table style="font-size: 10px; padding: 5px 10px;">
		<tr>
		<td style="border: 1px solid #666; background-color: white; width: 240px">$productName</td>
		<td style="border: 1px solid #666; background-color: white; width: 100px">$quantity</td>
		<td style="border: 1px solid #666; background-color: white; width: 100px">$ $price</td>
		<td style="border: 1px solid #666; background-color: white; width: 100px">$ $total</td>
		</tr> 

	</table>	
EOF;

$pdf->writeHTML($bloque4, false, false, false, false, '');

}

// ----------------------------------------------------------------------------------------

// ----------------------------------------------------------------------------------------
$bloque5 = <<<EOF
	<table style="font-size: 10px; padding: 5px 10px;">
	<tr><td></td></tr>
	<tr>
	<td style="border-right: 1px solid #666; background-color: white; width: 340px"></td>
	<td style="border: 1px solid #666; background-color: white; width: 100px">Net price: </td>
	<td style="border: 1px solid #666; background-color: white; width: 100px">$ $netPrice</td>
	</tr>
	<tr>
	<td style="border-right: 1px solid #666; background-color: white; width: 340px"></td>
	<td style="border: 1px solid #666; background-color: white; width: 100px">Tax: </td>
	<td style="border: 1px solid #666; background-color: white; width: 100px">$ $tax</td>
	</tr>
	<tr>
	<td style="border-right: 1px solid #666; background-color: white; width: 340px"></td>
	<td style="border: 1px solid #666; background-color: white; width: 100px">Total: </td>
	<td style="border: 1px solid #666; background-color: white; width: 100px">$ $totalPrice</td>
	</tr>
	</table>
EOF;

$pdf->writeHTML($bloque5, false, false, false, false, '');
// ----------------------------------------------------------------------------------------



// output 
$pdf->Output('bill.pdf');

	}
 }



$bill = new printBill();
$bill->code=$_GET['code'];
$bill->getBillPrinting();


?>