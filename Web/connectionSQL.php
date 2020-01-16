<?php


$server = 'localhost';
$user = 'cst157';
$pswd = '457101';
$db='ICS199Group10_dev';

$link = mysqli_connect($server,$user,$pswd,$db);

if (!$link) {
    die ('MySQL Error:' . mysqli_connect_error());
}
else {
     //print "Connecting to database <BR>" ;
 }


?>

