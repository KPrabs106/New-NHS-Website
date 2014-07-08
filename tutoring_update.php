<?php
session_start();
require_once('connection.php');

$errflag = false;


$username = $_POST['username'];

if($username == ''){
        $errflag = true;
        echo '<script type="text/javascript">alert("BLANK USERNAME!");window.location="http://www.waynehillsnhs.org/home.php";</script>';
        die();
}


$qry = "UPDATE details SET tutoring=1 WHERE username='$username'";
$result=mysql_query($qry);
if($result){
    echo '<script type="text/javascript">alert("Success!");window.location="http://www.waynehillsnhs.org/home.php";</script>';
}
else{
    echo '<script type="text/javascript">alert("QUERY FAILED!\nNO CHANGES WERE MADE.");window.location="http://www.waynehillsnhs.org/home.php";</script>';
}
?>