<?php
//save as plogout.php
session_start();
// session_unset();
unset($_SESSION['userlogged']); 
session_destroy();
header("Location: index.php");
?>