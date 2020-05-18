<?php 

  if (!isset($_SESSION['admin_email'])) {
    echo "<script>window.open('login.php', '_self')</script>";
  } else {

 ?>

<div class="row">
    <div class="col-lg-12 content-header">
        <h1>Orders</h1>
        <ol class="breadcrumb">
            <li><a href="index.php?dashboard"><i class="fa fa-fw fa-dashboard"></i> Dashboard </a></li>
            <li class="active">Orders</li>
        </ol>
    </div>
</div>


<div class="row">
    <div class="col-lg-12">

        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <i class="fa fa-money"></i> View Orders
                </h3>
            </div>

            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Order No</th>
                            <th>Event</th>
                            <th>Category</th>
                            <th>Booked Seats</th>
                            <th>Amount</th>
                            <th>Order Date</th>
                            <th>Order Status</th>
                            <th>Customer email</th>
                            <th>Actions</th>
                        </tr>
                        </thead>

                            <tbody>
                                <?php
                                $sql = "SELECT * FROM order_details ORDER BY id DESC";
                                $exec = mysqli_query($conn, $sql);
                                confirm($exec);
                                $sr_no = 0;
                                while ($rows = mysqli_fetch_array($exec)) {
                                    $order_id  = $rows['id'];
                                    $order_no     =$rows['order_no'];
                                    $customer_id   =$rows['customer_id'];
                                    $category_id  =$rows['category_id'];
                                    $event_id  =$rows['event_id'];
                                    $booked_seats   =$rows['booked_seats'];
                                    $amount   =$rows['amount'];
                                    $order_date   =$rows['order_date'];
                                    $status   =$rows['status'];

                                    $get_event   = "SELECT * FROM events WHERE event_id = $event_id";
                                    $run_event   = mysqli_query($conn, $get_event);
                                    $row_event   = mysqli_fetch_array($run_event);
                                    $event_name   = $row_event['event_name'];

                                    $get_category = "SELECT * FROM categories WHERE cat_id = $category_id";
                                    $run_category = mysqli_query($conn, $get_category);
                                    $row_category = mysqli_fetch_array($run_category);
                                    $cat_name   =   $row_category['cat_name']; 

                                    $get_customer   = "SELECT * FROM customers WHERE cust_id = $customer_id";
                                    $run_customer   = mysqli_query($conn, $get_customer);
                                    $row_customer   = mysqli_fetch_array($run_customer);
                                    $customer_email = $row_customer['cust_email'];







                                    $sr_no++;
                                    
                            ?>
                            <tr>
                                <td><?php echo $sr_no; ?></td>
                                <td><?php echo $order_no; ?></td>
                                <td><?php echo $event_name; ?></td>
                                <td><?php echo $cat_name; ?></td>
                                <td><?php echo $booked_seats; ?></td>
                                <td><?php echo $amount; ?></td>
                                <td><?php echo $order_date; ?></td>
                                <td><?php echo $status; ?></td>
                                <td><?php echo $customer_email; ?></td>
                                
                                <td>
                                    <div class="btn-group">
                    
                                    <!-- <a href="index.php?edit_order=<?php //echo $order_id;?>" class="btn btn-warning btn-sm"><i class="fa fa-pencil"></i>
                                    </a> -->
                                     <button class="btn btn-info btn-sm btn_print_bill" order="<?php echo $order_no; ?>"><i class="fa fa-print"></i></button>
                                    <button class="btn btn-danger btn-sm btn_delete_order" order_id="<?php echo $order_id; ?>"><i class="fa fa-times"></i>
                                    </button>

                                    </div>
                                </td>
                            </tr>

                             <?php } ?>
                            </tbody>
                       
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php } ?>
