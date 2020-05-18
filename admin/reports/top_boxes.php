

<?php 

 /****** Total orders ******/ 
 $get_orders = "SELECT * FROM order_details";
 $run_orders = mysqli_query($conn, $get_orders);
 $count_orders = mysqli_num_rows($run_orders);

 /****** Total categories ******/ 
 $get_categories = "SELECT * FROM categories";
 $run_categories = mysqli_query($conn, $get_categories);
 $count_categories = mysqli_num_rows($run_categories);

 /****** Total customers ******/ 
 $get_customers = "SELECT * FROM customers";
 $run_customers = mysqli_query($conn, $get_customers);
 $count_customers = mysqli_num_rows($run_customers);

 /****** Total events ******/ 
 $get_events = "SELECT * FROM events";
 $run_events = mysqli_query($conn, $get_events);
 $count_events = mysqli_num_rows($run_events);



?>



      


      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?php echo $count_orders; ?></h3>

              <p>New Orders</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="index.php?view_orders" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?php echo $count_categories; ?></h3>

              <p>Categories</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="index.php?view_categories" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?php echo $count_customers; ?></h3>

              <p>New Customers</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="index.php?view_customers" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3><?php echo $count_events; ?></h3>

              <p>Events</p>
            </div>
            <div class="icon">
              <i class="ion ion-ios-cart"></i>
            </div>
            <a href="index.php?view_events" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>