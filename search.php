<?php
//Database connection
require_once("connection.php");

//Get the term from the field
$term = $_GET['term'];

//Make a query
$qry = "SELECT username FROM details WHERE username LIKE '%".$term."%'";
$result = mysql_query($qry);

$return_arr = array();

//Adds the username to the array
while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
    $row_array['id'] = $row['id'];
    $row_array['value'] = $row['username'];
    array_push($return_arr,$row_array);
}
//Encodes the array in JSON
echo json_encode($return_arr);
?>