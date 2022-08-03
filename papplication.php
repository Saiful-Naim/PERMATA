<?php
include("connection.php");
session_start();
use PHPMailer\PHPMailer\PHPMailer;

include('PHPMailer/src/PHPMailer.php');
include('PHPMailer/src/SMTP.php');
include('PHPMailer/src/Exception.php');

// $activity_no = $_POST['activity_no'];//activity - activity_no
$activity_name = $_POST['activity_name'];//activity - activity_name
$organization_id = $_POST['organization_id'];//activity - organization_code
$level_name = $_POST['level_name'];//activity - level_id
//$organizer_name = $_POST['organizer_name'];//activity - organizer_name
$coorganizer_name = $_POST['coorganizer_name'];//activity - coorganizer
$objective = $_POST['objective'];//category - objective
$purpose = $_POST['purpose'];//activity - purpose
$activity_background = $_POST['activity_background'];//activity - activity_background
$committee = $_POST['committee'];//committee
$category_id = $_POST['category_id'];//activity_category - category_id                        +(activity_category_id,     activity_no,     category_id)                                       3
$date = $_POST['date'];//activity - activity_date
$position = $_POST['position'];//activity - committee                                             5
$cgpa = $_POST['cgpa'];//activity - currentcgpa
$club_advisor_name = $_POST['club_advisor_name'];//activity - club_advisor_name
$club_advisor_email = $_POST['club_advisor_email_1'];//activity - club_advisor_email
$escort_officer = $_POST['escort_officer'];//activity - escort_officer
$maleparticipant = $_POST['maleparticipant'];//activity - total_men
$femaleparticipant = $_POST['femaleparticipant'];//activity - total_women
$organizergoal = $_POST['organizergoal'];//activity - KI_organizer
$participantgoal = $_POST['participantgoal'];//activity - KI_participant
$conclusion = $_POST['conclusion'];//activity - activity_conclusion

$reservationdate = date("Y-m-d", strtotime($date));
$studno =  $_SESSION['studentno'];
$applicationstatus = 'DIPROSES';
$user_id=NULL;

$sql = "INSERT INTO activity (activity_name, objective, purpose, activity_date, activity_background, total_men, total_women, club_advisor_name, club_advisor_email, escort_officer, committee, application_status, studentno, USER_ID, currentcgpa, position, level_id, KI_organizer, KI_participant, activity_conclusion, coorganizer, organization_id) VALUES('".$activity_name."','".$objective."','".$purpose."','".$reservationdate."','".$activity_background."','".$maleparticipant."','".$femaleparticipant."','".$club_advisor_name."','".$club_advisor_email."','".$escort_officer."','".$committee."','".$applicationstatus."','".$studno."','".$user_id."','".$cgpa."','".$position."','".$level_name."','".$organizergoal."','".$participantgoal."','".$conclusion."','".$coorganizer_name."','".$organization_id."')";
$query_run = mysqli_query($conn,$sql);

$sql1 = "INSERT INTO activity_category (activity_category_id, category_id, activity_no)
SELECT activity_no,'$category_id' , activity_no
FROM activity 
WHERE activity_name = '".$activity_name."';";
$query_run = mysqli_query($conn,$sql1);

if($query_run)
{
    $_SESSION['status'] = "Permohonan anda telah berjaya dihantar. Sila tunggu keputusan melalui email.";
    $name = "Test";  // Name of your website or yours
    $to = $club_advisor_email;  // mail of reciever
    $subject = "Test PERMATA";
    $body = "Test. Permohonan Anda telah berjaya dihantar. Sila tunggu keputusan yang akan dihantar melalui email.";
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
    header('Location: pages/forms/general.php');

}
else
{
    echo "ssss";
}
// header('Location: pages/forms/general.php');
?>