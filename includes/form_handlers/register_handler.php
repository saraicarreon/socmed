<?php 
// Declaring variables to prevent errors
$fname = ""; // First Name
$lname = ""; // Last Name
$em = ""; // Email
$em2 = ""; // Confirm Email
$password = ""; // Password
$password2 = ""; // Confirm Password
$date = ""; // Sign up date of the user
$error_array = array(); // Holds the error messages

// If this button has been pressed, then start having the form
if(isset($_POST['register_button'])) {

    /*Registration form values 
    $_POST stores the value from the form */

    //First Name
    $fname = strip_tags($_POST['register_fname']); // Removes HTML tags
    $fname = str_replace(' ','',$fname); // Removes spaces
    $fname = strtoupper($fname); //Uppercases the first letter
    $_SESSION['register_fname'] = $fname; //Stores frist name into session variable

    //Last Name
    $lname = strip_tags($_POST['register_lname']); // Removes HTML tags
    $lname = str_replace(' ','',$lname); // Removes spaces
    $lname = strtoupper($lname); //Uppercases the first letter
    $_SESSION['register_lname'] = $lname; //Stores frist name into session variable

     //Email
     $em = strip_tags($_POST['register_email']); // Removes HTML tags
     $em = str_replace(' ','',$em); // Removes spaces
     $em = strtolower($em); //Uppercases the first letter
     $_SESSION['register_email'] = $em; //Stores frist name into session variable

     //Confirm Email
     $em2 = strip_tags($_POST['register_email2']); // Removes HTML tags
     $em2 = str_replace(' ','',$em2); // Removes spaces
     $em2 = strtolower($em2); //Uppercases the first letter
     $_SESSION['register_email2'] = $em2; //Stores frist name into session variable

     //Password
     $password = strip_tags($_POST['register_password']); // Removes HTML tags
     $password2 = strip_tags($_POST['register_password2']); // Removes HTML tags

     //Date
     $date = date("Y-m-d"); // Gets current date

     if($em == $em2) {
        //Checks if email is in valid format
        if(filter_var($em, FILTER_VALIDATE_EMAIL)) {
        
            $em = filter_var($em, FILTER_VALIDATE_EMAIL);
        
            //Checks if email already exists
            $e_check = mysqli_query($con, "SELECT email FROM users WHERE email='$em'");

            //Count the number of rows returned
            $num_rows = mysqli_num_rows($e_check); 

            //Shows that the email has been used
            if($num_rows > 0) {
                array_push ($error_array, "Email already in use <br>");
            }
        
        }
        else {
            array_push ($error_array, "Invalid email format <br>");
        }
    }
     else {
        array_push ($error_array, "Emails dont match <br>");
    }

     //Output if user input with characters in First name is not right
     if(strlen($fname) > 25 || strlen($fname) < 2) {
        array_push ($error_array, "Your first name must be between 2 and 25 characters <br>");
     }

     //Output if user input with characters in Last name is not right
     if(strlen($lname) > 25 || strlen($lname) < 2) {
        array_push ($error_array, "Your last name must be between 2 and 25 characters <br>");
    }

    //Output if user input in password is not right
    if($password != $password2) {
        array_push ($error_array, "Your passwords do not match <br>");
    }

    else {
        //Checks if the characters that are input are between A-Z,a-z,0-9 to validate it
        if(preg_match('/[^A-Za-z0-9]/', $password)) {
            //Output if the validates characters are not the user input
            array_push ($error_array, "Your passwords can only contain English characters or numbers <br>");
        }
    }

     //Output if user input with password is not right
     if(strlen($password) > 30 || strlen($password) < 5) {
        array_push ($error_array, "Your passwords must be between 5 and 30 characters <br>");
    }

    if (empty($error_array)) {
        //Hides the password by encrypting in into the database
        $password = md5($password);

        //Generate username by connecting first name and last name
        $username = strtolower($fname . "_" . $lname);
        $check_username_query = mysqli_query($con, "SELECT username FROM users WHERE username='$username'");

        //If someone has a same username in the database, program will add 1

        $i = 0;
        //If username exists add number to username
        while(mysqli_num_rows($check_username_query) != 0) {
            $i++; // Add 1 to i
            $username = $username . "_" . $i;
            $check_username_query = mysqli_query($con, "SELECT username FROM users WHERE username='$username'");
        }

        //Profile picture asssignment
        $rand = rand(1,10); //Random number between 1 and 2

        if ($rand == 1)
        $profile_pic = "assets/images/pfps/defaults/catto1.png";
        else if ($rand == 2)
        $profile_pic = "assets/images/pfps/defaults/catto2.png";
        else if ($rand == 3)
        $profile_pic = "assets/images/pfps/defaults/catto3.png";
        else if ($rand == 4)
        $profile_pic = "assets/images/pfps/defaults/catto4.png";
        else if ($rand == 5)
        $profile_pic = "assets/images/pfps/defaults/catto5.png";
        else if ($rand == 6)
        $profile_pic = "assets/images/pfps/defaults/catto6.png";
        else if ($rand == 7)
        $profile_pic = "assets/images/pfps/defaults/catto7.png";
        else if ($rand == 8)
        $profile_pic = "assets/images/pfps/defaults/catto8.png";
        else if ($rand == 9)
        $profile_pic = "assets/images/pfps/defaults/catto9.png";
        else if ($rand == 10)
        $profile_pic = "assets/images/pfps/defaults/catto10.png";
        


        $query = mysqli_query($con, "INSERT INTO users VALUES ('', '$fname', '$lname', '$username', '$em', '$password', '$date', '$profile_pic', '0', '0', 'no')");

        array_push($error_array,"<span style= 'color: #14C800'> You're all set! Go ahead and login :) </span> <br>");

        //Clear session variables
        $_SESSION['register_fname'] = "";
        $_SESSION['register_lname'] = "";
        $_SESSION['register_email'] = "";
        $_SESSION['register_email2'] = "";

    }

}

?>