<?php
session_start();
if(!isset($_SESSION['SESS_USERNAME']) && (trim($_SESSION['SESS_USERNAME']) == '')){
    echo'<script type="text/javascript">alert("NO USERNAME SET");</script>';    
    //echo'<script type="text/javascript"> document.location="http://waynehillsnhs.org/login.php";</script>';
    //die();
}
//require_once('auth.php');
require_once('connection.php');
include('vars.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>My NHS</title>
</head>
 
<body>
You are now logged in as 
<?php 
echo $_SESSION['SESS_USERNAME'];
echo '<br>';
?>

<!--Displays if the user is just a member-->
<?php
if($_SESSION['SESS_POSITION'] == 'member'){
    echo 'You have '.$_SESSION['SESS_SERVICECREDS'].' service credits and '.$_SESSION['SESS_DONATIONCREDS']. ' donation credits.';
    echo '<br>';
    if($_SESSION['SESS_YEAR'] == 1){
        $credits_needed = $fycreditsneeded;
    }
    else if($_SESSION['SESS_YEAR'] == 2){
        $credits_needed = $sycreditsneeded;
    }
    
    if(($_SESSION['SESS_SERVICECREDS']+$_SESSION['SESS_DONATIONCREDS']) >= $credits_needed){
        echo '<img src="check.png" alt="Good to go!">';
    }
    else{
        echo '<img src="wrong.png" alt="You still need more!">';
    }
}
?>

<!--Displays to all officers-->
<?php if($_SESSION['SESS_POSITION'] != 'member') { ?>
<h1>Member Registration</h1>
<!--This part displays if there are any errors with the form submission-->
<?php
if(isset($_SESSION['ERRMSG_REG_ARR']) && is_array($_SESSION['ERRMSG_REG_ARR']) && count($_SESSION['ERRMSG_REG_ARR']) >0 ){
    echo '<ul>';
	foreach($_SESSION['ERRMSG_REG_ARR'] as $msg){
		echo '<li>',$msg,'</li>';
	}
	echo '</ul>';
	unset($_SESSION['ERRMSG_REG_ARR']);
}
?>
<form method="post" action="member_registration.php">
    Username
    <input type="text" name="username" size="40" /><br />
    Password
    <input type="text" name="password" size="40" /><br/>
    <input type="radio" name="year" value="1">First Year</input>
    <input type="radio" name="year" value="2">Second Year</input><br/>
    <input id="button" type="submit" name="submit" value="Submit" />
</form>
<?php } ?>

<!--Displays if the user is a credit officer-->
<?php if( ($_SESSION['SESS_POSITION'] == 'fycro') || ($_SESSION['SESS_POSITION'] == 'sycro')) { ?>
<h1>Credit Updater</h1>
<form method="post" action="credit_update.php">
    Username
    <input type="text" name="username" size="40"/><br/>
    Increment<br/>
    <input type="number" placeholder="Service Credits" name="servicecredits" /><br/>
    <input type="number" placeholder="Donation Credits" name="donationcredits" /><br/>
    <input id="button" type="submit" name="submit" value="Update" />
</form>
<?php } ?>

<!--Displays if the user is a first year credit officer-->
<?php if( ($_SESSION['SESS_POSITION'] == 'fycro') ) { ?>
<h1>Credit Statistics (First Year)</h1>
<?php
$qry = "SELECT * FROM details WHERE servicecreds+donationcreds>='$fycreditsneeded' AND year=1 AND position='member'";
$result = mysql_query($qry);
if($result){
    $amount_completed= mysql_num_rows($result);
    echo $amount_completed.' first year members have completed their credits. '.'<a href="fy_complete_list.php">Who?</a><br/>';
}
else{
    echo '<script type="text/javascript"> alert("FAILED QUERY!");</script>';
}
$qry = "SELECT * FROM details WHERE year=1 AND position='member'";
$result = mysql_query($qry);
if($result){
    $total_fy_members=mysql_num_rows($result);
    echo $total_fy_members-$amount_completed.' first year members have NOT completed their credits. '.'<a href="fy_incomplete_list.php">Who?</a><br/>';
}
?>
<?php } ?>

<!--Displays if the user is a second year credit officer-->
<?php if( ($_SESSION['SESS_POSITION'] == 'sycro') ) { ?>
<h1>Credit Statistics (Second Year)</h1>
<?php
$qry = "SELECT * FROM details WHERE servicecreds+donationcreds>='$sycreditsneeded' AND year=2 AND position='member'";
$result = mysql_query($qry);
if($result){
    $amount_completed= mysql_num_rows($result);
    echo $amount_completed.' second year members have completed their credits. '.'<a href="sy_complete_list.php">Who?</a><br/>';
}
else{
    echo '<script type="text/javascript"> alert("FAILED QUERY!");</script>';
}
$qry = "SELECT * FROM details WHERE year=2 AND position='member'";
$result = mysql_query($qry);
if($result){
    $total_fy_members=mysql_num_rows($result);
    echo $total_fy_members-$amount_completed.' second year members have NOT completed their credits. '.'<a href="sy_incomplete_list.php">Who?</a><br/>';
}
?>
<?php } ?>

<!--Displays if the user is a tutoring officer-->
<?php if( ($_SESSION['SESS_POSITION'] == 'tutoring')) { ?>
<h1>Tutoring Updater</h1>
<!--This part displays if there are any errors with the form submission-->
<?php
if(isset($_SESSION['ERRMSG_TUT_ARR']) && is_array($_SESSION['ERRMSG_TUT_ARR']) && count($_SESSION['ERRMSG_TUT_ARR']) >0 ){
    echo '<ul>';
	foreach($_SESSION['ERRMSG_TUT_ARR'] as $msg){
		echo '<li>',$msg,'</li>';
	}
	echo '</ul>';
	unset($_SESSION['ERRMSG_TUT_ARR']);
}
?>
<form method="post" action="tutoring_update.php">
    Username
    <input type="text" name="username" size="40"/><br/>
    <input type="submit" name="submit" value="Update" />
</form>
<?php } ?>

<!--Displays if the user is a tutoring officer-->
<?php if( ($_SESSION['SESS_POSITION'] == 'tutoring' )) { ?>
<h1>Tutoring Statistics</h1>
<?php
$qry = "SELECT * FROM details WHERE position='member' AND tutoring=1";
$result = mysql_query($qry);
if($result){
    $amount_tutored = mysql_num_rows($result);
    echo $amount_tutored.' members have completed their tutoring requirements. '.'<a href="complete_tutoring.php">Who?</a><br/>';
}
else{
    echo '<script type="text/javascript"> alert("FAILED QUERY!");</script>';
}
$qry = "SELECT * FROM details WHERE position='member' AND tutoring=0";
$result = mysql_query($qry);
if($result){
    $amount_not_tutored=mysql_num_rows($result);
    echo $amount_not_tutored.' members have NOT completed their tutoring requirements. '.'<a href="incomplete_tutoring.php">Who?</a><br/>';
}
?>
<?php } ?>

<p align="center"><a href="login.php">logout</a></p>
</body>
</html>