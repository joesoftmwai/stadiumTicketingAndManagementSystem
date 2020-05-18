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
                    <i class="fa fa-money"></i> View Events
                </h3>
            </div>

            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Date</th>
                            <th>Event</th>
                            <th>Event Extras</th>
                            <th>Venue</th>
                            <th>Actions</th>
                        </tr>
                        </thead>

                        
                            <tbody>
                                <?php
                                $sql = "SELECT * FROM events ORDER BY event_id DESC";
                                $exec = mysqli_query($conn, $sql);
                                confirm($exec);
                                $sr_no = 0;
                                while ($rows = mysqli_fetch_array($exec)) {
                                    $event_id     =$rows['event_id'];
                                    $event_name   =$rows['event_name'];
                                    $event_extras =$rows['event_extras'];
                                    $event_venue  =$rows['event_venue'];
                                    $event_date   =$rows['event_date'];
                                    $sr_no++;
                                    
                            ?>
                            <tr>
                                <td><?php echo $sr_no; ?></td>
                                <td><?php echo $event_date; ?></td>
                                <td><?php echo $event_name; ?></td>
                                <td><?php echo $event_extras; ?></td>
                                <td><?php echo $event_venue; ?></td>
                                <td>
                                    <div class="btn-group">
                    
                                    <a href="index.php?edit_event=<?php echo $event_id;?>" class="btn btn-warning btn-sm"><i class="fa fa-pencil"></i>
                                    </a>
                                    <button class="btn btn-danger btn-sm btn_delete_event" event_id="<?php echo $event_id; ?>"><i class="fa fa-times"></i>
                                    </button>

                                    </div>
                                </td>
                            </tr>

                             <?php } ?>
                            </tbody>
                       
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php } ?>
