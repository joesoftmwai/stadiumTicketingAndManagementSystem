

<nav class="navbar navbar-default" id="navbar"> <!-- Navbar starts -->
    <div class="container">
        <div class="navbar-header">
        <a href="<?php echo $site_url; ?>/index.php" class="navbar-brand home pull-reft">
            <span class="logo">TicketInn</span>
        </a>

        <button type="button" class="navbar-toggle pull-right" data-toggle="collapse" data-target="#navigation">
            <span class="sr-only">Toggle Navigation</span>
            <i class="fa fa-align-justify"></i>
        </button>

        <!-- <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#search">
            <span class="sr-only">Toggle Search</span>
            <i class="fa fa-search"></i>
        </button>
 -->        </div>

        <div class="navbar-collapse collapse" id="navigation">
            <div class="padding-nav">
                <ul class="nav navbar-nav navbar-left">
                    <li>
                        <a href="<?php echo $site_url; ?>/index.php">Home</a>
                    </li>

                    <li>
                        <a href="#">About</a>
                    </li>

                    <li>
                        <a href="<?php echo $site_url; ?>/cart.php">Shopping Cart</a>
                    </li>
                    <li>
                        <a href="#" data-toggle="modal" data-target="#contact_us_modal">Contact Us</a>
                    </li>
                </ul>
            </div>

            <a href="<?php echo $site_url; ?>/cart.php" class=" navbar-btn right" id="cart-ml">
                <i class="fa fa-shopping-cart"></i>
                <span class="badge"> <?php items(); ?></span>
            </a>


            <div class="navbar-collapse collapse right">
                <div class="navbar-btn navbar-right" type="button" data-toggle="collapse" data-target="#search">
                    <span class="sr-only">Toggle Search</span>
                    <i class="fa fa-search"></i>
                </div>
            </div>



            <div class="collapse clearfix" id="search">
            <form action="search.php" method="post" class="navbar-form">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search Events" name="search_value" required="true">
                    <span class="input-group-btn">
                    <button type="submit" value="Search" name="submit_search" class="btn btn-primary">
                        <i class="fa fa-search"></i>
                    </button>
                    </span>

                </div>
            </form>
            </div>
                        
        </div>

    </div>
</nav><!-- Navbar ends -->


<!--user_modals(login, register, forgot) modals-->
<?php include "user_modals(login, register,forgot).php";?>