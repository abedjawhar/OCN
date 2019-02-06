<?php
// start of session stuff.
session_start();
?>
<?php
if (isset($_SESSION['user']) || isset($_SESSION['admin'])) {
  echo "we are logged in as someone.";
} else {
  echo "we are not logged in.";
}

// end of session stuff

  require_once('mysql_connect.php'); 

  $sql = "SELECT name FROM `Province`";
  $result = $conn->query($sql);

  while($row = $result->fetch_assoc()){
    $categories[] = array("name" => $row['name']);
  }

  $query = "SELECT name, province FROM `City`";
  $result = $conn->query($query);

  while($row = $result->fetch_assoc()){
    $subcats[$row['province']][] = array("name" => $row['name']);
  }
 
    $query = "SELECT type, price FROM `Membership`";
  $result = $conn->query($query);

  while($row = $result->fetch_assoc()){
    $mem[] = array("type" => $row['type'], "price" => $row['price']);
  }

  $jsonCats = json_encode($categories);
  $jsonSubCats = json_encode($subcats);
  $jsonMem = json_encode($mem);
?>

<html>


<style>
/* Full-width input fields */
input[type=text], input[type=password] {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    box-sizing: border-box;
}

/* Set a style for all buttons */
button {
    background-color: #4CAF50;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 100%;
}
    
button.signup {
    background-color: #4CAF50;
    color: white;
    padding: 14px 20px;
    margin: 8px 30px;
    border: none;
    cursor: pointer;
    width: 100%;
}

button:hover {
    opacity: 0.8;
}

/* Extra styles for the cancel button */
.cancelbtn {
    width: auto;
    padding: 10px 18px;
    background-color: #f44336;
}

/* Center the image and position the close button */
.imgcontainer {
    text-align: center;
    margin: 24px 0 12px 0;
    position: relative;
}

img.avatar {
    width: 20%;
    border-radius: 50%;
}

.container {
    padding: 16px;
}

span.psw {
    float: right;
    padding-top: 16px;
}

/* The Modal (background) */
.modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
    padding-top: 60px;
}

/* Modal Content/Box */
.modal-content {
    background-color: #fefefe;
    margin: 5% auto 15% auto; /* 5% from the top, 15% from the bottom and centered */
    border: 1px solid #888;
    width: 50%; /* Could be more or less, depending on screen size */
}

/* The Close Button (x) */
.close {
    position: absolute;
    right: 25px;
    top: 0;
    color: #000;
    font-size: 35px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: red;
    cursor: pointer;
}

/* Add Zoom Animation */
.animate {
    -webkit-animation: animatezoom 0.6s;
    animation: animatezoom 0.6s
}

@-webkit-keyframes animatezoom {
    from {-webkit-transform: scale(0)} 
    to {-webkit-transform: scale(1)}
}
    
@keyframes animatezoom {
    from {transform: scale(0)} 
    to {transform: scale(1)}
}

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
    span.psw {
       display: block;
       float: none;
    }
    .cancelbtn {
       width: 100%;
    }
}
</style>
<body>

<?php if (!isset($_SESSION['user']) && !isset($_SESSION['admin'])) { ?>

<h2>Login Or Sign up</h2>

<button onclick="document.getElementById('id01').style.display='block'" style="width:auto;">Login</button>
<button id ="signup" onclick="document.getElementById('id02').style.display='block'" style="width:auto;">Sign Up</button>

<!-- LOGIN MODAL -->
<div id="id01" class="modal">
  
  <!-- login form -->
  <form class="modal-content animate" method="post" action="login.php">
    <div class="container">
      <!-- email -->
      <label><b>Email</b></label>
      <input type="email" name="email" placeholder="Enter Username" required/>
      </div>
      <div class="container">
      <!-- password -->
      <label><b>Password</b></label>
    <input type="password" name="password" placeholder="Enter Password" required/></div>
      <!-- submit -->

      <input type="submit" name="validate" value="Validate" />
   
   </form>
<!--
    <div class="imgcontainer">
      <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
      <img src="img_avatar2.png" alt="Avatar" class="avatar">
    </div>

    <div class="container">
      <label><b>Username</b></label>
      <input type="text" placeholder="Enter Username" name="uname" required>

      <label><b>Password</b></label>
      <input type="password" placeholder="Enter Password" name="psw" required>
        
      <button type="submit">Login</button>
      <input type="checkbox" checked="checked"> Remember me
    </div>

    <div class="container" style="background-color:#f1f1f1">
      <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
      <span class="psw">Forgot <a href="#">password?</a></span>
    </div>
-->

</div>

<script>
// Get the modal
var modal = document.getElementById('id01');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}





</script>

<script type='text/javascript'>
      <?php
        echo "var subcats = $jsonSubCats; \n";
        echo "var categories = $jsonCats; \n";
        echo "var mem = $jsonMem; \n";
        
      ?>
        function loadmem(){
        
        var select = document.getElementById("membership");
        for(var i = 0; i < mem.length; i++){
          select.options[i] = new Option(mem[i].type); 
      }
  }

      function loadCategories(){
        
        var select = document.getElementById("categoriesSelect");
        updateSubCats("alberta")

        for(var i = 0; i < categories.length; i++){
          select.options[i] = new Option(categories[i].name); 

        }

      }
      function updateSubCats(val){

        var subcatSelect = document.getElementById("subcatsSelect");
        subcatSelect.options.length = 0; //delete all options if any present
        for(var i = 0; i < subcats[val].length; i++){
          subcatSelect.options[i] = new Option(subcats[val][i].name);
        }
      }
      function GetSelectedTextValue(categoriesSelect) {
        var selectedValue = categoriesSelect.value;
        updateSubCats(selectedValue)
    }
</script>


    
<div id="id02" class="modal">
  <span onclick="document.getElementById('id02').style.display='none'" class="close" title="Close Modal">×</span>
  <form class="modal-content animate" action="signup.php" method="post">
    <div class="container">
		<label><b>Name</b></label>
		<input type="text" placeholder="Enter full name" name="name" required>
  
		<label><b>Username</b></label>
		<input type="text" placeholder="Enter username" name="username" required>
		
		<label><b>Email</b></label>
		<input type="text" placeholder="Enter Email" name="email" required>

		<label><b>Password</b></label>
		<input type="password" placeholder="Enter Password" name="psw" required>
		
		<label><b>Repeat Password</b></label>
		<input type="password" placeholder="Repeat Password" name="psw-repeat" required>
		
		<label><b>postal code</b></label>
		<input type="text" placeholder="Enter postal code" name="postalCode" required>
		
		<label><b>phone number</b></label>
		<input type="text" placeholder="Enter phone number" name="phoneNumber" required>
		
		<label><b>Credit card number</b></label>
		<input type="text" placeholder="Enter credit card number" name="creditCard" required>
        

		<body onload='loadCategories(); loadmem();'>


    <label><b>province</b></label>
    <select id='categoriesSelect' onchange="GetSelectedTextValue(this)"; name="province"  >
    </select>

<label><b>city</b></label>
    <select id='subcatsSelect' name="city" >
    </select>

<label>Membership</label>
    <select id='membership' name="membership" >
            </select>
   

  </body>



 

		<input type="checkbox" checked="checked"> Remember me
		<p>By creating an account you agree to our <a href="#">Terms & Privacy</a>.</p>

		<div class="clearfix">
			<button type="button" onclick="document.getElementById('id02').style.display='none'" class="cancelbtn">Cancel</button>
			<button type="submit" class="signupbtn">Sign Up</button>
		</div>
    </div>
 </form>
</div>

<script>
// Get the modal
var modal = document.getElementById('id02');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>
</body>

<?php } ?>
</html>



<html>		
   
    
    <title>Home page</title>
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

<!-- THIS IS THE OLD NAVBAR
					<div id="top-nav">
						<ul>
						<li><a href="Home.php">Home Page</a></li>
                            <li><a href="user.php">User</a></li>
                              <li><a href="admin.php">Admin</a></li>
						<li><a href="Browse%20available%20good.php">Browse Available Goods</a></li>
						<li><a href="Have%20something%20to%20sell.php">Have Something to Sell</a></li>
						<li><a href="store.php">Store</a></li>
						</ul>
					</div>
-->
					<div class="clr"></div>
				</div>
			</header>
			<div class="feature">
				<div class="feature-inner">
                    <h1>Home page</h1>
				</div>
			</div>
		
	
			<div id="content">
				<div id="content-inner">
           
					<main id="contentbar">
						<div class="article">
                            <h1><center>An Easy Way to Buy and Sell</center></h1>
                            <center><img src="exchange.jpg" alt="Exchange" style="width:304px;height:228px;"></center>
				
						         <p> ExchangeGoods is a website which allows people to post goods they want to sell as well as allows people to browse a wide selction of goods that are for sale. All goods are classfied by location area and price of the goods. All goods posted include a decription of the good and include the sellers direct contact information to make for and easy exchange.</p>	
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