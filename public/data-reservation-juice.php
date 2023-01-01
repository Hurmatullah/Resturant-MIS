<style>
#list{
		
		
	    text-align:right;
		
	}
	
	#list-item{
		
	    
		background-color: #ccc;
		padding:4x;
		margin:2px;	
		border-radius:10px;
		
	}
	
	
	
</style>
	<!-- START CONTENT -->
    <section id="content">

        <!--breadcrumbs start-->
        <div id="breadcrumbs-wrapper" class=" grey lighten-3">
          	<div class="container">
            	<div class="row">
              		<div class="col s12 m12 l12">
               			<h5 class="breadcrumbs-title">جزئیات سفارشات - نوشیدنی ها</h5>
		                <ol class="breadcrumb">
		                  <li><a href="dashboard.php">صفحه اصلی</a>
		                  </li>
		                  <li><a href="#" class="active">جزئیات سفارش</a>
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
<?php
	
	//header('Content-Type:text/html;charset=UTF-8');
	$host = "localhost";
	$db   = "restaurant";
	$user = "root";
	$pass = "";
	
	$conn = mysqli_connect($host,$user,$pass,$db);
	$conn->set_charset("utf8");
	
		if(isset($_GET['id'])){
			$ID = $_GET['id'];
		}else{
			$ID = "";
		}
	$s = mysqli_query($conn,"select * from order_list_view where res_status = 0 AND order_id='$ID' and category_id = 3  group by order_id order by order_id DESC"); // شرط
	
	
	
 ?>
 
	<table class="bordered">
	<tr>
	<thead>
	
		<th style="text-align:center;background-color:#fdb94e; color:white;">اسم گارسون</th>
		<th style="text-align:center;background-color:white; color:#000;;">تاریخ و ساعت</th>
		<th style="text-align:center;background-color:#008bcf; color:white;">نمبر میز</th>
		<th style="text-align:center;background-color:#ccc; color:white;">سفارشات</th>
		
		
	</thead>
	</tr>
	<tbody>
  
    <?php while($data = mysqli_fetch_array($s)){ ?>
	
		<tr style="padding:0;">
			
			<td style="width:200px; background-color:#fdb94e; text-align:center;">  <?php echo $data[6] ?> </td>
			<td style="width:200px; background-color:white; text-align:center;">  <?php echo $data[2] ?> </td>
			<td style="width:100px; background-color:dodgerblue; text-align:center; font-size:36px;  color:white;">  <?php echo $data[5] ?> </td>
			
			<td style ="padding:0 20px 0 20px;"> <ul id="list">
			<?php 	 
			
			$menu_list = mysqli_query($conn,"select * from order_list_view where order_id = '$data[0]' and category_id = 3 ");// شرط
			while($item = mysqli_fetch_array($menu_list)){ ?>
					
			       
				   <?php if($item[14] == 1){?>
				   <li id="list-item" style="background-color:#0af167; color:green;">

				   <span style="width:60px; background-color:#e9e8dd; border-radius:0 10px 10px 0; padding:30; display:inline-block; text-align:center; font-size:1.5em;"> <?php  echo $item[13]; ?> </span> <span style="padding-right:10px;"> <?php echo $item[9]; ?> </span>  
				   <span style="float:left;">
						
					<form action="public/updateorderlist-juice.php" method="POST" >
					<input type="hidden" name="order_id" value="<?php echo $item[7]?>"/>
					<input type="hidden" name="qty"      value="<?php echo $item[13]?>"/>
					<input type="hidden" name="name"     value="<?php echo $item[9]?>"/>
					<input type="hidden" name="isUpdate" value="<?php echo 0; ?>"/>
					<input type="hidden" name="ID" value="<?php echo $ID; ?>"/>
					<input type="submit" value="رد ارسال"  style="border-color:transparent;background-color:red; border-radius:4px; color:white; border-radius:10px; color:white; margin-left:10px;margin-top:5px;"/>
					</form>

				 </span>
				   
				 			   
				   </li>
				   <?php }else { ?>
				   
				   <!-- btn send -->
				  <li id="list-item" style="background-color:#ffaaaa;">
				   <span style="width:60px; background-color:#e9e8dd; border-radius:0 10px 10px 0; padding:3; display:inline-block; text-align:center; font-size:1.5em;"> <?php  echo $item[13]; ?></span> <span style="padding-right:10px;"> <?php echo $item[9]; ?></span>
				   <span style="float:left;">
					
					<form action="public/updateorderlist-juice.php" method="POST">
					<input type="hidden" name="order_id" value="<?php echo $item[7]?>"/>
					<input type="hidden" name="qty"      value="<?php echo $item[13]?>"/>
					<input type="hidden" name="name"     value="<?php echo $item[9]?>"/>
					<input type="hidden" name="isUpdate" value="<?php echo 1; ?>"/>
					<input type="hidden" name="ID" value="<?php echo $ID; ?>"/>
					<input type="submit" value="ارسال" style="border-color:transparent;background-color:green; border-radius:10px; color:white; margin-left:10px;margin-top:5px;"/>
					</form>
					
				   </span>
				  </li>
				   
				   
						
				  <?php } ?>
				  
		<?php 	} ?>
		</ul>
		</td>
		
		</tr>
		
<?php	}?> 

	</tbody>
	</table>
        </div>		
		
	<!-- <?php /*	<tr>
													<th><div align="right">حالت</div></th>
													<td><div align="right">
														<select name="status" class="form-control">	

														<?php if ($data['status'] == 0) { ?>
															<option value="0" selected="selected">درحال انتظار</option>
															<option value="1">ارسال به مدیریت</option>
															<option value="2">کنسل شد</option>

														<?php } else if ($data['status'] == 1) { ?>
															<option value="0">در حال انتظار</option>
															<option value="1" selected="selected">ارسال به مدیریت</option>
															<option value="2">کنسل شد</option>
														<?php } else if ($data['status'] == 2) { ?>
															<option value="0">در حال انتظار</option>
															<option value="1" selected="selected">ارسال به مدیریت</option>
															<option value="2">کنسل شد</option>
														
														<?php } else { ?>
															<option value="0">در حال انتظار</option>
															<option value="1">ارسال به مدیریت</option>
															<option value="2" selected="selected">کنسل شد</option>
														<?php } ?>
	
														</select>
													</div></td>
												</tr>
												
											</table>
											<br>
											<button type="submit" class="btn waves-effect waves-light indigo right" name="btnSave">تکمیل <i class="mdi-content-send right"></i></button> */ ?>-->
	
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		
		
		
		
		
		
<script language="javascript" type="text/javascript">
    function submitUpdate() {
       $(".update_order_status").submit();
	   location.reload();
    }
</script>





			
<?php include_once('includes/close_database.php'); ?>