<?php
session_start();
require_once('connection.php');

$errflag = false;
$errmsg_arr = array();

$username = $_POST['username'];

if($username == ''){
        $errflag = true;
        $errmsg_arr[] = 'Blank username';
        $_SESSION['ERRMSG_TUT_ARR'] = $errmsg_arr;
        echo '<script type="text/javascript">window.location="http://www.waynehillsnhs.org/home.php";</script>';
        die();
}

/*if($errflag){
    $_SESSION['ERRMSG_TUT_ARR'] = $errmsg_arr;
    echo '<script type="text/javascript">alert("BAD");window.location="http://www.waynehillsnhs.org/home.php";</script>';
    die();
}*/

$qry = "UPDATE details SET tutoring=1 WHERE username='$username'";
$result=mysql_query($qry);
if($result){
    echo '<script type="text/javascript">alert("Success!");window.location="http://www.waynehillsnhs.org/home.php";</script>';
}
else{
    echo '<script type="text/javascript">alert("QUERY FAILED!\nNO CHANGES WERE MADE.");window.location="http://www.waynehillsnhs.org/home.php";</script>';
}
?>