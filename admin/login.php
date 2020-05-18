<?php
 session_start();
 include '../includes/db.php';
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Admin Login</title>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/login.css">
  <script src="js/sweetalert2.js"></script>
</head>
<body>
  <div class="container">
    <form class="form-login" action="" method="post">
      <h2 class="form-login-heading">Admin Login</h2>
      <input type="email" class="form-control" name="admin_email" placeholder="Email" required>

      <input type="password" class="form-control" name="admin_pass" placeholder="Password" required>

      <button class="btn btn-lg btn-primary btn-block" type="submit" name="admin_login">Login</button>
    </form>
  </div>
</body>
</html>

<?php 
  if (isset($_POST['admin_login'])) {

    $admin_email  = mysqli_real_escape_string($conn, $_POST['admin_email']);
    $admin_pass   = mysqli_real_escape_string($conn, $_POST['admin_pass']);

    $get_admin    = "SELECT * FROM `admins` WHERE user_email = '$admin_email' AND user_pass = '$admin_pass'";
    $run_admin    = mysqli_query($conn, $get_admin);
    $count_admin  = mysqli_num_rows($run_admin);


    if ($count_admin == null ? null : 1) {
      
      $_SESSION['admin_email'] = $admin_email;


     echo "<script>
            Swal.fire({
                type: 'success',
                title: 'Login successfull',
                showConfirmButton: true,
                confirmButtonText: 'Close',
                closeOnConfirm: false
                }).then((result) => {
                   if (result.value) {
                       window.location = 'index.php?dashboard'
                   }
                });

        </script>";

    } else {
      
      echo "<script>
            Swal.fire({
            title: 'Login failed',
            text: 'Ensure Email and password are correct',
            type: 'error',
            confirmButtonText: 'close'
        });

        </script>";
    }


  }
 ?>