<?php
include("connection.php");
use PHPMailer\PHPMailer\PHPMailer;

include('PHPMailer/src/PHPMailer.php');
include('PHPMailer/src/SMTP.php');
include('PHPMailer/src/Exception.php');


session_start();
$activity_no = $_POST['activity_no'];
$studentemail = $_POST['studentemail'];

$jk = "SELECT s.studentemail 
        from activity a 
        join students s on s.studentno = a.studentno
        where a.activity_no = '$activity_no'";
mysqli_query($conn,$jk);
$qry=mysqli_query($conn,$jk);
$d = mysqli_fetch_assoc($qry);

$sql = "UPDATE activity SET application_status='APPROVED' WHERE activity_no='$activity_no';";
mysqli_query($conn,$sql);

if (($sql)) {
    $name = "Test";  // Name of your website or yours
    $to = $d['studentemail'];  // mail of reciever
    $subject = "Test PERMATA";
    $body = "Test. Permohonan anda telah diluluskan." ."<br>"."<br>"."<br>". "Email ini dijana secara automatik oleh sistem PERMATA dan tidak perlu dibalas.";
    $from = "fakhrulradzi200@gmail.com";  // you mail
    $password = "iixavhzahxunqzqa";  // your mail password

    $mail = new PHPMailer();

    // To Here

    //SMTP Settings
    $mail->isSMTP();
    // $mail->SMTPDebug = 3;  Keep It commented this is used for debugging                          
    $mail->Host = "smtp.gmail.com"; // smtp address of your email
    $mail->SMTPAuth = true;
    $mail->Username = $from;
    $mail->Password = $password;
    $mail->Port = 587;  // port
    $mail->SMTPSecure = "tls";  // tls or ssl
    $mail->smtpConnect([
    'ssl' => [
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
    ]
    ]);

    //Email Settings
        $mail->isHTML(true);
        $mail->setFrom($from, $name);
        $mail->addAddress($to); // enter email address whom you want to send
        $mail->Subject = ("$subject");
        $mail->Body = $body;
        if ($mail->send()) {
            echo "Email is sent!";
        } else {
            echo "Something is wrong: <br><br>" . $mail->ErrorInfo;
        }

        if (isset($_GET['sendmail'])) {
            sendmail();
        }
}


header('location:admin_approved.php');
echo "<script language='javascript'>alert(Application is successful.');window.location='dashboard.php';</script>";
?>