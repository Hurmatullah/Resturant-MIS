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
			
		if(empty($keyword)){
			$sql_query = "SELECT nid, news_heading, news_image, news_date 
					FROM tbl_news
					ORDER BY nid DESC";
		}else{
			$sql_query = "SELECT nid, news_heading, news_image, news_date 
					FROM tbl_news
					WHERE news_heading LIKE ? 
					ORDER BY nid DESC";
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
			$stmt->bind_result($data['nid'], 
					$data['news_heading'], 
					$data['news_image'], 
					$data['news_date']
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
		
		if(empty($keyword)){
			$sql_query = "SELECT nid, news_heading, news_image, news_date 
					FROM tbl_news
					ORDER BY nid DESC LIMIT ?, ?";
		}else{
			$sql_query = "SELECT nid, news_heading, news_image, news_date 
					FROM tbl_news
					WHERE news_heading LIKE ? 
					ORDER BY nid DESC LIMIT ?, ?";
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
			$stmt_paging->bind_result($data['nid'], 
					$data['news_heading'], 
					$data['news_image'], 
					$data['news_date']
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
               			<h5 class="breadcrumbs-title">لیست جدید</h5>
		                <ol class="breadcrumb">
		                  <li><a href="dashboard.php">صفجه اصلی</a>
		                  </li>
		                  <li><a href="#" class="active">مدیریت اخبار</a>
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
							                    <a href="add-news.php" class="btn waves-effect waves-light indigo">اضافه کردن خبر جدید</a>
							                </div></div>
				                		</td>
				                		<td width="40%"><div align="right">
				                			<div class="input-field col s12">
							                    <input type="text" class="validate" name="keyword">
							                    <label for="first_name">جستجو</label>
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
				                    <h5>اخباری یافت نشد</h5>
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
               			<h5 class="breadcrumbs-title">لیست جدید</h5>
		                <ol class="breadcrumb">
		                  <li><a href="dashboard.php">صفحه اصلی</a>
		                  </li>
		                  <li><a href="#" class="active">مدیریت اخبار</a>
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
							                    <a href="add-news.php" class="btn waves-effect waves-light indigo">اضافه کردن خبر جدید</a>
							                </div></div>
				                		</td>
				                		<td width="40%"><div align="right">
				                			<div class="input-field col s12">
							                    <input type="text" class="validate" name="keyword">
							                    <label for="first_name">Search</label>
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
											<tr>
												<th><div align="right">عنوان جدید</div></th>
												<th><div align="right">عکس</div></th>
												<th><div align="right">تاریخ</div></th>
												<th><div align="right">عملیه</div></th>
											</tr>
										</thead>

											<?php 
												while ($stmt_paging->fetch()){ ?>
												<tbody>
													<tr>
														<td width="40%"><div align="right"><?php echo $data['news_heading'];?></div></td>
														<td><div align="right"><img src="upload/news/thumbs/<?php echo $data['news_image']; ?>" width="50" height="50"/></div></td>
														<td><div align="right"><?php echo $data['news_date'];?></div></td>
														<td><div align="right">		
															<a href="edit-news.php?id=<?php echo $data['nid'];?>">
															<i class="mdi-editor-mode-edit"></i>
															</a>
															<a href="delete-news.php?id=<?php echo $data['nid'];?>">
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

										<h4><?php $function->doPages($offset, 'news.php', '', $total_records, $keyword); ?></h4>

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