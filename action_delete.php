<?php
include("connection.php");
session_start();
$activity_no = $_GET['activity_no'];

$sql = "UPDATE activity SET application_status='DELETED' WHERE activity_no='$activity_no';";
mysqli_query($conn,$sql);


header('location:table_application.php');
echo "<script language='javascript'>alert(Application is successful.');window.location='dashboard.php';</script>";
?>