<?php
session_start();

require_once("mysql_connect.php");

// sanitize Data
$postId = $conn->real_escape_string($_POST['email']);

echo "Removing ad";
echo "$_POST[$postId]";

$sql = "UPDATE Ad SET  endDate= (curdate()-1) WHERE  postId = '$postId'";
if($results = $conn->query($sql));


if (headers_sent()) {
	die("Redirect failed. Please click on this link: <a href='/Home.php'>Take me back!</a>");
}
else{
	exit(header("Location: /Home.php"));
}
?>