<?php 

  if (!isset($_SESSION['admin_email'])) {
    echo "<script>window.open('login.php', '_self')</script>";
  } else {

 ?>

<?php

if (isset($_GET['delete_event'])) {
    $delete_event = $_GET['delete_event'];

    $sql = "DELETE FROM events WHERE event_id={$delete_event}";
    $exec = mysqli_query($conn, $sql);

    if ($exec) {
    	 echo "<script>
                    Swal.fire({
                        type: 'success',
                        title: 'Event deleted successfully',
                        showConfirmButton: true,
                        confirmButtonText: 'Close',
                        closeOnConfirm: false
                        }).then((result) => {
                           if (result.value) {
                               window.location = 'index.php?view_events'
                           }
                        });

                </script>";
    }
    
}
?>
<?php } ?>
