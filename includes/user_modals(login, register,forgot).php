
<!--Login modal-->
<div class="modal fade" id="login_modal">
    <div class="modal-dialog">
        <div class="modal-form login modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
                <h4 class="modal-title">Login To Your Account</h4>
            </div>

            <div class="modal-body">
                <?php

                  if (isset($_POST['signin-submit'])) {
                   $email    = escape($_POST['signin-email']);
                   $password = escape($_POST['signin-password']);

                   $error = [
                        '_email' => '',
                        '_password' => ''
                   ];

                   if (!email_exists($email)) {
                       $error['_email'] = '* Email does not exists';
                   }

                   foreach ($error as $key => $value) {
                      if (empty($value)) {
                        unset($error[$key]);
                    }
                }

                if (empty($error)) {
                   login_customer($email, $password);

                }

               }

                 ?>

                <form action="" method="POST">

                    <div class="form-group">
                        <input type="signin-email" name="signin-email" id="signin-email" class="form-control" required value="<?php echo isset($email) ? $email : '' ?>" placeholder="Email">
                        <p class="text-danger"><?php echo isset($error['_email']) ? $error['_email'] : '' ?></p>
                    </div>
                    <div class="form-group">
                        <input type="password" name="signin-password" id="signin-password" class="form-control" required value="<?php echo isset($password) ? $password : '' ?>" placeholder="Password">
                        <p class="text-danger"><?php echo isset($error['_password']) ? $error['_password'] : '' ?></p>
                    </div>

                    <input type="submit" name="signin-submit" class="btn btn-success btn-block" value="Login">

                    <div class="text-center mt-3">
                        <a href="#" data-toggle="modal" data-target="#register_modal" data-dismiss="modal">
                            Register
                        </a>
                        &nbsp;&nbsp; | &nbsp;&nbsp;
                        <a href="#" data-toggle="modal" data-target="#forgot_modal" data-dismiss="modal">
                            Forgot Password
                        </a>
                    </div>

                </form>
            </div>

        </div>
    </div>
</div>


<!--register modal-->

<div class="modal fade" id="register_modal">
    <div class="modal-dialog">
        <div class="modal-form register modal-content">
            <div class="modal-header">
                <button class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
                <h4 class="modal-title">Register Account</h4>
            </div>

            <div class="modal-body">

                <?php
                    if (isset($_POST['register-submit'])){

                     $f_name      = escape($_POST['f_name']);
                     $l_name      = escape($_POST['l_name']);
                     $email       = escape($_POST['email']);
                     $password    = escape($_POST['password']);
                     $confirmpass = escape($_POST['confirm-password']);
                     $phone       = escape($_POST['phone']);
                     $city        = escape($_POST['city']);
                     $street      = escape($_POST['street']);
                     $postal_code = escape($_POST['postal_code']);

                     $error = [
                        'email' => '',
                        'password' => '',
                        'confirmpass' => '',
                        'phone' => ''
                     ];

                    if (email_exists($email)) {
                        $error['email'] = '* Email already exists';
                    }
                    if (strlen($password) < 6) {
                        $error['password'] = '* Password cannot be less than 6 characters';
                    }
                    if ($password !== $confirmpass) {
                        $error['confirmpass'] = '* Password do not match';
                    }
                    if (strlen($phone) < 10) {
                        $error['phone'] = '* Invalid phone number';
                    }

                    foreach ($error as $key => $value) {
                        if (empty($value)) {
                            unset($error[$key]);
                        }
                    }

                    if (empty($error)) {
                        register_customer($f_name, $l_name, $email, $password, $phone, $city, $street, $postal_code);

                    }

                 }
                 ?>

                <form action="" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                          <input type="text" name="f_name" id="f_name" class="form-control" required
                            value="<?php echo isset($f_name) ? $f_name : '' ?>" placeholder="First Name">
                        </div>
                        <div class="form-group">
                            <input type="text" name="l_name" id="l_name" class="form-control" required
                            value="<?php echo isset($l_name) ? $l_name : '' ?>" placeholder="Last Name">
                        </div>
                         <div class="form-group">
                            <input type="email" name="email" id="email" class="form-control" required
                             value="<?php echo isset($email) ? $email : '' ?>" placeholder="Email">
                              <p class="text-danger"><?php echo isset($error['email']) ? $error['email'] : '' ?></p>
                        </div>
                        <div class="form-group">
                            <input type="password" name="password" id="password" class="form-control" required
                             value="<?php echo isset($password) ? $password : '' ?>" placeholder="Password">
                            <p class="text-danger"><?php echo isset($error['password']) ? $error['password'] : ''?></p>
                        </div>
                        <div class="form-group">
                            <input type="password" name="confirm-password" id="confirm-password" class="form-control" required value="<?php echo isset($confirmpass) ? $confirmpass : '' ?>" placeholder="Confirm password">
                            <p class="text-danger"><?php echo isset($error['confirmpass']) ? $error['confirmpass'] : '' ?></p>
                        </div>
                         <div class="form-group">
                            <input type="number" name="phone" id="phone" class="form-control" required
                            value="<?php echo isset($phone) ? $phone : '' ;?>" placeholder="Phone">
                            <p class="text-danger"><?php echo isset($error['phone']) ? $error['phone'] : '' ?></p>
                        </div>
                        <div class="form-group">
                            <input type="text" name="city" id="city" class="form-control"
                            value="<?php echo isset($city) ? $city : '' ?>" placeholder="City">
                        </div>
                        <div class="form-group">
                            <input type="text" name="street" id="street" class="form-control"
                            value="<?php echo isset($street) ? $street : '' ?>" Placeholder="Street">
                        </div>
                        <div class="form-group">
                            <input type="text" name="postal_code" id="postal_code" class="form-control"
                            value="<?php echo isset($postal_code) ? $postal_code : '' ?>" placeholder="Postal Code">
                        </div>

                        <input type="submit" name="register-submit" class="btn btn-success btn-block" value="Register">


                </form>
            </div>
        </div>
    </div>
</div>


<!--Forgot modal-->
<div class="modal fade" id="forgot_modal">
    <div class="modal-dialog">
        <div class="modal-form forgot modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
                <h4 class="modal-title">Forgot Password</h4>
            </div>

            <div class="modal-body">
                <p class="text-muted text-center mb-2">
                    Enter your profile email and we will send a password reset link
                </p>
                <form action="" method="post">
                    <div class="form-group">
                        <input type="text" class="form-control" name="forgot_email" placeholder="Enter Your email">
                    </div>
                    <input type="submit" name="forgot" class="btn btn-success btn-block">
                    <p class="text-muted text-center mt-3">
                        Not a member yet ?
                        <a href="#" data-toggle="modal" data-target="#register_modal" data-dismiss="modal">
                            Join now
                        </a>
                    </p>
                </form>
            </div>
        </div>
    </div>
</div>



<!--Contact us modal-->
<div class="modal fade" id="contact_us_modal">
    <div class="modal-dialog">
        <div class="modal-form register modal-content">
            <div class="modal-header">
                <button class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
                <h4 class="modal-title">Contact Us</h4>
            </div>

            <div class="modal-body">
                <form action="" method="post">

                    <div class="form-group">
                        <label for="">Name</label>
                        <input type="text" class="form-control" name="name" required>
                    </div>

                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="email" class="form-control" name="email" required>
                    </div>

                    <div class="form-group">
                        <label for="">Subject</label>
                        <input type="text" class="form-control" name="subject" required>
                    </div>

                    <div class="form-group">
                        <label for="">Message</label>
                        <textarea name="message" class="form-control" id="" cols="30" rows="3"></textarea>
                    </div>


                    <input type="submit" name="submit" class="btn btn-success btn-block" value="Send Message">

                    </div>

                </form>
            </div>

        </div>
    </div>
</div>

