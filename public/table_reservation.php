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
		
		// get all data from pemesanan table
		if(empty($keyword)){
			$sql_query = "SELECT ID, name, number_of_people, date_time, phone, status, email
				FROM tbl_reservation  
				ORDER BY ID DESC";
		}else{
			$sql_query = "SELECT ID, name, number_of_people, date_time, phone, status, email
				FROM tbl_reservation 
				WHERE name LIKE ? 
				ORDER BY ID DESC";
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
			$stmt->bind_result($data['ID'], 
					$data['name'],					
					$data['number_of_people'], 
					$data['date_time'], 
					$data['phone'],
					$data['status'],
					$data['email']
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
		$offset = 20;
							
		//lets calculate the LIMIT for SQL, and save it $from
		if ($page){
			$from 	= ($page * $offset) - $offset;
		}else{
			//if nothing was given in page request, lets load the first page
			$from = 0;	
		}
		
		// get all data from pemesanan table
		if(empty($keyword)){
			$sql_query = "SELECT ID, name, number_of_people, date_time, phone, status, email 
				FROM tbl_reservation 
				ORDER BY ID DESC 
				LIMIT ?, ?";
		}else{
			$sql_query = "SELECT ID, name, number_of_people, date_time, phone, status, email 
				FROM tbl_reservation 
				WHERE name LIKE ? 
				ORDER BY ID ASC 
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
			
			$stmt_paging ->bind_result($data['ID'], 
					$data['name'], 
					$data['number_of_people'], 
					$data['date_time'], 
					$data['phone'],
					$data['status'],
					$data['email']
					);
			
			// for paging purpose
			$total_records_paging = $total_records; 
		}
						
		// if no data on database show "Tidak Ada Pemesanan"
		if($total_records_paging == 0){
	?>

	<!-- START CONTENT -->
    <section id="content">

        <!--breadcrumbs start-->
        <div id="breadcrumbs-wrapper" class=" grey lighten-3">
          	<div class="container">
            	<div class="row">
              		<div class="col s12 m12 l12">
               			<h5 class="breadcrumbs-title">لیست ریزرف</h5>
		                <ol class="breadcrumb">
		                  <li><a href="dashboard.php">صفحه اصلی</a>
		                  </li>
		                  <li><a href="#" class="active">لیست ریزرف</a>
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
				                		<td width="40%"><div align="right">
				                			<div class="input-field col s12">
							                    <input type="text" class="validate" name="keyword">
							                    <label for="first_name">جستجو به اساس نام: </label>
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
				                    <h5>هیچ ریزرفی یافت نشد</h5>
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
		}else{ $row_number = $from + 1;?>
	

	<!-- START CONTENT -->
    <section id="content">

        <!--breadcrumbs start-->
        <div id="breadcrumbs-wrapper" class=" grey lighten-3">
          	<div class="container">
            	<div class="row">
              		<div class="col s12 m12 l12">
               			<h5 class="breadcrumbs-title">لیست ریزرف</h5>
		                <ol class="breadcrumb">
		                  <li><a href="dashboard.php">صفحه اصلی</a>
		                  </li>
		                  <li><a href="#" class="active">لیست ریزرف</a>
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
				                		<td width="40%"><div align="right">
				                			<div class="input-field col s12">
							                    <input type="text" class="validate" name="keyword">
							                    <label for="first_name">جستجو به اساس نام</label>
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
            
				<div class="row">
		            <div class="col s12 m12 l12">
		              	<div class="card-panel">
		                	<div class="row">
		                  		<div class="row">
		                    		<div class="input-field col s12">
	
										<table class='hoverable bordered'>
										<thead>
										<!--	<tr>
												<th><div align="right">Name</div></th>
												<th><div align="right">Number of People</div></th>
												<th><div align="right">Phone</div></th>
												<th><div align="right">Email</div></th>
												<th><div align="right">Date & Time</div></th>
												<th><div align="right">Status</div></th>
												<th><div align="right">Action</div></th>
											</tr>
											-->
											
											<tr>
												<th><div align="right">شماره سفارش</div></th>
												<th><div align="right">آی دی گارسون</div></th>
												<th><div align="right">شماره میز</div></th>
												<th><div align="right">نام مشتری</div></th>
												<th><div align="right">تاریخ و ساعت</div></th>
												<th><div align="right">حالت</div></th>
												<th><div align="right">عملیه</div></th>
											</tr>
										</thead>

											<?php 
												while ($stmt_paging->fetch()){ ?>
												<tbody>
													<tr>
														<td><div align="right"><?php echo $data['ID'];?></div></td>
														<td><div align="right"><?php echo $data['name'];?></div></td>
														<td><div align="right"><?php echo $data['number_of_people'];?> نفر</div></td>
														<td><div align="right"><?php echo $data['phone'];?></div></td>
														<!--<td><div align="right"><?php //echo $data['email'];?></div></td>-->
														<td><div align="right"><?php echo $data['date_time'];?></div></td>
														<td><div align="right">

														<?php if($data['status'] == 0) { ?>
															<span class='white-text red lighten-2'>&nbsp;&nbsp;انتظار&nbsp;&nbsp;</span>
															<?php } else if($data['status'] == 1) {?>
															<span class='white-text green lighten-2'>&nbsp;&nbsp;ارسال به مدیریت&nbsp;&nbsp;</span>
															<?php } else {?>
															<span class='white-text black lighten-2'>&nbsp;&nbsp;کنسل شد&nbsp;&nbsp;</span>
															<?php } ?></div>
														</td>																											
														<td><div align="right">
															<a href="detail-reservation.php?id=<?php echo $data['ID'];?>">
															<i class="mdi-action-pageview"></i>
															</a>
															<a href="delete-reservation.php?id=<?php echo $data['ID'];?>">
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

										<h4><?php $function->doPages($offset, 'reservation.php', '', $total_records, $keyword); ?></h4>

		                    		</div>
		                  		</div>
		                	</div>
		              	</div>
		            </div>
		        </div>
        	</div>
        </div>

	</section>	


<?php 
	$stmt->close();
	include_once('includes/close_database.php'); ?>
					
				