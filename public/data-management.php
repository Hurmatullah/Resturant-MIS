






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
		left:100px;
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
		text-align:left;
		width:300px;
		
	}
	
	
	.title{
		
		text-align:right;
		font-weight:bold;
		padding-right:10px;
		
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
	$s = mysqli_query($conn,"select * from order_list_manage where res_status =0 AND order_id='$ID' group by order_id"); // شرط
	
	$total_price=0;
	$order_id="";
	
	
 ?>
 
 
	<div style="padding:0px;background-color:#dcf8c6;margin:0;">
		<p style="padding:5px; margin:0;font-weight:bold;">جزئیات مدیریت مالی - بل</p>
	</div>
	<table id="table-info" style="padding:0;">
	
		<?php while($get =mysqli_fetch_array($s) ){ $order_id=$get['order_id']; ?>		
			
		<tr>	<td class="title" style="padding:0;">اسم گارسون :	</td>   	<td class="title" style="padding:0;">  <?php echo $get['waiter_name'] ?> </td></tr>
		<tr> 	<td class="title" style="padding:0;">اسم مشتری :		</td> 		<td class="title" style="padding:0;">  <?php echo $get['customer_name'] ?> </td></tr>
		<tr>	<td class="title" style="padding:0;">تاریخ و ساعت :	</td>   	<td class="title" style="padding:0;">  <?php echo $get['date_time'] ?>   </td></tr>																																									`															
		<tr>	<td class="title" style="padding:0;">نمبر میز :   	</td>   	<td class="title" style="padding:0;"> <span style="font-size:2em;"> <?php echo $get['phone'] ?></span>       </td></tr>
		
		<?php $db_dis_amount = $get['discount_amount'];?>
		<?php $db_dis_per = $get['discount_percentage'];?>
		<?php }?>
		
		</table >
		
		
		<div style="background-color:#dcf8c6; padding:0px; color:#4aae20;">
		 <p style="padding-right:10px;">لیست سفارشات صرف شده</p></div>
		 
		 
	<!-- start table  foot item -->
		
		<table class="bordered">
		<thead >
			<tr style="background-color:#f3f6f8;">
			<th class="title">اسم غذا</th>
			<th class="title">نرخ</th>
			<th class="title">تعداد</th>
			<th class="title">مجموعه</th>
			</tr>
		</thead>
		
		<tbody>
		
			
			<?php 	 
			$kitchen_status_flag=0;
			$kitchen_out_status_flag=0;
			$menu_list = mysqli_query($conn,"select * from order_list_view where order_id = '$order_id'");// شرط
			while($item = mysqli_fetch_array($menu_list)){ ?>
			<?php if($item['status']==0) {  $kitchen_status_flag=1; ?>	
			
			  <tr style="background-color:#ffaaaa"> 
				  <td class="title"><?php echo $item['menu_name'] ?></td>  
				  <td class="title"><?php echo $item['price'] ?> </td> 
				  <td class="title"><?php echo $item['qty'] ?></td>  
				  <td class="title" style="padding-right:20px;"><?php echo $item['qty']*$item['price'] ?></td>
					
				  
				 <?php $gtotal+=$item['qty']*$item['price']  ?> 
			
			  </tr>
		<?php 	} else { $kitchen_out_status_flag=1; ?>
			  <tr> 
				  <td class="title"><?php echo $item['menu_name'] ?></td>  
				  <td class="title"><?php echo $item['price'] ?> </td> 
				  <td class="title"><?php echo $item['qty'] ?></td>  
				  <td class="title" style="padding-right:20px;"><?php echo $item['qty']*$item['price'] ?></td>
					
				  
				 <?php $gtotal+=$item['qty']*$item['price']  ?> 
			
			  </tr>		
			
	<?php	} ?>
			  
			  
			  
				  
		<?php 	} ?>
			
		<!-- table grand total -->
			<tr style="background-color:#fff;">
			<td></td>
			<td></td>
			<td id="gtotal" ><input type="hidden" name="gtotal" id="gtotal" value="<?php echo $gtotal; ?>"/>  مجموعه</td>
			<td style="background-color:#dcf8c6; text-align:right;padding:0;" >
				
				<span style="font-size:2em;font-weight:bold; color:#000;padding-right:20px;"><?php echo $gtotal; ?></span> <span>افغانی</span>
			
			
			</td>
			 
			 </tr>
		</tbody>
		</table>	
		
		<!-- end table foot item -->
			
		
		<!-- input --->
		<div style="background-color:#e9eff3; padding: 20px 0 20px 0; margin:0;">
		<form method="POST"  action="public/discount_calculation_page.php" class="center2"  style="width:450px;">
		
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
					<th> مجموعه بعد از تخفیف <th> 
					
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
					        <?php  if($kitchen_status_flag==0 && $kitchen_out_status_flag==1) {?>
							<form action="public/updateorderlist-management.php" method="POST">
	
											<button type="submit" class="btn" style="margin-bottom:60px; float:left;" name="btnComplete">تکمیل <i class="mdi-content-send right"></i></button>	
										<!--	<button type="submit" class="btn waves-effect waves-light indigo right" name="btnCancel">کنسل <i class="mdi-content-send right"></i></button>	-->
											<input type="hidden" name="ID" value="<?php echo $ID; ?>"/>
		      				</form>
							<?php }  ?>

		
		
		
		
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