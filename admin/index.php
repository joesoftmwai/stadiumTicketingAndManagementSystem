
<?php include 'includes/header.php'; ?>

<?php 

  @session_start();

  if (!isset($_SESSION['admin_email'])) {
    echo "<script>window.open('login.php', '_self')</script>";
  } else {

 ?>

<?php 
 
 $admin_email = $_SESSION['admin_email'];

 $get_admin  = "SELECT * FROM admins WHERE user_email = '$admin_email'";
 $run_admin  = mysqli_query($conn, $get_admin);
 $row_admin  = mysqli_fetch_array($run_admin);

  $admin_id    = $row_admin['user_id'];
  $admin_name  = $row_admin['user_name'];
  $admin_email = $row_admin['user_email'];
  $admin_pass  = $row_admin['user_pass'];
  $admin_contact  = $row_admin['user_contact'];
  $admin_image  = $row_admin['user_image'];

 ?>

<div id="wrapper"> <!-- wrapper starts -->
    <?php include 'includes/navigation.php'; ?>
    <div id="page-wrapper">
        <div class="container-fluid">

            <?php
             if (isset($_GET['dashboard'])) {
                include 'dashboard.php';
             }

              if (isset($_GET['insert_event'])) {
                 include 'insert_event.php';
              }

              if (isset($_GET['view_events'])) {
                  include 'view_events.php';
              }

              if (isset($_GET['delete_event'])) {
                include 'delete_event.php';
              }

              if (isset($_GET['edit_event'])) {
                include 'edit_event.php';
              }

              if (isset($_GET['insert_category'])) {
               include('insert_category.php');
              }

              if (isset($_GET['view_categories'])) {
               include('view_categories.php');
              }

              if (isset($_GET['delete_category'])) {
                include 'delete_category.php';
              }

              if (isset($_GET['edit_category'])) {
                include 'edit_category.php';
              }

              if (isset($_GET['view_users'])) {
                include 'view_users.php';
              }

              if (isset($_GET['insert_user'])) {
                include 'insert_user.php';
              }

              if (isset($_GET['edit_user'])) {
                include 'edit_user.php';
              }

              if (isset($_GET['delete_user'])) {
                include 'delete_user.php';
              }

              if (isset($_GET['view_customers'])) {
                include 'view_customers.php';
              }

              if (isset($_GET['edit_customer'])) {
               include 'edit_customer.php';
              }

              if (isset($_GET['delete_customer'])) {
               include 'delete_customer.php';
              }

              if (isset($_GET['view_orders'])) {
               include 'view_orders.php';
              }
            

              if (isset($_GET['edit_order'])) {
               include 'edit_order.php';
              }

              if (isset($_GET['delete_order'])) {
               include 'delete_order.php';
              }

              if (isset($_GET['view_payements'])) {
               include 'view_payements.php';
              }

              if (isset($_GET['delete_payement'])) {
               include 'delete_payement.php';
              }

              if (isset($_GET['view_sliders'])) {
               include 'view_sliders.php';
              }

              if (isset($_GET['insert_slider'])) {
               include 'insert_slider.php';
              }

              if (isset($_GET['edit_slider'])) {
               include 'edit_slider.php';
              }

              if (isset($_GET['delete_slider'])) {
               include 'delete_slider.php';
              }

              


              

              

              
              

              
              


             ?>
            
        </div>
    </div>  
</div> <!-- Wrapper ends -->

<?php include 'includes/footer.php'; ?>

<?php } ?>


