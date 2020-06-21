<?php 

$host="localhost";
$db_username="root";
$db_password="";
$database="phpboot";
$conn=mysqli_connect($host, $db_username, $db_password, $database);
$conn->set_charset("utf8"); //türkçe karakter sorunu çözümü için

if(!$conn){
  die("error: " . mysqli_connect_error());
}


?>