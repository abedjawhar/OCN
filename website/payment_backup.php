<?php
session_start();

if (isset($_SESSION['admin'])) {
	require_once("mysql_connect.php");

	// sanitize Data
	if (!$conn->query('CALL paymentbackup()')) {
		echo "Payement was successfully backedup!";
	} else {
		echo "Payement did not backup!";
	}

	echo "<br />";

	if (headers_sent()) {
		die("Redirect failed. Please click on this link: <a href='/Home.php'>Take me back!</a>");
	} else {
		exit(header("Location: /Home.php"));
	}
}
?>