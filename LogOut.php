<?php
session_start();
session_unset(); // Unset all session variables
session_destroy(); // Destroy the session
header("Location: Main_login.html"); // Redirect to the login page
exit();
?>