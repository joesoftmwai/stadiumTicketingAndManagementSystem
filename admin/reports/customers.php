<?php 
 $get_orders = "SELECT * FROM order_details";;
 $run_orders = mysqli_query($conn, $get_orders);

 $get_customers = "SELECT * FROM customers";
 $run_customers = mysqli_query($conn, $get_customers);

 $arrayCustomersList = array();
 $arrayCustomers = array();
 $customers   = array();
 $orders  = array();  

 while($row_customers = mysqli_fetch_array($run_customers)) {
    array_push($customers, $row_customers);
 }
  while($row_orders = mysqli_fetch_array($run_orders)) {
    array_push($orders, $row_orders);   
  }


  foreach ($orders as $key => $valueOrders) {
    foreach ($customers as $key => $valueCustomers) {
       if ($valueOrders['customer_id'] == $valueCustomers['cust_id']) {

         array_push($arrayCustomers, $valueCustomers['cust_f_name']);
         $arrayCustomersList = array($valueCustomers['cust_f_name'] => $valueOrders['amount']);

         foreach ($arrayCustomersList as $key => $value) {
           $totalPurchasesPerCustomer[$key] += $value;
         }
       }
    }
  }

  $noRepeatedNames = array_unique($arrayCustomers);

  // array_push($arrayCustomers, $row_customers['cust_f_name']);
  // var_dump($arrayCustomers);

 ?>

<div class="box box-primary">

    <div class="box-header with-border">
        <h3 class="box-title">Customers</h3>
    </div>

    <div class="box-body">
        <div class="chart-responsive">
            <div class="chart" id="bar-chart-customers" style="height: 300px;"></div>
        </div>
    </div>
</div>



<script>
	var bar = new Morris.Bar({
      element: 'bar-chart-customers',
      resize: true,
      data: [

      <?php 

      foreach ($noRepeatedNames as $value) {

        echo "

          { y: '".$value."', a: ".$totalPurchasesPerCustomer[$value]."},

        ";
        # code...
      }

       ?>
      	
      ],
      barColors: ['#0af'],
      xkey: 'y',
      ykeys: ['a'],
      labels: ['Purchases'],
      preUnits: 'ksh ',
      hideHover: 'auto'
    });
</script>