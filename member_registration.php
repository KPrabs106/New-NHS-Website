<?php
    session_start();
    require_once ('connection.php');
    
    //Handles errors with the form
    $errflag = false;
    $errmsg_reg_arr = array();
    //Get the values
    $newusername = $_POST['username'];
    $newpassword = $_POST['password'];
    
    //Check for blank fields
    if($newusername == ''){
        $errflag = true;
        $errmsg_reg_arr[] = 'Username missing';
    }
    if($newpassword == ''){
        $errflag = true;
        $errmsg_reg_arr[] = 'Password missing';
    }
    if(!isset($_POST['year'])){
        $errflag = true;
        $errmsg_reg_arr[] = 'Year missing';
    }
    
    if($errflag){
        $_SESSION['ERRMSG_REG_ARR'] = $errmsg_reg_arr;
        echo '<script type="text/javascript">location.href="home.php";</script>';
        die();
    }
    
    $selected_radio = $_POST['year'];       
    
    //Hash the password
    $newpassword_hash = md5($newpassword);
    
    
    //Create a query for checking if the user exists
    $check_qry = "SELECT * FROM details WHERE username='$newusername'";
    $check_result = mysql_query($check_qry);
    
    if($check_result){
        if(mysql_num_rows($check_result) == 0){
            //No other users with that username exist
            //Create a query for adding the user
            $qry = "INSERT INTO details (username, password, year) VALUES ('$newusername','$newpassword_hash','$year')";
            $result = mysql_query($qry);
            
            if($result){
                $_SESSION['SUCCESS_REG_MSG'] = 'Success! '. $newusername .' was added.';
				echo '<script type="text/javascript">location.href="home.php";</script>';
            }
            else{
                echo '<script type="text/javascript">alert("QUERY FAILED!\nNO ENTRY WAS MADE.");location.href="home.php";</script>';
            }
        }
        else{
            //There is already someone with the same username
            $_SESSION['ERR_REG_MSG'] = $newusername.' already exists!';
            echo '<script type="text/javascript">location.href="home.php";</script>';
        }
    }
    else{
        echo '<script type="text/javascript">alert("CHECKING QUERY FAILED!\nNO ENTRY WAS MADE.");location.href="home.php";</script>';
    }

    
?>