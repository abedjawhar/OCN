<?php session_start(); ?>
<html>
<body>
<?php
require_once('mysql_connect.php');
$user = $_SESSION['user'];
$sql = "SELECT membership FROM `User` WHERE id = '$user' ";
if($results = $conn->query($sql)) {
	// process the query results
	if ($results->num_rows == 1) {
		$row = $results->fetch_object();
		$memtype = $row->membership;
		$sql2 = "SELECT duration FROM `Membership` WHERE type = '$memtype' ";
		if($results2 = $conn->query($sql2)) {
		// process the query results
			if ($results2->num_rows == 1) {
				$row2 = $results2->fetch_object();
				$memduration = $row2->duration;
			}
		}
	}
}



$title = mysqli_real_escape_string($conn, $_REQUEST['title']);
$description = mysqli_real_escape_string($conn, $_REQUEST['descript']);
$price = mysqli_real_escape_string($conn, $_REQUEST['price']);
$owner = mysqli_real_escape_string($conn, $_REQUEST['owner']);
$pic = mysqli_real_escape_string($conn, $_REQUEST['pic']);
$address = mysqli_real_escape_string($conn, $_REQUEST['address']);

$category = mysqli_real_escape_string($conn, $_REQUEST['category']);
$subcategory = mysqli_real_escape_string($conn, $_REQUEST['subcategory']);
$promotion = mysqli_real_escape_string($conn, $_REQUEST['promotion']);
$startdate = date("Y-m-d");
$endDate = date("Y-m-d" , strtotime("+".$memduration." days"));
if(strlen($pic) <= 0){
	$pic = "img_avatar2.png";
}

$store = $_POST['Physicalstore'];

if($store == "none"){
$sql = "INSERT INTO `Ad` (`title`, `description`, `price`, `forsale`, `image`, `address`, `startDate`, `endDate`, `userId`, `ad_promotion`, `category`, `subCategory`)
VALUES('$title','$description','$price','$owner','$pic','$address', '$startdate', '$endDate', '$user', '$promotion', '$category','$subcategory')";

if($results = $conn->query($sql)){
    echo "Records added successfully.";
    $last_id = $conn->insert_id;
    echo "New record created successfully. Last inserted ID is: " . $last_id;
	
}
} else {
	$sql2 = "SELECT storeId FROM `PhysicalStore` WHERE name = '$store' ";
		if($results2 = $conn->query($sql2)) {
		// process the query results
			if ($results2->num_rows == 1) {
				$row2 = $results2->fetch_object();
				$storeID = $row2->storeId;
			}
		}
	
	$sql = "INSERT INTO `Ad` (`title`, `description`, `price`, `forsale`, `image`, `address`, `startDate`, `endDate`, `userId`, `ad_promotion`, `category`, `subCategory`, `storeID`)
VALUES('$title','$description','$price','$owner','$pic','$address', '$startdate', '$endDate', '$user', '$promotion', '$category','$subcategory', '$storeID')";

	if($results = $conn->query($sql)){
		echo "Records added successfully. with store Id" . $store;
		$last_id = $conn->insert_id;
		echo "New record created successfully. Last inserted ID is: " . $last_id;
	}
}

if($promotion != 'none'){
	$sql = "SELECT duration FROM `Promotion` WHERE type = '$promotion' ";
	$results = $conn->query($sql);
	$row = $results->fetch_object();
	$promo = $row->duration;

	echo $promo;
	$endDate = date("Y-m-d" , strtotime("+".$promo." days"));	

    $sql = "INSERT INTO `Promoted` (`startDate`, `endDate`, `promoType`, `adId`) VALUES('$startdate', '$endDate', '$promotion', '$last_id')";

$results = $conn->query($sql);





} /*else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
}
*/




$beginrentday1 = $_POST['rentStart'];
$endrentday1  = $_POST['rentEnd'];

$beginrentday = strtotime($_POST['rentStart']);
$endrentday  = strtotime($_POST['rentEnd']);
$no_days  = 0;
$weekends = 0;
while ($beginrentday <= $endrentday) {
    $no_days++; // no of days in the given interval
    $what_day = date("N", $beginrentday);
    if ($what_day > 5) { // 6 and 7 are weekend days
        $weekends++;
    };
    $beginrentday += 86400; // +1 day
};
$working_days = $no_days - $weekends;

echo "wd ". $working_days . " wends " . $weekends;
$hourRent = (int)$_POST['hours'];
$del = $_POST['delivery'];
if($store != "none"){
	echo "1  ";
	$sl = $_POST['sLocation'];
	$sql = "SELECT weekRate, weekEndRate FROM `Strategic Location` WHERE type = '$sl' ";
	$results = $conn->query($sql);
	$row = $results->fetch_object();
	$rentprice = ($row->weekRate * $working_days * $hourRent) + ($row->weekEndRate * $weekends * $hourRent);
	echo $rentprice;
	
	$sql2 = "SELECT storeId FROM `PhysicalStore` WHERE name = '$store' ";
		if($results2 = $conn->query($sql2)) {
		// process the query results
			if ($results2->num_rows == 1) {
				$row2 = $results2->fetch_object();
				$storeID = $row2->storeId;
			}
		}
	if($del != "Yes"){
		echo " 22";
		$sql = "INSERT INTO `Rents` (`rentStart`, `rentEnd`, `rentPrice`, `delivery`, `postId`, `storeId`, `userId`, `hoursperday`) VALUES('$beginrentday1', '$endrentday1', '$rentprice', 'No', '$last_id', '$storeID', '$user', '$hourRent')";
		if($results = $conn->query($sql)){
			echo "Records added successfully.";
		} else {
			echo mysqli_error($conn);
		}
	} else {
		echo " 33";
		$rentprice = $rentprice + ($working_days * 5 * $hourRent) + (10 * $weekends * $hourRent);
		$sql = "INSERT INTO `Rents` (`rentStart`, `rentEnd`, `rentPrice`, `delivery`, `postId`, `storeId`, `userId`, `hoursperday`) VALUES('$beginrentday1', '$endrentday1', '$rentprice', '$del', '$last_id', '$storeID', '$user', '$hourRent')";
		
		if($results = $conn->query($sql)){
			echo "Records added successfully.";
		} else {
			echo mysqli_error($conn);
		}
	}
}


/*
$sql3 = "SELECT cardNumber FROM `User` WHERE id = '$user' ";
if($results3 = $conn->query($sql3)) {
	// process the query results
	if ($results3->num_rows == 1) {
		$row3 = $results3->fetch_object();
		$creditCard = $row3->cardNumber;

	}
}


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

*/
echo "done";
mysqli_close($conn);
?>

<body onload="document.frm1.submit()">
   <form action="./pay.php" method = "post" name="frm1">
      <input type="hidden" name="promotion" value="<?php echo $promotion; ?>" >
	  <input type="hidden" name="rentingPrice" value="<?php echo $rentprice; ?>" >
	  <input type="hidden" name="strtLocation" value="<?php echo $_POST['sLocation']; ?>" >
   </form>
</body>
<script>
alert("Ad successfully posted!! " + $promo);
window.location = "./pay.php";
</script>

</body>

</html>