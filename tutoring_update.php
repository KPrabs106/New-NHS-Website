<?php
session_start();
require_once('connection.php');

$username = $_POST['username'];

if($username == ''){
        $_SESSION['ERR_TUT_MSG'] = 'Blank username';
        echo '<script type="text/javascript">location.href="home.php";</script>';
        die();
}

    $check_qry = "SELECT * FROM details WHERE username='$username'";
    $check_result = mysql_query($check_qry);
    if(mysql_num_rows($check_result) == 0){
        $_SESSION['ERR_TUT_MSG'] = 'Invalid username';
        echo '<script type="text/javascript">location.href="home.php";</script>';
        die();
    }

$qry = "UPDATE details SET tutoring=1 WHERE username='$username'";
$result=mysql_query($qry);
if($result){
    $_SESSION['SUCCESS_TUT_MSG'] = 'Updated!';
    echo '<script type="text/javascript">location.href="home.php";</script>';
}
else{
    $_SESSION['ERR_TUT_MSG'] = 'Query failed!';
    echo '<script type="text/javascript">location.href="home.php";</script>';
}
?>