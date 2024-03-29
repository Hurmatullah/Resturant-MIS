<?php
	include_once('includes/connect_database.php'); 
?>

	<?php 
		
		if(isset($_POST['btnDelete'])){
			if(isset($_GET['id'])){
				$ID = $_GET['id'];
			}else{
				$ID = "";
			}
			// get image file from table
			$sql_query = "SELECT category_image 
					FROM tbl_category 
					WHERE category_id = ?";
			
			$stmt = $connect->stmt_init();
			if($stmt->prepare($sql_query)) {	
				// Bind your variables to replace the ?s
				$stmt->bind_param('s', $ID);
				// Execute query
				$stmt->execute();
				// store result 
				$stmt->store_result();
				$stmt->bind_result($category_image);
				$stmt->fetch();
				$stmt->close();
			}
			
			// delete image file from directory
			$delete = unlink("$category_image");
			
			// delete data from menu table
			$sql_query = "DELETE FROM tbl_category 
					WHERE category_id = ?";
			
			$stmt = $connect->stmt_init();
			if($stmt->prepare($sql_query)) {	
				// Bind your variables to replace the ?s
				$stmt->bind_param('s', $ID);
				// Execute query
				$stmt->execute();
				// store result 
				$delete_category_result = $stmt->store_result();
				$stmt->close();
			}
			
			// get image file from table
			$sql_query = "SELECT menu_image 
					FROM tbl_menu 
					WHERE category_id = ?";
			
			// create array variable to store menu image
			$image_data = array();
			
			$stmt_menu = $connect->stmt_init();
			if($stmt_menu->prepare($sql_query)) {	
				// Bind your variables to replace the ?s
				$stmt_menu->bind_param('s', $ID);
				// Execute query
				$stmt_menu->execute();
				// store result 
				$stmt_menu->store_result();
				$stmt_menu->bind_result($image_data['menu_image']);
			}
			
			// delete all menu image files from directory
			while($stmt_menu->fetch()){
				$menu_image = $image_data[menu_image];
				$delete_image = unlink("$menu_image");
			}
			
			$stmt_menu->close();
			
			// delete data from menu table
			$sql_query = "DELETE FROM tbl_menu 
					WHERE category_id = ?";
			
			$stmt = $connect->stmt_init();
			if($stmt->prepare($sql_query)) {	
				// Bind your variables to replace the ?s
				$stmt->bind_param('s', $ID);
				// Execute query
				$stmt->execute();
				// store result 
				$delete_menu_result = $stmt->store_result();
				$stmt->close();
			}
				
			// if delete data success back to reservation page
			if($delete_category_result && $delete_menu_result){
				header("location: category.php");
			}
		}		
		
		if(isset($_POST['btnNo'])){
			header("location: category.php");
		}
		
	?>

	<!-- START CONTENT -->
    <section id="content">

        <!--breadcrumbs start-->
        <div id="breadcrumbs-wrapper" class=" grey lighten-3">
          	<div class="container">
            	<div class="row">
              		<div class="col s12 m12 l12">
               			<h5 class="breadcrumbs-title">حذف کردن کتگوری</h5>
		                <ol class="breadcrumb">
		                  <li><a href="dashboard.php">صفحه اصلی</a>
		                  </li>
		                  <li><a href="#" class="active">حذف کتگوری</a>
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
		                    				<p>آیا میخواهید این کتگوری حذف گردد</p>
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