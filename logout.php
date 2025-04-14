<?php
session_start();
require_once('conne.php');
session_destroy();
header("location:index.php");
exit();
?>