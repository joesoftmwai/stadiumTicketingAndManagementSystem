<?php 

  if (!isset($_SESSION['admin_email'])) {
    echo "<script>window.open('login.php', '_self')</script>";
  } else {

 ?>

<?php

if (isset($_GET['delete_payement'])) {
    $delete_payement = $_GET['delete_payement'];

    $sql = "DELETE FROM payements WHERE payment_id={$delete_payement}";
    $exec = mysqli_query($conn, $sql);

    if ($exec) {
    	 echo "<script>
                    Swal.fire({
                        type: 'success',
                        title: 'Payement deleted successfully',
                        showConfirmButton: true,
                        confirmButtonText: 'Close',
                        closeOnConfirm: false
                        }).then((result) => {
                           if (result.value) {
                               window.location = 'index.php?view_payements'
                           }
                        });

                </script>";
    }
    
}
?>
<?php } ?>
