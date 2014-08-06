<!DOCTYPE html>
<html>
<head>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,400,700|Roboto:400,700,700italic,400italic' rel='stylesheet' type='text/css'>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
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
					<a href="news.html">News</a>
				</li>
				<li class="active">
					<a href="about.html">Tutoring</a>
				</li>
				<li>
					<a href="contact.html">Contact</a>
				</li>
                                <li>
					<a href="home.php">My NHS</a>
				</li>
			</ul>
		</div>
	</div>
	<div id="contents">
            <form method="post" action="send_email.php">
                <input type="radio" name="is_member" value="student">I want to tutor
                <br/>
                <input type="radio" name="is_member" value="student">I want to be tutored
                <br/>
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