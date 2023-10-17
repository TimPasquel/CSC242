<?php
session_start();
require_once('functions.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Local Events</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<?php include "nav.html" ?>
<h1>Local Events</h1>

<?php
$db = new PDO("sqlite:local_events.db");
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$stmt = $db->query("select * from events");
$records = $stmt->fetchall(PDO::FETCH_ASSOC);
printTable($records);
$db = null;
?>
</body>
</html>
