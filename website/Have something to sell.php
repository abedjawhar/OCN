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
   

  $query = "SELECT type, price FROM `Promotion`";
  $result = $conn->query($query);
if ($result->num_rows <= 0) {
	  echo "error 00";
  }

  while($row = $result->fetch_assoc()){
 	$promo[] = array("type" => $row['type'], "price" => $row['price']);
  }


$sql = "SELECT type FROM `Strategic Location`";
  $result = $conn->query($sql);

  if ($result->num_rows <= 0) {
	  echo "error 44";
  }
  while($row = $result->fetch_assoc()){
	$sl[] = array("type" => $row['type']);
  }
  $sl = array_values($sl);

  $query = "SELECT name, sl FROM `PhysicalStore`";
  $result = $conn->query($query);
if ($result->num_rows <= 0) {
	  echo "error 88";
  }
  while($row = $result->fetch_assoc()){
    $stores[$row['sl']][] = array("name" => $row['name']);
  }

  

  $jsonCats = json_encode($categories);
  $jsonSubCats = json_encode($subcats);
  $jsonPromo = json_encode($promo);
  $jsonSl = json_encode($sl);
  $jsonStores = json_encode($stores);
  
?> 
<!DOCTYPE html>
<html>
    
    
    <title>Have Something to Sell</title>
	<link rel="stylesheet" href="file.css">
	
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>Form Validation</title>
	</head>
    
	<body>
		<div id="page">
			<header id="header">        
           	<div id="header-inner">	
				<div id="logo">
					<h1><a href="Home.php">Exchange<span>Goods</span></a></h1>
				</div>
			
        <div style="float: right; width: 190px;">
<head>
<script type='text/javascript'>
	  <?php
		echo "var subcats = $jsonSubCats; \n";
		echo "var categories = $jsonCats; \n";
		echo "var promo = $jsonPromo; \n";
		echo "var startegicLocation = $jsonSl; \n";
		echo "var store = $jsonStores; \n";
		
	  ?>
	  
</script>

<script>
    function Validate(){
        var title= document.AdForm.title;
        var address= document.AdForm.address;
        var category= document.AdForm.category;
		var subcategory= document.AdForm.subcategory;
        var price= document.AdForm.price;
        var descript=document.AdForm.descript;
            
    if (title.value == "")
{
    window.alert("Please enter a title.");
    title.focus();
    return false;
	}
	if (price.value == "")
	{
    window.alert("Please enter your price.");
    title.focus();
    return false;
	}
	if(category.selectedIndex < 1)
    {
        window.alert("Please choose a category");
        category.focus();
        return false;
                
    }
			
	if(subcategory.selectedIndex < 1)
    {
        window.alert("Please choose a subcategory");
        subcategory.focus();
        return false;           
    }       
	
	if (address.value == "")
    {
        window.alert("Please enter a valid address.");
        address.focus();
        return false;
    }
    if (descript.value == "")
	{
		window.alert("Please add description.");
		title.focus();
		return false;
	}
	return true;
}
</script>
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
<?php require_once("navigation.php") ?>
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
</header>
<div class="feature">
	<div class="feature-inner">
		<h1>Have Something to Sell</h1>
	</div>
</div>
<div id="content">
	<div id="content-inner">
		<main id="contentbar">
			<div class="article">

			    <h2 id = "highlight2"> Ad</h2>
				<form method="post" name="AdForm" action="./insert_ad.php" onsubmit="return Validate();">
				<fieldset>
				<h2 id = "highlight6"> Title </h2>
				<input type="text" name="title"><br>
				<h2 id = "highlight6"> Price</h2>
				<input type="number" name="price" min = "0">  $CAD<br>     
				
				<body>


				<h2 id="highlight3">Category</h2>
				<select id='categoriesSelect' name="category" onchange="myfunction()" >
				<option value="" disabled="disabled" selected>Choose category</option>
				<script>
				var select = document.AdForm.category;

				for(var i = 1; i <= categories.length; i++){
					select.options[i] = new Option(categories[i-1].type, categories[i-1].type); 

				}
				
				</script>
				<script>
				
				
				function myfunction(){
					var subcatSelect = document.AdForm.subcategory;
					var val = document.AdForm.category.value;
					subcatSelect.options[0].disabled;
					//subcatSelect.options.length = 0; //delete all options if any present
					for(var i = 1; i <= subcats[val].length; i++){
						subcatSelect.options[i] = new Option(subcats[val][i-1].type, subcats[val][i-1].type);
					}
				}
				</script>
				</select>

				<h2 id="highlight3">Sub-Category</h2>
				<select id='subcatsSelect' name="subcategory" >
				<option value="" disabled="disabled" selected>Choose subcategory</option>
				</select>

				<h2 id="highlight3">Promotion</h2>
				<select id='promotion' name="promotion" >
				<script>
					var select = document.AdForm.promotion;
					select.options[0] = new Option(promo[3].type, promo[3].type);
					for(var i = 1; i < promo.length; i++){
						select.options[i] = new Option(promo[i - 1].type + " - $" +promo[i - 1].price, promo[i - 1].type); 
					}
				</script>
				</select>
				<h2 id="highlight3">Store Rent (optional)</h2>
				<label for="sl">Strategic Location type</label>
				<select id='slSelect' name="sLocation" onchange="myfunction2()" >
				<option value="none" selected>Choose Strategic Location</option>
				<script>
					var select = document.AdForm.sLocation;

					for(var i = 1; i <= startegicLocation.length; i++){
						select.options[i] = new Option(startegicLocation[i-1].type, startegicLocation[i-1].type); 

					}
					
				</script>
				<script>				
					function myfunction2(){
						var storeSelect = document.AdForm.Physicalstore;
						var val = document.AdForm.sLocation.value;
						storeSelect.options[0].disabled;
						//subcatSelect.options.length = 0; //delete all options if any present
						for(var i = 1; i <= store[val].length; i++){
							storeSelect.options[i] = new Option(store[val][i-1].name, store[val][i-1].name);
						}
					}
				</script>
				</select>

				<label for="phyStore">Store</label>
				<select id='pstore' name="Physicalstore" >
				<option value="none" selected>Choose Store</option>
				</select>
				<br>
				strat date:
				<input type="date" name="rentStart">
				<br>
				end date:
				<input type="date" name="rentEnd">
				<br>
				<label for="hour rent">renting hours per day : </label>
				<select name ="hours">
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
					<option value="5">5</option>
					<option value="6">6</option>
					<option value="7">7</option>
					<option value="8">8</option>
					<option value="9">9</option>
					<option value="10">10</option>
					<option value="11">11</option>
					<option value="12">12</option>
				</select>
				<input type="checkbox" name="delivery" value="Yes"> Provide delivery?<br>
				
				</body>

				
				<h2 id = "highlight5"> Postal code</h2>
				<input type="text" name="address">
				<h2 id = "highlight6"> Description of the Goods </h2>
				(Be brief and concise...)
				<p>
					<textarea name = "descript"  rows = "3" cols = "40"></textarea>
				</p>
				<h2 id = "highlight5"> Attach picture</h2>
				<input type="file" name="pic" accept="image/*">
				<br><br>
				<input type="checkbox" name="owner" value="byOwner"> By owner?<br>
				<input type="Reset" value="Clear">
				<input type="Submit" value="Submit">
			</div>
		</main>
		
		<div class="clr"></div>
		
	</div>
	<div id="footerblurb">
		<div id="footerblurb-inner">
			<div class="column"></div>	
			<div class="column"></div>
			<div class="column"></div>	
			<div class="clr"></div>
		</div>
	</div>
        
       
</form> 
	<footer id="footer">
		<div id="footer-inner">
			<p>&copy; Copyright  <a href="Private%20Policy.php">Privacy Policy</a></p>
			<div class="clr"></div>
		</div>
	</footer>
</div>
</div>
</div>
</body>
</html>