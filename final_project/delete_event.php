<?php
session_start();
include 'functions.php';
?>

<?php
$is_valid = true;

if(isset($_POST['rows'])) {
        $rows = $_POST['rows'];
        $items = array();
        foreach($rows as $element) {
                $items[] = explode(",", $element);
        }
	if(deleteEvents($items)) {
		 header("Location: delete_event.php");
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
  <title>Delete Event</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<?php include "nav.html" ?>
<h1>Delete Event</h1>
<h2>Below you can delete the events that you have created</h2>
<p>Select the Box or Boxes and Select Delete to Delete the Event</p>
<form action="delete_event.php" method="post">
  <?php
  if(isset($_SESSION['Email'])) {
  $email = $_SESSION['Email'];
  $db = new PDO("sqlite:local_events.db");
  $sql = "SELECT * FROM events WHERE Poster = ?";
  $stmt = $db->prepare($sql);
  $stmt->execute([$email]);
  $records = $stmt->fetchall(PDO::FETCH_ASSOC);
  $db = null;
  printFormTable($records);
  }
  ?>
  <input type="submit" value="Delete">
</form>
<?php
if (!$is_valid) {
	print "<p>An error occurred</p>";
}
?>
</body>
</html>
