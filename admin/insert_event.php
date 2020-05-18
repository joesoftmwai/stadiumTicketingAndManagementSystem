<?php 

  if (!isset($_SESSION['admin_email'])) {
    echo "<script>window.open('login.php', '_self')</script>";
  } else {

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
                    <i class="fa fa-money"></i> Insert Event
                </h3>
            </div>

            <div class="panel-body">
                <form action="" method="post" class="form-horizontal" autocomplete="off" enctype="multipart/form-data">

                     <div class="form-group">
                        <label for="event_name" class="col-md-3 control-label">Event Name</label>
                        <div class="col-md-6">
                             <input type="text" class="form-control" name="event_name" id="event_name" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="event_extras" class="col-md-3 control-label">Event Extras</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="event_extras" id="event_extras" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="event_venue" class="col-md-3 control-label">Event Venue</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="event_venue" id="event_venue" required>
                        </div>
                    </div>

                    <!--date time picker-->
                    <div class="form-group">
                        <label for="id_1" class="col-md-3 control-label">Event Date</label>
                        <div class="col-md-6">
                            <div class="input-group date" id="id_1">
                               <input type="text" class="form-control"
                                   name="event_date" id="id_1" required>
                                <span class="input-group-addon">
                                    <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
                                </span> 
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="event_image" class="col-md-3 control-label">Event Image</label>
                        <div class="col-md-6">
                            <input type="file" class="form-control" name="event_image" id="event_image">
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
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $event_name   =$_POST["event_name"];
        $event_extras =$_POST["event_extras"];
        $event_venue  =$_POST["event_venue"];
        $event_date   =$_POST["event_date"];

        $event_name   =escape($event_name);

        class SanitizeUrl {

            public static function slug($string, $space="-") {
                $string = utf8_encode($string);
                if (function_exists('iconv')) {
                    $string = iconv('UTF-8', 'ASCII//TRANSLIT', $string);
                }

                $string = preg_replace("/[^a-zA-Z0-9 \-]/", "", $string);
                $string = trim(preg_replace("/\\s+/", " ", $string));
                $string = strtolower($string);
                $string = str_replace(" ", $space, $string);

                return $string;
            }
        }

        $sanitize_url = SanitizeUrl::slug($event_name);

        $event_url    =escape($sanitize_url);
        $event_extras =escape($event_extras);
        $event_venue  =escape($event_venue);
        $event_date   =escape($event_date);

        $event_image = $_FILES['event_image']['name'];
        $tmp_event_image = $_FILES['event_image']['tmp_name'];

        $allowed_img = array('png', 'jpg', 'jpg', 'gif', 'tif');
        $event_image_extension = pathinfo($event_image, PATHINFO_EXTENSION);

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
                               window.location = 'index.php?insert_event'
                           }
                        });

                </script>";
            exit();
        }

        move_uploaded_file($tmp_event_image, "images/event_files/$event_image");

        
        $sql = "INSERT INTO events (event_name, event_url, event_extras, event_venue, event_image, event_date) 
                VALUES ('{$event_name}', '{$event_url}', '{$event_extras}', '{$event_venue}', '{$event_image}', '{$event_date}')";
        $exec = mysqli_query($conn, $sql);
        confirm($exec);
        if ($exec) {
             echo "<script>
                    Swal.fire({
                        type: 'success',
                        title: 'Event added successfully',
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

   
