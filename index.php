<?php
	//Start session
	session_start();
	//Unset stored variables
	unset($_SESSION['SESS_MEMBER_ID']);
	unset($_SESSION['SESS_USERNAME']);
	unset($_SESSION['SESS_SERVICECREDS']);
	unset($_SESSION['SESS_DONATIONCREDS']);
	unset($_SESSION['SESS_TUTORING']);
?>