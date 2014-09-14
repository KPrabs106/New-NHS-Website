<?php
	//Start session
	session_start();
	//Unset stored variables
	unset($_SESSION['SESS_USERNAME']);
        unset($_SESSION['SESS_YEAR']);
	unset($_SESSION['SESS_SERVICECREDS']);
	unset($_SESSION['SESS_DONATIONCREDS']);
	unset($_SESSION['SESS_TUTORING']);
        unset($_SESSION['SESS_POSITION']);
        unset($_SESSION['ERRMSG_REG_ARR']);
        unset($_SESSION['ERRMSG_TUT_ARR']);
?>
<!DOCTYPE html>
<html>
<head>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,400,700|Roboto:400,700,700italic,400italic' rel='stylesheet' type='text/css'>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.1/themes/blitzer/jquery-ui.min.css">
    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <meta charset="UTF-8">
<title>Log In</title>
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
                <a href="tutoring.php">Tutoring</a>
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
<!-- Displays message of the input validation -->
<?php
if(isset($_SESSION['ERRMSG_ARR']) && is_array($_SESSION['ERRMSG_ARR']) && count($_SESSION['ERRMSG_ARR']) >0 ){
	echo '<br>';
	echo '<p class="ui-state-error">';
	//echo '<br/>';
	//echo '<ul>';
	foreach($_SESSION['ERRMSG_ARR'] as $msg){
		echo $msg.'<br/>';
		//echo '<li>',$msg,'</li>';
	}
	echo '</p>';
	//echo '</ul>';
	unset($_SESSION['ERRMSG_ARR']);
}
?>
<h1>Log in</h1>
        <div id="login">
            <form method="post" action="login_exec.php">
            User name (ex: johnsmith)
            <br><input type="Text" name="username" size="40" /><br>
            Password (8 digit SCHOOL USERNAME)
            <br><input type="password" name="pass" size="40" /><br>
            <input id="button" type="submit" name="submit" value="Log In">
            </form>
        </div>
    </div>
</div>
<div id="footer">
		<div class="clearfix">
			<p>
				Designed by Kartik Prabhu
			</p>
		</div>
</div>
</body>
</html>