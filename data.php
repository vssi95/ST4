<?php
	$DOCUMENT_ROOT = $_SERVER['DOCUMENT_ROOT'];
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Data Display</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600&display=swap" rel="stylesheet">
</head>
<body>

	<div class="hero">
		<div class="navbar">
			<nav>
				<ul id="menuList">
					<li><a href="index.html">Home</a></li>
					<li><a href="calculator.html">Calculator</a></li>
					<li><a href="data.php">Data</a></li>
					<li><a href="privacy.html">Privacy Policy</a></li>
				</ul>
			</nav>
			<img src="menu.png" class="menu-icon" onclick="togglemenu()">
		</div>

		<div class="">
			<?php
     	 		$data = file("$DOCUMENT_ROOT/st4/data.txt"); 

     	 		$no = 0;
             	$data_no = count($data);
				if ($data_no == 0){
					echo "<p><strong>No data</strong></p>";
				}
			?>
			<table class="data-table">
				<caption>Previous Responses</caption>
				<thead>
		        	<tr>
		        		<th>No.</th>
			            <th>Postcode</th>
			            <th>Average Anuual Carbon Footprint (lbs)</th>
			            <th>Added Date</th>
					</tr>
				</thead>

				<tbody>
					<?php
		     	 	 for ($i=0; $i<$data_no; $i++) {
						//split up each line
						$line = explode("\t", $data[$i]);

		          	echo "<tr>
				              <td>".$i."</td>
				              <td>".$line[3]."</td>
				              <td>".$line[14]."</td>
				              <td>".$line[0]."</td>
			          	  </tr>";}
			           ?>
	        	</tbody>
        	</table>
		</div>
	</div>

	<script type="text/javascript">
		var menuList = document.getElementById("menuList");

		menuList.style.maxHeight = "0px";

		function togglemenu(){
			if (menuList.style.maxHeight == "0px"){
				menuList.style.maxHeight = "150px";
			}
			else{
				menuList.style.maxHeight = "0px";
			}
		}

	</script>



</body>
</html>