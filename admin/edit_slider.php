<?php 

  if (!isset($_SESSION['admin_email'])) {
    echo "<script>window.open('login.php', '_self')</script>";
  } else {

 ?>

 <?php 
  
  if (isset($_GET['edit_slider'])) {
      $edit_id  = $_GET['edit_slider'];

      $get_sliders = "SELECT * FROM slider WHERE slider_id = {$edit_id}";
      $run_sliders = mysqli_query($conn, $get_sliders);
      $row_sliders = mysqli_fetch_array($run_sliders);

      $slider_id   = $row_sliders['slider_id'];
      $slider_name   = $row_sliders['slider_name'];
      $slider_image   = $row_sliders['slider_image'];
  }

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
                    <i class="fa fa-money"></i> Edit Slider
                </h3>
            </div>

            <div class="panel-body">

             <form action="" method="post" class="form-horizontal" enctype="multipart/form-data">
                    <div class="form-group">
                        <label class="col-md-3 control-label">Slider Name</label>
                        <div class="col-md-6">
                            <input type="text" name="slider_name" class="form-control" value="<?php echo isset($slider_name) ? $slider_name : '' ;?>" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Slider Image</label>
                        <div class="col-md-6">
                            <input type="file" class="form-control" name="slider_image" required>
                            <br>
                            <img src="../images/sliders/<?php echo isset($slider_image) ? $slider_image : '' ;?>" alt="" width="100" height="100">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label"></label>
                        <div class="col-md-6">
                            <input type="submit" name="update" value="Update" class="btn btn-primary form-control">
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<?php 
 
 if (isset($_POST['update'])) {

    $slider_name    = $_POST['slider_name'];
    $slider_image   = $_FILES['slider_image']['name'];
    $temp_name     = $_FILES['slider_image']['tmp_name'];

    $view_sliders   = "SELECT * FROM slider";
    $run_view_sliders = mysqli_query($conn, $view_sliders);
    $count_sliders   = mysqli_num_rows($run_view_sliders);

    move_uploaded_file($temp_name, "../images/sliders/$slider_image");

    $update_slider = "UPDATE slider SET slider_name = '$slider_name', slider_image = '$slider_image' WHERE slider_id={$edit_id}";
    $run_update_slider    = mysqli_query($conn, $update_slider);
    confirm($run_update_slider);

    echo "<script>
        Swal.fire({
            type: 'success',
            title: 'Slider updated successfully',
            showConfirmButton: true,
            confirmButtonText: 'Close',
            closeOnConfirm: false
            }).then((result) => {
               if (result.value) {
                   window.location = 'index.php?view_sliders'
               }
            });

    </script>";

 }

 ?>

<?php } ?>

  













