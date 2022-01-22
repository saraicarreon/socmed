<?php
require 'config/config.php';
require 'includes/form_handlers/register_handler.php';
require 'includes/form_handlers/login_handler.php';
?>

<html>
<head>
<title>Login and Register Form</title>
<link rel="stylesheet" type="text/css" href="assets/css/register_style.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script src="assets/js/register.js"></script>
</head>
<body>

<?php 

if(isset($_POST['register_button'])) {
    echo '
    <script>
    
    $(document).ready(function() {
        $("#first").hide();
        $("#second").show();
    });

    </script>
    ';
}

?>

<div class="login_box">

    <div contenteditable class="header_logintitle">
    <h1><span style="color: #DDAB4A">CAT</span><span style="color: #9F703D">A</span>LOG</h1>
    </div>

    <div id="first">
        <form action="register.php" method="POST" 
        style="font-family: 'Inconsolata', monospace;
        color:#585858;
        font-size: 13px;">

                <input type="email" name="log_email" placeholder="Email Address" <input type ="text" name="register_fname" placeholder="First Name" value="<?php 
                if (isset($_SESSION['log_email'])) {
                    echo $_SESSION['log_email'];
                }
                ?>" required>
                
                <br>

                <input type="password" name="log_password" placeholder="Password">
                
                <br>
                <input type="submit" 
                style= "font-family: 'Montserrat', sans-serif;
                background-color: #9F703D;
                font-weight:600;
                width: 70%;
                border-radius: 10px;
                margin: 5px 0 5px 0;
                padding: 11px 15px 11px 15px;
                color: #FFFFFFFF;"
                name="login_button" value="Login" name="login_button" value="Login">
                <br>

                
                <input type="button" name="submit[signup]"
                value="Register here!" id="signup" name="signup_button">

                <br>
                <?php if(in_array("Email or password was incorrect <br>",$error_array)) echo "Email or password was incorrect <br>"; ?>

            </form>
    </div>


    <div id="second">
        <!-- Register Form -->
        <form action="register.php" method="POST" 
        style="font-family: 'Inconsolata', monospace;
        color:#585858;
        font-size: 13px;">

            <input type ="text" name="register_fname" placeholder="First Name" value="<?php 
            if (isset($_SESSION['register_fname'])) {
                echo $_SESSION['register_fname'];
            }
            ?>" required>
            <br>
            <?php if(in_array("Your first name must be between 2 and 25 characters <br>", $error_array)) echo "Your first name must be between 2 and 25 characters <br>"; ?>


            <input type ="text" name="register_lname" placeholder="Last Name" value="<?php 
            if (isset($_SESSION['register_lname'])) {
                echo $_SESSION['register_lname'];
            }
            ?>" required>
            <br>
            <?php if(in_array("Your last name must be between 2 and 25 characters <br>", $error_array)) echo "Your last name must be between 2 and 25 characters <br>"; ?>



            <input type ="email" name="register_email" placeholder="Email" value="<?php 
            if (isset($_SESSION['register_email'])) {
                echo $_SESSION['register_email'];
            }
            ?>" required>
            <br>
            
            <input type ="email" name="register_email2" placeholder="Confirm Email" value="<?php 
            if (isset($_SESSION['register_email2'])) {
                echo $_SESSION['register_email2'];
            }
            ?>" required>
            <br>
            <?php if(in_array("Email already in use <br>", $error_array)) echo "Email already in use <br>"; 
            else if(in_array("Invalid email format <br>", $error_array)) echo "Invalid email format <br>"; 
            else if(in_array("Emails dont match <br>", $error_array)) echo "Emails dont match <br>"; ?>


            <input type ="password" name="register_password" placeholder="Password" required>
            <br>
            <?php if(in_array("Your passwords do not match <br>", $error_array)) echo "Your passwords do not match <br>"; 
            else if(in_array("Your passwords can only contain English characters or numbers <br>", $error_array)) echo "Your passwords can only contain English characters or numbers <br>"; 
            else if(in_array("Your passwords must be between 5 and 30 characters <br>", $error_array)) echo "Your passwords must be between 5 and 30 characters <br>"; ?>

            <input type ="password" name="register_password2" placeholder="Confirm Password" required>
            <br>
            <input type="submit" style="font-family: 'Montserrat', sans-serif;
            background-color: #9F703D;
            font-weight:600;
            width: 70%;
            border-radius: 10px;
            margin: 5px 0 5px 0;
            padding: 11px 15px 11px 15px;
            color: #FFFFFFFF;"          
            name="register_button" value="Register">
            <br>
            
            <?php if(in_array("<span style= 'color: #14C800'> You're all set! Go ahead and login :) </span> <br>", $error_array)) echo "<span style= 'color: #14C800'> You're all set! Go ahead and login :) </span> <br>"; ?>
           
            <input type="button" name="submit[signin]"
            value="Sign in here!" id="signin" name="signin_button">
        
        </form>
    </div>

</div>
</body>
</html>