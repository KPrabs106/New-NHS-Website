<?php
	//Start session
	session_start();
	//Unset stored variables
	unset($_SESSION['SESS_MEMBER_ID']);
	unset($_SESSION['SESS_USERNAME']);
	unset($_SESSION['SESS_SERVICECREDS']);
	unset($_SESSION['SESS_DONATIONCREDS']);
	unset($_SESSION['SESS_TUTORING']);
        unset($_SESSION['SESS_POSITION']);
?>
<html>
<head>
    <link rel="stylesheet" href="css/style.css" type="text/css">
<title>Log In</title>
</head>
<body>
<!-- Displays message of the input validation -->
<?php
if(isset($_SESSION['ERRMSG_ARR']) && is_array($_SESSION['ERRMSG_ARR']) && count($_SESSION['ERRMSG_ARR']) >0 ){
	echo '<ul>';
	foreach($_SESSION['ERRMSG_ARR'] as $msg){
		echo '<li>',$msg,'</li>';
	}
	echo '</ul>';
	unset($_SESSION['ERRMSG_ARR']);
}
?>
<div id="login">
<form method="post" action="login_exec.php">
User name (ex: johnsmith)
<br><input type="Text" name="username" size="40" /><br>
Password (8 digit SCHOOL USERNAME)
<br><input type="password" name="pass" size="40" /><br>
<input id="button" type="submit" name="submit" value="Log In">
</form>
</div>
</body>
</html>