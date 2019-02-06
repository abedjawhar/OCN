<?php
session_start();
 
// require a database connection
require_once('mysql_connect.php');

// check post
if (isset($_POST['validate'])) {
  // sanitize Data
  $email = $conn->real_escape_string($_POST['email']);
  $password = $conn->real_escape_string($_POST['password']);
  
  // sql query
  $sql = "SELECT *
    FROM User
    WHERE User.email='$email'";

	$sql2 = "SELECT *
    FROM Admin
    WHERE Admin.email='$email'";

  if(($results = $conn->query($sql)) && ($results->num_rows > 0)) {
    
      $result_object = $results->fetch_object();
    
      // check password
      if ($password === $result_object->password) {
        echo "\nSuccessfully validated user.";
        $_SESSION['user'] = $result_object->id;
      } else {
        echo "\nFailed to validated user.";
      }
    } else if (($results2 = $conn->query($sql2)) && ($results2->num_rows > 0)){
      $result_object = $results2->fetch_object();
    
      // check password
      if ($password === $result_object->password) {
        echo "\nSuccessfully validated admin.";
        $_SESSION['admin'] = $result_object->adminId;
		
		
      } else {
        echo "\nFailed to validated user.";
      }
	  
	  
    } else {
		echo "\nNo such user exists.";
	}
  }


if (headers_sent()) {
    die("Redirect failed. Please click on this link: <a href='/Home.php'>Take me back!</a>");
}
else{
    exit(header("Location: /Home.php"));
}
?>