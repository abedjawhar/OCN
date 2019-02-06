<?php



require_once('mysql_connect.php'); 

$sql = "SELECT type FROM `Membership`";
$results = $conn->query($sql);

if (!$results) {
    throw new Exception("Database Error [{$this->database->errno}] {$this->database->error}");
}

if($results) {
    if ($results->num_rows > 0) {

    	echo "<select type='type'>";
        while ($row = $results->fetch_assoc()) {
            echo "<option value='" . $row['type'] . "'>" . $row['type'] . "</option>";
		}

		echo "</select>";

    } else {
        echo "this didn't work";
    }
}



?>


<html lang = "en">
	<head>
		<title>Hello World</title>
	</head>
	<body>
		<?php echo "Hello world!";?>
	</body>
</html>