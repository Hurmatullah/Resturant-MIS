<?php include('db.php'); ?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="lib/style.css">
    <title>Main</title>


 
    <style>
    
        .sub-category-title{
            padding: 10px 10px 10px 30px;
            background-color: white;
            margin-top: 60px;
        }


        .sub{
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            height: 47px;
        }

        .price{
            font-size: 1.5em;
            font-weight: bold;
            color: blueviolet;
            width: 30%;
            margin-top: 10px;
        }

        .category{
            width: 70%;
        }

        .currency{
            font-size: 12px;
            display: inline;
            color: blueviolet;
        }

    </style>
</head>
<body>






<?php 
            $id;
            $cat_name;
			$sub_name;
			if(isset($_GET['id'])){
				$id = $_GET['id'];
			}
			if(isset($_GET['sub_name'])){
			   $sub_name = $_GET['sub_name'];
            }
            
            if(isset($_GET['cat_name'])){
                $cat_name = $_GET['cat_name'];
             }
 


			
			

			
			$sql = "select * from tbl_menu where sub_category_id = '$id'" ;
			$data = mysqli_query($conn , $sql);


		



?>

    <div class="container" style="background-color: #F1F3F4;">

        <div class="toolbar">
		    <span class="btn-search"></span>
			<input class="input-search" id="search" type="text" onkeyup="Search()" placeholder="Search" name="inputSearch"/>
			
       </div>

       <div class="sub-category-title" style="width: 100%;">

            <h4><?php echo $sub_name." ".$cat_name; ?></h4>

       </div>


       <table id="mytable" style="width: 100%;">

            

       <?php while($rows = $data->fetch_assoc()){ ?>

            <tr >
                    <td>

                        <div class="list-item">
                        <img class="image" src="<?php  echo "http://localhost/project/Restaurant/". $rows['menu_image']; ?>" alt="image">
                            <div class="text" id="two">
                                    <span style="color: transparent; height: 0;">juice</span>
                                    <h1 class="title" style="font-size:1.em;"><?php echo $rows['menu_name']; ?></h1>
                                    <div class="sub">
                                            <h3 style="width:100%; font-size:14px; padding:0 10px 0 10px"> <?php echo htmlspecialchars_decode($rows['menu_description']); ?> </h3>
                                            <h3 class="price"><?php echo $rows['price']; ?> <span class="currency">AFN</span></h3> 
                                    </div>
                            </div>
                        </div>


                    </td>	
                </tr>

                <?php } ?>

       </table>
	   
	   </div>
    </div>



<!--  search  -->	

<script>
	function Search() {
		var input, filter, table, tr, td, i, txtValue;
		input = document.getElementById("search");
		filter = input.value;

		console.log(filter);
		table = document.getElementById("mytable");
		tr = table.getElementsByTagName("tr");
		for (i = 0; i < tr.length; i++) {
			td = tr[i].getElementsByTagName("td")[0];
			if (td) {
			txtValue = td.textContent || td.innerText;
			if (txtValue.indexOf(filter) > -1) {
				tr[i].style.display = "";
			} else {
				tr[i].style.display = "none";
			}
			} 
		}
		}
</script>



</body>
</html>