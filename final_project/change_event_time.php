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
        if(changeTime($items, $_POST['time'])) {
                 header("Location: change_event_time.php");
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
  <title>Change Event Time</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<?php include "nav.html" ?>
<h1>Change Event Time</h1>
<h2>Below you can change the event time of selected events that you have created</h2>
<form action="change_event_time.php" method="post">
  <p>Include the New Time Here:</p>
  <label>Time<input type="time" name="time" required> </label>
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
  <input type="submit" value="Change Time">
</form>
<?php
if (!$is_valid) {
        print "<p>An error occurred</p>";
}
?>
</body>
</html>
