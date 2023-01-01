<?php
	include_once('../includes/connect_database.php'); 
	include_once('../includes/variables.php');
	
	// get data from android app
	@$name 				= $_POST['name'];
	@$number_of_people 	= $_POST['number_of_people'];
	@$date_time 			= $_POST['date_time'];
	@$phone 				= $_POST['phone'];
	@$order_list 		= $_POST['prettyGson'];
	@$comment 			= $_POST['comment'];
	@$email 				= $_POST['email'];
	$waiterId = $_POST['wid'];
	
	
	
	

	
	$sql_query = "set names 'utf8'";
	$stmt = $connect->stmt_init();
	if($stmt->prepare($sql_query)) {	
		// Execute query
		$stmt->execute();
		// store result 
		$stmt->close();
	}
	
	 // insert data into reservation table
	$sql_query = "INSERT INTO tbl_reservation (name, number_of_people, date_time, phone, order_list, comment, email,waiter_id) 
					VALUES (?, ?, ?, ?, ?, ?, ?,?)";
	
	$stmt = $connect->stmt_init();
	if($stmt->prepare($sql_query)) {	
		// Bind your variables to replace the ?s
		$stmt->bind_param('ssssssss', 
					$name,
					$number_of_people, 
					$date_time, 
					$phone, 
					$order_list,
					$comment,
					$email,
					$waiterId
					);
		// Execute query
		$stmt->execute();
		$result = $stmt->affected_rows;
		// store result 
		//$result = $stmt->store_result();
		$stmt->close();
	} 
	
	//
	
		
		
		//get id from tbl_reservation
		$result = $connect->query("select LAST_INSERT_ID() from tbl_reservation") or die ("Error :".mysql_error());
		$data = $result->fetch_row();
		$oid = $data[0];
		$result->close();
		
	
	  $test = json_decode($order_list,true);
	  
	  foreach($test as $value){
		  
		  $mid = $value['id'];
		  $n = $value['name'];
		  $q = $value['qty'];
		  
		  
		  $sql = "INSERT INTO order_list (order_id,menu_id, name, qty, status) 
					VALUES ('$oid','$mid','$n', '$q', 0)";

			$stmt = $connect->stmt_init();
			if($stmt->prepare($sql)) {	

			$stmt->execute();
		
			}
			
			
			
	  }
	  	$result = $stmt->affected_rows;
	    $stmt->close();

	
	
	
	
	
	
	
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