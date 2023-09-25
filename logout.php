<?php
session_start();

// Unset all of the session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Redirect the user to the login page after logging out
header("Location: login.php");
exit(); // Ensure that the script stops here after the redirect