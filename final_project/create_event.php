<?php
session_start();
require_once('functions.php');

$is_valid = true;

if(isset($_POST['title']) && isset($_POST['location']) && isset($_POST['host']) && isset($_POST['date']) && isset($_POST['time']) && isset($_POST['time']) && isset($_SESSION['Name'])) {
	if(insertEvent($_POST['title'], $_POST['location'], $_POST['host'], $_POST['date'], $_POST['time'], $_SESSION['Email'], $_POST['id'])) {
        	header("Location: local_events.php");
		exit();
	}
        else {
        	$is_valid = false;
	}		
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Create Event</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<?php include "nav.html" ?>
<h1>Create Event</h1>
<h2>Please Fill out the Form to Post Your Event for Other Enthusiasts to See</h2>
<p>Fill Title of Event, Location of Event, Host of Event, Date of Event,</p>
<p>Time of Event, and a unique personal ID Number of Event</p>
<form action="create_event.php" method="post">
	<label>Title of Event<input type="text" name="title" required> </label>
	<label>Location<input type="text" name="location" required> </label>
	<label>Host<input type="text" name="host" required> </label>
	<label>Date<input type="date" name="date" required> </label>
	<label>Time<input type="time" name="time" required> </label>
<!--
 * Author: W3 Schools
 * Publication Date: NA, Copyright of Company 1999-2022
 * Title and Version: HTML <input type = "number">
 * Source: https://www.w3schools.com/tags/att_input_type_number.asp 
 * Date Retrieved: 12/13/2022
-->
	<label for="id">ID Number (between 0 and 999999):</label>
	<input type="number" id="id" name="id" min="0" max="999999">
	<input type="submit" value="Create Event">
</form>

<?php
	if(!$is_valid) {
		print "<p>An Error has Occured</p>";
	}
?>
</body>
</html>
