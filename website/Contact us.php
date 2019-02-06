<!DOCTYPE html>

<?php
$servername = "svc353_2.encs.concordia.ca";
$username = "svc353_2";
$password = "M9G9A4UW";

// Create connection
$conn = mysqli_connect($servername, $username, $password);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully";
?>


<html>
    <title>Contact Us</title>
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
					<div id="top-nav">
						<ul>
						<li><a href="Home.php">Home Page</a></li>
						<li><a href="Browse%20available%20good.php">Browse Available Goods</a></li>
						<li><a href="Have%20something%20to%20sell.php">Have Something to Sell</a></li>
						<li><a href="Contact%20us.php">Contact Us</a></li>
						</ul>
					</div>
					<div class="clr"></div>
				</div>
			</header>
			<div class="feature">
				<div class="feature-inner">
				<h1>Contact Us</h1>
				</div>
			</div>
		
	
			<div id="content">
				<div id="content-inner">
           
				
					<main id="contentbar">
						<div class="article">
						         <h1>Giulia Gaudio</h1>	
                            <h1>Student id: 27191766</h1>
                            <h1>Email: giuliagaudio94@gmail.com</h1>
						</div>
					</main>
					
					<nav id="sidebar">
						<div class="widget">
							<h3>Menu</h3>
							<ul>
							<li><a href="Home.php">Home Page</a></li>
						<li><a href="Browse%20available%20good.php">Browse Available Goods</a></li>
						<li><a href="Have%20something%20to%20sell.php">Have Something to Sell</a></li>
						<li><a href="Contact%20us.php">Contact Us</a></li>
							</ul>
						</div>
					</nav>
					
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