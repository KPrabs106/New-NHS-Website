<?php

session_start();
require_once('connection.php');

$username = $_POST['username'];
$inc_service_credits = $_POST['servicecredits'];
$inc_donation_credits = $_POST['donationcredits'];


$qry = "SELECT servicecreds FROM details WHERE username='$username'";
$result = mysql_query($qry);
if($result){
	$row= mysql_fetch_assoc($result);
	$current_service_credits = $row['servicecreds']; 
}

$qry = "SELECT donationcreds FROM details WHERE username='$username'";
$result = mysql_query($qry);
if($result){
	$row= mysql_fetch_assoc($result);
	$current_donation_credits = $row['donationcreds']; 
}

$new_service_credits = $current_service_credits+$inc_service_credits;
$new_donation_credits = $current_donation_credits+$inc_donation_credits;


//$new_service_credits = $_SESSION['SESS_SERVICECREDS'] + $inc_service_credits;
//$new_donation_credits = $_SESSION['SESS_DONATIONCREDS'] + $inc_donation_credits;

//$qry = "UPDATE details SET servicecreds='$current_service_credits+$inc_service_credits', donationcreds='$current_donation_credits+$inc_donation_credits' WHERE username='$username'";
$qry = "UPDATE details SET servicecreds='$new_service_credits', donationcreds='$new_donation_credits' WHERE username='$username'";
//$qry = "UPDATE details SET servicecreds='servicecreds+$inc_service_credits' AND donationcreds='donationcreds+$inc_donation_credits' WHERE username='$username'";
$result=mysql_query($qry);

if($result){
    $_SESSION['SUCCESS_CRED_MSG'] = 'Credits updated!';
    echo '<script type="text/javascript">location.href="home.php";</script>';
}
else{
    $_SESSION['ERR_CRED_MSG'] = 'Failed!';
    echo '<script type="text/javascript">location.href="home.php";</script>';
}
?>