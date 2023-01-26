<?php
 
$dbhost="localhost";
$dbuser="root";
$dbpass="";
$db="grocery_spmart_shop";
$con=new mysqli($dbhost,$dbuser,$dbpass,$db);
if($con->connect_error){die("Connection Failed ".$mysqli->connect_error);}
return $con;

?>
 