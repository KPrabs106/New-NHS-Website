<?php
require_once("connection.php");

$qry = "SELECT username FROM details WHERE username LIKE '%".$term."%'";
$json = array();
while($member=mysql_fetch_array($query)){
    $json[] = array(
        'value'=> $member["username"],
        'label'=> $member["username"]
    );
}
echo json_encode($json);

/*
if(isset($_GET['term'])){
    $return_arr = array();
    $qry = "SELECT username FROM details WHERE username LIKE :term";
    $result = mysql_query($qry);
    
}*/
?>