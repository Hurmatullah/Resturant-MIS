<?php

	include_once ('../includes/variables.php');

	DEFINE ('DB_HOST', $host);
	DEFINE ('DB_USER', $user);	 
	DEFINE ('DB_PASSWORD', $pass);
	DEFINE ('DB_NAME', $database);
	 
	$mysqli = @mysql_connect (DB_HOST, DB_USER, DB_PASSWORD) OR die ('Could not connect to MySQL');
	@mysql_select_db (DB_NAME) OR die ('Could not select the database');
 
 ?>
 
<?php
 
 	mysql_query("SET NAMES 'utf8'"); 
	
	if(isset($_GET['cat_id']))
	{		
			$query="SELECT * FROM tbl_gallery_category c,tbl_gallery n WHERE c.cid=n.cat_id and c.cid='".$_GET['cat_id']."' ORDER BY n.gid DESC";			
			$resouter = mysql_query($query);
			
	}
	
	else if(isset($_GET['gid']))
	{		
			$id = $_GET['gid'];

			$query="SELECT * FROM tbl_gallery WHERE gid = '$id'";					
			$resouter = mysql_query($query);
			
	}	
	
	else if(isset($_GET['latest_gallery']))
	{	
			$query = "SELECT * FROM tbl_gallery ORDER BY gid DESC";			
			$resouter = mysql_query($query);
	}

	else
	{	
			$query = "SELECT * FROM tbl_gallery ORDER BY gid DESC";			
			$resouter = mysql_query($query);
	}
     
    $set = array();
     
    $total_records = mysql_num_rows($resouter);
    if($total_records >= 1){
     
      while ($link = mysql_fetch_array($resouter, MYSQL_ASSOC)){
	   
        $set['data'][] = $link;
      }
    }
     
     echo $val= str_replace('\\/', '/', json_encode($set)); 	 
	 
?>