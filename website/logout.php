<?php
session_start();

echo "Logout Successfully ";
session_destroy();

if (headers_sent()) {
	die("Redirect failed. Please click on this link: <a href='/Home.php'>Take me back!</a>");
}
else{
	exit(header("Location: /Home.php"));
}
?>