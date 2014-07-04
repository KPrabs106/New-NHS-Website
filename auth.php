<?php
session_start();
//echo $_SESSION['SESS_MEMBER_ID'];
if(!isset($_SESSION['SESS_MEMBER_ID']) && (trim($_SESSION['SESS_MEMBER_ID']) == '')){
	echo 'nope';
	echo $_SESSION['SESS_MEMBER_ID'];
	//header("location: index.php");
	//exit();
}
?>