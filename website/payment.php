<?php session_start(); ?>
<?php  
require_once('mysql_connect.php');
?>


<html>
    <title>Payment Profile</title>
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
					<div class="clr"></div>
				</div>
			</header>
			<div class="feature">
				<div class="feature-inner">
				<h1>Payment</h1>
				</div>
			</div>
		
	
			<div id="content">
				<div id="content-inner">
           
				
					<main id="contentbar">
						<div class="article">
						         <h1>Payment</h1>	
								 <?php 
									$sql = "SELECT * FROM `Payment`";
									if($results = $conn->query($sql)) {
										if ($results->num_rows > 0) {
											while ($row = $results->fetch_object()) {
												$userID = $row->userID;
												$sql2 = "SELECT email FROM `User` WHERE id = '$userID'";
												if($results2 = $conn->query($sql2)) {
													$result = $results2->fetch_object();
													$username = $result->email;
												}
												
												echo "<font color=blue font face='arial' size='2pt'>$username</font>";
												echo  str_repeat('&nbsp;', 5);
												echo "<font color=blue font face='arial' size='2pt'>$row->date</font>";
												echo  str_repeat('&nbsp;', 5);
												echo "<font color=blue font face='arial' size='2pt'>$row->purchase</font>";
												echo  str_repeat('&nbsp;', 5);
												echo "<font color=blue font face='arial' size='2pt'>$row->description</font>";
												echo  str_repeat('&nbsp;', 5);
												echo "<font color=blue font face='arial' size='2pt'>$row->amount</font>";
												echo  str_repeat('&nbsp;', 5);
												echo "<font color=blue font face='arial' size='2pt'>$row->cardNumber</font>";
												echo "<br />";
											}
										}
									}
									
								 ?>
								 
                            <form>
<input type="button" value="backup" href="payment_backup.php" />
<a href="payment_backup.php">backup</a>

</form> 
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