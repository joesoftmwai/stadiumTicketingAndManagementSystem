
<!--footer-->
<!-- <footer class="main-footer">
    <strong>Copyright &copy; <a href="https://#" target="_blank">Joesoft</a></strong>
    All rights reserved.
</footer> -->



</div>
<!-- /.container -->
<div id="footer" style="width: 100%; "><!-- Footer starts -->
	<div class="container">
		<div class="row">
			<div class="col-md-3 col-sm-6">

				<h4>Pages</h4>
				<ul>
					<li><a href="cart.php">Shopping Cart</a></li>
					<li><a href="#" data-toggle="modal" data-target="#contact_us_modal">Contact Us</a></li>
					<li><a href="#">About</a></li>
				</ul>

				<hr class="hidden-md hidden-lg hidden-sm">

			</div>

			<div class="col-md-3 col-md-6">
				<h4>Support</h4>

				<a href="#" data-toggle="modal" data-target="#contact_us_modal">Customer Support</a>

				<!-- <h4>User Section</h4>
				<ul>
					<li>
						<?php 
						 if (!isset($_SESSION['customer_email'])) {
						 	echo '
                                <a href="#" data-toggle="modal" data-target="#login_modal">Login</a><li>
                                <a href="#" data-toggle="modal" data-target="#register_modal">Register</a>
                                ';
						 } else {
						 	echo '<a href="customer/my_account.php?my_orders">My Account</a>';
						 }
						 ?> 
					</li>
				</ul> -->
				
				<hr class="hidden-md hidden-lg">
			</div>

			<div class="col-md-3 col-sm-6">
				

				<h4>Payment methods</h4>
				<p><img src="<?php echo $site_url; ?>/images/paypal.png" alt="" height="50"  width="200px" ></p>
				<p><img src="<?php echo $site_url; ?>/images/credit_cards.jpg" alt="" height="50"  width="200px" ></p>

				<hr class="hidden-md hidden-lg">
			</div>

			<div class="col-md-3 col-sm-6">
				<h4>Stay in touch</h4>


                <ul>
					<li><a href="#"><i class="fa fa-facebook"></i> Facebook</a></li>
                    <li><a href="#"><i class="fa fa-twitter"></i> Twitter</a></li>
                    <li><a href="#"><i class="fa fa-instagram"></i> Instagram</a></li>
                    <li><a href="#"><i class="fa fa-google-plus"></i> Google Plus</a></li>
                    <li><a href="#"><i class="fa fa-envelope"></i> Email</a></li>

                </ul>

			</div>
		</div>
	</div>
</div><!-- Footer ends -->

<!--user_modals(login, register, forgot) modals-->
<?php include "user_modals(login, register,forgot).php";?>

<div id="copyright"> <!-- Copyright starts -->
	<div class="container">
		<div class="col-md-6">
			<strong>Copyright &copy; 2019<a href="https://#" target="_blank"> Joesoft </a>
    			All rights reserved.
    		</strong>   
		</div>

		<div class="col-md-6">
			<p class="pull-right">
				<strong>
					Powered by <a href="#">mj@Joesoft.com</a>
				</strong>
			</p>
		</div>
	</div>
</div> <!-- Copyright ends -->



<!-- Bootstrap Core JavaScript -->
<script src="<?php echo $site_url; ?>/js/bootstrap.min.js"></script>

<!-- user defined scripts -->
<script src="<?php echo $site_url; ?>/js/scripts.js"></script>

</body>

</html>