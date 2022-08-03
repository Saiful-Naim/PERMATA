<?php
include("connection.php");
session_start();

$activity_name = $_POST['activity_no'];//activity - activity_name
$organization_id = $_POST['organization_id'];//activity - organization_code
$level_name = $_POST['level_name'];//activity - level_id
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
$club_advicor_email = $_POST['club_advisor_email_1'];//activity - club_advisor_email
$escort_officer = $_POST['escort_officer'];//activity - escort_officer
$maleparticipant = $_POST['maleparticipant'];//activity - total_men
$femaleparticipant = $_POST['femaleparticipant'];//activity - total_women
$organizergoal = $_POST['organizergoal'];//activity - KI_organizer
$participantgoal = $_POST['participantgoal'];//activity - KI_participant
$conclusion = $_POST['conclusion'];//activity - activity_conclusion

$reservationdate = date("Y-m-d", strtotime($date));
$studno =  $_SESSION['studentno'];
$applicationstatus = 'processing';
$user_id=NULL;

$sql = "INSERT INTO activity (activity_name, objective, purpose, activity_date, activity_background, total_men, total_women, club_advisor_name, club_advisor_email, escort_officer, committee, application_status, studentno, USER_ID, currentcgpa, position, level_id, KI_organizer, KI_participant, activity_conclusion, coorganizer, organization_id) VALUES('".$activity_name."','".$objective."','".$purpose."','".$reservationdate."','".$activity_background."','".$maleparticipant."','".$femaleparticipant."','".$club_advisor_name."','".$club_advicor_email."','".$escort_officer."','".$committee."','".$applicationstatus."','".$studno."','".$user_id."','".$cgpa."','".$position."','".$level_name."','".$organizergoal."','".$participantgoal."','".$conclusion."','".$coorganizer_name."','".$organization_id."')";
mysqli_query($conn,$sql);

$sql1 = "INSERT INTO activity_category (activity_category_id, category_id, activity_no)
SELECT activity_no,'$category_id' , activity_no
FROM activity 
WHERE activity_name = '".$activity_name."';";
mysqli_query($conn,$sql1);


header('location: pages/forms/general.php');
echo "<script language='javascript'>alert(Application is successful.');window.location='dashboard.php';</script>";
?>