<?php
session_start();
require_once('functions.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Search Events</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<?php include "nav.html" ?>
<?php
$s_Title = isset($_POST['category']) && $_POST['category'] === 'Title';
$s_Location = isset($_POST['category']) && $_POST['category'] === 'Location';
$s_Host = isset($_POST['category']) && $_POST['category'] === 'Host';
$s_Date = isset($_POST['category']) && $_POST['category'] === 'Date';
$s_Time = isset($_POST['category']) && $_POST['category'] === 'Time';
$s_Poster = isset($_POST['category']) && $_POST['category'] === 'Poster';
$s_Id = isset($_POST['category']) && $_POST['category'] === 'Id';
?>
<h1>Search Events</h1>
<h2>Please Fill out the Form to Find Specific Events</h2>
<p>Choose an Attribute you Would Like to Search for in the Box and Type the Desired Content in the Search Bar</p>
<form action="search_events.php" method="post">
    <label>Category:
      <select name="category">
        <option value="Title" <?php print $s_Title ? "selected" : ""; ?> >Title</option>
        <option value="Location" <?php print $s_Location ? "selected" : ""; ?> >Location</option>
        <option value="Host" <?php print $s_Host ? "selected" : ""; ?> >Host</option>
        <option value="Date" <?php print $s_Date ? "selected" : ""; ?> >Date</option>
	<option value="Time" <?php print $s_Time ? "selected" : ""; ?> >Time</option>
	<option value="Poster" <?php print $s_Poster ? "selected" : ""; ?> >Poster</option>
	<option value="Id" <?php print $s_Id ? "selected" : ""; ?> >Id</option>
      </select>
    </label>
    <label>Term: <input type="text" name="term" required></label>
    <input type="submit">
  </form>
<?php
$is_valid = true;

if (isset($_POST['category']) && isset($_POST['term'])) {
	$category = $_POST['category'];
	$term = $_POST['term'];
	if(searchEvents($category, $term));
        else {
                $is_valid = false;
        }		
}
if (!$is_valid) {
        print "<p>An error occurred</p>";
}
?>
</body>
</html>
