<?php include('db.php');?>
<?php include('header.php'); ?>



<?php   

		
        $sql = "select * from tbl_category" ;
		$category = mysqli_query($conn , $sql);
		
		
?>

    <div class="container" style="background-color: #F1F3F4;">

        <div class="toolbar">
			<span class="btn-search"></span>
			<input class="input-search" id="search" type="text" onkeyup="Search()" placeholder="Search" name="inputSearch"/>
		</div>


			   <table id="mytable" style="width: 100%;margin-top:60px">


				<?php while($rows=$category->fetch_assoc()){ ?>

					
				
					<tr>
					
						<td>

						<a href="sub.php?id=<?php echo $rows['category_id']."&&cat_name=".$rows['category_name'];  ?>" >
							
							<div class="list-item">
								<img class="image" src="<?php  echo "http://localhost/project/Restaurant/". $rows['category_image']; ?>" alt="image">
								<div class="text" id="two">
										
										<span style="color: transparent; height: 0; width:0;display:inline;"> <?php echo strtolower($rows['category_name']); ?></span>
										<h1 class="title"><?php  echo $rows['category_name']; ?></h1>
										<h3 style="width:100%; font-size:14px; padding:0 10px 0 10px">Banana Juice </h3>
								</div>
							</div>
							</a>
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
		filter = input.value.toLowerCase();

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