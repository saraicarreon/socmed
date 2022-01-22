<?php
ob_start(); //Turns on Output Buffering 
session_start();

$timezone = date_default_timezone_set("Etc/GMT+4"); //Time set in UAE

// Connecting the PHP file to Database
$con = mysqli_connect("localhost", "root", "", "socmedclone");

// If there's an error to connecting, system will display what the error was
if(mysqli_connect_errno()) {
    echo "Failed to connect: " . mymysqli_connect_errno();
}

?>