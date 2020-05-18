<?php 

  if (!isset($_SESSION['admin_email'])) {
    echo "<script>window.open('login.php', '_self')</script>";
  } else {

 ?>

<?php

if (isset($_GET['delete_order'])) {
    $delete_order = $_GET['delete_order'];

    $sql = "DELETE FROM `order_details` WHERE id = {$delete_order}";
    $exec = mysqli_query($conn, $sql);

    if ($exec) {
    	 echo "<script>
                    Swal.fire({
                        type: 'success',
                        title: 'Order deleted successfully',
                        showConfirmButton: true,
                        confirmButtonText: 'Close',
                        closeOnConfirm: false
                        }).then((result) => {
                           if (result.value) {
                               window.location = 'index.php?view_orders'
                           }
                        });

                </script>";
    }
}
?>
<?php } ?>
