<?php
require_once('auth.php');
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
print $_SESSION['SESS_USERNAME'];
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
<h1>Credit Update</h1>
<form method="post" action="credit_update.php">
    Username
    <input type="text" name="username" size="40"/><br/>
    Increment<br/>
    <input type="number" placeholder="Service Credits" name="servicecredits" /><br/>
    <input type="number" placeholder="Donation Credits" name="donationcredits" /><br/>
    <input id="button" type="submit" name="submit" value="Update" />
</form>
<?php } ?>

<p align="center"><a href="login.php">logout</a></p>
</body>
</html>