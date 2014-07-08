<?php
require_once('connection.php');
include('vars.php');
$qry = "SELECT username,servicecreds,donationcreds FROM details WHERE servicecreds+donationcreds>='$sycreditsneeded' AND year=2 AND position='member'";
$result = mysql_query($qry);
while($row = mysql_fetch_assoc($result)){
    foreach($row as $cname => $cvalue){
        echo "$cname: $cvalue&nbsp;&nbsp;&nbsp;";
    }
    echo "<br/>";
}
?>