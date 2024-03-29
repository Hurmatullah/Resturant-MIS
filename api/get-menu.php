<?php
	include_once('../includes/connect_database.php'); 
	include_once('../includes/variables.php');
	include_once('../public/functions.php');
	
	if(isset($_GET['accesskey']) && isset($_GET['category_id'])) {
		$access_key_received = $_GET['accesskey'];
		$category_id = $_GET['category_id'];
		
		if(isset($_GET['keyword'])){
			$keyword = $_GET['keyword'];
		}else{
			$keyword = "";
		}
		
		if($access_key_received == $access_key){
			if($keyword == ""){
				// find menu by category id in menu table
				$sql_query = "SELECT menu_id, menu_name, price, menu_image 
					FROM tbl_menu 
					WHERE category_id = ".$category_id." 
					ORDER BY menu_id DESC";
			}else{
				// find menu by category id and keyword in menu table
				$sql_query = "SELECT menu_id, menu_name, price, menu_image 
					FROM tbl_menu 
					WHERE menu_name LIKE '%".$keyword."%' AND category_id = ".$category_id." 
					ORDER BY menu_id DESC";
			}
			
			$result = $connect->query($sql_query) or die("Error : ".mysql_error());
			
			$menus = array();
			while($menu = $result->fetch_assoc()) {
				$menus[] = array('menu'=>$menu);
			}
			
			// create json output
			$output = json_encode(array('data' => $menus));
		}else{
			die('accesskey is incorrect.');
		}
	} else {
		die('accesskey and category id are required.');
	}
 
	//Output the output.
	echo $output;

	include_once('../includes/close_database.php'); 
?>