<?php 

	$host = "localhost";
	$db   = "restaurant";
	$user = "root";
	$pass = "";
	
	$conn = mysqli_connect($host,$user,$pass,$db);
	$conn->set_charset("utf8");
	
	
	
		$order_id = $_POST['order_id'];
		$qty = $_POST['qty'];
		$name = $_POST['name'];
	    $update = $_POST['isUpdate'];
		$ID = $_POST['ID'];
		$res_status = $_POST['res_status'];
		$order_list_id = $_POST['order_list_id'];
		
		$btnComplete = $_POST['btnComplete'];
		$btnCancel = $_POST['btnCancel'];
		
		
		$deleteBtn = $_POST['deleteBtn'];
		

		
		
	
		
		
		
		
		echo $ID;
		
	    $mid = mysqli_query($conn,"select menu_id from tbl_menu where menu_name = '$name'");
		while($m = mysqli_fetch_array($mid)){
					
			if($update == 0 || $update ==1){
				$qry_update = "update order_list set status = 2 where id = '$order_id' AND menu_id = '$m[0]' AND qty = '$qty'";
			}else if($update == 2) {
				$qry_update = "update order_list set status = 0 where id = '$order_id' AND menu_id = '$m[0]' AND qty = '$qty'";
			}		
								
						$stmt = $conn->stmt_init();
						if($stmt->prepare($qry_update)) {	
							$stmt->execute();
							$stmt->close();
							header("Location: http://192.168.0.100/project/restaurant/detail-general-management.php?id=$ID");
						}
		

		}
		
		
		
		
		
		
		
		
		
		if(isset($_POST['btnComplete']))
		{
		$qry_update_status = "UPDATE tbl_reservation SET status = 2 WHERE ID = '$ID'";

	$stmt2 = $conn->stmt_init();
						if($stmt2->prepare($qry_update_status)) {	
							$stmt2->execute();
							$stmt2->close();
							header("Location: http://192.168.0.100/project/restaurant/management.php");
						}
						
		// print action

						//redirect to print.php
						header("Location: http://192.168.0.100/project/restaurant/public/print.php?id=$ID.php");
						
		
		//end print aciton
						

		
		}else if(isset($_POST['btnCancel'])){
			if($res_status==3) {
			$qry_update_status = "UPDATE tbl_reservation SET status = 0 WHERE ID = '$ID'";
				$stmt1 = $conn->stmt_init();
						if($stmt1->prepare($qry_update_status)) {	
							$stmt1->execute();
							$stmt1->close();
							header("Location: http://192.168.0.100/project/restaurant/general-management.php");
						}				
			}else {
			$qry_update_status = "UPDATE tbl_reservation SET status = 3 WHERE ID = '$ID'";
				$stmt1 = $conn->stmt_init();
						if($stmt1->prepare($qry_update_status)) {	
							$stmt1->execute();
							$stmt1->close();
							header("Location: http://192.168.0.100/project/restaurant/general-management.php");
						}
			}
		
		}else if(isset($_POST['deleteBtn']))
		{
			$qry_update_status = "DELETE from order_list where id='$order_list_id'";
				$stmt1 = $conn->stmt_init();
						if($stmt1->prepare($qry_update_status)) {	
							$stmt1->execute();
							$stmt1->close();
							header("Location: http://192.168.0.100/project/restaurant/detail-general-management.php?id=$ID.php");	
						}
		}
		



?>