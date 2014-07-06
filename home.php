<?php
require_once('auth.php');
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
    if($_SESSION['SESS_YEAR'] == 1);
    //
    //$credits_needed = 
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
<?php if($_SESSION['SESS_POSITION'] == 'fycr') { ?>

<?php } ?>

<p align="center" class="style1">Login successfully </p>
<p align="center">This page is the home, you can put some stuff here......</p>
<p align="center"><a href="login.php">logout</a></p>
</body>
</html>