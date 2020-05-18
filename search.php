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
                <?php include 'includes/widgets/search.php'; ?>

            </div>

            <!-- Fixtures Entries Column -->
            <div class="col-md-9">

                <h2 id="upcoming-events">Upcoming events</h2>

            <div class="row"> <!-- row starts -->

                <?php
                if (isset($_POST['submit_search'])) {

                    $per_page = 6;
                    if (isset($_GET['page'])) {
                        $page = $_GET['page'];
                      } else {
                        $page = 1;                
                      }

                    $start_from = ($page-1) * $per_page;
                    $search = $_POST['search_value'];

                    $sql = "SELECT * FROM events WHERE 
                    event_name LIKE '%$search%' OR
                    event_extras LIKE '%$search%' OR
                    event_venue LIKE '%$search%' ORDER BY event_date DESC LIMIT $start_from, $per_page";
                    $exec = mysqli_query($conn, $sql);
                    confirm($exec);

                    $count = mysqli_num_rows($exec);

                    if ($count == 0) {
                        echo '
                        
                            <div class="alert alert-danger">
                                <h3>NOTHING FOUND</h3>
                                <p>Sorry, but nothing matched your search terms. Please try again with some different keywords</p>
                            </div>
                        
                        ';
                    } else {

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
                        

                        <a href="categories.php?event=<?php echo $event_id;?>" class="event-image">
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
                                <a href="categories.php?event=<?php echo $event_id;?>" class="pull-right btn btn-success btn-sm">View</a>
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

            <?php } } } ?>


            </div> <!-- row ends -->

            


            </div>

        </div>

        <hr>

    <!-- Footer -->
    <?php include 'includes/footer.php'; ?>
