<?php 
  
  error_reporting(0);

  $get_orders = "SELECT * FROM order_details";
  $run_orders = mysqli_query($conn, $get_orders);

  $array_dates = array();
  $array_sales = array();
  $addOrderPayements = array();

  while($response = mysqli_fetch_assoc($run_orders)) {

    $order_date = substr($response["order_date"], 0, 10);
    array_push($array_dates, $order_date);

    $array_sales = array($order_date => $response["amount"]);

    foreach ($array_sales as $key => $value) {
      $addOrderPayements[$key] += $value;
    }
    
  }

  $noRepeatDates = array_unique($array_dates);

 ?>

	<div class="box  bg-teal-gradient">
    <div class="box-header">

        <i class="fa fa-th"></i>
        <h3 class="box-title">Sales Graph</h3>
           <div class="chart" id="line-chart" style="height: 300px"></div>

    </div>
</div>


<script>

	var line = new Morris.Line({
    element          : 'line-chart',
    resize           : true,
    data             : [

    <?php 


     if ($noRepeatDates != null) {

      foreach ($noRepeatDates as $key) {
      echo "{ y: '".$key."', Sales: ".$addOrderPayements[$key]." },";
     }
     echo "{ y: '".$key."', Sales: ".$addOrderPayements[$key]." }";

     } else {
      echo "{ y: '0', Sales: '0' }";
     }


     ?>
      

    ],
    xkey             : 'y',
    ykeys            : ['Sales'],
    labels           : ['Sales'],
    lineColors       : ['#efefef'],
    lineWidth        : 2,
    hideHover        : 'auto',
    gridTextColor    : '#fff',
    gridStrokeWidth  : 0.4,
    pointSize        : 4,
    pointStrokeColors: ['#efefef'],
    gridLineColor    : '#efefef',
    gridTextFamily   : 'Open Sans',
    preUnits         : 'ksh ',
    gridTextSize     : 14
  });
</script>
