
<section class="carousel-fixed-height" id="top-carousel" style="margin: -10px 0 10px 0;">
	<div id="carousel-fixed-height" class="carousel slide" data-ride="carousel">
	  <ol class="carousel-indicators">
	    <li data-target="#carousel-fixed-height" data-slide-to="0" class=""></li>
	    <li data-target="#carousel-fixed-height" data-slide-to="1" class=""></li>
	    <li data-target="#carousel-fixed-height" data-slide-to="2" class="active"></li>
	  </ol>

		  <div class="carousel-inner" role="listbox">
		    <!-- NOTE: Bootstrap v4 changes class name to carousel-item -->

		    <?php 
			 $get_slides = "SELECT * FROM slider LIMIT 0,1";
			 $run_slides = mysqli_query($conn, $get_slides);

			 while($rows = mysqli_fetch_array($run_slides)) {
			 	$slider_name = $rows['slider_name'];
			 	$slider_image = $rows['slider_image'];
			 	$slider_name  = $rows['slider_name'];

			 ?>
		    <div class="item active">
		      <!--<img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/158072/woman-camera.jpg" alt="First slide">-->
		      <div style="background:url('images/sliders/<?php echo  $slider_image; ?>'); background-size:cover;" class="slider-size">
		        <div class="carousel-caption d-lg-block d-md-block d-none">
		        	<?php echo $slider_name; ?>
		        	<center class="pt-2">
		        		<a href="#upcoming-events" class="btn btn-success">View Tickets</a>
		        	</center>
		        </div>
		      </div>
		    </div>
		<?php } ?>

		<?php 
			 $get_slides = "SELECT * FROM slider LIMIT 1,2";
			 $run_slides = mysqli_query($conn, $get_slides);

			 while($rows = mysqli_fetch_array($run_slides)) {
			 	$slider_name = $rows['slider_name'];
			 	$slider_image = $rows['slider_image'];
			 	$slider_name  = $rows['slider_name'];

			 ?>
		    <div class="item">
		      <!--<img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/158072/woman-camera.jpg" alt="First slide">-->
		      <div style="background:url('images/sliders/<?php echo  $slider_image; ?>'); background-size:cover;" class="slider-size">
		        <div class="carousel-caption d-lg-block d-md-block d-none">
                   <?php echo $slider_name; ?>
                   <center class="pt-2">
		        		<a href="#upcoming-events" class="btn btn-success">View Tickets</a>
		        	</center>
		        </div>
		      </div>
		    </div>
		<?php } ?>

		  <a class="left carousel-control" href="#carousel-fixed-height" role="button" data-slide="prev">
		    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
		    <span class="sr-only">Previous</span>
		  </a>

		  <a class="right carousel-control" href="#carousel-fixed-height" role="button" data-slide="next">
		    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
		    <span class="sr-only">Next</span>
		  </a>

	</div>
</section>
