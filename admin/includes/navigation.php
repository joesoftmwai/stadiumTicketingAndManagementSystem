<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="index.php">Admin </a>
    </div>
    <!-- Top Menu Items -->
    <ul class="nav navbar-right top-nav">
        <li><a href="../index.php">Visit Website</a></li>
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $admin_name; ?> <b class="caret"></b></a>
            <ul class="dropdown-menu">
                <li>
                    <a href="index.php?edit_user=<?php echo  $admin_id; ?>"><i class="fa fa-fw fa-user"></i> Profile</a>
                </li>
                <li>
                    <a href="#"><i class="fa fa-fw fa-envelope"></i> Inbox</a>
                </li>
                <li>
                    <a href="#"><i class="fa fa-fw fa-gear"></i> Settings</a>
                </li>
                <li class="divider"></li>
                <li>
                    <a href="logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                </li>
            </ul>
        </li>
    </ul>

    <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
     <div class="collapse navbar-collapse navbar-ex1-collapse">
        <ul class="nav navbar-nav side-nav">
            <li>
                <a href="index.php?dashboard"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
            </li>

            <li>
                <a href="javascript:;" data-toggle="collapse" data-target="#demo"><i class="fa fa-fw fa-calendar"></i> Events <i class="fa fa-fw fa-caret-down"></i></a>
                <ul id="demo" class="collapse">
                    <li>
                        <a href="index.php?insert_event">Insert Event</a>
                    </li>
                    <li>
                        <a href="index.php?view_events">View Events</a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="javascript:;" data-toggle="collapse" data-target="#_demo"><i class="fa fa-fw fa-bar-chart-o"></i> Categories <i class="fa fa-fw fa-caret-down"></i></a>
                <ul id="_demo" class="collapse">
                    <li>
                        <a href="index.php?insert_category">Insert Category</a>
                    </li>
                    <li>
                        <a href="index.php?view_categories">View Categories</a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="index.php?view_customers">
                    <i class="fa fa-fw fa-edit"></i> Customers
                </a>
            </li>

            <li>
                <a href="index.php?view_orders"><i class="fa fa-fw fa-list"></i> Orders</a>
            </li>

            <li>
                <a href="index.php?view_payements"><i class="fa fa-fw fa-money"></i> Payements</a>
            </li>
            
            <li>
                <a href="javascript:;" data-toggle="collapse" data-target="#users"><i class="fa fa-fw fa-users"></i> Users<i class="fa fa-fw fa-caret-down"></i></a>
                <ul id="users" class="collapse">
                    <li>
                        <a href="index.php?insert_user">Insert User</a>
                    </li>
                    <li>
                        <a href="index.php?view_users">View Users</a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="javascript:;" data-toggle="collapse" data-target="#sliders"><i class="fa fa-fw fa-sliders"></i> Sliders<i class="fa fa-fw fa-caret-down"></i></a>
                <ul id="sliders" class="collapse">
                    <li>
                        <a href="index.php?insert_slider">Insert Slider</a>
                    </li>
                    <li>
                         <a href="index.php?view_sliders">View Sliders</a>
                    </li>
                </ul>
            </li>


            <li>
               
            </li>


            <li>
                 <a href="logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
            </li>
        </ul>
    </div>


    <!-- /.navbar-collapse -->
</nav>