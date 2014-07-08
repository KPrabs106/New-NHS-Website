<?php

session_start();
require_once('connection.php');

$username = $_POST['username'];
$new_service_credits = $_POST['servicecredits'];
$new_donation_credits = $_POST['donationcredits'];

$qry = "UPDATE details SET servicecreds='$new_service_credits', donationcreds='$new_donation_credits' WHERE username='$username'";
$result=mysql_query($qry);

if($result){
    echo '<script type="text/javascript">alert("Success!\nThe credits were updated!");window.location="http://www.waynehillsnhs.org/home.php";</script>';
}
else{
    echo '<script type="text/javascript">alert("QUERY FAILED!\nNO UPDATE WAS MADE.");window.location="http://www.waynehillsnhs.org/home.php";</script>';

}
?>