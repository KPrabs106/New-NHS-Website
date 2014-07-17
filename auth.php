<?php
session_start();
if(!isset($_SESSION['SESS_USERNAME']) && (trim($_SESSION['SESS_USERNAME']) == '')){
        echo'<script type="text/javascript">document.location="http://waynehillsnhs.org/login.php";</script>';
	die();
}
?>