<?php

include('connection.php');
$username = mysqli_real_escape_string($conn,$_POST['studentno']);
$password = mysqli_real_escape_string($conn,$_POST['studenticno']);

$sql = "SELECT * FROM students WHERE studentno='".$username."' AND studenticno = '".$password."'";

$qry = mysqli_query($conn,$sql);
$row = mysqli_num_rows($qry);

if($row > 0) {
    $r = mysqli_fetch_assoc($qry);
    session_start();
    $_SESSION['userlogged'] = 1;
    $_SESSION['stat']="Active";
    $_SESSION['studentname'] = $r['studentname'];
    $_SESSION['studentno'] = $r['studentno'];
    $_SESSION['studentemail'] = $r['studentemail'];
    $_SESSION['studentphoneno'] = $r['studentphoneno'];
    header('Location: dashboard.php');
}
else {
    header('Location: index.php?error=1');
    echo "<script language='javascript'>alert('User does not exist.');window.location='index.php';</script>";
}
?>