<?php
	include_once('includes/connect_database.php'); 
?>

	<?php 
		if(isset($_GET['id'])){
			$ID = $_GET['id'];
		}else{
			$ID = "";
		}
		
		// create array variable to store data from database
		$data = array();
		
		// get currency symbol from setting table
		$sql_query = "SELECT Value 
				FROM tbl_setting 
				WHERE Variable = 'Currency'";
		
		$stmt = $connect->stmt_init();
		if($stmt->prepare($sql_query)) {	
			// Execute query
			$stmt->execute();
			// store result 
			$stmt->store_result();
			$stmt->bind_result($currency);
			$stmt->fetch();
			$stmt->close();
		}	
		
		// get all data from menu table and category table
		$sql_query = "SELECT menu_id, menu_name, menu_status, price, category_name, menu_image, menu_description, serve_for 
				FROM tbl_menu m, tbl_category c
				WHERE m.menu_id = ? AND m.category_id = c.category_id";
		
		$stmt = $connect->stmt_init();
		if($stmt->prepare($sql_query)) {	
			// Bind your variables to replace the ?s
			$stmt->bind_param('s', $ID);
			// Execute query
			$stmt->execute();
			// store result 
			$stmt->store_result();
			$stmt->bind_result($data['menu_id'], 
					$data['menu_name'], 
					$data['menu_status'], 
					$data['price'], 
					$data['category_name'],
					$data['menu_image'],
					$data['menu_description'],
					$data['serve_for']
					);
			$stmt->fetch();
			$stmt->close();
		}
		
	?>

	<!-- START CONTENT -->
    <section id="content">

        <!--breadcrumbs start-->
        <div id="breadcrumbs-wrapper" class=" grey lighten-3">
          	<div class="container">
            	<div class="row">
              		<div class="col s12 m12 l12">
               			<h5 class="breadcrumbs-title">جزئیات منو</h5>
		                <ol class="breadcrumb">
		                  <li><a href="dashboard.php">صفحه اصلی</a>
		                  </li>
		                  <li><a href="#" class="active">جزئیات منو</a>
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
		              		<?php echo isset($error['update_data']) ? $error['update_data'] : '';?>
		                	<div class="row">
		                  		<div class="row">
		                    		<div class="input-field col s12">
		                    			<form method="post" class="col s12">

											<table class="bordered">
												<tr>
													<th><div align="right">نام</div></th>
													<td><div align="right"><?php echo $data['menu_name']; ?></div></td>
												</tr>
													<tr>
													<th><div align="right">حالت</div></th>
													<td><div align="right"><?php echo $data['menu_status']; ?></div></td>
												</tr>
												</tr>
													<tr>
													<th><div align="right">سرو میشود برای</div></th>
													<td><div align="right"><?php echo $data['serve_for']; ?> نفر</div></td>
												</tr>
												<tr>
													<th><div align="right">قیمت</div></th>
													<td><div align="right"><?php echo $data['price']." ".$currency; ?></div></td>
												</tr>
												<tr>
													<th><div align="right">کتگوری</div></th>
													<td><div align="right"><?php echo $data['category_name']; ?></div></td>
												</tr>
												<tr>
													<th><div align="right">عکس</div></th>
													<td><div align="right"><img src="<?php echo $data['menu_image']; ?>" width="200" height="150"/></div></td>
												</tr>
												<tr>
													<th><div align="right">توضیحات منو</div></th>
													<td><div align="right"><?php echo $data['menu_description']; ?></div></td>
												</tr>
											</table>
		
										</form>												          
		                    		</div>
		                  		</div>
		                	</div>
		              	</div>
						<a href="edit-menu.php?id=<?php echo $ID; ?>"><button class="btn waves-effect waves-light indigo">ویرایش</button></a>
						<a href="delete-menu.php?id=<?php echo $ID; ?>"><button class="btn waves-effect waves-light indigo">حذف</button></a>
		            </div>
		        </div>
        	</div>
        </div>

	</section>			
			
<?php include_once('includes/close_database.php'); ?>