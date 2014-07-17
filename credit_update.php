<?php

session_start();
require_once('connection.php');

$username = $_POST['username'];
$inc_service_credits = $_POST['servicecredits'];
$inc_donation_credits = $_POST['donationcredits'];

$new_service_credits = $_SESSION['SESS_SERVICECREDS'] + $inc_service_credits;
$new_donation_credits = $_SESSION['SESS_DONATIONCREDS'] + $inc_donation_credits;

$qry = "UPDATE details SET servicecreds='$new_service_credits', donationcreds='$new_donation_credits' WHERE username='$username'";
$result=mysql_query($qry);

if($result){
    $_SESSION['SUCCESS_CRED_MSG'] = 'Credits updated!';
    echo '<script type="text/javascript">window.location="http://www.waynehillsnhs.org/home.php";</script>';
}
else{
    $_SESSION['ERR_CRED_MSG'] = 'Failed!';
    echo '<script type="text/javascript">window.location="http://www.waynehillsnhs.org/home.php";</script>';
}
?>