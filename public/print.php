<html>
<head>
<link rel="stylesheet" type="text/css" href="printStyle.css">
</head>


<body >

<?php
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

		$gtotal = 0;
		$customer_name;
		$orderId;
		$date_time;
		$dis_amnt;
		$dis_per;
		
		$no_inc=1;
		
		$query=mysqli_query($conn,"select * from order_list_manage where order_id='$ID'");
		
		while($head =mysqli_fetch_array($query)) {
			$customer_name = $head['customer_name'];
			$orderId = $head['order_id'];
			$date_time = $head['date_time'];
			$dis_amnt = $head['discount_amount'];
			$dis_per = $head['discount_percentage'];
		}
		
?>

<div id="container" style="margin:auto;">
	<table id="table">
		<tr >
			<h3 style="text-align:center; margin-bottom:20px; ">Karim Continental</h3>
		</tr>
		<tr>
			<td>Customer Name: &nbsp;&nbsp;&nbsp;&nbsp; <?php echo $customer_name;?> </td>
			
		</tr>
		<tr>
			<td>Order ID: &nbsp;&nbsp;&nbsp;&nbsp; <?php echo $orderId;?></td>
			
		</tr>
		<tr>
			<td>Date - Time: &nbsp;&nbsp;&nbsp;&nbsp; <?php echo $date_time;?></td>
		
		</tr>
	</table>
	<table id="food-table">
		<tr>
			<th id="f-no">No</th>
			<th id="f-name"> Menu Name </th>
			<th id="f-price"> Price </th>
			<th id="f-qty"> QTY </th>
			<th id="f-total"> Total </th>
		</tr>
		
		<?php $query=mysqli_query($conn,"select * from order_list_manage where order_id='$ID'"); 
		 while($get =mysqli_fetch_array($query) ){ $order_id=$get['order_id']; ?>
		<tr>
			<td id="f-no"> <?php echo $no_inc++; ?> </td>
			<td id="f-name">  <?php echo $get['menu_name']; ?> </td>
			<td id="f-price"> <?php echo $get['price']; ?> </td>
			<td id="f-qty"> <?php echo $get['qty']; ?></td>
			<td id="f-total"> <?php echo $get['price']*$get['qty'];?> </td>
			<?php $gtotal+= $get['price']*$get['qty']; ?>
		</tr>
		<?php } ?>	
	</table>
	
	<table id="amount-table">
		<tr><td style="">GTotal: </td><td><b><?php echo $gtotal; ?><b></td></tr>
		<tr><td>Amount Disc: </td><td><?php echo $dis_amnt; ?></td></tr>
		<tr><td>Per Disc: </td><td><?php echo $dis_per; ?></td></tr>
		<tr><td>Net Total: </td><td><b><?php echo $gtotal-$dis_amnt-($gtotal/100*$dis_per) ?></b></td></tr>
	</table>
	
	
	
	<div  style="clear:both;">
	<table>
		<tr><span style="font-size:10px;">Malik Asghar Square, Dawoodzai Business Center, Kabul-AFG</span><br></tr>
		<tr><span style="font-size:10px;">+93731 600 666 - +93731 600 666</span></tr>
		<hr style="margin:2px">
		<tr><span style="font-size:10px;">Powered by iCube Software Corporation - www.iCubeInnovators.com - +93(0) 777 436 436</span></tr>
	</table>
	</div>
	

</div>

<script type="text/javascript">

  print('container');

  </script>

</body>
<script type="text/javascript">

function print(divName)
{
	var printContents = document.getElementById(divName).innerHTML;
	var originalContents = document.body.innerHTML;
	
	document.body.innerHTML = printContents;
	window.print();
	
	//document.body.innerHTML = originalContents;
	window.close();
	
	
	}

</script>


</html>