<?php 



 $server = "localhost";
 $name = "root"; 
 $password = "";
 $db = "restaurant";




 $conn = new mysqli($server , $name , $password , $db);
 $conn->set_charset("utf8");


 if ($conn->connect_error) {
 	

 	die("not connected");
                                      
}		
		@$fdate = $_POST['fdate'];
		@$tdate = $_POST['tdate'];
		

		$from_date = str_replace('/','.',$fdate);
		$to_date = str_replace('/','.',$tdate);
		
		// concatinate 0 with the day and month for a single value of day and month --- from_date
		if(strlen($from_date)<10) {
			
			$sub=substr($from_date,5,strlen($from_date));
			$y = substr($from_date,0,4);
			
			//echo "year : ".$y."\n";
			
			$m = substr($sub,0,strpos($sub,"."));
			$d = substr($sub,strpos($sub,".")+1);
			
			
			if(strlen($m)==1)
				$m = "0".$m;
			if(strlen($d)==1)
				$d = "0".$d;
			
			$from_date = $y."."."$m"."."."$d";
		
			//echo  "date : ".$from_date."\n";
		}
		 
		 // concatinate 0 with the day and month for a single value of day and month -- to_date
		  if(strlen($to_date)<10) {
			$sub=substr($to_date,5,strlen($to_date));
			$y = substr($to_date,0,4);
			
			//echo "year : ".$y."\n";
			
			$m = substr($sub,0,strpos($sub,"."));
			$d = substr($sub,strpos($sub,".")+1);
			
			
			if(strlen($m)==1)
				$m = "0".$m;
			if(strlen($d)==1)
				$d = "0".$d;
		
			$to_date = $y."."."$m"."."."$d";
		
            $to_date = $to_date." 23:59:59";		
			
			//echo "to date ".$to_date;
			  
		  }
		
		
		$sql = "SELECT * FROM order_list_manage WHERE date_time between '$from_date' and '$to_date' and res_status = 2" ;
		
		//echo $sql;

		$result = mysqli_query($conn , $sql);
		
	   
	    $dis_per = "SELECT sum(price*qty)/100*discount_percentage as dis FROM order_list_manage WHERE date_time between '$from_date' and '$to_date' and res_status = 2 group by order_id" ;

		$result1 = mysqli_query($conn , $dis_per);
		
	    $dis_amnt = "SELECT discount_amount as amount FROM order_list_manage WHERE date_time between '$from_date' and '$to_date' and res_status = 2 group by order_id";

		$result_amnt = mysqli_query($conn , $dis_amnt);

		
		


?>