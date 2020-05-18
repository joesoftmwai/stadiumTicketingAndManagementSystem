<?php include "includes/header.php"; ?>
<!-- Navigation -->
<?php include "includes/navigation.php" ?>

<!-- Page Content -->
<div class="container">
    <div class="row">

        <div class="col-md-12">
            <ul class="breadcrumb">
                <li>
                    <a href="index.php">Home</a>
                </li>

                <li>Events</li>

                <?php 
                     if (isset($_GET['event_url'])) {
                        $event_url = $_GET['event_url'];
                        $get_event = "SELECT * FROM events WHERE event_url = '$event_url'";
                        $run_event = mysqli_query($conn, $get_event);
                        $row_event = mysqli_fetch_array($run_event);
                        $event_name = $row_event['event_name'];
                    }
                 ?>
                <li><?php echo $event_name ; ?></li>
            </ul>
        </div>

        <!-- Fixtures Entries Column -->
        <div class="col-md-8">

            <div class="panel panel">
                <div class="panel-heading details">
                    <?php
                    if (isset($_GET['event_url'])) {
                        $event_url = $_GET['event_url'];
                        $sql = "SELECT * FROM events WHERE event_url = '$event_url'";
                        $exec = mysqli_query($conn, $sql);
                        confirm($exec);
                        while ($rows = mysqli_fetch_array($exec)) {
                            $event_id = $rows['event_id'];
                            $event_name = $rows['event_name'];
                            $event_extras = $rows['event_extras'];
                            $event_venue = $rows['event_venue'];
                            $event_date = $rows['event_date'];
                            $event_image = $rows['event_image'];

                            $event_date = strtotime($event_date);
                            $formated_date = strftime("%d %b, %Y  %H:%M", $event_date);

                            ?>

                            <div class="details_banner">
                                <h4><?php echo $event_name; ?></h4> 

                                <small class="pull-right"><?php echo $event_extras; ?></small>

                            </div>

                            <div class="banner_details_date">
                                <span><?php echo $formated_date; ?></span> |
                                <span><?php echo $event_venue; ?></span>
                            </div>

                            
                            
                            

                            <img class="img-responsive" src="<?php echo $site_url ?>/admin/images/event_files/<?php echo $event_image; ?>">

                        <?php }
                    } ?>
                </div>
            </div>


                <div class="panel panel">
                    <div class="panel-heading "></div>

                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped categories_table">
                            <thead>
                            <tr>
                                <th>Categories</th>
                                <th>POV</th> <!--POV - Point Of View-->
                                <th>Quantity</th>
                                <th>Price</th>
                            </tr>
                            </thead>
                            
                            <tbody>

                                <?php
                                if (isset($_GET['event_url'])) {
                                    $sql = "SELECT * FROM categories ORDER BY cat_id ASC";
                                    $exec = mysqli_query($conn, $sql);
                                    confirm($exec);
                                    while ($rows = mysqli_fetch_array($exec)) {
                                        $cat_id = $rows['cat_id'];
                                        $cat_name = $rows['cat_name'];
                                        $cat_description = $rows['cat_desc'];
                                        $cat_quantity = $rows['cat_quantity'];
                                        $cat_price = $rows['cat_price'];
                                        $cat_image = $rows['cat_image'];
                                        $cat_pov_image = $rows['cat_pov_image'];
                                        $cat_booking_fee = $rows['cat_booking_fee'];

                                    ?>

                                <tr class="cat_img_link categories_details" id="img_link_row" rel="<?php echo $cat_image; ?>">

                                    <?php add_cart(); ?>

                                    <form method="post" action="">

                                    <td><strong><?php echo $cat_name; ?></strong>
                                        <p class="text-muted text-lowercase"><?php echo $cat_description; ?></p>
                                    </td>
                                    <td>
                                        <span rel="<?php echo $cat_pov_image; ?>" class="pov_link" id="tooltip"
                                              title="Click to see estimated view">
                                            <i class="fa fa-eye"></i>
                                        </span>

                                        <!-- estimated view modal -->
                                        <div class="modal fade" id="myModal" role="dialog">
                                            <div class="modal-dialog category_pov_modal">
                                                <!-- estimated view modal content-->
                                                <div class="modal-content">
                                                    <div class="modal-body">
                                                        <button type="button" class="close" data-dismiss="modal">
                                                            &times
                                                        </button>
                                                        <img src="" alt="" class="img-responsive modal_pov_img">

                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </td>

                                    <td>

                                        <select name="no_of_seats" class="my_select"  id="my_select">
                                            <?php
                                            for ($i = 1; $i <= $cat_quantity; $i++) {
                                                echo $i
                                                ?>
                                                <option><?php echo $i; ?></option>
                                            <?php } ?>
                                        </select>
                                       


                                    </td>

                                    <td>
                                        <?php echo $cat_price; ?> KSH
                                       
                                    </td>
                                
                                    
                                    <td>
                                        <input type="hidden" name="price" class="price" value="<?php echo $cat_price;?>">
                                        <input type="hidden" name="cat_id"  value="<?php echo $cat_id; ?>">
                                        <input type="hidden" name="event_id" value="<?php echo $event_id; ?>">
                                        <input type="hidden" name="booking_fee" class="fee" value="<?php echo $cat_booking_fee; ?>">
                                        <input type="hidden" name="subtotal" class="subtotal">
                                        <input type="hidden" name="total" class="total">
                                        <input type="submit" name="submit_order" class="btn btn-success btn-sm btn_buy" value="Buy Now">
                                        
                                    </td>


                                    </form>


                                </tr>


                                <?php } ?>

                            <?php } ?>

                            </tbody>

                        </table>
                    </div>

                </div>
            </div>

        </div>
        <!-- /col-md-9-->

        <!-- Sidebar Widgets Column -->
        <div class="col-md-4">

            <?php if (isset($_GET['event_url'])) { ?>

            <?php include 'includes/widgets/advert.php'; ?>
            
            <!-- seating plan Well -->
            <div id="myWell">
                <img src="./images/seating_plan1.jpg" alt=""
                     class="img-responsive img-thumbnail cat_img_well">

                <!-- /.input-group -->
            </div>

        <?php } ?>

        </div>
        <!--/col-md-3-->


    </div>
    <!-- /.row -->

    <hr>

    <!-- Footer -->

    <?php include "includes/footer.php"; ?>



