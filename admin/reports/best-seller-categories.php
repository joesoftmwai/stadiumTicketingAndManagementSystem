 <?php 

   $get_categories = "SELECT * FROM categories";
   $run_categories = mysqli_query($conn, $get_categories);

   $array_cat_name = array();
   $array_booked_seats = array();

   while ($categories = mysqli_fetch_assoc($run_categories)) {
    array_push($array_cat_name, $categories["cat_name"]);
    array_push($array_booked_seats, $categories["cat_booked_seats"]);
   }

   $colors = array("green", "gold", "aqua", "purple", "blue", "red", "cyan", "yellow", "magenta");

   // Get total number of seats sold per category
   $sql    = "SELECT SUM(cat_booked_seats) as total_booked_seats FROM categories";
   $exec   = mysqli_query($conn, $sql);

   $totals = array();
   $result = mysqli_fetch_array($exec);
   array_push($totals, $result['total_booked_seats']);



  ?>
  

  <div class="box box-default">
    <div class="box-header with-border">
      <h3 class="box-title">Best Selling Categories</h3>

    </div>
    <!-- /.box-header -->
    <div class="box-body" style="padding: 10px;">
      <div class="row">
        <div class="col-md-7">
          <div class="chart-responsive">
            <canvas id="pieChart" height="150"></canvas>
          </div>
          <!-- ./chart-responsive -->
        </div>
        <!-- /.col -->
        <div class="col-md-5">
          <ul class="chart-legend clearfix" style="list-style-type: none;">

            <?php 

               for ($i=0; $i < 7 ; $i++) { 
                 echo '<li><i class="fa fa-circle-o text-'.$colors[$i].'"></i> '.$array_cat_name[$i].'</li>';
               }

              
             ?>
          </ul>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.box-body -->
    <div class="box-footer no-padding">
      <ul class="nav nav-pills nav-stacked">

        <?php  

         for ($i=0; $i < 7 ; $i++) { 
          echo '
            <li><a href="#">'.$array_cat_name[$i].'
              <span class="pull-right text-'.$colors[$i].'"><i class="fa fa-angle-right"> '. ceil($array_booked_seats[$i]*100/$totals[0]).' %</i></span></a>
            </li>'
            ;
         }

         ?>

      </ul>
    </div>
    <!-- /.footer -->
  </div>
  <!-- /.box -->




  <script>
      // -------------
  // - PIE CHART -
  // -------------
  // Get context with jQuery - using jQuery's .get() method.
  var pieChartCanvas = $('#pieChart').get(0).getContext('2d');
  var pieChart       = new Chart(pieChartCanvas);
  var PieData        = [
    <?php 

     for ($i=0; $i < 7; $i++) { 
        echo "{
          value    : ".$array_booked_seats[$i].",
          color    : '".$colors[$i]."',
          highlight: '".$colors[$i]."',
          label    : '".$array_cat_name[$i]."'
        },";

     }

     ?>
  ];
  var pieOptions     = {
    // Boolean - Whether we should show a stroke on each segment
    segmentShowStroke    : true,
    // String - The colour of each segment stroke
    segmentStrokeColor   : '#fff',
    // Number - The width of each segment stroke
    segmentStrokeWidth   : 1,
    // Number - The percentage of the chart that we cut out of the middle
    percentageInnerCutout: 50, // This is 0 for Pie charts
    // Number - Amount of animation steps
    animationSteps       : 100,
    // String - Animation easing effect
    animationEasing      : 'easeOutBounce',
    // Boolean - Whether we animate the rotation of the Doughnut
    animateRotate        : true,
    // Boolean - Whether we animate scaling the Doughnut from the centre
    animateScale         : false,
    // Boolean - whether to make the chart responsive to window resizing
    responsive           : true,
    // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
    maintainAspectRatio  : false,
    // String - A legend template
    legendTemplate       : '<ul class=\'<%=name.toLowerCase()%>-legend\'><% for (var i=0; i<segments.length; i++){%><li><span style=\'background-color:<%=segments[i].fillColor%>\'></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>',
    // String - A tooltip template
    tooltipTemplate      : '<%=label%> - <%=value %> seat(s)'
  };
  // Create pie or douhnut chart
  // You can switch between pie and douhnut using the method below.
  pieChart.Doughnut(PieData, pieOptions);
  // -----------------
  // - END PIE CHART -
  // 
  </script>