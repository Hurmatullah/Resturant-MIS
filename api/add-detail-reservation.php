<?php
	include_once('../includes/connect_database.php'); 
	include_once('../includes/variables.php');
	
	// get data from android app
	$name 	= $_POST['name'];
	$qty 	= $_POST['qty'];
	//$order_list = $_POST['prettyGson'];

	
	
	$test = json_decode($order_list,true);
	
	echo $test;
	
	$sql_query = "set names 'utf8'";
	$stmt = $connect->stmt_init();
	if($stmt->prepare($sql_query)) {	
		// Execute query
		$stmt->execute();
		// store result 
		$stmt->close();
	}
	
	// insert data into reservation table
	$sql_query = "INSERT INTO order_list(name, qty) 
					VALUES (?, ?)";
	
	
	
	
	
	
	$stmt = $connect->stmt_init();
	if($stmt->prepare($sql_query)) {	
		// Bind your variables to replace the ?s
		$stmt->bind_param('ss', 
					$name,
					$qty, 
					
					);
		// Execute query
		$stmt->execute();
		$result = $stmt->affected_rows;
		// store result 
		//$result = $stmt->store_result();
		$stmt->close();
	}
	
	// get admin email from user table
	$sql_query = "SELECT Email 
			FROM tbl_user";
	
	$stmt = $connect->stmt_init();
	if($stmt->prepare($sql_query)) {	
		// Execute query
		$stmt->execute();
		// store result 
		$stmt->store_result();
		$stmt->bind_result($email);
		$stmt->fetch();
		$stmt->close();
	}
	
	// if new reservation has been successfully added to reservation table 
	// send notification to admin via email
	if($result){
		$to = $email;
		$subject = $reservation_subject;
		$message = $reservation_message;
		$from = $admin_email;
		$headers = "From:" . $from;
		mail($to,$subject,$message,$headers);
		echo "OK";
	}else{
		echo "Failed";
	}

	include_once('../includes/close_database.php');
?>