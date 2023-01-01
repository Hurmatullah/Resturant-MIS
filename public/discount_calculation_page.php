<?php

	$host = "localhost";
	$db   = "restaurant";
	$user = "root";
	$pass = "";
	
	$conn = mysqli_connect($host,$user,$pass,$db);
	$conn->set_charset("utf8");
	

	$percentDiscount = $_POST['percentDiscount'];
	$amountDiscount = $_POST['amountDiscount'];
		$btnCountDiscount = $_POST['btnCountDiscount'];
			$ID = $_POST['ID'];
			$gtotal = $_POST['gtotal'];
		
		
		
if(isset($_POST['btnCountDiscount'])){
			

			if(!empty($amountDiscount))
			{
				$sql_query="UPDATE tbl_reservation set discount_amount = '$amountDiscount',discount_percentage=0 where ID='$ID'";
						$stmt = $conn->stmt_init();
						if($stmt->prepare($sql_query)) {	
							$stmt->execute();
							$stmt->close();
							header("Location: http://192.168.0.100/project/restaurant/detail-management.php?id=$ID");	
						}	
			}else if(!empty($percentDiscount)) {
				$sql_query="UPDATE tbl_reservation set discount_percentage = '$percentDiscount',discount_amount=0 where ID='$ID'";
						$stmt = $conn->stmt_init();
						if($stmt->prepare($sql_query)) {	
							$stmt->execute();
							$stmt->close();
							header("Location: http://192.168.0.100/project/restaurant/detail-management.php?id=$ID");	
						}						
			} else {
					$sql_query="UPDATE tbl_reservation set discount_amount = 0,discount_percentage=0 where ID='$ID'";
						$stmt = $conn->stmt_init();
						if($stmt->prepare($sql_query)) {	
							$stmt->execute();
							$stmt->close();			
				header("Location: http://192.168.0.100/project/restaurant/detail-management.php?id=$ID");
			}
			
		
			}
}
	?>