<?php
require_once('functions.php');
session_start();

$is_valid = true;

if (isset($_POST['password']) && isset($_POST['password1']) && isset($_SESSION['Name'])) {
	if($_POST['password'] === $_POST['password1']) {
		editPassword($_SESSION['Name'], $_POST['password']);
		session_unset();
		session_destroy();
            	header("Location: sign_in.php");
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
  <title>Change Password</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<?php include "nav.html" ?>
<h1>Change Password</h1>
<p>Enter a New Password Below and Retype it on the Right to Confirm it</P>
<form action="change_password.php" method="post">
    <label>New Password<input type="password" name="password" required> </label>
    <label>Retype Password<input type="password" name="password1" required></label>
    <input type="submit" value="Change Password">
</form>
<?php
        if(!$is_valid) {
                print "<p>An Error has Occured</p>";
        }
?>

</body>
</html>
