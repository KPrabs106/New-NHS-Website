<?php
    session_start();
    require_once ('connection.php');
    
    $errflag = false;
    $errmsg_reg_arr = array();
    //Get the values
    $newusername = $_POST['username'];
    $newpassword = $_POST['password'];
    
    //Check for blank fields
    if($newusername == ''){
        $errflag = true;
        $errmsg_reg_arr[] = 'Username missing';
        /*
        echo '<script type="text/javascript">alert("BLANK USERNAME!");window.location="http://www.waynehillsnhs.org/home.php";</script>';
        die();
        */
    }
    if($newpassword == ''){
        $errflag = true;
        $errmsg_reg_arr[] = 'Password missing';
        /*
        echo '<script type="text/javascript">alert("BLANK PASSWORD!");window.location="http://www.waynehillsnhs.org/home.php";</script>';
        die();
         */
    }
    if(!isset($_POST['year'])){
        $errflag = true;
        $errmsg_reg_arr[] = 'Year missing';
        /*
        echo '<script type="text/javascript">alert("SELECT A YEAR!");window.location="http://www.waynehillsnhs.org/home.php";</script>';
        die();
         */
    }
    
    if($errflag){
        $_SESSION['ERRMSG_REG_ARR'] = $errmsg_reg_arr;
        echo '<script type="text/javascript">window.location="http://www.waynehillsnhs.org/home.php";</script>';
        die();
    }
    
    $selected_radio = $_POST['year'];       
    
    //Hash the password
    $newpassword_hash = md5($newpassword);
    
    //Create a query
    $qry = "INSERT INTO details (username, password, year) VALUES ('$newusername','$newpassword_hash','$year')";
    $result = mysql_query($qry);
    
    if($result){
        echo '<script type="text/javascript">alert("Success!\nThe member was added.");window.location="http://www.waynehillsnhs.org/home.php";</script>';
    }
    else{
        echo '<script type="text/javascript">alert("QUERY FAILED!\nNO ENTRY WAS MADE.");window.location="http://www.waynehillsnhs.org/home.php";</script>';
    }
    
?>