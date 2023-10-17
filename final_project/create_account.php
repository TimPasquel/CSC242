<?php
require_once('functions.php');

$is_valid = true;

if (isset($_POST['user']) && isset($_POST['email']) && isset($_POST['dob']) && isset($_POST['password1']) && isset($_POST['password2'])) {
    $user = $_POST['user'];
    $email = $_POST['email'];
    $dob = $_POST['dob'];
    $p1 = $_POST['password1'];
    $p2 = $_POST['password2'];
    if ($p1 === $p2) {
        if (insertUserRecord($user, $email, $dob, $p1)) {
            header("Location: sign_in.php");
            exit();
        }
        else {
            $is_valid = false;
        }
    }
    else {
        $is_valid = false;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Create Account</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<nav>
<ul>
<li><a href="index.php">Home</a></li>
</ul>
</nav>
<h1>Create an Account</h1>
<form action="create_account.php" method="post">
  <label>User Name<input type="text" name="user" required autofocus> </label>
  <label>Email<input type="email" name="email" required></label>
  <label>Date of birth: <input type="date" name="dob" required></label>
  <label>Password<input type="password" name="password1" required></label>
  <label>Retype Password<input type="password" name="password2" required></label>
  <input type="submit" value="Create Account">
</form>

<?php
	if(!$is_valid) {
		print "<p>An Error has Occured</p>";
	}
?>

</body>
</html>
