<?php
	include_once('includes/connect_database.php'); 
	include_once('functions.php'); 
?>

	<?php 
		// create object of functions class
		$function = new functions;
		
		// create array variable to store data from database
		$data = array();
		
		 
		
		if(isset($_GET['keyword'])){	
			// check value of keyword variable
			$keyword = $_GET['keyword'];
			$bind_keyword = "%".$keyword."%";
		}else{
			$keyword = "";
			$bind_keyword = $keyword;
		}
		
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
		if(empty($keyword)){
			$sql_query = "SELECT menu_id, menu_name, category_name, price, menu_status, menu_image, serve_for 
					FROM tbl_menu m, tbl_category c
					WHERE m.category_id = c.category_id  
					ORDER BY m.menu_id DESC";
		}else{
			$sql_query = "SELECT menu_id, menu_name, category_name, price, menu_status, menu_image, serve_for  
					FROM tbl_menu m, tbl_category c
					WHERE m.category_id = c.category_id AND menu_name LIKE ? 
					ORDER BY m.menu_id DESC";
		}
		
		$stmt = $connect->stmt_init();
		if($stmt->prepare($sql_query)) {	
			// Bind your variables to replace the ?s
			if(!empty($keyword)){
				$stmt->bind_param('s', $bind_keyword);
			}
			// Execute query
			$stmt->execute();
			// store result 
			$stmt->store_result();
			$stmt->bind_result($data['menu_id'], 
					$data['menu_name'], 
					$data['category_name'],
					$data['price'], 
					$data['menu_status'],
					$data['menu_image'],
					$data['serve_for']
					);
					
			// get total records
			$total_records = $stmt->num_rows;
		}
		
		// check page parameter
		if(isset($_GET['page'])){
			$page = $_GET['page'];
		}else{
			$page = 1;
		}
		
		// number of data that will be display per page		
		$offset = 10;
						
		//lets calculate the LIMIT for SQL, and save it $from
		if ($page){
			$from 	= ($page * $offset) - $offset;
		}else{
			//if nothing was given in page request, lets load the first page
			$from = 0;	
		}
		
		// get all data from reservation table
		if(empty($keyword)){
			$sql_query = "SELECT menu_id, menu_name, category_name, price, menu_status, menu_image, serve_for  
					FROM tbl_menu m, tbl_category c
					WHERE m.category_id = c.category_id  
					ORDER BY m.menu_id DESC";
		}else{
			$sql_query = "SELECT menu_id, menu_name, category_name, price, menu_status, menu_image, serve_for  
					FROM tbl_menu m, tbl_category c
					WHERE m.category_id = c.category_id AND menu_name LIKE ? 
					ORDER BY m.menu_id DESC";
		}
		
		$stmt_paging = $connect->stmt_init();
		if($stmt_paging ->prepare($sql_query)) {
			// Bind your variables to replace the ?s
			//if(empty($keyword)){
			//	$stmt_paging ->bind_param('ss', $from, $offset);
			//}else{
				//$stmt_paging ->bind_param('sss', $bind_keyword, $from, $offset);
			//}
			// Execute query
			$stmt_paging ->execute();
			// store result 
			$stmt_paging ->store_result();
			
			$stmt_paging->bind_result($data['menu_id'], 
					$data['menu_name'], 
					$data['category_name'],
					$data['price'], 
					$data['menu_status'],
					$data['menu_image'],
					$data['serve_for']
					);
			
			// for paging purpose
			$total_records_paging = $total_records; 
		}

		// if no data on database show "No Reservation is Available"
		if($total_records_paging == 0){
	
	?>

	<!-- START CONTENT -->
    <section id="content">

        <!--breadcrumbs start-->
        <div id="breadcrumbs-wrapper" class=" grey lighten-3">
          	<div class="container">
            	<div class="row">
              		<div class="col s12 m12 l12">
               			<h5 class="breadcrumbs-title">لیست منو</h5>
		                <ol class="breadcrumb">
		                  <li><a href="dashboard.php">صفحه اصلی</a>
		                  </li>
		                  <li><a href="#" class="active">مدیریت منو</a>
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
				<div class="col s12 m12 l9">
				    <div class="row">
				        <form method="get" class="col s12">
				            <div class="row">
				                <table>
				                	<tr>
				                		<td width="25%"><div align="right">
				                			<div class="input-field col s12">
							                    <a href="add-menu.php" class="btn waves-effect waves-light indigo">اضافه کردن منو</a>
							                </div></div>
				                		</td>
				                		<td width="40%"><div align="right">
				                			<div class="input-field col s12" style="display:none;">
							                    <input type="text" class="validate" name="keyword">
							                    <label for="first_name">جستجو به اساس نام:</label>
							                </div></div>
				                		</td>
				                		<td><div align="right">
				                			<div class="input-field col s12">
							                	<button type="submit" name="btnSearch" class="btn-floating btn-large waves-effect waves-light"><i class="mdi-action-search"></i></button>
							                </div></div>
				                		</td>
				                	</tr>
				                </table>
				             </div>
				        </form>
				    </div>
				</div>


				<div class="col s12 m12 l9">
				    <div class="row">
				        <form method="get" class="col s12">
				            <div class="row">
								<div class="input-field col s12">
				                    <h5>منو یافت نشد!</h5>
				                </div>
				             </div>
				        </form>
				    </div>
				</div>
			</div>
		</div>
	</section>
	<br><br><br><br><br><br><br><br><br><br>
	
	<?php 
		// otherwise, show data
		}else{
			$row_number = $from + 1;
	?>

	<!-- START CONTENT -->
    <section id="content">

        <!--breadcrumbs start-->
        <div id="breadcrumbs-wrapper" class=" grey lighten-3">
          	<div class="container">
            	<div class="row">
              		<div class="col s12 m12 l12">
               			<h5 class="breadcrumbs-title">لیست منو</h5>
		                <ol class="breadcrumb">
		                  <li><a href="dashboard.php">صفحه اصلی</a>
		                  </li>
		                  <li><a href="#" class="active">مدیریت منو</a>
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
				<div class="col s12 m12 l9">
				    <div class="row">
				        <form method="get" class="col s12">
				            <div class="row">
				                <table>
				                	<tr>
				                		<td width="25%"><div align="right">
				                			<div class="input-field col s12">
							                    <a href="add-menu.php" class="btn waves-effect waves-light indigo">اضافه کردن منو</a>
							                </div></div>
				                		</td>
				                		<td width="40%"><div align="right">
				                			<div class="input-field col s12">
											
											
											
							                    <input type="text" class="validate" name="keyword" id="input_search" onkeyup="Search()" autocomplete="off">
							                    <label for="first_name">جستجو به اساس نام</label>
							                </div></div>
				                		</td>
				                		<td><div align="right">
				                			<div class="input-field col s12">
							                	<button type="submit" name="btnSearch" style="display:none;" class="btn-floating btn-large waves-effect waves-light"><i class="mdi-action-search"></i></button>
							                </div></div>
				                		</td>
				                	</tr>
				                </table>
				             </div>
				        </form>
				    </div>
				</div>
            
				<div class="row">
		            <div class="col s12 m12 l12">
		              	<div class="card-panel">
		                	<div class="row">
		                  		<div class="row">
		                    		<div class="input-field col s12">
	
										<table class='hoverable bordered' id="mytable">
										<thead>
											<tr>
												<th><div align="right">نام منو</div></th>
												<th><div align="right">عکس</div></th>
												<th><div align="right">حالت</div></th>
												<th><div align="right">سرو میشود برای</div></th>
												<th><div align="right">قیمت</div></th>
												<th><div align="right">کتگوری</div></th>
												<th><div align="right">عملیه</div></th>
											</tr>
										</thead>

											<?php 
												$counter=0;
											
												while ($stmt_paging->fetch()){ $counter++;?>
												  
												<tbody>
													<tr>
														<td><div align="right"><?php echo mb_strtolower($data['menu_name']);?></div></td>
														<td><div align="right"><img src="<?php echo $data['menu_image']; ?>" width="60" height="40"/></div></td>
														<td><div align="right"><?php echo $data['menu_status'];?></div></td>
														<td><div align="right"><?php echo $data['serve_for'];?> نفر</div></td>
														<td><div align="right"><?php echo $data['price']." ".$currency;?></div></td>
														<td><div align="right"><?php echo $data['category_name'];?></div></td>
														<td><div align="right">
															<a href="menu-detail.php?id=<?php echo $data['menu_id'];?>">
															<i class="mdi-action-pageview"></i>
															</a>					
															<a href="edit-menu.php?id=<?php echo $data['menu_id'];?>">
															<i class="mdi-editor-mode-edit"></i>
															</a>
															<a href="delete-menu.php?id=<?php echo $data['menu_id'];?>">
															<i class="mdi-action-delete"></i>
															</a></div>															
														</td>
													</tr>
												</tbody>
													<?php 
													} 
												}
											?>
										</table>
											<?php // echo "offset : ".$offset ." Total records : ". $total_records." Keyword : ". $sql_query ?>
										
									<!--	<h4><?php// $function->doPages($offset, 'menu.php',null, $total_records,$keyword); ?> </h4> -->
									<h4> Total Records : <?php echo $counter; ?> <h4>

		                    		</div>
		                  		</div>
		                	</div>
		              	</div>
		            </div>
		        </div>
        	</div>
        </div>

	</section>	
	
	
		<script>
function Search() {

  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("input_search");
  filter = input.value.toLowerCase();
  table = document.getElementById("mytable");
  tr = table.getElementsByTagName("tr");
  
  for (i = 0; i < tr.length; i++) {
	  // جستجو به اساس نام در جدول
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    } 
  }
}
</script>

<?php 
	$stmt->close();
	include_once('includes/close_database.php'); ?>
					
				