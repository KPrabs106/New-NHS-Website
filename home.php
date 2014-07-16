<?php
session_start();
require_once('auth.php');
require_once('connection.php');
include('vars.php');
?>
<!DOCTYPE html>
<html>
<head>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,400,700|Roboto:400,700,700italic,400italic' rel='stylesheet' type='text/css'>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/redmond/jquery-ui.css">
    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <script>
        $(function() {
            $("#usernameauto").autocomplete({
                source: "search.php",
                minLength: 2
            });
        });
    </script>
    <meta charset="UTF-8">
    <title>My NHS- Wayne Hills NHS</title>
</head>
 
<body>
<div id="header">
    <div>
        <div class="logo">
            <a href="index.html">NHS</a>
        </div>
        <ul id="navigation">
            <li>
                <a href="index.html">Home</a>
            </li>
            <li>
                <a href="news.html">News</a>
            </li>
            <li>
                <a href="about.html">About</a>
            </li>
            <li>
                <a href="contact.html">Contact</a>
            </li>
            <li class="active">
                <a href="home.php">My NHS</a>
            </li>
        </ul>
    </div>
</div>
<div id="contents">
    <div id="tagline" class="clearfix">
You are now logged in as  
<?php 
echo '<var>'.$_SESSION['SESS_USERNAME'].'</var>';
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
<form method="post" action="member_registration.php">
    <fieldset>
        <legend>Member Registration</legend>
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
    Username
    <input type="text" name="username" size="40" /><br />
    Password
    <input type="text" name="password" size="40" /><br/>
    <input type="radio" name="year" value="1">First Year</input>
    <input type="radio" name="year" value="2">Second Year</input><br/>
    <input id="button" type="submit" name="submit" value="Submit" />
    </fieldset>
</form>
<?php } ?>

<!--Displays if the user is a credit officer-->
<?php if( ($_SESSION['SESS_POSITION'] == 'fycro') || ($_SESSION['SESS_POSITION'] == 'sycro')) { ?>

<!--Credit Updater Form-->
<form method="post" action="credit_update.php">
    <fieldset>
        <legend>Credit Updater</legend>
        
            <label for="username">Username</label>
            <input type="text" name="username" size="40" id="usernameauto"/>
            <br/>
            Increment<br/>
            <input type="number" placeholder="Service Credits" name="servicecredits" /><br/>
            <input type="number" placeholder="Donation Credits" name="donationcredits" /><br/>
            <input id="button" type="submit" name="submit" value="Update" />
        
    </fieldset>
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
<form method="post" action="tutoring_update.php">
    <fieldset>
        <legend>Tutoring Updater</legend>
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
    <label for="username">Username</label>
    <input type="text" name="username" size="40" id="usernameauto"/><br/>
    <input type="submit" name="submit" value="Update" />
    </fieldset>
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
    </div>
</div>
<div id="footer">
		<div class="clearfix">
			<div id="connect">
				<a href="http://freewebsitetemplates.com/go/facebook/" target="_blank" class="facebook"></a><a href="http://freewebsitetemplates.com/go/googleplus/" target="_blank" class="googleplus"></a><a href="http://freewebsitetemplates.com/go/twitter/" target="_blank" class="twitter"></a><a href="http://www.freewebsitetemplates.com/misc/contact/" target="_blank" class="tumbler"></a>
			</div>
			<p>
				Designed by Kartik Prabhu
			</p>
		</div>
</div>
</body>
</html>