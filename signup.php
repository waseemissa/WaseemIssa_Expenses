<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Expense Tracker</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="images/icons/favicon.ico" />
    <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
    <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
    <link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
    <link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
    <link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
    <link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" type="text/css" href="css/util.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">

</head>

<body style="background-color: #666666;">

    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <form method="POST" action="php/signup.php" class="login100-form validate-form">

                    <span class="login100-form-title p-b-43">
                        <h1>Expenses Manager</h1>
                    </span>

                    <span class="login100-form-title p-b-43">
                        Sign up to continue
                    </span>

                    <div class="wrap-input100">
                        <input id="input_first_name" class="input100" type="text" name="first_name">
                        <span class="focus-input100"></span>
                        <span id="first_name" class="label-input100">First Name</span>
                    </div>

                    <div class="wrap-input100">
                        <input id="input_last_name" class="input100" type="text" name="last_name">
                        <span class="focus-input100"></span>
                        <span id="last_name" class="label-input100">Last Name</span>
                    </div>

                    <div class="wrap-input100">
                        <input id="input_email" class="input100" type="text" name="email">
                        <span class="focus-input100"></span>
                        <span id="email" class="label-input100">Email</span>
                    </div>

                    <div class="wrap-input100">
                        <input id="input_date_of_birth" class="input100" type="text" name="date_of_birth">
                        <span class="focus-input100"></span>
                        <span id="date_of_birth" class="label-input100">Date of Birth</span>
                    </div>


                    <div class="wrap-input100">
                        <input id="input_password" class="input100" type="password" name="password">
                        <span class="focus-input100"></span>
                        <span id="password" class="label-input100">Password</span>
                    </div>

                    <div class="wrap-input100">
                        <input id="input_confirm_password" class="input100" type="password" name="confirm_password">
                        <span class="focus-input100"></span>
                        <span id="confirm_password" class="label-input100">Confirm Password</span>
                    </div>

                    <div id="error" class="alert alert-light" role="alert">
                        <?php
                                if(isset($_SESSION['first_name_error']))
                                    echo nl2br($_SESSION['first_name_error']."\n");
                                if(isset($_SESSION['last_name_error']))
                                    echo nl2br($_SESSION['last_name_error']."\n");
                                if(isset($_SESSION['email_error']))
                                    echo nl2br($_SESSION['email_error']."\n");
                                if(isset($_SESSION['error_email']))
                                    echo nl2br($_SESSION['error_email']."\n");
                                if(isset($_SESSION['password_error']))
                                    echo nl2br($_SESSION['password_error']."\n");
                                if(isset($_SESSION['confirm_password_error']))
                                    echo nl2br($_SESSION['confirm_password_error']."\n");
                                if(isset($_SESSION['age_error']))
                                    echo nl2br($_SESSION['age_error']."\n");
                            ?>
                    </div>


                    <div class="container-login100-form-btn">
                        <button id="btn_submit" class="login100-form-btn">
                            Sign Up
                        </button>
                    </div>

                    <div class="text-center p-t-46 p-b-20">
                        <span class="txt2">
                            Already have an account?
                        </span>
                    </div>

                    <div class="login100-form-social flex-c-m">
                        <a href="index.php"><i aria-hidden="true">Login</i></a>
                    </div>
                </form>

                <div class="login100-more" style="background-image: url('images/expenses_bg.jpg');">
                </div>
            </div>
        </div>
    </div>

    <script src="vendor/jquery/jquery-3.2.1.min.js"></script>
    <script src="js/login_signup_script.js"></script>
    <script src="vendor/animsition/js/animsition.min.js"></script>
    <script src="vendor/bootstrap/js/popper.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="vendor/select2/select2.min.js"></script>
    <script src="vendor/daterangepicker/moment.min.js"></script>
    <script src="vendor/daterangepicker/daterangepicker.js"></script>
    <script src="vendor/countdowntime/countdowntime.js"></script>
    <script src="js/main.js"></script>

</body>

</html>