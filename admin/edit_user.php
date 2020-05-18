<?php 

  if (!isset($_SESSION['admin_email'])) {
    echo "<script>window.open('login.php', '_self')</script>";
  } else {

 ?>

 <?php 

  if (isset($_GET['edit_user'])) {
      $edit_id  = $_GET['edit_user'];

      $get_user = "SELECT * FROM admins WHERE user_id = '{$edit_id}'";
      $run_user = mysqli_query($conn, $get_user);
      $row_user = mysqli_fetch_array($run_user);

      $user_id     = $row_user['user_id'];
      $user_name   = $row_user['user_name'];
      $user_email  = $row_user['user_email'];
      $user_pass   = $row_user['user_pass'];
      $user_contact = $row_user['user_contact'];
      $user_image   = $row_user['user_image'];

      $default_img  = 'anonymous.png';

  }

  ?>



<div class="row">
    <div class="col-lg-12 content-header">
        <h1>Users</h1>
        <ol class="breadcrumb">
            <li><a href="index.php?dashboard"><i class="fa fa-fw fa-dashboard"></i> Dashboard </a></li>
            <li class="active">Users</li>
        </ol>
    </div>
</div>


<div class="row">
    <div class="col-lg-12">

        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <i class="fa fa-money"></i> Update User
                </h3>
            </div>

            <div class="panel-body">
                <form action="" method="post" class="form-horizontal" autocomplete="off" enctype="multipart/form-data">
                    
                    <center>
                    <div class="col-md-6-offset-3">
                        <img src="images/<?php echo $user_image == '' ? $default_img : $user_image; ?>" alt="" class="img-responsive img-circle" width="150" height="150" style="border: 1px solid grey;">
                    </div>
                    <center><br>


                     <div class="form-group">
                        <label for="user_name" class="col-md-3 control-label"></label>
                        <div class="col-md-6">
                             <input type="text" class="form-control" name="user_name" id="user_name" required value="<?php echo isset($user_name) ? $user_name : ''; ?>" placeholder="Name">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="user_email" class="col-md-3 control-label"></label>
                        <div class="col-md-6">
                            <input type="email" class="form-control" name="user_email" id="user_email" required value="<?php echo isset($user_email) ? $user_email : ''; ?>" placeholder="Email">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="user_pass" class="col-md-3 control-label"></label>
                        <div class="col-md-6">
                            <input type="password" class="form-control" name="user_pass" id="user_pass" required value="<?php echo isset($user_pass) ? $user_pass : '';?>" placeholder="Password">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="user_contact" class="col-md-3 control-label"></label>
                        <div class="col-md-6">
                            <input type="number" class="form-control" name="user_contact" id="user_contact" required value="<?php echo isset($user_contact) ? $user_contact : '';?>" placeholder="Contact">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="user_image" class="col-md-3 control-label"></label>
                        <div class="col-md-6">
                            <input type="file" class="form-control" name="user_image" id="user_image" required>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-md-3 control-label"></label>
                        <div class="col-md-6">
                            <input type="submit" name="submit" value="Update" class="btn btn-primary form-control">
                        </div>
                    </div>

                   
                </form>

            </div>
        </div>
    </div>
</div>

<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $user_name    =$_POST["user_name"];
        $user_email   =$_POST["user_email"];
        $user_pass    =$_POST["user_pass"];
        $user_contact =$_POST["user_contact"];

        $user_image=$_FILES['user_image']['name'];
        $user_image_temp=$_FILES['user_image']['tmp_name'];
        move_uploaded_file($user_image_temp, "images/$user_image");

        $user_image    =escape($user_image);
        
        $sql = "UPDATE admins SET user_name='{$user_name}', user_email='{$user_email}', user_pass='{$user_pass}', user_contact='{$user_contact}', user_image='{$user_image}' WHERE user_id={$edit_id}";
        $exec = mysqli_query($conn, $sql);
        confirm($exec);
        if ($exec) {
             echo "<script>
                    Swal.fire({
                        type: 'success',
                        title: 'User updated successfully',
                        showConfirmButton: true,
                        confirmButtonText: 'Close',
                        closeOnConfirm: false
                        }).then((result) => {
                           if (result.value) {
                               window.location = 'index.php?view_users'
                           }
                        });

                </script>";
        }
    }
?>


<?php } ?>

   
