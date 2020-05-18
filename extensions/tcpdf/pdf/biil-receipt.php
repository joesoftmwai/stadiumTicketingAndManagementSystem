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
		$date 	  = substr($responseSale['date'], 0, 20); //substr($responseSale['date'], 0, 10);
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

// ! include headers & footers
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// allows multiple pages to be added
$pdf->startPageGroup();

// add a page
$pdf->AddPage('P', 'A7');

// set content to print
// ----------------------------------------------------------------------------------------
$bloque1 = <<<EOF

		<table style="font-size: 9px; text-align: center;">
			<tr>
				<td style="width: 160px">
					<div>

						Date: $date

						<br><br>
						Inventory System

						<br>
						NIT: 71.15942-17

						<br>
						Adress: Dominion House, d5 

						<br>
						Phone: 0798221939

						<br>
						BILL NO. $code

						<br><br>
						Client: $client ,

						Seller: $seller
						<br>

					</div>
				</td>
			</tr>
		</table>

EOF;

$pdf->writeHTML($bloque1, false, false, false, false, '');

// ----------------------------------------------------------------------------------------

// ----------------------------------------------------------------------------------------

foreach ($products as $key => $value) {

	$itemProduct = 'description';
	$itemValue = $value['description'];

	$responseProducts = ProductsController::ctrShowProducts($itemProduct, $itemValue);

	$productName = $value['description'];
	$quantity = $value['quantity'];
	$price = number_format($value['price'], 2);
	$total = number_format($value['total'], 2);

$bloque2 = <<<EOF

	<table style="font-size: 9px">

		<tr>
			<td style="width: 160px; text-align: right;">
				$productName
			</td>
		</tr>

		<tr>
			<td style="width: 160px; text-align:right;">
				$ $price * $quantity = $ $total 
			</td>
			
		</tr>

	</table>


EOF;

$pdf->writeHTML($bloque2, false, false, false, false, '');

}
// ----------------------------------------------------------------------------------------


$bloque3 = <<<EOF

	<table style="font-size: 9px; text-align: right;">
	    <tr><td></td></tr>
		<tr>
			<td style="width: 80px">
				Price:
			</td>

			<td style="width: 80px">
				$ $netPrice
			</td>
		</tr>

		<tr>
			<td style="width: 80px">
				Tax:
			</td>

			<td style="width: 80px">
				$ $tax
			</td>
		</tr>

		<tr>
			<td style="width: 160px;">
			-----------------------------------
			</td>
		</tr>

		<tr>
			<td style="width: 80px">
				Total:
			</td>

			<td style="width: 80px">
				$ $totalPrice
			</td>
		</tr>

		<tr>

			<td style="width: 160px; color: green;">
			  <br><br>
			  Thank you for your purchase	
			</td>
		</tr>
	</table>

EOF;

$pdf->writeHTML($bloque3, false, false, false, false, '');

// ----------------------------------------------------------------------------------------

// output 
$pdf->Output('bill.pdf');

	}
 }



$bill = new printBill();
$bill->code=$_GET['code'];
$bill->getBillPrinting();


?>