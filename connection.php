 <?php 
//Connecting to database.
$link = mysql_connect('waynehillsnhsorg.ipagemysql.com', 'waynehillsnhsorg', 'waynehills=NHS13'); 
/*if (!$link) { 
    die('Could not connect: ' . mysql_error()); 
} 
echo 'Connected successfully';*/ 
mysql_select_db(members, $link) or die("Could not select database");
?> 