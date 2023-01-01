<?php
	include_once('includes/connect_database.php'); 
	include_once('functions.php'); 
	
?>

<head>
<meta http-equiv="refresh" content="5"/>

</head>

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
			$sql_query = "SELECT order_id, waiter_name, number_of_people, date_time, phone, res_status
				FROM order_list_view where res_status = 0 group by order_id 
				ORDER BY order_id DESC";
		}else{
			$sql_query = "SELECT order_id, waiter_name, number_of_people, date_time, phone, res_status
				FROM order_list_view where res_status = 0  group by order_id  
				WHERE name LIKE ? 
				ORDER BY order_id DESC";
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
			$stmt->bind_result($data['order_id'], 
					$data['waiter_name'],					
					$data['number_of_people'], 
					$data['date_time'], 
					$data['phone'],
					$data['res_status']
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
			$sql_query = "SELECT order_id, waiter_name, number_of_people, date_time, phone, res_status
				FROM order_list_view where res_status = 0 group by order_id  
				ORDER BY order_id DESC
				LIMIT ?, ?";
		}else{
			$sql_query = "SELECT order_id, waiter_name, number_of_people, date_time, phone, res_status
				FROM order_list_view where res_status = 0 group by order_id 
				WHERE waiter_name LIKE ? 
				ORDER BY order_id ASC 
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
			
			$stmt_paging ->bind_result($data['order_id'], 
					$data['waiter_name'],					
					$data['number_of_people'], 
					$data['date_time'], 
					$data['phone'],
					$data['res_status']
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
               			<h5 class="breadcrumbs-title">مدیریت مالی</h5>
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
							                	<button type="submit" name="btnSearch" style="display:none;" class="btn-floating btn-large waves-effect waves-light"><i class="mdi-action-search"></i></button>
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
               			<h5 class="breadcrumbs-title">مدیریت مالی</h5>
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
											
											
<!-- ---------------------------------------  SEARCH ON TABLE WHILE DATA ON TABLE EXIST------------------------------------- -->
											
							                    <input type="text" class="validate" name="keyword" id="input_search" onkeyup="Search()" autocomplete="off">
							                    <label for="first_name">جستجو به اساس میز نمبر</label>
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
											
												<th><div align="right">شماره سفارش</div></th>
												<th><div align="right">اسم گارسون</div></th>
												<th><div align="right">شماره میز</div></th>
												<th><div align="right">تعداد نفر</div></th>
												<th><div align="right">تاریخ و ساعت</div></th>
												<th><div align="right">حالت</div></th>
												<th><div align="right">عملیه</div></th>
											</tr>
										</thead>

											<?php 
												while ($stmt_paging->fetch()){ ?>
												<tbody>
													<tr>
														<td><div align="right"><?php echo $data['order_id'];?></div></td>
														<td><div align="right"><?php echo $data['waiter_name'];?></div></td>
														<td><div align="right" style="font-size:2em;background-color:dodgerblue;border-radius:10px;color:white; padding:2px; width:50px; height:50px; text-align:center;"><?php echo $data['phone'];?></div></td>
														<td><div align="right"><?php echo $data['number_of_people'];?> نفر</div></td>
														<!--<td><div align="right"><?php //echo $data['email'];?></div></td>-->
														<td><div align="right"><?php echo $data['date_time'];?></div></td>
														<td><div align="right">

														<?php if($data['res_status'] == 0) { ?>
															<span class='white-text red lighten-2'>&nbsp;&nbsp;انتظار&nbsp;&nbsp;</span>
															<?php } else if($data['res_status'] == 1) {?>
															<span class='white-text green lighten-2'>&nbsp;&nbsp;ارسال به مدیریت&nbsp;&nbsp;</span>
															<?php } else if($data['res_status'] == 3) {?>
															<span class='white-text brown lighten-2'>&nbsp;&nbsp;تکمیل شد&nbsp;&nbsp;</span>
															<?php } ?></div>
														</td>																											
														<td><div align="right">
															<a href="detail-management.php?id=<?php echo $data['order_id'];?>">
															<i class="mdi-action-pageview"></i>
															</a>
															<a href="delete-management.php?id=<?php echo $data['order_id'];?>">
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

										<h4><?php $function->doPages($offset, 'management.php', '', $total_records, $keyword); ?></h4>

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
  filter = input.value;
  table = document.getElementById("mytable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[2];
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
					
				