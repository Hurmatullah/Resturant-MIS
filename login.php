<?php
	
	$host = "localhost";
	$db = "restaurant";
	$user= "root";
	$pass ="";
	
	$conn = mysqli_connect($host,$user,$pass,$db);
	
	
	$xname = filter_input(INPUT_POST,"username");
	$xpass = filter_input(INPUT_POST,"password");
	
	
	
	
	$s = mysqli_query($conn,"select * from waiter_user where user_name = '".$xname."' AND password = '".$xpass."'");
	if($isValid = mysqli_fetch_array($s)){
		
		echo "valid $isValid[0]";
	}else{
		
		echo "wrong username or Password";
	}
	
	
	
	
	
	?>