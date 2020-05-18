<?php 

  if (!isset($_SESSION['admin_email'])) {
    echo "<script>window.open('login.php', '_self')</script>";
  } else {

 ?>

<?php //fetches the event based on id passed from the url{GET}
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $edit_event = $_GET['edit_event'];


    $sql = "SELECT * FROM events WHERE event_id={$edit_event}";
    $exec = mysqli_query($conn, $sql);
    confirm($exec);
    while ($rows = mysqli_fetch_array($exec)) {
        $event_name=$rows['event_name'];
        $event_extras=$rows['event_extras'];
        $event_venue=$rows['event_venue'];
        $event_date=$rows['event_date'];
        $event_image=$rows['event_image'];
    }
}
?>


    <div class="row">
    <div class="col-lg-12 content-header">
        <h1>Events</h1>
        <ol class="breadcrumb">
            <li><a href="index.php?dashboard"><i class="fa fa-fw fa-dashboard"></i> Dashboard </a></li>
            <li class="active">Events</li>
        </ol>
    </div>
</div>


<div class="row">
    <div class="col-lg-12">

        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <i class="fa fa-money"></i> Edit Event
                </h3>
            </div>

            <div class="panel-body">
                <form action="" method="post" class="form-horizontal" autocomplete="off" enctype="multipart/form-data">

                     <div class="form-group">
                        <label for="event_name" class="col-md-3 control-label">Event Name</label>
                        <div class="col-md-6">
                             <input type="text" class="form-control" name="event_name" id="event_name" required value="<?php echo isset($event_name) ? $event_name : ''; ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="event_extras" class="col-md-3 control-label">Event Extras</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="event_extras" id="event_extras" required value="<?php echo isset($event_extras) ? $event_extras : ''; ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="event_venue" class="col-md-3 control-label">Event Venue</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="event_venue" id="event_venue" required value="<?php echo isset($event_venue) ? $event_venue : ''; ?>">
                        </div>
                    </div>

                    <!--date time picker-->
                    <div class="form-group">
                        <label for="id_1" class="col-md-3 control-label">Event Date</label>
                        <div class="col-md-6">
                            <div class="input-group date" id="id_1">
                               <input type="text" class="form-control"
                                   name="event_date" id="id_1" required value="<?php echo isset($event_date) ? $event_date : ''; ?>">
                                <span class="input-group-addon">
                                    <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
                                </span> 
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="event_image" class="col-md-3 control-label">POV Image</label>
                        <div class="col-md-6">
                            <img src="images/event_files/<?php echo empty($event_image) ? 'no-image.jpg' : $event_image;  ?>" width='150px' height='80px'
                             alt="" class="img-rounded"><br>
                            <input type="file" id="event_image" class="form-control" name="event_image">
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




<?php  //updates the event
$msg = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $edit_event   = $_GET['edit_event'];
    $event_name   =$_POST["event_name"];
    $event_extras =$_POST["event_extras"];
    $event_venue  =$_POST["event_venue"];
    $event_date   =$_POST["event_date"];

    $event_name   =escape($event_name);
    $event_extras =escape($event_extras);
    $event_venue  =escape($event_venue);
    $event_date   =escape($event_date);

    $event_image = $_FILES['event_image']['name'];
        $tmp_event_image = $_FILES['event_image']['tmp_name'];

        $allowed_img = array('png', 'jpg', 'jpg', 'gif', 'tif');
        $event_image_extension = pathinfo($event_image, PATHINFO_EXTENSION);

        if (!empty($event_image)) {
            if (!in_array($event_image_extension, $allowed_img)) {
             echo "<script>
                    Swal.fire({
                        type: 'error',
                        title: 'Failed',
                        text:  'Your event image extension is not supported',
                        showConfirmButton: true,
                        confirmButtonText: 'Close',
                        closeOnConfirm: false
                        }).then((result) => {
                           if (result.value) {
                               window.location = 'index.php?edit_event'
                           }
                        });

                </script>";
            exit();
        }
        } else {
            $event_image = $event_image;
        }

        move_uploaded_file($tmp_event_image, "images/event_files/$event_image");

        $sql = "UPDATE events SET event_name='{$event_name}', event_image='{$event_image}', event_extras='{$event_extras}', 
                event_venue='{$event_venue}', event_date='{$event_date}' WHERE event_id={$edit_event} ";
        $exec = mysqli_query($conn, $sql);
        confirm($exec);

        if ($exec) {
            echo "<script>
                    Swal.fire({
                        type: 'success',
                        title: 'Event updated successfully',
                        showConfirmButton: true,
                        confirmButtonText: 'Close',
                        closeOnConfirm: false
                        }).then((result) => {
                           if (result.value) {
                               window.location = 'index.php?view_events'
                           }
                        });

                </script>";
        }
}
?>

<?php } ?>