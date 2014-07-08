<?php
session_start();
if(!isset($_SESSION['SESS_MEMBER_ID']) && (trim($_SESSION['SESS_MEMBER_ID']) == '')){
        echo'<script type="text/javascript"> document.location="http://waynehillsnhs.org/login.php";</script>';
	//header("location: index.php");
	exit();
}
?>