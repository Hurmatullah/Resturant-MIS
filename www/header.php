<?php
function ip_html($code){
	return htmlentities($code);
}
$test_index = 0;
$ip_src = '../src/';
$current_page = strtolower(basename($_SERVER['SCRIPT_FILENAME']));
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8" >
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Inputpicker - A jQuery plugin of supporting multiple columns by Ukalpa(ukalpa@gmail.com)</title>
	<meta name="author" content="ukalpa@gmail.com">
	<meta name="description" content="Inputpicker - A jQuery plugin of supporting multiple columns by Ukalpa">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<script>
        function dd(d) {
            console.log(d);
        }
	</script>


	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="../src/bootstrap.min.css">

	<!-- Optional theme -->
	<link rel="stylesheet" href="../src/bootstrap-theme.min.css">

	<link rel="stylesheet" href="<?php echo $ip_src ?>jquery.inputpicker.css?<?php echo time();?>" />

	<script src="../src/jquery-3.2.1.min.js"></script>
	<!-- Latest compiled and minified JavaScript -->
	<script src="../src/bootstrap.min.js"></script>

	<script src="<?php echo $ip_src ?>jquery.inputpicker.js?<?php echo time();?>"></script>

	<link rel="stylesheet" href="../src/default.min.css">
	<script src="../src/highlight.min.js"></script>
	<link rel="stylesheet" href="./style.css?<?php echo time()?>" >
</head>
