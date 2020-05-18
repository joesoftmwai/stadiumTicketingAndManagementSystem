<?php 

  if (!isset($_SESSION['admin_email'])) {
    echo "<script>window.open('login.php', '_self')</script>";
  } else {

 ?>

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
        
        $sql = "INSERT INTO admins (user_name, user_email, user_pass, user_contact, user_image) 
                VALUES ('{$user_name}', '{$user_email}', '{$user_pass}', '{$user_contact}', '{$user_image}')";
        $exec = mysqli_query($conn, $sql);
        confirm($exec);
        if ($exec) {
             echo "<script>
                    Swal.fire({
                        type: 'success',
                        title: 'User added successfully',
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
                    <i class="fa fa-money"></i> Add User
                </h3>
            </div>

            <div class="panel-body">
                <form action="" method="post" class="form-horizontal" autocomplete="off" enctype="multipart/form-data">

                     <div class="form-group">
                        <label for="user_name" class="col-md-3 control-label">Name</label>
                        <div class="col-md-6">
                             <input type="text" class="form-control" name="user_name" id="user_name" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="user_email" class="col-md-3 control-label">Email</label>
                        <div class="col-md-6">
                            <input type="email" class="form-control" name="user_email" id="user_email" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="user_pass" class="col-md-3 control-label">Password</label>
                        <div class="col-md-6">
                            <input type="password" class="form-control" name="user_pass" id="user_pass" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="user_contact" class="col-md-3 control-label">Contact</label>
                        <div class="col-md-6">
                            <input type="number" class="form-control" name="user_contact" id="user_contact" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="user_image" class="col-md-3 control-label">Image</label>
                        <div class="col-md-6">
                            <input type="file" class="form-control" name="user_image" id="user_image" required>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-md-3 control-label"></label>
                        <div class="col-md-6">
                            <input type="submit" name="submit" value="Submit" class="btn btn-primary form-control">
                        </div>
                    </div>

                   
                </form>

            </div>
        </div>
    </div>
</div>

<?php } ?>

   
