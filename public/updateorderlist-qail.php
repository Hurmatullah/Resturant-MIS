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
		
		
		
		echo $ID;
		
		
		
		
		
		
	    $mid = mysqli_query($conn,"select menu_id from tbl_menu where menu_name = '$name'");
		while($m = mysqli_fetch_array($mid)){
					
			if($update == 0){
				$qry_update = "update order_list set status = 0 where id = '$order_id' AND menu_id = '$m[0]' AND qty = '$qty'";
			}else {
				$qry_update = "update order_list set status = 1 where id = '$order_id' AND menu_id = '$m[0]' AND qty = '$qty'";
			}		
					
			
						$stmt = $conn->stmt_init();
						if($stmt->prepare($qry_update)) {	
							$stmt->execute();
							$stmt->close();
							header("Location: http://192.168.0.100/project/restaurant/detail-reservation-qail.php?id=$ID");
						}
		

		}
		
	


?>