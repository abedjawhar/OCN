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

<html>
    <title>Admin Profile</title>
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
				<h1>Admin Profile</h1>
                    
                    
				</div>
			</div>
		
		<?php 
			echo "report 1<br>";
		  	$query = "SELECT username , category, MAX(Members) FROM (SELECT  userID, category, count(category) AS Members FROM Ad group by userID, category) AS Max_Emp, User Where userId = id group by category;";
  			$result = $conn->query($query);
			if ($result->num_rows <= 0) {
	  			echo "error 00";
  			}
  			else{
  				while($row = $result->fetch_assoc()){
 			echo "<br>UserName: " . $row['username'] ." Category " .  $row['MAX(Members)']. " MAX(Members): " . $row['MAX(Members)'];
  			}
  			}

  			

  			echo "<br><br>report 2 <br>";
		  	$query = "select * From Ad where datediff(startDate, curdate()) <=10 AND category = 'buy and sell'";
  			$result = $conn->query($query);
			if ($result->num_rows <= 0) {
	  			echo "error 00";
  			}

  			else{
  				while($row = $result->fetch_assoc()){
  				 echo '<br>';
 				foreach($row as $field) {
        		echo '<td>' . htmlspecialchars($field) . ' </td>';
   				 }
  			}
  			}

  			

  			echo "<br><br>report 3 <br>";
		  	$query = "select * From(select userID FROM Ad where title LIKE '%men%' AND title LIKE '%winter%' AND title LIKE '%jacket%'' ) AS search, User where id = userId and province = 'quebec'";
  			$result = $conn->query($query);
			if ($result->num_rows <= 0) {
	  			echo "<br>NO RESULTS";

  			}
  			else{
  				while($row = $result->fetch_assoc()){
  				 echo '<br>';
 				foreach($row as $field) {
        		echo '<td>' . htmlspecialchars($field) . ' </td>';
   				 }
  			}
  			}

  			echo "<br><br>report 4 <br>";
		  	$query = "select * FROM Ad where  category	 ='rent'";
  			$result = $conn->query($query);
			if ($result->num_rows <= 0) {
	  			echo "<br>NO RESULTS";

  			}
  			else{
  				while($row = $result->fetch_assoc()){
  				 echo '<br>';
 				foreach($row as $field) {
        		echo '<td>' . htmlspecialchars($field) . ' </td>';
   				 }
  			}
  			}

  			echo "<br><br>report 5<br>";
		  	$query = "select username,category, MAX(average) From (select username,category,sum(rating)/count(username) AS average From (select Ad.* , username From Ad, User Where  userId = id and province = 'quebec' and city = 'montreal' )AS b  Where category = 'buy and sell' group by (username)) AS c1
UNION select username,category, MAX(average) From (select username,category,sum(rating)/count(username) AS average From (select Ad.* , username From Ad, User Where  userId = id and province = 'quebec' and city = 'montreal')AS b  Where category = 'rent' group by (username)) AS c2
UNION select username,category, MAX(average) From (select username,category,sum(rating)/count(username) AS average From (select Ad.* , username From Ad, User Where  userId = id and province = 'quebec' and city = 'montreal')AS b  Where category = 'services' group by (username)) AS c3
UNION select username, category,MAX(average) From (select username,category,sum(rating)/count(username) AS average From (select Ad.* , username From Ad, User Where  userId = id and province = 'quebec' and city = 'montreal')AS b  Where category = 'jobs'  group by (username)) AS c4";
  			$result = $conn->query($query);
			if ($result->num_rows <= 0) {
	  			echo "<br>NO RESULTS";

  			}
  			else{
  				while($row = $result->fetch_assoc()){
  				 echo '<br>';
 				foreach($row as $field) {
        		echo '<td>' . htmlspecialchars($field) . ' </td>';
   				 }
  			}
  			}

  			echo "<br><br>report 6 <br>";
		  	$query = "storeid, name, select 'purchases'  CAST(date AS DATE), sum(amount) as revenue from (select * from POS where  storeid = '300002' and datediff(date,curdate()) <= 15 ) AS days group by (CAST(date AS DATE))
union select 'rentals', storeId as storeid,  CAST(rentStart AS DATE), sum(rentPrice) as revenue from (select * from Rents where  storeId = '300002' and datediff(rentStart,curdate()) <= 15 ) AS days group by (CAST(rentStart AS DATE))";
  			$result = $conn->query($query);
			if ($result->num_rows <= 0) {
	  			echo "<br>NO RESULTS";

  			}
  			else{
  				while($row = $result->fetch_assoc()){
  				 echo '<br>';
 				foreach($row as $field) {
        		echo '<td>' . htmlspecialchars($field) . ' </td>';
   				 }
  			}
  			}

  			echo "<br><br>report 8 <br>";
		  	$query = "select Ad.* From Ad, Rents, PhysicalStore where Ad.postId = Rents.postid AND PhysicalStore.storeId = Rents.storeId AND province ='quebec'";
  			$result = $conn->query($query);
			if ($result->num_rows <= 0) {
	  			echo "<br>NO RESULTS";

  			}
  			else{
  				while($row = $result->fetch_assoc()){
  				 echo '<br>';
 				foreach($row as $field) {
        		echo '<td>' . htmlspecialchars($field) . ' </td>';
   				 }
  			}
  			}


			echo "<br><br>report 9 <br>";
		  	$query = "select sum(deliveryFee) from (select hoursperday*5* @total_workdays +  hoursperday*10* @total_weekends as deliveryFee from (SELECT Rents.*,
	@start := if (DATEDIFF(rentStart, curdate()) <= 7, rentStart, DATE_SUB(curdate(), INTERVAL 7 DAY)),
    @end := if (DATEDIFF(rentEnd, curdate()) <= 7, rentEnd, DATE_ADD(curdate(), INTERVAL 7 DAY)),
    @raw_days   := DATEDIFF(@end, @start)+1 'raw_days',
    @full_weeks := FLOOR(@raw_days / 7) 'full_weeks',
    @odd_days   := @raw_days - @full_weeks * 7 'odd_days',
    @wday_start := DAYOFWEEK(@start) 'wday_start',
    @wday_end   := DAYOFWEEK(@end) 'wday_end',
    @weekend_intrusion  := @wday_start + @odd_days 'weekend_intrusion',
    @extra_weekends     :=
        IF(@wday_start = 1, IF(@odd_days = 0, 0, 1),
            IF(@weekend_intrusion > 7, 2,
                IF(@weekend_intrusion > 6, 1, 0)
            )
        ) 'extra_weekends',
    @total_weekends     := @full_weeks * 2 + @extra_weekends 'total_weekends',
    @total_workdays     := @raw_days - @total_weekends 'total_workdays' From Rents where userId = '100066' and delivery = 'yes') as calculation) as individualPrice group by (deliveryFee)";
  			$result = $conn->query($query);
			if ($result->num_rows <= 0) {
	  			echo "<br>NO RESULTS";

  			}
  			else{
  				while($row = $result->fetch_assoc()){
  				 echo '<br>';
 				foreach($row as $field) {
        		echo '<td>' . htmlspecialchars($field) . ' </td>';
   				 }
  			}
  			}
		?>
	

	</body>
</html>