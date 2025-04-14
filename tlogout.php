<<?php
session_start();
require_once('conne.php');

// Prevent browser caching
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

// Unset all session variables and destroy the session
session_unset();
session_destroy();

// Redirect to login page
header("Location: tlogin.php");
exit();
?>
