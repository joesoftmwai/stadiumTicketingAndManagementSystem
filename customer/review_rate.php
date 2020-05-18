<center>
	<h2>Review & Rate</h2>
</center>

<hr>

<div class="order-review-box mb-2 p-2">
	<h3 class="text-center text-white">
		Please review and rate us
	</h3>

	<div class="row">
		<div class="col-md-8 col-md-offset-2">

		<form action="" method="post" class="text-center">
			<div class="form-group">
				<label for="" class="h6 text-white">Review rating</label>
				<select name="rating" id="" class="rating-select">
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
					<option value="5">5</option>
				</select>

				<script>
					$(document).ready(function() {
						$('.rating-select').barrating({
							theme: 'fontawesome-stars'
						});
					})
				</script>

			</div>

			<textarea name="review" id="" cols="30" rows="3" class="form-control mb-2" placeholder="write your experience with us" required></textarea><br>

			<input type="submit" name="customer_review_submit" class="btn btn-success">
			</form>

			<?php

				if (isset($_POST['customer_review_submit'])) {
					$rating = $_POST['rating'];
					$review = $_POST['review'];
					$date = date("M d Y");

					$insert_review = "INSERT INTO `customer_reviews`(`review_customer_id`, `customer_rating`, `customer_review`, `review_date`) VALUES ('$customer_id','$rating','$review','$date')";
					$run_insert_review = mysqli_query($conn, $insert_review);

					if (!$run_insert_review) {
						die("QUERY FAILED".mysqli_error($conn));
					}

					echo "<script>
		                Swal.fire({
		                    type: 'success',
		                    title: 'Your review and rating submitted successfully',
		                    showConfirmButton: true,
		                    confirmButtonText: 'Close',
		                    closeOnConfirm: false
		                    }).then((result) => {
		                       if (result.value) {
		                           window.location = '../index.php'
		                       }
		                    });

		            </script>";



				}
			  ?>

		</div>
	</div>

</div>