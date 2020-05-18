<?php 

  if (!isset($_SESSION['admin_email'])) {
    echo "<script>window.open('login.php', '_self')</script>";
  } else {

 ?>

<div class="row">
    <div class="col-lg-12 content-header">
        <h1>Events</h1>
        <ol class="breadcrumb">
            <li><a href="index.php?dashboard"><i class="fa fa-fw fa-dashboard"></i> Dashboard </a></li>
            <li class="active">Events</li>
        </ol>
    </div>
</div>


<div class="row">
    <div class="col-lg-12">

        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <i class="fa fa-money"></i> View Events
                </h3>
            </div>

            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>POV Image</th>
                            <th>Actions</th>
                        </tr>
                        </thead>

                        <tbody>

                        <?php
                        $sql = "SELECT * FROM categories ORDER BY cat_id DESC";
                        $exec = mysqli_query($conn, $sql);
                        confirm($exec);
                        $sr_no = 0;
                        while ($rows = mysqli_fetch_array($exec)) {
                            $cat_id          =$rows['cat_id'];
                            $cat_name        =$rows['cat_name'];
                            $cat_description =$rows['cat_desc'];
                            $cat_quantity    =$rows['cat_quantity'];
                            $cat_price       =$rows['cat_price'];
                            $cat_image       =$rows['cat_image'];
                            $cat_pov_image   =$rows['cat_pov_image'];
                            $sr_no++;

                            ?>
                            
                            <tr>
                                <td><?php echo $sr_no; ?></td>
                                <td><img src="../images/<?php echo $cat_image; ?>" width="150px" height="80px" class="img-rounded"></td>
                                <td><?php echo $cat_name; ?></td>
                                <td><?php echo $cat_description; ?></td>
                                <td><?php echo $cat_quantity; ?></td>
                                <td><?php echo $cat_price; ?></td>

                                <td><img src="../images/<?php echo $cat_pov_image; ?>" width="150px" height="80px" class="img-rounded"></td>

                                <td>
                                     <div class="btn-group">
                                        <a href="index.php?edit_category=<?php echo $cat_id;?>" class="btn btn-warning btn-sm"><i class="fa fa-pencil"></i>
                                        </a>
                                        <button class="btn btn-danger btn-sm btn_delete_category" cat_id="<?php echo $cat_id; ?>"><i class="fa fa-times"></i>
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
