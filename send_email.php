<?php
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
		
	$err_tut_arr = array();
	$errflag_tut = false;
	
	//Validate input
	if($_POST['fullname'] == ''){
		$err_tut_arr[] = 'Please enter a name.';	
		$errflag_tut = true;
	}
	if( ($_POST['email'] == '') || !(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))){
		$err_tut_arr[] = 'Invalid email.';
		$errflag_tut = true;
	}
	if( ($_POST['grade']=='') || !(filter_var($_POST['grade'], FILTER_VALIDATE_INT))){
		$err_tut_arr[] = 'Invalid grade.';	
		$errflag_tut = true;
	}
	if(!(isset($_POST['role']))){
		$err_tut_arr[] = 'Please select a box.';
		$errflag_tut = true;
	}
	if($_POST['subject']==''){
		$err_tut_arr[] = 'Please enter a subject.';
		$errflag_tut = true;
	}
	
	//Redirect back if there are any errors
	if($errflag_tut || $errflag){
		$_SESSION['ERR_TUT_ARR'] = $err_tut_arr;
		$_SESSION['ERR_LOGIN_ARR'] = $errmsg_arr;
		session_write_close();
	    echo '<script type="text/javascript">location.href = "tutoring.php";</script>';
		die();
	}
	
	/**************************
	 Check log in credentials
	 **************************/
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
		}
		else{
			//Failed login
			$errmsg_arr[] = 'invalid username and/or password';
			$errflag = true;
			if($errflag){
				$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
				session_write_close();
			    echo '<script type="text/javascript">location.href="login.php";</script>';
				exit();
			}
		}
	}		
	else{
		die("Query failed");
	}
	
	//Create and send the email
    $to = "tutoring@waynehillsnhs.org";
	$name = $_POST['fullname'];
	$grade = $_POST['grade'];
	if($_POST['role'] == 'student'){
		$role = 'Tutored';
	}
	else if ($_POST['role'] == 'tutor'){
		$role = 'A tutor';
	}
	$email= $_POST['email'];
	$tutoring_subject = $_POST['subject'];
	$subject = "Tutoring Request- ".$name;
	//$msg = $name." in grade ".$grade." wants <b>".$role."</b> in ".$tutoring_subject.".<br/> Contact them at ".$_POST['email'];
	$msg = '<div>
                <table >
                    <tr>
                        <td>
                            Name:
                        </td>
                        <td >
                            '.$name.'
                        </td>
                    </tr>
                    <tr>
                        <td >
                            Wants to be:
                        </td>
                        <td>
                            '.$role.'
                        </td>
                    </tr>
                    <tr>
                        <td >
                            Email:
                        </td>
                        <td>
                            '.$email.'
                        </td>
                    </tr>
                    <tr>
                        <td >
                            Subject:
                        </td>
                        <td>
                            '.$tutoring_subject.'
                        </td>
                    </tr>
                    <tr>
                        <td >
                            Grade:
                        </td>
                        <td>
                            '.$grade.'
                        </td>
                    </tr>
                </table>
            </div>';
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	$headers .= 'To: NHS Tutoring <tutoring@waynehillsnhs.org>'."\r\n";
	$headers .= 'From: '.$name.' <'.$email.'>';
	mail($to,$subject,$msg, $headers);
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
    <title>Tutoring- Wayne Hills NHS</title>
    
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
					<a href="files.html">Files</a>
				</li>
				<li class="active">
					<a href="tutoring.php">Tutoring</a>
				</li>
				<li>
					<a href="contact.html">Contact</a>
				</li>
                <li>
	                <a href="home.php">Log In</a>
				</li>
			</ul>
		</div>
	</div>
	<div id="contents">
		<h1>Thank you for signing up for tutoring.</h1>
		<h2>An NHS officer will contact you shortly.</h2>
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