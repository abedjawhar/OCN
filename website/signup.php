<html>
<body>
<?php

	require_once('mysql_connect.php'); 




$name = $conn->real_escape_string($_POST['name']);
$username = $conn->real_escape_string($_POST['username']);
$email = $conn->real_escape_string($_POST['email']);
$psw = $conn->real_escape_string($_POST['psw']);
$postalCode = $conn->real_escape_string($_POST['postalCode']);
$phoneNumber = $conn->real_escape_string($_POST['phoneNumber']);
$creditCard = $conn->real_escape_string($_POST['creditCard']);
$province = $conn->real_escape_string($_POST['province']);
$city = $conn->real_escape_string($_POST['city']);
$membership = $conn->real_escape_string($_POST['membership']);




$sql = "SELECT username FROM Admin Where username = '$username'";


if($results = $conn->query($sql)){
	if ($results->num_rows > 0) {
		echo "This is an Admin userName";
		exit();
	}
}

$sql = "INSERT INTO User  (name, email, username, password, postalCode, phone, cardNumber, membership, province, city) VALUES ('$name', '$email', '$username', '$psw', '$postalCode', $phoneNumber, $creditCard, '$membership', '$province', '$city')";



if($results = $conn->query($sql)) {
	echo "user added";
	$sql = "SELECT id FROM User Where username = '$username'";
	$results = $conn->query($sql);
	echo "result added";
	echo "testtt added";
	$row = $results->fetch_object();
 	$id = $row->id;
	$sql = "SELECT price FROM Membership Where type = '$membership'";
	$results = $conn->query($sql);
	echo "price added";
	$row = $results->fetch_object();
 	$price =  $row->price;
 	$sql = "INSERT INTO Payment  (date, purchase, description, amount, cardNumber, userID) VALUES (NOW(), 'Membership', '$membership', '$price', '$creditCard', '$id')";

 	if($results = $conn->query($sql)) {
 		echo "payment added";
 
 		echo "<script>";
   		echo "window.location = 'https://svc353_2.encs.concordia.ca/Home.php';";
   		echo "</script>";
 	} else {
	echo "error: ";
	echo $conn->error . "\n";
	}

} else {
	echo "error: ";
	echo $conn->error . "\n";
	}


?>



</body>


</html>