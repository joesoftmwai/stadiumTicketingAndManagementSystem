<?php 

  if (!isset($_SESSION['admin_email'])) {
    echo "<script>window.open('login.php', '_self')</script>";
  } else {

 ?>

<div class="row">
    <div class="col-lg-12 content-header">
        <h1>Users</h1>
        <ol class="breadcrumb">
            <li><a href="index.php?dashboard"><i class="fa fa-fw fa-dashboard"></i> Dashboard </a></li>
            <li class="active">users</li>
        </ol>
    </div>
</div>


<div class="row">
    <div class="col-lg-12">

        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <i class="fa fa-money"></i> View Users
                </h3>
            </div>

            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>User Name</th>
                            <th>User Email</th>
                            <th>User Contact</th>
                            <th>User Image</th>
                            <th>Actions</th>
                        </tr>
                        </thead>

                        
                            <tbody>
                                <?php
                                $sql = "SELECT * FROM admins ORDER BY user_id DESC";
                                $exec = mysqli_query($conn, $sql);
                                confirm($exec);
                                $sr_no = 0;
                                while ($rows = mysqli_fetch_array($exec)) {
                                    $user_id     =$rows['user_id'];
                                    $user_name   =$rows['user_name'];
                                    $user_email  =$rows['user_email'];
                                    $user_contact  =$rows['user_contact'];
                                    $user_image   =$rows['user_image'];
                                    $sr_no++;
                                    
                            ?>
                            <tr>
                                <td><?php echo $sr_no; ?></td>
                                <td><?php echo $user_name; ?></td>
                                <td><?php echo $user_email; ?></td>
                                <td><?php echo $user_contact; ?></td>
                                <td>
                                    <img src="images/<?php echo $user_image; ?>" alt="" height="50" width="50" class="img-responsive img-thumbnail">
                                </td>
                                <td>
                                    <div class="btn-group">
                    
                                    <a href="index.php?edit_user=<?php echo $user_id;?>" class="btn btn-warning btn-sm"><i class="fa fa-pencil"></i>
                                    </a>
                                    <button class="btn btn-danger btn-sm btn_delete_user" user_id="<?php echo $user_id; ?>"><i class="fa fa-times"></i>
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
