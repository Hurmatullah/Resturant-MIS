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
			$keyword = $function->sanitize($_GET['keyword']);
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
			$sql_query = "SELECT id, name, user_name, password, status 
					FROM waiter_user
					";
		}else{
			$sql_query = "SELECT id, name, user_name, password, status 
					FROM waiter_user
					WHERE name LIKE ? 
					";
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
			$stmt->bind_result($data['id'], 
					$data['name'], 
					$data['user_name'],
					$data['password'], 
					$data['status']
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
			$sql_query = "SELECT id, name, user_name, password, status 
					FROM waiter_user 
					LIMIT ?, ?";
		}else{
			$sql_query = "SELECT id, name, user_name, password, status 
					FROM waiter_user LIKE ? 
					LIMIT ?, ?";
		}
		
		$stmt_paging = $connect->stmt_init();
		if($stmt_paging ->prepare($sql_query)) {
			// Bind your variables to replace the ?s
			if(empty($keyword)){
				$stmt_paging ->bind_param('ss', $from, $offset);
			}else{
				$stmt_paging ->bind_param('sss', $bind_keyword, $from, $offset);
			}
			// Execute query
			$stmt_paging ->execute();
			// store result 
			$stmt_paging ->store_result();
			
			$stmt_paging->bind_result($data['id'], 
					$data['name'], 
					$data['user_name'],
					$data['password'], 
					$data['status']
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
               			<h5 class="breadcrumbs-title">لیست گارسون</h5>
		                <ol class="breadcrumb">
		                  <li><a href="dashboard.php">صفحه اصلی</a>
		                  </li>
		                  <li><a href="#" class="active">مدیریت گارسون</a>
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
							                    <a href="add-garson.php" class="btn waves-effect waves-light indigo">اضافه کردن گارسون</a>
							                </div></div>
				                		</td>
				                		<td width="40%"><div align="right">
				                			<div class="input-field col s12" style="display:none;">
							                    <input type="text" class="validate" name="keyword" >
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
				                    <h5>گارسون یافت نشد!</h5>
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
               			<h5 class="breadcrumbs-title">لیست گارسون</h5>
		                <ol class="breadcrumb">
		                  <li><a href="dashboard.php">صفحه اصلی</a>
		                  </li>
		                  <li><a href="#" class="active">مدیریت گارسون</a>
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
							                    <a href="add-garson.php" class="btn waves-effect waves-light indigo">اضافه کردن گارسون</a>
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
							                	<button type="submit" style="display:none;" name="btnSearch" class="btn-floating btn-large waves-effect waves-light"><i class="mdi-action-search"></i></button>
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
												<th><div align="right">شماره</div></th>
												<th><div align="right">نام</div></th>
												<th><div align="right">نام کاربری</div></th>
												<th><div align="right">رمز عبور</div></th>
												<th><div align="right">حالت</div></th>
											    <th><div align="right">عملیه</div></th>
											</tr>
										</thead>

											<?php 
												while ($stmt_paging->fetch()){ ?>
												<tbody>
													<tr>
														<td><div align="right"><?php echo $data['id'];?></div></td>
														<td><div align="right"><?php echo mb_strtolower($data['name']);?></div></td>
														<td><div align="right"><?php echo $data['user_name'];?></div></td>
														<td><div align="right"><?php echo $data['password'];?></div></td>
												     <td><div align="right"><?php if($data['status']==0) {echo "فعال";} else {echo "غیرفعال";} ?></div></td>
														</div></td>
														
														<td><div align="right">
															<a href="edit-garson.php?id=<?php echo $data['id'];?>">
															<i class="mdi-editor-mode-edit"></i>
															</a>
															<a href="delete-garson.php?id=<?php echo $data['id'];?>">
														<!--	<i class="mdi-action-delete"></i> -->
															</a></div>
														</td>
											
													</tr>
												</tbody>
													<?php 
													} 
												}
											?>
										</table>

										<h4><?php $function->doPages($offset, 'garson.php', '', $total_records, $keyword); ?></h4>

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
    td = tr[i].getElementsByTagName("td")[1];
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
					
				