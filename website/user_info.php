<?php session_start(); ?>

<?php
	require_once("mysql_connect.php");

	$key = $conn->real_escape_string($_SESSION['user']);

	// sql query for user
	$sql = "SELECT *
			FROM User
			WHERE User.id='$key'";

	// user information
	if($results = $conn->query($sql)) {
		if ($results->num_rows > 0) {
			$result_object = $results->fetch_object();

			// once logged in must see users information (email username membership type )after posted user should be able to see all ads/expiration/position of ads/modify ad after buying, ranking of ad

			$email = $result_object->email;
			$username = $result_object->username;
			$membership = $result_object->membership;

			echo "$username\n";
			echo "$email\n";
			echo "$membership\n";
			echo "<br />";

			// sql query for ads
			$sql = "SELECT *
					FROM Ad
					WHERE Ad.userId='$key'";

			// user ads
			if($results = $conn->query($sql)) {
				if ($results->num_rows > 0) {
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
						echo "</div>";
						echo "</div>";
					}
				}
			}
		}
		else {
			echo "\nNo such user exists.";
		}
	}
?>