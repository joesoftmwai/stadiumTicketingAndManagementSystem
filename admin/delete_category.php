<?php 

  if (!isset($_SESSION['admin_email'])) {
    echo "<script>window.open('login.php', '_self')</script>";
  } else {

 ?>

<?php

if (isset($_GET['delete_category'])) {
    $delete_category = $_GET['delete_category'];

    $sql = "DELETE FROM categories WHERE cat_id={$delete_category}";
    $exec = mysqli_query($conn, $sql);

    if ($exec) {
    	 echo "<script>
                    Swal.fire({
                        type: 'success',
                        title: 'Category deleted successfully',
                        showConfirmButton: true,
                        confirmButtonText: 'Close',
                        closeOnConfirm: false
                        }).then((result) => {
                           if (result.value) {
                               window.location = 'index.php?view_categories'
                           }
                        });

                </script>";
    } 
}
?>

<?php } ?>

