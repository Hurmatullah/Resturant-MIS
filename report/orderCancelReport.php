<?php 

// <---------------- Including of cancelConnection file in this file ------------------>
    include('cancelConnection.php');

// <-----------------End of Including ------------------------------------------------->    
    
?>

<!DOCTYPE html>
<html>
<head>
    <title>Order Cancel Report</title>

    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="style.css">
    <script type="text/javascript" src="js/bootstrap.js"></script>
	
		<!-- Favicons-->
    <link rel="icon" href="/assets/images/favicon/favicon-32x32.png" sizes="32x32">
    <!-- Favicons-->
    <link rel="apple-touch-icon-precomposed" href="/assets/images/favicon/apple-touch-icon-152x152.png">
</head>
<body>

    <div class="container">
          

        <ul class="list-group" style="margin-top: 15px;">
            <li class="list-group-item"><center>Karim Continental</center></li>
            <li class="list-group-item" id="list2" style="margin-top: 5px;"><center>Order Cancel Report</center></li>
            <li class="list-group-item" style="margin-top: 5px;">

                <label style="font-size: 14px; margin-bottom: 0px;">Form Date: <?php  echo $_POST['fdate'] ?></label>
                <label style="font-size: 14px; margin-bottom: 0px; float: right; margin-right: 50px;">To Date: <?php echo $_POST['tdate'] ?></label>

            </li>
        </ul>

        <div>
            <?php $total = 0 ; ?>
            <table class="table table-bordered">
                <thead>
                <tr>
					<th style="text-align: center; width: 70px;">Order ID</th>
                    <th style="text-align: center; width: 70px;">Menu ID</th>
                    <th style="text-align: center; width: 70px;">Menu Name</th>
                    <th style="text-align: center; width: 70px;">Price</th>
					<th style="text-align: center; width: 70px;">Qty</th>

                </tr>
                </thead>
                <tbody>
                <?php


					 $total_dis_amount=0;
					 $total_dis_per=0;
					 $total=0;
					 
                     while($rows = $cancel->fetch_assoc()) {


                ?>
                <tr>
					<td style="text-align: center;"><?php echo $rows['order_id'] ?></td>
                    <td style="text-align: center;"><?php echo $rows['menu_id'] ?></td>
                    <td style="text-align: center;"><?php echo $rows['menu_name'] ?></td>
                    <td style="text-align: center;"><?php echo $rows['price']?></td>
					<td style="text-align: center;"><?php echo $rows['qty']?></td>



                    <?php $total += ($rows['price'] * $rows['qty']) ; ?>


                </tr>
            <?php } ?>
			
			
			<?php 
				while($row = $cancel->fetch_assoc()) {
					
					$total_dis_per += ($row['dis']);
					
				}
					while($row = $result_amnt->fetch_assoc()) {
					
					$total_dis_amount += ($row['amount']);
					
				}
			
			?>
			
			
			
			
			
                </tbody>
            </table>

        </div>

        <center>
            <table class="table table-bordered" id="table" style="width: 50%;">
                    <tr>
                    <td style="text-align: right;">Total Amount</td>
                    <td style="text-align: right;"><?php echo $total ?></td>
                </tr>
                 <tr>
                    <td style="text-align: right;">Discount(Amount)</td>
                    <td style="text-align: right;"><?php echo $total_dis_amount;  ?></td>
                </tr>
                <tr>
                    <td style="text-align: right;">Discount(%)</td>
                    <td style="text-align: right;"><?php echo $total_dis_per;  ?></td>
                </tr>				
				
                <tr>
                    <td style="text-align: right;">Net Amount</td>
                    <td style="text-align: right;"><?php echo $total-$total_dis_amount-$total_dis_per; ?></td>
                </tr>
            </table>

        </center>



        <button type="submit" id="Print" class="btn btn-primary">Print</button>
        <button id="back" class="btn btn-primary">Back</button>

    </div>

    <script src="lib_UI_jquery_assets_js_jquery-1.9.0.min.js"></script>
    <script>
        
        function hide(){

            $('#Print').hide();
            $('#back').hide();

        }
        document.getElementById('Print').addEventListener('click' , function(){

            window.print(hide());

        });

        document.getElementById('back').addEventListener('click' , function(){


            window.location.href = "cancelReport.php";

        });



    </script>

    <style type="text/css">
        
        #Print {

            margin-left: 20px;

        }

        #back {

            margin-left: 30px;

        }

    </style>

</body>
</html>