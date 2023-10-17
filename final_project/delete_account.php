<?php
require_once('functions.php');
session_start();
if(isset($_SESSION['Name']) && isset($_SESSION['Email']) && isset($_SESSION['Dob']) && isset($_SESSION['Password'])) {
	deleteUser($_SESSION['Name'], $_SESSION['Email'], $_SESSION['Dob'], $_SESSION['Password']);
	deleteAllUserEvents($_SESSION['Email']);
	session_unset();
	session_destroy();
	header("Location: index.php");
	exit();
}
else {
	print "<p>An Error has Occured</p>";
}
?>
