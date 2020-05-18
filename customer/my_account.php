
    <!-- Header -->
<?php include "../includes/header.php"; ?>
    <!-- Navigation -->
<?php include "../includes/navigation.php" ?>

<!-- Page Content -->
<div class="container">
  

        <div class="row">

        <div class="col-md-12">
			<ul class="breadcrumb">
				<li>
					<a href="../index.php">Home</a>
				</li>
				<li>My Account</li>
			</ul>
		</div>

		<div class="col-md-3">

			<!-- Sidebar -->
			<?php include 'includes/sidebar.php'; ?>

		</div>

		<div class="col-md-9">
			<div class="box"> 

				<?php 
				  if(isset($_GET['my_orders'])) {
				  	include 'my_orders.php';
				  }

				  if (isset($_GET['pay_offline'])) {
				  	include 'pay_offline.php';
				  }

				  if (isset($_GET['edit_account'])) {
				  	include 'edit_account.php';
				  }

				  if (isset($_GET['change_pass'])) {
				  	include 'change_pass.php';
				  }

				  if (isset($_GET['delete_account'])) {
				  	include 'delete_account.php';
				  }

				  if (isset($_GET['review_rate'])) {
				  	include 'review_rate.php';
				  }

				 ?>

			</div>
		</div>


        </div>

        <hr>

    <!-- Footer -->
    <?php include '../includes/footer.php'; ?>












