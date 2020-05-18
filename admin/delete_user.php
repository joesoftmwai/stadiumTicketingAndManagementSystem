<?php 

  if (!isset($_SESSION['admin_email'])) {
    echo "<script>window.open('login.php', '_self')</script>";
  } else {

 ?>

<?php

if (isset($_GET['delete_user'])) {
    $delete_user = $_GET['delete_user'];

    $sql = "DELETE FROM admins WHERE user_id={$delete_user}";
    $exec = mysqli_query($conn, $sql);

    if ($exec) {
    	 echo "<script>
                    Swal.fire({
                        type: 'success',
                        title: 'User deleted successfully',
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

