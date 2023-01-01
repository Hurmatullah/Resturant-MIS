<?php 

    include('cancelConnection.php');


?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="renderer" content="webkit">
    <title>Paid Report</title>
    <link rel="stylesheet" href="src/calendar.css">
    <link rel="stylesheet" href="src/style.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	
		<!-- Favicons-->
    <link rel="icon" href="/assets/images/favicon/favicon-32x32.png" sizes="32x32">
    <!-- Favicons-->
    <link rel="apple-touch-icon-precomposed" href="/assets/images/favicon/apple-touch-icon-152x152.png">

</head>
<body>
    <div id="demo">
	
			<div class="container">
		
			<div class="row">
			
				<h2>Sale Report</h2>
				
			</div>
		</div>

        <form method="POST" action="orderPaidReport.php">
            
            <label>From Date</label>
            <input type="text" id="dt" name="fdate" class="form-control" placeholder="Choose some date">
            <div id="two"></div>
            <br>          
            <label>To Date</label>
            <input type="text" id="ds" name="tdate" class="form-control" placeholder="Choose some date">
            <div id="three"></div> <br>

                <br>
            <button type="submit" id="print" name="button" class="btn btn-primary">Print</button>


        </form>


    </div>

    <script src="lib_UI_jquery_assets_js_jquery-1.9.0.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.js"></script>
    <script src="src/calendar.js"></script>
    <script>
        var now = new Date();
        var year = now.getFullYear();
        var month = now.getMonth() + 1;
        var date = now.getDate();


        var data = [{
            date: year + '-' + month + '-' + (date - 1),
            value: 'hello'
        }, {
            date: year + '-' + month + '-' + date,
            value: ''
        }, {
            date: new Date(year, month - 1, date + 1),
            value: ''
        }, {
            date: '2016-10-31',
            value: '2016-10-31'
        }];

        // picker
        $('#two').calendar({
            trigger: '#dt',
            // offset: [0, 1],
            zIndex: 999,
            data: data,
            onSelected: function (view, date, data) {
                console.log('event: onSelected')
            },
            onClose: function (view, date, data) {
                console.log('event: onClose')
                console.log('view:' + view)
                console.log('date:' + date)
                console.log('data:' + (data));
            }
        });
        $('#three').calendar({
            trigger: '#ds',
            // offset: [0, 1],
            zIndex: 999,
            data: data,
            onSelected: function (view, date, data) {
                console.log('event: onSelected')
            },
            onClose: function (view, date, data) {
                console.log('event: onClose')
                console.log('view:' + view)
                console.log('date:' + date)
                console.log('data:' + (data));
            }
        });



        document.getElementById('print').addEventListener('click' , function(){

            window.location.href = "orderCancelReport.php";

        });


    </script>
</body>
</html>
