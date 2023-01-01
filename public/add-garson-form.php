 
<?php
	
	$host = "localhost";
	$db = "restaurant";
	$user= "root";
	$pass ="";

	$conn = mysqli_connect($host,$user,$pass,$db);
	
		if(isset($_POST['btnAdd'])){
			$name = $_POST['name'];
			$username = $_POST['user_name'];
			$password = $_POST['password'];
			$status = $_POST['status'];	
	
	        $query="insert into waiter_user(name,user_name,password,status) VALUES('$name','$username','$password','$status')";
            
			if(mysqli_query($conn,$query)) {
				
					echo "<div class='card-panel teal lighten-2'>
											    <span class='white-text text-darken-2'>
												   New Waiter Added Successfully
											    </span>
											</div>";
				} 
				else {
					echo "<div class='card-panel red darken-1'>
											    <span class='white-text text-darken-2'>
												    Added Failed
											    </span>
											</div>";
				}
				
						
		}
	
	
	?> 
 <?php
 
 /*
 
 
	include_once('includes/connect_database.php'); 
	 
?>

	<?php 
		
			
			$name;
			$username;
			$password;
			$status;
		//$max_serve = 10;
			
		if(isset($_POST['btnAdd'])){
			$name = $_POST['name'];
			$username = $_POST['user_name'];
			$password = $_POST['password'];
			$status = $_POST['status'];

			
			echo $name." " .$username."  ".$password." " .$status;
			
		//	if(!empty($name) && !empty($username) && !empty($password)){
				
				$sql_query = "INSERT INTO waiter_user('name', 'user_name', 'password', 'status') 
				VALUES (?,?,?,?)";
				$stmt = $connect->stmt_init();
				if($stmt->prepare($sql_query)) {	
					// Bind your variables to replace the ?s
					$stmt->bind_param('ssss', 
								$name, 
								$username, 
								$password, 
								$status);
					
					$stmt->execute();
					// store result 
					$result = $stmt->store_result();
					$stmt->close();
					echo "Executed ...";
			//	}
				
/* 				if($result) {
					echo "<div class='card-panel teal lighten-2'>
											    <span class='white-text text-darken-2'>
												   New Menu Added Successfully
											    </span>
											</div>";
				} 
				else {
					echo "<div class='card-panel red darken-1'>
											    <span class='white-text text-darken-2'>
												    Added Failed
											    </span>
											</div>";
				} */
				
			
			
		//	}
				
			//}
	?> 

	<!-- START CONTENT -->
    <section id="content">

        <!--breadcrumbs start-->
        <div id="breadcrumbs-wrapper" class=" grey lighten-3">
          	<div class="container">
            	<div class="row">
              		<div class="col s12 m12 l12">
               			<h5 class="breadcrumbs-title">اضافه کردن گارسون</h5>
		                <ol class="breadcrumb">
		                  <li><a href="dashboard.php">صفحه اصلی</a>
		                  </li>
		                  <li><a href="#" class="active">اضافه کردن گارسون</a>
		                  </li>
		                </ol>
              		</div>
            	</div>
          	</div>
        </div>
        <!--breadcrumbs end-->

         <!--start container-->
        <div class="container">
          	<div class="section">
				<form method="post">
					<div class="row">
					  <div class="col s12 m12 l5">
					        <div class="card-panel">
					          	<div class="row">
				    <table style="width:100%">
					
					<tr><td><input type="text" name="name" id="name" placeholder="اسم" required/></tr></td>
					<br>
					<tr><td><input type="text" name="user_name" id="user_name" placeholder="یوزر آیدی" required/></tr></td>
					<br>
					<tr><td><input type="password" name="password" id="password" placeholder="رمز"  required/></tr></td>
					<br>
					<tr><td><select name="status" >
						<option value="0">فعال</option>
						<option value="1">غیرفعال</option>
					</select></tr></td>
					
					<tr><td><button class="btn cyan waves-effect waves-light right" type="submit" name="btnAdd"> اضافه کردن</button> </tr></td>
					
					</table>
				            </div>
		                            </div>

							           </div>
							                </div>
				
				
				</form>
		</div>
	</section> 

<?php 
	
	include_once('includes/close_database.php'); ?>