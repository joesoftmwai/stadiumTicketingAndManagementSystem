<?php 

  if (!isset($_SESSION['admin_email'])) {
    echo "<script>window.open('login.php', '_self')</script>";
  } else {

 ?>

<div class="row">
    <div class="col-lg-12 content-header">
        <h1>Customers</h1>
        <ol class="breadcrumb">
            <li><a href="index.php?dashboard"><i class="fa fa-fw fa-dashboard"></i> Dashboard </a></li>
            <li class="active">Customers</li>
        </ol>
    </div>
</div>


<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <i class="fa fa-money"></i> View Customers
                </h3>
            </div>

         
                
            
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Customer Name</th>
                            <th>Customer Email</th>
                            <th>Customer Contact</th>
                            <th>Customer City</th>
                            <th>Customer Street</th>
                            <th>Postal Code</th>
                            <th>Actions</th>
                        </tr>
                        </thead>


                        

                        
                            <tbody>
                                <?php
                                $sql = "SELECT * FROM customers ORDER BY cust_id DESC";
                                $exec = mysqli_query($conn, $sql);
                                confirm($exec);
                                $sr_no = 0;
                                while ($rows = mysqli_fetch_array($exec)) {
                                    $cust_id  = $rows['cust_id'];
                                    $cust_email     =$rows['cust_email'];
                                    $cust_password   =$rows['cust_password'];
                                    $cust_f_name  =$rows['cust_f_name'];
                                    $cust_l_name  =$rows['cust_l_name'];
                                    $cust_phone   =$rows['cust_phone'];
                                    $cust_city   =$rows['cust_city'];
                                    $cust_street   =$rows['cust_street'];
                                    $cust_postal_code   =$rows['cust_postal_code'];
                                    $sr_no++;
                                    
                            ?>
                            <tr>
                                <td><?php echo $sr_no; ?></td>
                                <td><?php echo $cust_f_name .' '.$cust_l_name; ?></td>
                                <td><?php echo $cust_email; ?></td>
                                <td><?php echo $cust_phone; ?></td>
                                <td><?php echo $cust_city; ?></td>
                                <td><?php echo $cust_street; ?></td>
                                <td><?php echo $cust_postal_code; ?></td>
                                
                                <td>
                                    <div class="btn-group">
                    
                                    <a href="index.php?edit_customer=<?php echo $cust_id;?>" class="btn btn-warning btn-sm"><i class="fa fa-pencil"></i>
                                    </a>
                                    <button class="btn btn-danger btn-sm btn_delete_customer" cust_id="<?php echo $cust_id; ?>"><i class="fa fa-times"></i>
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
</div>

<?php } ?>
