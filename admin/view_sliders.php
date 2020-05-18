<?php 

  if (!isset($_SESSION['admin_email'])) {
    echo "<script>window.open('login.php', '_self')</script>";
  } else {

 ?>

<div class="row">
    <div class="col-lg-12 content-header">
        <h1>Sliders</h1>
        <ol class="breadcrumb">
            <li><a href="index.php?dashboard"><i class="fa fa-fw fa-dashboard"></i> Dashboard </a></li>
            <li class="active">Sliders</li>
        </ol>
    </div>
</div>


<div class="row">
    <div class="col-lg-12">

        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <i class="fa fa-money"></i> View Sliders
                </h3>
            </div>

            <div class="panel-body">

                <?php 
                 $get_sliders = "SELECT * FROM slider";
                 $run_sliders = mysqli_query($conn, $get_sliders);
                 while($row_sliders = mysqli_fetch_array($run_sliders)) {
                    
                    $slider_id    = $row_sliders['slider_id'];
                    $slider_name  = $row_sliders['slider_name'];
                    $slider_image = $row_sliders['slider_image'];
        
                 ?>

                 <div class="col-lg-4 col-md-4">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title" align="center">
                                <?php echo $slider_name; ?>
                            </h3>
                            </div>
                            <div class="panel-body">
                                <img src="../images/sliders/<?php echo $slider_image; ?>" alt="" class="img-responsive">
                            </div>
                            <div class="panel-footer">
                                <center>
                                    <a class="pull-left" href="index.php?edit_slider=<?php echo $slider_id; ?>"><i class="fa fa-pencil"></i> Edit
                                    </a>

                                    <a class="pull-right btn_delete_slider" slider_id="<?php echo $slider_id; ?>" style="cursor: pointer;"><i class="fa fa-times"></i> Delete
                                    </a>

                                        <div class="clearfix"></div>
                                </center>
                            </div>
                        
                    </div>
                 </div>



                <?php } ?>
            </div>
        </div>
    </div>
</div>

<?php } ?>
