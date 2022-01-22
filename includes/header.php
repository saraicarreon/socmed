<?php

require 'config/config.php';

if (isset($_SESSION['username'])) {
    $userLoggedIn = $_SESSION['username'];
    $user_details_query = mysqli_query($con, "SELECT * FROM users WHERE username='$userLoggedIn'");
    $user = mysqli_fetch_array($user_details_query);
}
else {
    header("Location: register.php");
}

?>
        <title> Welcome to CATALOG </title>

        <!-- Javascript -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
        <script src="assets/js/bootstrap.js"></script>
        
        <!-- CSS -->
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="assets/css/style.css">

        <!-- Montserrat and Inconsolata Font -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inconsolata&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
        
    </head>
<body>
    
    <div>

    <div class="top_bar">
        <div class="logo">
        <h1><span style="color: #F1DD6F">CAT</span><span style="color: #DDAB4A">A</span><span style="color: #9F703D">LOG</span></h1>
        </div>

        <nav>
            <!-- <a href="#">
            <?php /* echo $user['first_name']; */ ?> 
            </a> -->

            <a href="settings.php">
            <img src="assets/images/icons/settingsic.png" alt="settings_icon" width="40" height="40" 
            style="margin-right:20px; margin-top:5px;"> 
            </a>
            
            <a href="includes/handlers/logout.php" id="logout_icon">
            <img src="assets/images/icons/logoutic.png" alt="logout_icon" width="40" height="40"
            style="margin-right:20px; margin-top:5px"> 
            </a>

        </nav>

    </div>

    <div class="wrapper">


