<?php
require_once('connection.php');
$qry = "SELECT username FROM details WHERE tutoring=0 AND position='member'";
$result = mysql_query($qry);
while($row = mysql_fetch_assoc($result)){
    foreach($row as $cname => $cvalue){
        echo "$cname: $cvalue";
    }
    echo "<br/>";
}
?>