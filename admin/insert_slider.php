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
                    <i class="fa fa-money"></i> Add Slider
                </h3>
            </div>

            <div class="panel-body">

             <form action="" method="post" class="form-horizontal" enctype="multipart/form-data">
                    <div class="form-group">
                        <label class="col-md-3 control-label">Slider Name</label>
                        <div class="col-md-6">
                            <input type="text" name="slider_name" class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Slider Image</label>
                        <div class="col-md-6">
                            <input type="file" class="form-control" name="slider_image">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label"></label>
                        <div class="col-md-6">
                            <input type="submit" name="submit" value="Submit" class="btn btn-primary form-control">
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<?php 
 
 if (isset($_POST['submit'])) {

    $slider_name    = $_POST['slider_name'];
    $slider_image   = $_FILES['slider_image']['name'];
    $temp_name     = $_FILES['slider_image']['tmp_name'];

    $view_sliders   = "SELECT * FROM slider";
    $run_view_sliders = mysqli_query($conn, $view_sliders);
    $count_sliders   = mysqli_num_rows($run_view_sliders);

    if ($count_sliders < 3) {

        move_uploaded_file($temp_name, "../images/sliders/$slider_image");

        $insert_slide = "INSERT INTO slider (slider_name, slider_image) VALUES ('$slider_name' ,'$slider_image')";
        $run_insert_slide    = mysqli_query($conn, $insert_slide);

        echo "<script>
            Swal.fire({
                type: 'success',
                title: 'New Slider added successfully',
                showConfirmButton: true,
                confirmButtonText: 'Close',
                closeOnConfirm: false
                }).then((result) => {
                   if (result.value) {
                       window.location = 'index.php?view_sliders'
                   }
                });

        </script>";

    } else {
        echo "<script>
            Swal.fire({
            title: 'Could not add new slider',
            text: 'You have already inserted 3 slider images',
            type: 'error',
            confirmButtonText: 'close'
        });

        </script>";

    }

 }

 ?>

<?php } ?>

  













