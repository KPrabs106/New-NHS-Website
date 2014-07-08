<?php
//Start session
session_start();

//Connection to database
require_once('connection.php');

//Store validation errors
$errmsg_arr = array();

//Error flag
$errflag = false;

//SQL injection protection
function clean($str){
	$str = @trim($str);
	if(get_magic_quotes_gpc()){
		$str = stripslashes($str);
	}
	return mysql_real_escape_string($str);
}

//Clean the POST values
$username = clean($_POST['username']);
$password = clean($_POST['pass']);

//Validate input
if($username == ''){
	$errmsg_arr[] = 'Username missing';
	$errflag = true;
}
if($password == ''){
	$errmsg_arr[] = 'Password missing';
	$errflag = true;
}

//Redirect to login form if there are any errors
if($errflag){
	$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
	session_write_close();
        //header("Location: http://waynehillsnhs.org/index.php");
        echo '<script type="text/javascript"> document.location = "http://waynehillsnhs.org/login.php";</script>';
//header("location: index.php");
	exit();
}

//Hash the password
$password_hash = md5($password);
//Create a query
$qry="SELECT * FROM details WHERE username='$username' AND password='$password_hash'";
$result=mysql_query($qry);

//Check if query was successful
if ($result){
	if(mysql_num_rows($result) > 0){
		//Successful login
		session_regenerate_id();
		$member = mysql_fetch_assoc($result);
		//Assign values
		$_SESSION['SESS_MEMBER_ID'] = $member['id'];
		$_SESSION['SESS_USERNAME'] = $member['username'];
                $_SESSION['SESS_YEAR'] = $member['year'];
		$_SESSION['SESS_SERVICECREDS'] = $member['servicecreds'];
		$_SESSION['SESS_DONATIONCREDS'] = $member['donationcreds'];
		$_SESSION['SESS_TUTORING'] = $member['tutoring'];
                $_SESSION['SESS_POSITION'] = $member['position'];
		
		echo '<script type="text/javascript"> document.location = "http://waynehillsnhs.org/home.php";</script>';
		
		//The code below does not work for some reason...
		/*header('Location: home.php');
		exit();*/
	}
	else{
		//Failed login
		$errmsg_arr[] = 'invalid username and/or password';
		$errflag = true;
		if($errflag){
			$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
			session_write_close();
		        echo '<script type="text/javascript"> document.location = "http://waynehillsnhs.org/login.php";</script>';
                        //header("location: login.php");
			die();
			//exit();
		}
	}
}		
else{
	die("Query failed");
}
?>