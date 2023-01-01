 
<?php
	
	$host = "localhost";
	$db = "restaurant";
	$user= "root";
	$pass ="";

	$conn = mysqli_connect($host,$user,$pass,$db);
	
	 $ID = 0;
	 
	 if(isset($_GET['id'])){
		 $ID = $_GET['id']; 
	 }
	 
	 
	 
	 $getData ="select * from waiter_user where id = ". $ID;
	 $result = mysqli_query($conn , $getData);
	 
	 
	 $name;
	 $username;
	 $password;
	 
	 while($row = $result->fetch_assoc()){
		 
		 $name     = $row['name'];
		 $username = $row['user_name'];
		 $password = $row['password']; 
		 
		 
	 }
	 
	 
	 
	 
	 #update garson
	 $flag = 0;
	 
	 if(isset($_POST['btnUpdate'])){
		 
		 $newName = $_POST['name'];
		 $newUsername = $_POST['user_name'];
		 $newPass = $_POST['password'];
		 $newStatus = $_POST['status'];
		 
		 
		 $update = "update waiter_user set name='$newName', user_name='$newUsername', password='$newPass', status='$newStatus' where id = ".$ID;
		 
			if(mysqli_query($conn,$update)) {
				
					echo "<div class='card-panel green lighten-2'>
											    <span class='white-text text-darken-2'>
												   Updated Successfully
											    </span>
											</div>";
											
					$flag = 1;
				#	header("location: garson.php");
					

					
											
											
											
				} 
				else {
					echo "<div class='card-panel red darken-1'>
											    <span class='white-text text-darken-2'>
												   Update Failed
											    </span>
											</div>";
				}
		 
		 
	
		 
		 
	 }

	?>
  

	<!-- START CONTENT -->
    <section id="content">

        <!--breadcrumbs start-->
        <div id="breadcrumbs-wrapper" class=" grey lighten-3">
          	<div class="container">
            	<div class="row">
              		<div class="col s12 m12 l12">
               			<h5 class="breadcrumbs-title">ویرایش گارسون</h5>
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
					
					<?php if($flag == 1){ ?>
					<tr><td><input type="text"    name="name" id="name" placeholder="اسم" required/></tr></td>
					<br>
					<tr><td><input type="text"  name="user_name" id="user_name" placeholder="یوزر آیدی" required/></tr></td>
					<br>
					<tr><td><input type="text"  name="password" id="password" placeholder="رمز"  required/></tr></td>
					<br>
					<tr><td><select name="status" >
						<option value="0">فعال</option>
						<option value="1">غیرفعال</option>
					</select></tr></td>
					<?php }else{ ?>
					
					
					<tr><td><input type="text" value="<?php echo $name;?>"   name="name" id="name" placeholder="اسم" required/></tr></td>
					<br>
					<tr><td><input type="text" value="<?php echo $username;?>" name="user_name" id="user_name" placeholder="یوزر آیدی" required/></tr></td>
					<br>
					<tr><td><input type="text" value="<?php echo $password;?>" name="password" id="password" placeholder="رمز"  required/></tr></td>
					<br>
					<tr><td><select name="status" >
						<option value="0">فعال</option>
						<option value="1">غیرفعال</option>
					</select></tr></td>
					
					
					<?php } ?>
					<tr><td><button class="btn cyan waves-effect waves-light right" type="submit" name="btnUpdate"> جدید کردن</button> </tr></td>
					
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