<?php session_start(); ?>
<?php 
	require_once('mysql_connect.php'); 
	$sql = "SELECT type FROM `Category`";
	  $result = $conn->query($sql);

	  if ($result->num_rows <= 0) {
		  echo "error 44";
	  }
	  while($row = $result->fetch_assoc()){
		$categories[] = array("type" => $row['type']);
	  }
	  $categories = array_values($categories);
	 
		
	  $query = "SELECT type, category FROM `Subcategory`";
	  $result = $conn->query($query);
	if ($result->num_rows <= 0) {
		  echo "error 88";
	  }
	  while($row = $result->fetch_assoc()){
		$subcats[$row['category']][] = array("type" => $row['type']);
	  }
	$jsonCats = json_encode($categories);
	$jsonSubCats = json_encode($subcats);

?>
<!DOCTYPE html>





<html>
    <title>Browse Available Goods</title>
<link rel="stylesheet" href="file.css">
	<body>
		<div id="page">
			<header id="header">
				<div id="header-inner">	
					<div id="logo">
						<h1><a href="Home.php">Exchange<span>Goods</span></a></h1>
					</div>
                            <div style="float: right; width: 190px;">
<head>
<p id="demo"></p>

<script>
var d = new Date();
document.getElementById("demo").innerHTML = d.toDateString();
function startTime() {
   
    var today = new Date();
    var h = today.getHours();
    var m = today.getMinutes();
    var s = today.getSeconds();
    m = checkTime(m);
    s = checkTime(s);
    document.getElementById('txt').innerHTML =
    h + ":" + m + ":" + s;
    var t = setTimeout(startTime, 500);
}
function checkTime(i) {
    if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
    return i;
}
</script>

<script type='text/javascript'>
	  <?php
		echo "var subcats = $jsonSubCats; \n";
		echo "var categories = $jsonCats; \n";
		//echo "var promo = $jsonPromo; \n";
	  ?>
	  
</script>


</head>

<body onload="startTime()">

<div id="txt"></div>

</body>
</div>
<?php require_once("navigation.php"); ?>
<!--
<div id="top-nav">
	<ul>
		<li><a href="Home.php">Home Page</a></li>
        <li><a href="user.php">User</a></li>
        <li><a href="admin.php">Admin</a></li>
		<li><a href="Browse available good.php">Browse Available Goods</a></li>
		<li><a href="Have something to sell.php">Have Something to Sell</a></li>
		<li><a href="store.php">Store</a></li>
	</ul>
</div>
 -->
<div class="clr"></div>
</div>
</header>
<div class="feature">
	<div class="feature-inner">
		<h1>Browse Available Goods</h1>
	</div>
</div>

<div id="content">
<div id="content-inner">
<main id="contentbar">
<div class="article">
    <h1><center>List of Goods</center></h1>
	
	<form name="browse" action="./Browse available good.php" method="post" id = "11" onsubmit="showHide(); return false;">
	
	<select name="category" onchange = "myfunction()">
		
		<option value="" disabled="disabled" selected>Choose category</option>
				<script>
				var select = document.browse.category;

				for(var i = 1; i <= categories.length; i++){
					select.options[i] = new Option(categories[i-1].type, categories[i-1].type); 

				}
				
				</script>
				<script>
				function myfunction(){
					var subcatSelect = document.browse.subcategory;
					var val = document.browse.category.value;
					subcatSelect.options[0].disabled;
					//subcatSelect.options.length = 0; //delete all options if any present
					for(var i = 1; i <= subcats[val].length; i++){
						subcatSelect.options[i] = new Option(subcats[val][i-1].type, subcats[val][i-1].type);
					}
				}
				</script>
	</select>
	  
	<select name="subcategory">
		<option value="" disabled="disabled" selected>Choose subcategory</option>
	</select>
	
	<input type="Submit" value="Search">
	<br><br>
	
</form>

<?php
	if($_POST['subcategory'] != ("select subcategory") && isset($_POST['subcategory']) && !empty($_POST['subcategory'])){
		$category = $conn->real_escape_string($_POST['category']);
		$subcategory = $conn->real_escape_string($_POST['subcategory']);
		
		
		echo "<font color=blue font face='arial' size='6pt'>" .$_POST['category']." ==> ".$_POST['subcategory']."</font>";
		echo "<br />";
		echo "<br />";
		$sql = "SELECT * FROM `Ad` WHERE category = '$category' AND subcategory = '$subcategory' AND ad_promotion != 'none' AND endDate > curDate()";
		if($results = $conn->query($sql)) {
	// process the query results
		if ($results->num_rows > 0) {
			while ($row = $results->fetch_object()) {
				echo "<div>";
				if($row->image != null){
					echo "<div style='max-width:150px;display: inline-block;'>";
					echo "<img src='" . $row-> image . "' height='130' width='150'> ";
					echo "</div>";
				}
				echo "<div style = 'text-align :left; display:inline-block; margin: 1em;'>";
				echo "<font color=blue font face='arial' size='2pt'>$row->title</font>";
				echo  "<br>";
				echo "<font color=blue font face='arial' size='2pt'>$row->description</font>";
				echo  "<br>";
				echo "<font color=blue font face='arial' size='2pt'>$row->price\$CAD</font>";
				echo  str_repeat('&nbsp;', 5);
				echo "<font color=blue font face='arial' size='2pt'>$row->forsale</font>";
				echo  str_repeat('&nbsp;', 5);
				echo "<font color=blue font face='arial' size='2pt'>$row->address</font>";
				echo "</div>";
				echo "</div>";
			}
		}
	}

	$sql2 = "SELECT * FROM `Ad` WHERE category = '$category' AND subcategory = '$subcategory' AND ad_promotion = 'none' AND endDate > curDate()";
		
		
		if($results2 = $conn->query($sql2)) {
	// process the query results
		if ($results2->num_rows > 0) {
			while ($row2 = $results2->fetch_object()) {
				echo "<div>";
				if($row2->image != null){
					echo "<div style='max-width:150px;display: inline-block;'>";
					echo "<img src='" . $row2-> image . "' height='130' width='150'> ";
					echo "</div>";
				}
				echo "<div style = 'text-align :left; display:inline-block; margin: 1em;'>";
				echo "<font color=blue font face='arial' size='2pt'>$row2->title</font>";
				echo  "<br>";
				echo "<font color=blue font face='arial' size='2pt'>$row2->description</font>";
				echo  "<br>";
				echo "<font color=blue font face='arial' size='2pt'>$row2->price\$CAD</font>";
				echo  str_repeat('&nbsp;', 5);
				echo "<font color=blue font face='arial' size='2pt'>$row2->forsale</font>";
				echo  str_repeat('&nbsp;', 5);
				echo "<font color=blue font face='arial' size='2pt'>$row2->address</font>";
				echo "</div>";
				echo "</div>";
			}
		} 
	}
	
	if($results2->num_rows == 0 && $results->num_rows == 0){
		echo "<font color=red font face='arial' size='2pt'>no adds to show1</font>";
	}
	}
?>

						</div>
					</main>
					
					
					
					
					<div class="clr"></div>
				</div>
			</div>
		
			<div id="footerblurb">
				<div id="footerblurb-inner">
				
					<div class="column">
				
					
					</div>	
					<div class="column">
		
						
					</div>
					<div class="column">
		
					
					</div>	
					
					<div class="clr"></div>
				</div>
			</div>
			<footer id="footer">
				<div id="footer-inner">
					<p>&copy; Copyright <a href="Private%20Policy.php">Privacy Policy</a></p>
					<div class="clr"></div>
				</div>
			</footer>
		</div>
	</body>
</html>