 
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
					
					<tr><td><input type="text" value="<?php echo $result['name']; ?>"  name="name" id="name" placeholder="اسم" required/></tr></td>
					<br>
					<tr><td><input type="text" value="<?php echo $result['user_name']; ?>" name="user_name" id="user_name" placeholder="یوزر آیدی" required/></tr></td>
					<br>
					<tr><td><input type="password" value = "<?php echo $result['password']; ?>" name="password" id="password" placeholder="رمز"  required/></tr></td>
					<br>
					<tr><td><select name="status" >
						<option value="0">فعال</option>
						<option value="1">غیرفعال</option>
					</select></tr></td>
					
					<tr><td><button class="btn cyan waves-effect waves-light right" type="submit" name="btnUpdate"> چدید کردن</button> </tr></td>
					
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