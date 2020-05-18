<?php 

  if (!isset($_SESSION['admin_email'])) {
  	echo "<script>window.open('login.php', '_self')</script>";
  } else {

 ?>
<div class="row">
	<div class="col-lg-12 content-header">
		<h1>Dashboard <small>Control Panel</small></h1>
		<ol class="breadcrumb">
			<li><a href="index.php?dashboard"><i class="fa fa-fw fa-dashboard"></i> Dashboard </a></li>
			<li class="active">Home</li>
		</ol>
	</div>
</div>

<!-- TOP BOXES -->
<div class="row">
	<div class="col-lg-12">
		<?php include 'reports/top_boxes.php'; ?>
	</div>
</div>


<!-- SALES REPORTS -->
<div class="row">
	<div class="col-lg-12">
		<?php include 'reports/sales_graph.php'; ?>
	</div>
</div>

<!-- BEST SELLER CATEGORIES(pitch Section) -->
<div class="row">

	<div class="col-lg-6">
		<?php include 'reports/best-seller-categories.php'; ?>
	</div>

	<div class="col-lg-6">
		<?php include 'reports/customers.php'; ?>
	</div>
</div>








<?php } ?>





