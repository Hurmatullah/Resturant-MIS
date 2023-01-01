<?php
	//database configuration
	$host ="localhost";
	$user ="root";
	$pass ="";
	$database = "restaurant";
	$connect = new mysqli($host, $user, $pass,$database) or die("Error : ".mysql_error());
	
	// email configuration
	$admin_email = "youremail@gmail.com";
	$email_subject = "Notification of changes to account information!";
	$change_message = "You have change your admin info such as email and or password.";
	$reset_message = "Your new password is ";
	
	//order notification configuration
	$reservation_subject = "New Order Notification!";
	$reservation_message = "There is new order, please check Admin Panel.";
	
?>