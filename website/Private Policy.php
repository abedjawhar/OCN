
<!DOCTYPE HTML>

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
    <title>Privacy Policy</title>
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
				<h1>Privacy Policy</h1>
				</div>
			</div>
		
	
			<div id="content">
				<div id="content-inner">
           
				
					<main id="contentbar">
						<div class="article">
                            <center><h1>Privacy Policy</h1></center>

                            <p>This privacy policy discloses the privacy practices for ExhangeGoods. This privacy policy applies solely to information collected by this web site. It will notify you of the following:</p>

<p>What personally identifiable information is collected from you through the web site, how it is used and with whom it may be shared.
What choices are available to you regarding the use of your data.
The security procedures in place to protect the misuse of your information.
How you can correct any inaccuracies in the information.
Information Collection, Use, and Sharing 
We are the sole owners of the information collected on this site. We only have access to/collect information that you voluntarily give us via email or other direct contact from you. We will not sell or rent this information to anyone.</p>

                        <p>We will use your information to respond to you, regarding the reason you contacted us. We will not share your information with any third party outside of our organization, other than as necessary to fulfill your request, e.g. to ship an order.</p>

<p>Unless you ask us not to, we may contact you via email in the future to tell you about specials, new products or services, or changes to this privacy policy.

Your Access to and Control Over Information 
You may opt out of any future contacts from us at any time. You can do the following at any time by contacting us via the email address given on our website:

    See what data we have about you, if any.

   Change/correct any data we have about you.

    Have us delete any data we have about you.

    Express any concern you have about our use of your data.</p>

<p>Security 
We take precautions to protect your information. When you submit sensitive information via the website, your information is protected both online and offline.

Wherever we collect sensitive information (such as credit card data), that information is encrypted and transmitted to us in a secure way. You can verify this by looking for a closed lock icon at the bottom of your web browser, or looking for "https" at the beginning of the address of the web page.

While we use encryption to protect sensitive information transmitted online, we also protect your information offline. Only employees who need the information to perform a specific job (for example, billing or customer service) are granted access to personally identifiable information. The computers/servers in which we store personally identifiable information are kept in a secure environment.</p>

<p>Updates

Our Privacy Policy may change from time to time and all updates will be posted on this page.

If you feel that we are not abiding by this privacy policy, you should contact us immediately  via email. </p>	
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
					<p>&copy; Copyright <a href="Private%20Policy.php">Privacy Policy</a></p>
					<div class="clr"></div>
				</div>
			</footer>
		</div>
	</body>
</html>