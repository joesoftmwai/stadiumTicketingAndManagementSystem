<?php 

  if (!isset($_SESSION['admin_email'])) {
    echo "<script>window.open('login.php', '_self')</script>";
  } else {

 ?>

<div class="row">
    <div class="col-lg-12 content-header">
        <h1>Payments</h1>
        <ol class="breadcrumb">
            <li><a href="index.php?dashboard"><i class="fa fa-fw fa-dashboard"></i> Dashboard </a></li>
            <li class="active">Payments</li>
        </ol>
    </div>
</div>


<div class="row">
    <div class="col-lg-12">

        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <i class="fa fa-money"></i> View Payments
                </h3>
            </div>

            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th>Payement No</th>
                                <th>Customer Name</th>
                                <th>Invoice No</th>
                                <th>Amount Paid</th>
                                <th>Payement Method</th>
                                <th>Payement date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php 

                            $i = 0;
                             $get_payements = "SELECT * FROM payements";
                             $run_payements = mysqli_query($conn, $get_payements);
                             while($row_payements = mysqli_fetch_array($run_payements)) {
                                $payment_id   =   $row_payements['payment_id'];
                                $invoice_no   =   $row_payements['invoice'];
                                $amount   =   $row_payements['amount'];
                                $payment_method   =   $row_payements['payment_method'];
                                $customer_id   =   $row_payements['customer_id'];
                                $payment_date   =   $row_payements['payment_date'];
                                $get_customer = "SELECT * FROM customers WHERE cust_id='$customer_id'";
                                $run_customer = mysqli_query($conn, $get_customer);
                                $row_customer = mysqli_fetch_array($run_customer);
                                $customer_name = $row_customer['cust_f_name'] .' '.  $row_customer['cust_l_name'];
                                $i++;
                             ?>

                             <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $customer_name; ?></td>
                                <td><?php echo $invoice_no; ?></td>
                                <td><?php echo $amount; ?></td>
                                <td><?php echo $payment_method; ?></td>
                                <td><?php echo $payment_date; ?></td>
                                <td>
                                   <div class="btn-group">
                    
                                    <!-- <a href="index.php?edit_payement=<?php //echo $payement_id;?>" class="btn btn-warning btn-sm"><i class="fa fa-pencil"></i>
                                    </a> -->
                                    <button class="btn btn-danger btn-sm btn_delete_payement" payement_id="<?php echo $payment_id; ?>"><i class="fa fa-times"></i>
                                    </button>

                                    </div>
                                </td>
                                
                             </tr>


                             <?php  } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php } ?>
