<?php 

$server = "localhost";
$name = "root"; 
$password = "";
$db = "restaurant";

$conn = new mysqli($server , $name , $password , $db) or die("not connect to db");
$conn->set_charset("utf8");

?>