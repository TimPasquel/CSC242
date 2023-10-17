<?php
require_once('functions.php');

$is_valid = true;

if (isset($_POST['email']) && isset($_POST['password']) ){
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $record = getUserRecord($email, $pass);

    if ($record) {
        session_start();
        $_SESSION += $record;
        header("Location: index.php");
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
  <title>Home</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<nav>
<ul>
<li><a href="index.php">Home</a></li>
</ul>
</nav>
<h1>Sign In</h1>

<form action="sign_in.php" method="post">
    <label>User Email<input type="email" name="email" required autofocus></label>
    <br>
    <label>Password <input type="password" name="password" required></label>
    <br>
    <input type="submit" value="Sign In">
</form>

<?php
	if(!$is_valid) {
		print "<p>An Error has Occured</p>";
	}
?>

</body>
</html>
