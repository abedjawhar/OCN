<?php session_start(); ?>
<?php
require_once('mysql_connect.php');
$user = $_SESSION['user']; 
$sql3 = "SELECT cardNumber FROM `User` WHERE id = '$user' ";
if($results3 = $conn->query($sql3)) {
	// process the query results
	if ($results3->num_rows == 1) {
		$row3 = $results3->fetch_object();
		$creditCard = $row3->cardNumber;

	}
}

$promotion = mysqli_real_escape_string($conn, $_REQUEST['promotion']);
$rentPrice = mysqli_real_escape_string($conn, $_REQUEST['rentingPrice']);
$sl = mysqli_real_escape_string($conn, $_REQUEST['strtLocation']);

$sql4 = "SELECT price FROM `Promotion` Where type = '$promotion'";
	$results4 = $conn->query($sql4);
	echo "price added";
	$row4 = $results4->fetch_object();
 	$price =  $row4->price;
 	$sql5 = "INSERT INTO `Payment`  (`date`, `purchase`, `description`, `amount`, `cardNumber`, `userID`) VALUES (NOW(), 'Promotion', '$promotion', '$price', '$creditCard', '$user')";

 	if($results = $conn->query($sql5)) {
 		echo "payment added";
 
 	} else {
	echo "error: ";
	echo $conn->error . "\n";
	}

	if($sl != "none"){
		$sql6 = "INSERT INTO `Payment`  (`date`, `purchase`, `description`, `amount`, `cardNumber`, `userID`) VALUES (NOW(), 'Rent', '$sl', '$rentPrice', '$creditCard', '$user')";
		$results = $conn->query($sql6);
	}
	
?>
<html>
    <title>Payment Profile</title>
<link rel="stylesheet" href="file.css">
	<body>
		<div id="page">
			<header id="header">
				<div id="header-inner">	
					<div id="logo">
						<h1><a href="Home.html">Exchange<span>Goods</span></a></h1>
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
                               <li><a href="user.php">User</a></li>
                             <li><a href="admin.php">Admin</a></li>
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
				<h1>Payment</h1>
				</div>
			</div>
		
	
			<div id="content">
				<div id="content-inner">
           
				
					<main id="contentbar">
						<div class="article">
					
                            
                 <div class="container-fluid">
       
        <div class="creditCardForm">
            
            <div class="heading">
                <h1>Confirm Purchase</h1>
            </div>

            <div class="payment">
                <form>
                    <div class="form-group owner">
                        <label for="owner">Full name</label>
                        <input type="text" class="form-control" id="owner">
                    </div>

                    <div class="form-group" id="card-number-field">
                        <label for="cardNumber">Card Number</label>
                        <input type="text" class="form-control" id="cardNumber">
                    </div>

                  <div class="form-group" id="pay-now">
              

       <form>
<input type="button" value="Confirm" onclick="window.location.href='https://svc353_2.encs.concordia.ca/Home.php'" />
</form>


                   
                 
              
                        
                        
                    </div>
                </form>
            </div>
        </div>
    </div>

        </div>

              
                            
      
                                        
                            
                            
						</div>
			
					
					
					
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