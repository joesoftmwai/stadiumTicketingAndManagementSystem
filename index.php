<?php include "includes/header.php"; ?>
    <!-- Navigation -->
<?php include "includes/navigation.php" ?>

<!-- Page Content -->
<div class="container">
    <!-- Carousel -->
    <?php include 'includes/widgets/carousel.php'; ?>

        <div class="row">
            <!-- Sidebar Widgets Column -->
            <div class="col-md-3">
                <!--advert panel-->
                <?php include 'includes/widgets/advert.php'; ?>
                <!-- Search Well -->
                <!-- <?php //include 'includes/widgets/search.php'; ?> -->

            </div>


            <!-- Fixtures Entries Column -->
            <div class="col-md-9">

            <h2 id="upcoming-events">Upcoming events</h2>

            <div class="row"> <!-- row starts -->

                <?php
                    $per_page = 6;
                    if (isset($_GET['page'])) {
                        $page = $_GET['page'];
                      } else {
                        $page = 1;                
                      }

                    $start_from = ($page-1) * $per_page;

                    $sql = "SELECT * FROM events ORDER BY event_id DESC LIMIT $start_from, $per_page";
                    $exec = mysqli_query($conn, $sql);
                    confirm($exec);
                    while ($rows = mysqli_fetch_array($exec)) {
                        $event_id     =$rows['event_id'];
                        $event_name   =$rows['event_name'];
                        $event_category =$rows['event_extras'];
                        $event_venue  =$rows['event_venue'];
                        $event_image   =$rows['event_image'];
                        $event_url   =$rows['event_url'];
                        $event_date   =$rows['event_date'];

                        $event_date = strtotime($event_date);
                        $formated_date = strftime("%d %b, %Y  %H:%M", $event_date);
                        $ribbon_date = strftime("%d %b", $event_date);


                ?>
                 <div class="col-lg-4 col-md-6 col-sm-6"> <!-- col-lg-4 col-md-6 col-sm-6 starts -->
                    <div class="proposal-div"> <!-- proposal div starts -->
                        

                        <a href="<?php echo $event_url;?>" class="event-image">
                            <hr class="m-0 p-0">
                            <img src="<?php echo $site_url; ?>/admin/images/event_files/<?php echo $event_image; ?>" class="resp-img" alt="">
                        </a>

                        <div class="event-name">
                            <?php echo $event_name;  ?>
                        </div>

                        <div class="text text-muted">
                            <p><i class="fa fa-tag"></i> <?php echo $event_category; ?></p>
                            <p><i class="fa fa-map-marker"></i> <?php echo $event_venue; ?></p>
                            <p><i class="fa fa-calendar"></i> <?php echo $formated_date; ?></p>
                            <p class="buttons">
                                <span class="pull-leftt">Tickets Prices From <strong class="price">ksh 200</strong></span>
                                <a href="<?php echo $event_url;?>" class="pull-right btn btn-success btn-sm">View</a>
                            </p>
                        </div>

                        <div class="ribbon">
                            <div class="theribbon">
                                <h4><?php echo $ribbon_date; ?></h4>
                            </div>
                            <div class="ribbon-background"></div>
                        </div>

                    </div> <!-- proposal div ends -->
                </div> <!-- col-lg-4 col-md-6 col-sm-6 ends -->

            <?php } ?>


            </div> <!-- row ends -->

            <center>
                <ul class = "pagination"> <!-- pagination starts -->
                    <?php 
                        $sel_events = "SELECT * FROM events";
                        $run_events = mysqli_query($conn, $sel_events);
                        $count_events = mysqli_num_rows($run_events);

                        $total_pages = ceil($count_events/ 6);

                     ?>

                     <!-- Creating backward button -->
                   <?php if ($page > 1): ?>
                        <li><a href = "index.php?page=<?php echo $page-1; ?>">&laquo;</a></li>
                   <?php endif; ?>


                     <?php 
                        for($i=1;$i<=$total_pages;$i++) {

                            if ($i==$page) {
                                $active='active';
                            } else {
                                $active='';
                            }

                    ?>
                       <!-- <li><a href = "#">&laquo;</a></li> -->
                       <li class = "<?php echo $active ?>"><a href = "index.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>

                   <?php } ?>

                   <!-- Creating forward button -->
                   <?php if ($page < $total_pages) : ?>
                        <li><a href = "index.php?page=<?php echo $page+1; ?>">&raquo;</a></li>
                   <?php endif; ?>  
                   
                </ul> <!-- pagination ends -->
            </center>


            </div>

        </div>

        <div class="container" id="testimonial-section">
            <div class="row">
               
                
                    <h4 class="tetimonial-header">What Our Customers Say</h4>

                    <?php 
                        // get all reviews
                        $ratings = array();
                        $sel_reviews = "SELECT * FROM customer_reviews";
                        $run_reviews = mysqli_query($conn, $sel_reviews);
                        $count_total_reviews = mysqli_num_rows($run_reviews);
                        while ($row_reviews = mysqli_fetch_array($run_reviews)) {
                            $customer_rating = $row_reviews['customer_rating'];

                            // adds all customer ratings
                            array_push($ratings, $customer_rating);
                        }

                        $total_ratings = array_sum($ratings);

                        $total_ratings == 0 ? $average_rating = 0 : $average_rating = $total_ratings/count($ratings);
                        $average_rating = ceil($average_rating);

                     ?>

                    <h4 class="tetimonial-header-2">
                        <span><?php echo $count_total_reviews; ?> Reviews</span>

                        <?php 
                                                
                            for ($average_i=0; $average_i < $average_rating; $average_i++) { 
                                echo '<img src="images/user_rate_full_big.png" class="rating mb-2"> ';
                            }

                            for ($average_i=$average_rating; $average_i < 5; $average_i++) { 
                                echo '<img src="images/user_rate_blank_big.png" class="rating mb-2">';
                            }
                         ?>

                        <span class="text-muted avg"> 
                            (<?php 
                                if ($average_rating == 0) {
                                   echo "0.0";
                                } else {
                                    printf('%.1f', $average_rating);
                                }
                             ?>)
                         </span>
                    </h4>



                    <div id="testimonialCarousel" class="carousel slide" data-ride="carousel">
                        <!-- Carousel indicators -->
                        <div id="testimonial-carousel-indicators">
                            <ol class="carousel-indicators">

                                <?php 
                                    for ($indicator_i=0; $indicator_i < $count_total_reviews; $indicator_i++) { 
                                        if ($indicator_i == 0) {
                                            $active = 'active';
                                        } else {
                                            $active = '';
                                        }
                                 ?>
                                    <li data-target="#testimonialCarousel" data-slide-to="<?php echo $indicator_i; ?>" class="<?php echo $active; ?>"></li>
                                <?php } ?>
                               
                            </ol>   
                        </div>
                        <!-- Wrapper for carousel items -->
                        <div class="carousel-inner">

                            <!-- 1. Sorts out carousel-item active -->

                            <?php 
                                $get_reviews = "SELECT * FROM customer_reviews ORDER BY 1 DESC LIMIT 0,1";
                                $run_reviews = mysqli_query($conn, $get_reviews);
                                while($row_reviews = mysqli_fetch_array($run_reviews)) {
                                    $review_customer_id = $row_reviews['review_customer_id'];
                                    $customer_rating = $row_reviews['customer_rating'];
                                    $customer_review = $row_reviews['customer_review'];
                                    $review_date = $row_reviews['review_date'];

                                    $sel_customer = "SELECT * FROM customers WHERE cust_id='$review_customer_id'";
                                    $run_customer = mysqli_query($conn, $sel_customer);
                                    $row_customer = mysqli_fetch_array($run_customer);
                                    $customer_name = $row_customer['cust_f_name'] .' '. $row_customer['cust_l_name'];
                                
                             ?>

                            <div class="item carousel-item active">
 
                                <div class="testimonial-wrapper">
                                    
                                    <div class="media">
                                        <div class="media-body">
                                            <div class="overview">

                                                <div class="name"><b><?php echo $customer_name; ?></b></div>
                                                <div class="details"><?php echo $review_date; ?></div>
                                                <div class="star-rating">

                                                    <?php 
                                                
                                                        for ($customer_i=0; $customer_i < $customer_rating; $customer_i++) { 
                                                            echo '<img src="images/user_rate_full.png" class="rating mb-2">';
                                                        }

                                                        for ($customer_i=$customer_rating; $customer_i < 5; $customer_i++) { 
                                                            echo '<img src="images/user_rate_blank.png" class="rating mb-2">';
                                                        }
                                                     ?>
                                                    

                                                </div>
                                            </div>                                      
                                        </div>
                                    </div>

                                    <div class="testimonial">
                                        <?php echo $customer_review; ?>
                                    </div>
                                </div>                              
                                                
                            </div>

                            <?php } ?>

                             <!-- 1. Sorts out carousel-item  -->

                            <?php 
                                // query for the active carousel item
                                $get_reviews = "SELECT * FROM customer_reviews ORDER BY 1 DESC LIMIT 1, $count_total_reviews";
                                $run_reviews = mysqli_query($conn, $get_reviews);
                                while($row_reviews = mysqli_fetch_array($run_reviews)) {
                                    $review_customer_id = $row_reviews['review_customer_id'];
                                    $customer_rating = $row_reviews['customer_rating'];
                                    $customer_review = $row_reviews['customer_review'];
                                    $review_date = $row_reviews['review_date'];

                                    $sel_customer = "SELECT * FROM customers WHERE cust_id='$review_customer_id'";
                                    $run_customer = mysqli_query($conn, $sel_customer);
                                    $row_customer = mysqli_fetch_array($run_customer);
                                    $customer_name = $row_customer['cust_f_name'] .' '. $row_customer['cust_l_name'];
                                
                             ?>


                            <div class="item carousel-item">
 
                                <div class="testimonial-wrapper">
                                    
                                    <div class="media">
                                        <div class="media-body">
                                            <div class="overview">

                                                <div class="name"><b><?php echo $customer_name; ?></b></div>
                                                <div class="details"><?php echo $review_date; ?></div>
                                                <div class="star-rating">

                                                    <?php 
                                                
                                                        for ($customer_i=0; $customer_i < $customer_rating; $customer_i++) { 
                                                            echo '<img src="images/user_rate_full.png" class="rating mb-2">';
                                                        }

                                                        for ($customer_i=$customer_rating; $customer_i < 5; $customer_i++) { 
                                                            echo '<img src="images/user_rate_blank.png" class="rating mb-2">';
                                                        }
                                                     ?>
                                                    

                                                </div>
                                            </div>                                      
                                        </div>
                                    </div>

                                    <div class="testimonial">
                                        <?php echo $customer_review; ?>
                                    </div>
                                </div>                              
                                                
                            </div>

                            <?php } ?>


                            
                            
                        </div>
                    </div>

          </div>
        </div>



        <hr>

    <!-- Footer -->
    <?php include 'includes/footer.php'; ?>


        

