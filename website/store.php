<?php session_start(); ?>
<?php require_once('mysql_connect.php'); 
?>
<!DOCTYPE html>
<html>
    <title>Store</title>
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
</head>

<body onload="startTime()">

<div id="txt"></div>

</body>
</div>
	<?php require_once("navigation.php"); ?>
					<div class="clr"></div>
				</div>
			</header>
			<div class="feature">
				<div class="feature-inner">
				<h1>Store</h1>
				</div>
			</div>
		
	
			<div id="content">
				<div id="content-inner">
           
				
					<main id="contentbar">
						<div class="article">
						        <h1>Store</h1>	
								<?php
									$sql = "SELECT * FROM `Ad` WHERE storeID IS NOT NULL";

			// user ads
									if($results = $conn->query($sql)) {
										if ($results->num_rows > 0) {
											while ($row = $results->fetch_object()) {
												echo "<div>";
												if($row->image != null){
													echo "<div style='max-width:150px;display: inline-block;' >";
													echo "<img src='" . $row-> image . "' height='130' width='150' float='left'> ";
													echo "</div>";
												}
												
												$sql2 = "SELECT name FROM `PhysicalStore` WHERE storeId = '$row->storeID' ";
												if($results2 = $conn->query($sql2)) {
												// process the query results
													if ($results2->num_rows == 1) {
														$row2 = $results2->fetch_object();
														$storeName = $row2->name;
													}
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
												echo  str_repeat('&nbsp;', 5);
												echo "<font color=blue font face='arial' size='2pt'>Found in store: $storeName</font>";
												echo "</div>";
												echo "</div>";
											}
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
					<p>&copy; Copyright  <a href="Private%20Policy.php">Privacy Policy</a></p>
					<div class="clr"></div>
				</div>
			</footer>
		</div>
	</body>
</html>