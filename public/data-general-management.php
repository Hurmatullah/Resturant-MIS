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
	#w{
		position:relative;
		left:250px;
	}
	#z{
		position:relative;
		left:70px;
	}
	
	#x{
		position:relative;
		left:100px;
		text-align:center;
		padding:10px
		
	}
	#y
	{
		position:relative;
		left:20px
		
	}
	#s{
		position:relative;
		right:35px;
		
	}
	#table-info
	{
		position:relative;
		text-align:right;
		width:300px;
		
	}
	
	
	.title{
		
		text-align:right;
		font-weight:bold;
		padding-right:20px;
	}
	
	
	.title2{
		
		text-align:right;
		font-weight:bold;
		padding-right:20px;
	}
	
	.center2 {
	margin: auto;
	width: 50%;
	background-color:white;
	border: 1px solid #e9eff3;
	padding: 10px;
	}

	
</style>
	<!-- START CONTENT -->
    <section id="content">

   
		
		
        <!--breadcrumbs end-->

        <!--start container-->
        <div class="container">
          	<div class="section">
<?php
	$gtotal=0;
	$net_total=0;
	$db_dis_amount =0;
	$db_dis_per =0;
	$db_res_status;
	
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
	$s = mysqli_query($conn,"select * from order_list_manage where order_id='$ID' group by order_id"); // شرط
	
	$total_price=0;
	$order_id="";
	
	
 ?>
 
	<div style="padding:0px;background-color:#dcf8c6;margin:0;">
		<p style="padding:5px; margin:0;font-weight:bold;">جزئیات مدیریت عمومی - بل</p>
	</div>
 
	<table  id="table-info" style="padding:0;">
		<?php while($get =mysqli_fetch_array($s) ){ $order_id=$get['order_id']; ?>		
			
		<tr> <td class="title" style="padding:0;">اسم گارسون	</td> 	<td class="title" style="padding:0;">  <?php echo $get['waiter_name'] ?> </td></tr>
		<tr> <td class="title" style="padding:0;">اسم مشتری	</td> 	<td class="title" style="padding:0;">  <?php echo $get['customer_name'] ?> </td></tr>
		<tr> <td class="title" style="padding:0;">تاریخ و ساعت	</td>	<td class="title" style="padding:0;">  <?php echo $get['date_time'] ?> </td></tr>																																							`															
		<tr> <td class="title" style="padding:0;">نمبر میز		</td>	<td class="title" style="padding:0;">  <span style="font-size:2em;"> <?php echo $get['phone'] ?></span>  </td></tr>
		
		<?php $db_dis_amount = $get['discount_amount'];?>
		<?php $db_dis_per = $get['discount_percentage'];?>
		<?php $db_res_status = $get['res_status'];?>
		<?php }?>
		
		</table >
		
		
		<div style="background-color:#dcf8c6; padding:0px; color:#4aae20;">
		 <p style="padding-right:10px;">لیست سفارشات صرف شده</p></div>
		
		
		
		
		<table class="bordered" >
		<thead>
		<tr style="background-color:#f3f6f8;">
		<th class="title">غذا</th>
		<th class="title">نرخ</th>
		<th class="title">تعداد</th>
		<th class="title">جمله</th>
		<th class="title">عملکرد</th>
		</tr>
		</thead>
  
    <?php// while($data = mysqli_fetch_array($s)){ ?>
	

			<?php 	 
			$menu_list = mysqli_query($conn,"select * from order_list_view where order_id = '$order_id'");// شرط
			while($item = mysqli_fetch_array($menu_list)){ ?>
			<?php if($item['status']==0) {?>	
			
			  <tr style="background-color:#ffaaaa"> 
				  <td class="title2"><?php echo $item['menu_name'] ?></td>  
				  <td class="title2"><?php echo $item['price'] ?> </td> 
				  <td class="title2"><?php echo $item['qty'] ?></td>  
				  <td class="title2"><?php echo $item['qty']*$item['price'] ?></td>
				  
				  
				    <form action="public/updateorderlist-management.php" method="POST" >
					<input type="hidden" name="order_id" value="<?php echo $item[7]?>"/>
					<input type="hidden" name="qty"      value="<?php echo $item[13]?>"/>
					<input type="hidden" name="name"     value="<?php echo $item[9]?>"/>
					<input type="hidden" name="isUpdate" value="<?php echo 0; ?>"/>
					<input type="hidden" name="ID" value="<?php echo $ID; ?>"/>
					<input type="hidden" name="order_list_id" value="<?php echo $item['order_list_id']; ?>"/>
				  <td class="center"> <input type="submit" value="حذف"class="btn btn-default" name="deleteBtn"/></td> 
				  </form>
				  
				  
				</tr>	
				  
				 <?php $gtotal+=$item['qty']*$item['price'];
			
				 ?> 
				 
				 
				 
				 
				 
		<?php 	} else {?>
		
			  <tr> 
				  <td class="title2"><?php echo $item['menu_name'] ?></td>  
				  <td class="title2"><?php echo $item['price'] ?> </td> 
				  <td class="title2"><?php echo $item['qty'] ?></td>  
				  <td class="title2"><?php echo $item['qty']*$item['price'] ?></td>

				<form action="public/updateorderlist-management.php" method="POST" >
					<input type="hidden" name="order_id" value="<?php echo $item[7]?>"/>
					<input type="hidden" name="qty"      value="<?php echo $item[13]?>"/>
					<input type="hidden" name="name"     value="<?php echo $item[9]?>"/>
					<input type="hidden" name="isUpdate" value="<?php echo 0; ?>"/>
					<input type="hidden" name="ID" value="<?php echo $ID; ?>"/>
					<input type="hidden" name="order_list_id" value="<?php echo $item['order_list_id']; ?>"/>
				  <td class="center"> <input type="submit" value="حذف"class="btn btn-default" name="deleteBtn"/></td> 
				  </form>
			  </tr>				  
				  
				 <?php $gtotal+=$item['qty']*$item['price']  ?> 	
			<?php	} }?>	 
			
		
			<!-- table grand total -->
			<tr style="background-color:#fff;">
			<td></td>
			<td></td>
			<td id="gtotal" ><input type="hidden" name="gtotal" id="gtotal" value="<?php echo $gtotal; ?>"/>  مجموعه</td>
			<td style="background-color:#dcf8c6; text-align:right;padding:0;" >
				
				<span style="font-size:2em;font-weight:bold; color:#000;padding-right:20px;"><?php echo $gtotal; ?></span> <span>افغانی</span>
			
			
			</td>
			 
			 </tr>
		 

	</table>
	
	<!-- input --->
		<div style="background-color:#e9eff3; padding: 20px 0 20px 0; margin:0;">
	    <form method="POST"  action="public/discount_calculation_page.php" class="center2" style="width:450px;" >
		<table>
			
					<tr>
							<th> تخفیف (فیصدی) <th>
							<td> <input type="number" name="percentDiscount" id="percentDiscount" value="<?php echo $db_dis_per;?>" /></td>
					</tr>
					<tr>
							<th> تخفیف (مبلغ) <th> 
							<td>  <input type="number" value="<?php echo $db_dis_amount; ?>" name="amountDiscount" id="amaountDiscount" /> </td>
					</tr>
					
					<tr>
										<input type="hidden" name="ID" value="<?php echo $ID; ?>"/>
										<input type="hidden" name="gtotal" value="<?php echo $gtotal;?>"/>

							<td>  <input type="submit" class="btn"name="btnCountDiscount" class="btn waves-effect waves-light indigo left" value="محاسبه"></td>
					</tr>
					
					<tr>
					
					
					
					</tr>
					
					
					
					<tr >
							<th > مجموعه بعد از تخفیف <th> 
					
	<?php

			if($db_dis_amount>0 && $db_dis_per<=0)
				$net_total = $gtotal-$db_dis_amount;
			else if($db_dis_per>0 && $db_dis_amount<=0)
				$net_total = $gtotal-$gtotal/100*$db_dis_per;
			else 
				$net_total = $gtotal;
				
			
	?>	
				<td style="background-color:#dcf8c6; text-align:right;padding:0;">
				<span style="font-size:2em;font-weight:bold; color:#000;padding-right:20px;"><?php echo $net_total; ?></span> <span>افغانی</span>
				
				</td>
			</tr>


	


		</table>
	</form>
	
	</div>
	</div>		
					      
							<form action="public/updateorderlist-management.php" method="POST">
	
											<!--<button type="submit" class="btn waves-effect waves-light indigo left" name="btnComplete">تکمیل <i class="mdi-content-send right"></i></button>	-->
											<?php if($db_res_status==0 || $db_res_status ==2) {?>
											<button type="submit" class="btn" style="margin-bottom:60px; float:left;" name="btnCancel">کنسل </button>	
											
											<?php	} else if($db_res_status ==3) {?>
											<button type="submit" class="btn" style="margin-bottom:60px; float:left;" name="btnCancel">رد کنسل </button>
											<?php } ?>
											<input type="hidden" name="ID" value="<?php echo $ID; ?>"/>
											<input type="hidden" name="res_status" value="<?php echo $db_res_status; ?>"/>
		<br>				</form>
		
		
		
		
		
<script language="javascript" type="text/javascript">
    function submitUpdate() {
       $(".update_order_status").submit();
	   location.reload();
    }
	
/*	
	function test()
	{
   var total = document.getElementById('gtotal').value;
   var discount = document.getElementById('percentDiscount').value;
   
   var harchibadabad = total - discount ;
   
   alert(harchibadabad);
   
  */ 
	
}
	
</script>






			
<?php include_once('includes/close_database.php'); ?>