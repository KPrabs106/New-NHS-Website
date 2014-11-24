<?php
session_start();
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
    <script language="JavaScript">
    	function ShowLogIn()
    	{
    		if(document.getElementById('tutor').checked){
    			document.getElementById('login').style.display = 'block';    			
    		}
    		else{
    			document.getElementById('login').style.display = 'none';
    		}
    	}
    </script>
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
		<fieldset>
			<legend>Sign up for Tutoring</legend>
			<?php
			if(isset($_SESSION['ERR_TUT_ARR'])){
    			echo '<p class="ui-state-error">';
    			//echo '<ul>';
				foreach($_SESSION['ERR_TUT_ARR'] as $msg){
					echo $msg.'<br/>';
					//echo '<li>',$msg,'</li>';
				}
				//echo '</ul>';
    			echo '</p>';
    			unset($_SESSION['ERR_TUT_ARR']);
			}
			?>
            <form method="post" action="send_email.php">
                <input type="radio" name="role" id="tutor" value="tutor" onchange="ShowLogIn()">I want to tutor.
                <br/>
                <input type="radio" name="role" id="student" value="student" onchange="ShowLogIn()">I need tutoring.
                <br/>
			<?php
				if(isset($_SESSION['ERR_LOGIN_ARR'])){
	    			echo '<p class="ui-state-error">';
	    			//echo '<ul>';
					foreach($_SESSION['ERR_LOGIN_ARR'] as $msg){
						echo $msg.'<br/>';
						//echo '<li>',$msg,'</li>';
				}
				//echo '</ul>';
    			echo '</p>';
    			unset($_SESSION['ERR_LOGIN_ARR']);
			}
			?>
	            <div id="login" style="display: none;">
	            	<h3>You must be an NHS member in order to tutor. Please enter the following:</h3>
	            	User name (ex: johnsmith)
		            <br><input type="Text" name="username" size="40" /><br>
		            Password (8 digit SCHOOL USERNAME)
		            <br><input type="password" name="pass" size="40" /><br>
		            <br>
		            <br>
	            </div>
                Full name:
                <input type="text" name="fullname">
                &nbsp;&nbsp;&nbsp;&nbsp;
                Email address:
                <input type="email" name="email">
                <br/>
                Grade:
                <input type="number" name="grade">
                &nbsp;&nbsp;&nbsp;&nbsp;
                Subject:
                <input type="text" name="subject">
                <br/>
                <input type="submit">
            </form>
		</fieldset>
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