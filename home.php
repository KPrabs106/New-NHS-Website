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
    <link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.1/themes/blitzer/jquery-ui.min.css">
    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js"></script>
    <script src="js/jquery.tablesorter.min.js"></script>
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <link rel="stylesheet" href="js/tablesorter/style.css">
    <style>
    	td{
    		text-align:center;
    	}
    </style>
    <script>
    $(document).ready(function() 
    { 
        $("#myTable1").tablesorter();
        $("#myTable2").tablesorter(); 
        $("#myTable3").tablesorter(); 
        $("#myTable4").tablesorter();  
    } 
	); 
        $(function() {
            $("#usernameauto").autocomplete({
                source: "search.php",
                minLength: 2
            });
            $("#usernameauto2").autocomplete({
                source: "search.php",
                minLength: 2
            });
            
            $( "#accordion1" ).accordion({
	            collapsible: true,
	            heightStyle: "content"
	        });
	        
	        $( "#accordion2" ).accordion({
	            collapsible: true,
	            heightStyle: "content"
	        });
	        
	        $( "#accordion3" ).accordion({
	            collapsible: true,
	            heightStyle: "content"
	        });
        });
    </script>
    <meta charset="UTF-8">
    <title>My NHS- Wayne Hills NHS</title>
</head>
 
<body>
	<div id="wrapper">
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
		                <a href="files.html">Files</a>
		            </li>
		            <li>
		                <a href="tutoring.php">Tutoring</a>
		            </li>
		            <li>
		                <a href="contact.html">Contact</a>
		            </li>
		            <li class="active">
		                <a href="home.php">Log In</a>
		            </li>
		        </ul>
		    </div>
		</div>
		<div id="contents">
		    <div id="tagline" class="clearfix">
		    	<br/>
You are now logged in as  
<?php 
if($_SESSION['SESS_USERNAME'] == 'rishijashnani'){
	echo '<b><var><strike>rohitshinde</strike> rishijashnani.</var></b>';
}
else if($_SESSION['SESS_USERNAME'] == 'rohitshinde'){
	echo '<b><var><strike>rishijashnani</strike> rohitshinde.</var></b>';
}
else{
	echo '<b><var>'.$_SESSION['SESS_USERNAME'].'.</var></b> <a href="login.php"><button type="button">Logout</button></a>';
}
echo '<br><br>';
echo 'View the events Google Doc <a href="https://docs.google.com/spreadsheets/d/1Fa-2GjDTDqh9dTo3Mv1AjSLoy7Y3iopR9SWuvC0O6W8/edit?usp=sharing">here</a>!';
echo '<br><br>';
?>

<!--
<!--Displays if the user is just a member-->
<?php
if($_SESSION['SESS_POSITION'] == 'advisor'){
    echo 'You have &infin; service credits and &infin; donation credits.';
    echo '<br>';
	echo '<img src="check.png" alt="Good to go!">';
}

if($_SESSION['SESS_POSITION'] == 'member'){
    echo 'You have '.$_SESSION['SESS_SERVICECREDS'].' service credits and '.$_SESSION['SESS_DONATIONCREDS']. ' donation credits. ';
	if($_SESSION['SESS_TUTORING'] == 1){
		echo 'You have completed your tutoring requirement.';
	}
	else{
		echo 'You have NOT completed your tutoring requirement.';
	}
    echo '<br>';
    if($_SESSION['SESS_YEAR'] == 1){
        $credits_needed = $fycreditsneeded;
    }
    else if($_SESSION['SESS_YEAR'] == 2){
        $credits_needed = $sycreditsneeded;
    }
    
    if(($_SESSION['SESS_SERVICECREDS']+$_SESSION['SESS_DONATIONCREDS']) >= $credits_needed && $_SESSION['SESS_TUTORING'] == 1){
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
    echo '<p class="ui-state-error">';
    foreach($_SESSION['ERRMSG_REG_ARR'] as $msg){
        echo $msg,'<br/>';
    }
    unset($_SESSION['ERRMSG_REG_ARR']);
    echo'</p>';
}
if(isset($_SESSION['SUCCESS_REG_MSG'])){
    echo '<p class="ui-state-highlight">'.$_SESSION['SUCCESS_REG_MSG'].'</p>';
    unset($_SESSION['SUCCESS_REG_MSG']);
}
if(isset($_SESSION['ERR_REG_MSG'])){
    echo '<p class="ui-state-error">'.$_SESSION['ERR_REG_MSG'].'</p>';
    unset($_SESSION['ERR_REG_MSG']);
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
<?php if( ($_SESSION['SESS_POSITION'] == 'fycro') || ($_SESSION['SESS_POSITION'] == 'sycro') || $_SESSION['SESS_POSITION'] == 'advisor') { ?>
<!--Credit Updater Form-->
<form method="post" action="credit_update.php">
    <fieldset>
        <legend>Credit Updater</legend>
            <!--Displays problems-->
            <?php
            if(isset($_SESSION['SUCCESS_CRED_MSG'])){
                echo'<p class="ui-state-highlight">'.$_SESSION['SUCCESS_CRED_MSG'].'</p>';
                unset($_SESSION['SUCCESS_CRED_MSG']);
            }
            if(isset($_SESSION['ERR_CRED_MSG'])){
                echo'<p class="ui-state-error">'.$_SESSION['ERR_CRED_MSG'].'</p>';
                unset($_SESSION['ERR_CRED_MSG']);
            }
            ?>
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
<?php if( ($_SESSION['SESS_POSITION'] == 'fycro') || $_SESSION['SESS_POSITION'] == 'advisor') { ?>
<fieldset>
	<legend>Credits Details (First Year)</legend>

<?php
$qry = "SELECT * FROM details WHERE servicecreds+donationcreds>='$fycreditsneeded' AND year=1 AND position='member'";
$result = mysql_query($qry);
if($result){
    $amount_completed= mysql_num_rows($result);
    //echo $amount_completed.' first year members have completed their credits. '.'<a href="fy_complete_list.php">Who?</a><br/>';
    echo '<div id="accordion1" style="width:auto;">
	<h3>Members who have completed their credits. ('.$amount_completed.')</h3>
	<div>
	<p>';
	$qry = "SELECT username,servicecreds,donationcreds FROM details WHERE servicecreds+donationcreds>='$fycreditsneeded' AND year=1 AND position='member'";
	$result = mysql_query($qry);
	echo '<table id="myTable1" class="tablesorter">
			<thead>
			<tr>
				<th>Username</th>
				<th>Service Credits</th>
				<th>Donation Credits</th>
				<th>Total Credits</th>
			</tr>
			</thead>
			<tbody>';
	while($row = mysql_fetch_assoc($result)){
    	echo '<tr><td>'.$row['username'].'</td><td>'.$row['servicecreds'].'</td><td>'.$row['donationcreds'].'</td><td>'.($row['servicecreds']+$row['donationcreds']).'</tr>';
	}
	echo '</table>';
	echo '</p>
		</div>';
}
else{
    echo '<script type="text/javascript"> alert("FAILED QUERY!");</script>';
}
$qry = "SELECT * FROM details WHERE year=1 AND position='member'";
$result = mysql_query($qry);
if($result){
    $total_fy_members=mysql_num_rows($result);
    $amount_not_completed = $total_fy_members-$amount_completed;
    //echo $total_fy_members-$amount_completed.' first year members have NOT completed their credits. '.'<a href="fy_incomplete_list.php">Who?</a><br/>';
	    echo '<h3>Members who have NOT completed their credits. ('.$amount_not_completed.')</h3>
	<div>
	<p>';
	$qry = "SELECT username,servicecreds,donationcreds FROM details WHERE servicecreds+donationcreds<'$fycreditsneeded' AND year=1 AND position='member'";
	$result = mysql_query($qry);
	echo '<table id="myTable2" class="tablesorter">
			<thead>
			<tr>
				<th>Username</th>
				<th>Service Credits</th>
				<th>Donation Credits</th>
				<th>Total Credits</th>
			</tr>
			</thead>
			<tbody>';
	while($row = mysql_fetch_assoc($result)){
    	echo '<tr><td>'.$row['username'].'</td><td>'.$row['servicecreds'].'</td><td>'.$row['donationcreds'].'</td><td>'.($row['servicecreds']+$row['donationcreds']).'</tr>';
	}
	echo '</table>';
	echo '</p>
		</div>
		</div>';
}
?>
</fieldset>
<?php } ?>


<!--Displays if the user is a second year credit officer-->
<?php if( ($_SESSION['SESS_POSITION'] == 'sycro') || $_SESSION['SESS_POSITION'] == 'advisor' ) { ?>
<fieldset>
	<legend>Credits Details (Second Year)</legend>
<?php
$qry = "SELECT * FROM details WHERE servicecreds+donationcreds>='$sycreditsneeded' AND year=2 AND position='member'";
$result = mysql_query($qry);
if($result){
    $amount_completed= mysql_num_rows($result);
    //echo $amount_completed.' second year members have completed their credits. '.'<a href="sy_complete_list.php">Who?</a><br/>';
	echo '<div id="accordion2" style="width:auto;">
	<h3>Members who have completed their credits. ('.$amount_completed.')</h3>
	<div>
	<p>';
	$qry = "SELECT username,servicecreds,donationcreds FROM details WHERE servicecreds+donationcreds>='$sycreditsneeded' AND year=2 AND position='member'";
	$result = mysql_query($qry);
	echo '<table id="myTable3" class="tablesorter">
			<thead>
			<tr>
				<th>Username</th>
				<th>Service Credits</th>
				<th>Donation Credits</th>
				<th>Total Credits</th>
			</tr>
			</thead>
			<tbody>';
	while($row = mysql_fetch_assoc($result)){
    	echo '<tr><td>'.$row['username'].'</td><td>'.$row['servicecreds'].'</td><td>'.$row['donationcreds'].'</td><td>'.($row['servicecreds']+$row['donationcreds']).'</tr>';
	}
	echo '</table>';
	echo '</p>
		</div>
		';
}
else{
    echo '<script type="text/javascript"> alert("FAILED QUERY!");</script>';
}
$qry = "SELECT * FROM details WHERE year=2 AND position='member'";
$result = mysql_query($qry);
if($result){
    $total_sy_members=mysql_num_rows($result);
    $amount_not_completed = $total_sy_members-$amount_completed;
    //echo $total_fy_members-$amount_completed.' second year members have NOT completed their credits. '.'<a href="sy_incomplete_list.php">Who?</a><br/>';
	echo'<h3>Members who have NOT completed their credits. ('.$amount_not_completed.')</h3>
	<div>
	<p>';
	$qry = "SELECT username,servicecreds,donationcreds FROM details WHERE servicecreds+donationcreds<'$sycreditsneeded' AND year=2 AND position='member'";
	$result = mysql_query($qry);
	echo '<table id="myTable4" class="tablesorter">
			<thead>
			<tr>
				<th>Username</th>
				<th>Service Credits</th>
				<th>Donation Credits</th>
				<th>Total Credits</th>
			</tr>
			</thead>
			<tbody>';
	while($row = mysql_fetch_assoc($result)){
    	echo '<tr><td>'.$row['username'].'</td><td>'.$row['servicecreds'].'</td><td>'.$row['donationcreds'].'</td><td>'.($row['servicecreds']+$row['donationcreds']).'</tr>';
	}
	echo '</tbody>
			</table>';
	echo '</p>
		</div>
		</div>';
}
?>
</fieldset>
<?php } ?>

<!--Displays if the user is a tutoring officer-->
<?php if( ($_SESSION['SESS_POSITION'] == 'tutoring') || $_SESSION['SESS_POSITION'] == 'advisor' ) { ?>
<form method="post" action="tutoring_update.php">
    <fieldset>
        <legend>Tutoring Updater</legend>
<!--This part displays if there are any errors with the form submission-->
<?php
if(isset($_SESSION['SUCCESS_TUT_MSG'])){
    echo'<p class="ui-state-highlight">'.$_SESSION['SUCCESS_TUT_MSG'].'</p>';
    unset($_SESSION['SUCCESS_TUT_MSG']);
}
if(isset($_SESSION['ERR_TUT_MSG'])){
    echo'<p class="ui-state-error">'.$_SESSION['ERR_TUT_MSG'].'</p>';
    unset($_SESSION['ERR_TUT_MSG']);
}
?>
    <label for="username">Username</label>
    <input type="text" name="username" size="40" id="usernameauto2"/><br/>
    <input type="submit" name="submit" value="Update" />
    </fieldset>
</form>
<?php } ?>

<!--Displays if the user is a tutoring officer-->
<?php if( ($_SESSION['SESS_POSITION'] == 'tutoring' ) || $_SESSION['SESS_POSITION'] == 'advisor' ) { ?>
<fieldset>
	<legend>Tutoring Details</legend>
<?php
$qry = "SELECT * FROM details WHERE position='member' AND tutoring=1";
$result = mysql_query($qry);
if($result){
    $amount_tutored = mysql_num_rows($result);
    //echo '$amount_tutored.' members have completed their tutoring requirements. '.'<a href="complete_tutoring.php">Who?</a><br/>';
    echo '<div id="accordion3" width="auto;">
    <h3>Members who have completed their tutoring requirements. ('.$amount_tutored.')</h3>
    <div>
    <p>';
	$qry = "SELECT username FROM details WHERE tutoring=1 AND position='member'";
	$result = mysql_query($qry);
	while($row = mysql_fetch_assoc($result)){
	    foreach($row as $cname => $cvalue){
	        //echo "$cname: $cvalue";
	        echo "$cvalue";
	    }
	    echo "<br/>";
	}
    echo '</p>
    </div>';
}
else{
	echo '<script type="text/javascript">alert("MYSQL QUERY Failed (SELECT * FROM details WHERE position=member AND tutoring=1)");</script>';
    echo '<script type="text/javascript"> alert("FAILED QUERY!");</script>';
}
$qry = "SELECT * FROM details WHERE position='member' AND tutoring=0";
$result = mysql_query($qry);
if($result){
    $amount_not_tutored=mysql_num_rows($result);
    //echo $amount_not_tutored.' members have NOT completed their tutoring requirements. '.'<a href="incomplete_tutoring.php">Who?</a><br/>';
	echo '<h3>Members who have NOT completed their tutoring requirements. ('.$amount_not_tutored.')</h3>
    <div>
    <p>';
	$qry = "SELECT username FROM details WHERE tutoring=0 AND position='member'";
	$result = mysql_query($qry);
	while($row = mysql_fetch_assoc($result)){
	    foreach($row as $cname => $cvalue){
	        //echo "$cname: $cvalue";
	        echo "$cvalue";
	    }
	    echo "<br/>";
	}
    echo '</p>
    </div>
    </div>';
}
?>
</fieldset>
<?php } ?>
	<br>
	    </div>
	</div>
	<div id="footer">
		<div class="clearfix">
			<p>
				Designed by Kartik Prabhu
			</p>
		</div>
	</div>
</div>
</body>
</html>