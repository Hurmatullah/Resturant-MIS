<?php
	include_once('includes/connect_database.php'); 
	
	
	
?>

	<?php 
	
	
    $host = "localhost";
	$db = "restaurant";
	$user= "root";
	$pass ="";

	$conn = mysqli_connect($host,$user,$pass,$db) or die("not connected");
	
	
		
		if(isset($_POST['btnDelete'])){
			
			$ID;
			if(isset($_GET['id'])){
				$ID = $_GET['id'];
				
			}else{
				$ID = "";
			}
			
		
			
			$qry = "delete from waiter_user where id = ".$ID;
			
			echo $qry;
			
			if(mysqli_query($conn,$qry)) {
				
					echo "<div class='card-panel green lighten-2'>
											    <span class='white-text text-darken-2'>
												   Deleted Successfully
											    </span>
											</div>";
				
					header("location: garson.php");
					

					
											
											
											
				} 
				else {
					echo "<div class='card-panel red darken-1'>
											    <span class='white-text text-darken-2'>
												   Delete Failed
											    </span>
											</div>";
				}
			
		
		}		
		
		if(isset($_POST['btnNo'])){
			header("location: garson.php");
		}
		
	?>

	<!-- START CONTENT -->
    <section id="content">

        <!--breadcrumbs start-->
        <div id="breadcrumbs-wrapper" class=" grey lighten-3">
          	<div class="container">
            	<div class="row">
              		<div class="col s12 m12 l12">
               			<h5 class="breadcrumbs-title">حذف کردن گارسون</h5>
		                <ol class="breadcrumb">
		                  <li><a href="dashboard.php">صفحه اصلی</a>
		                  </li>
		                  <li><a href="#" class="active">حذف گارسون</a>
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
				<div class="row">
		        	<div class="col s12 m12 l12">
		        		<div class="card-panel">
		                	<div class="row">
		                 		<form method="post" class="col s12">
		                  			<div class="row">
		                    			<div class="input-field col s12">  
		                    				<p>آیا میخواهید این گارسون حذف گردد؟</p>
		                    				<button class="btn cyan waves-effect waves-light"
	                                                type="submit" name="btnDelete">حذف
	                                        </button>

		                    				<button class="btn cyan waves-effect waves-light"
	                                                type="submit" name="btnNo">کنسل
	                                        </button>
										</div>
									</div>
						        </form>
						    </div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
			
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
			
<?php include_once('includes/close_database.php'); ?>