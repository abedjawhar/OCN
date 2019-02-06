<?php session_start(); ?>

<?php
	require_once("mysql_connect.php");

	$key = $conn->real_escape_string($_SESSION['admin']);

	// sql query
	$sql = "SELECT *
			FROM Admin
			WHERE Admin.adminId='$key'";

	// user information
	if($results = $conn->query($sql)) {
		if ($results->num_rows > 0) {
			$result_object = $results->fetch_object();

			// once logged in see all membership/promotion/transaction payments admin sees all ads, can alter ads, payment backups(copy)click & by time, triggers/events

			$email = $result_object->email;
			$username = $result_object->username;
			//$membership = $result_object->membership;

			echo "$username";
			echo  str_repeat('&nbsp;', 5);
			echo "$email";
			//echo "$membership";
			echo "<br />";

			// sql query for ads
			$sql = "SELECT * 
					FROM Ad";

			// user ads
			if($results = $conn->query($sql)) {
				if ($results->num_rows > 0) {
					echo "<form method=\"post\" action=\"remove_add.php\">";
					while ($row = $results->fetch_object()) {
						echo "<div>";
						if($row->image != null){
							echo "<div style='max-width:150px;display: inline-block;' >";
							echo "<img src='" . $row-> image . "' height='130' width='150'> ";
							echo "</div>";
						}
						echo "<div style = 'text-align :left; display:inline-block; margin: 1em;'>";
						echo "<font color=blue font face='arial' size='2pt'>$row->title</font>";
						echo  "<br>";
						echo "<font color=blue font face='arial' size='2pt'>$row->description</font>";
						echo  "<br>";
						echo "<font color=blue font face='arial' size='2pt'>$row->price\$CAD</font>";
						echo  str_repeat('&nbsp;', 5);
						echo "<font color=blue font face='arial' size='2pt'>$row->forsale</font>";
						echo  str_repeat('&nbsp;', 5);
						echo "<font color=blue font face='arial' size='2pt'>$row->address</font>";
						
						echo  str_repeat('&nbsp;', 15);
						echo "<input type=\"submit\" name=\"remove\" value=\"$row->postId\" />";
						echo "</div>";
						echo "</div>";
					}
					echo "</form>";
				}
			}
		}
		else {
			echo "\nNo such user exists.";
		}
	}
?>