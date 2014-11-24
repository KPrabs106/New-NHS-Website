<?php
session_start();
require_once("connection.php");
$term = $_GET['term'];
if($_SESSION['SESS_POSITION'] == "fycro")
{
$qry = "SELECT username FROM details WHERE username LIKE '%".$term."%' AND year = 1";
}
if($_SESSION['SESS_POSITION'] == "sycro")
{
$qry = "SELECT username FROM details WHERE username LIKE '%".$term."%' AND year = 2";
}

//$qry = "SELECT username FROM details WHERE username LIKE '%".$term."%' AND year = 2";
$return_arr = array();

$result = mysql_query($qry);
while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
    $row_array['id'] = $row['id'];
    $row_array['value'] = $row['username'];
    array_push($return_arr,$row_array);
}

/*
while($member=mysql_fetch_array($query)){
    $json[] = array(
        'value'=> $member["username"],
        'label'=> $member["username"]
    );
}*/
echo json_encode($return_arr);

/*
if(isset($_GET['term'])){
    $return_arr = array();
    $qry = "SELECT username FROM details WHERE username LIKE :term";
    $result = mysql_query($qry);
    
}*/
?>