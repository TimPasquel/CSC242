<?php
//Name:Tim Pasquel
//Major:Information Technology
//Creation Date: 11/26/2022
//Due Date: 12/14/2022
//Course:CSC242
//Professor Name:Dr. Schwesinger
//Assignment Number: Final Project
//Filename: index.php | final-project-handout
//Purpose: Website hosting for ReadySetRace, holds individual accounts and user created events
session_start();
require_once('functions.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Home</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
 <h1>Welcome to ReadySetRace!</h1>
<?php

if(isset($_SESSION['Name']) && isset($_SESSION['Email']) && isset($_SESSION['Dob']) && isset($_SESSION['Password'])) {
        include "nav.html";
	print "<nav>\n";
	print "<ul>";
        print '<li><a href="log_out.php">Log Out</a></li>';
	print '<li><a href="delete_account.php">Delete Account</a></li>';
	print '<li><a href="change_password.php">Change Password</a></li>';
	print "</ul>";
        print "</nav>\n";

}
else {
        print "<nav>\n";
	print "<ul>";
        print '<li><a href="sign_in.php">Sign In</a></li>';
        print '<li><a href="create_account.php">Create Account</a></li>';
	print "</ul>";
	print "</nav>";
}

/////////////////////////////////////////////////////////////////

if(isset($_SESSION['Name']) && isset($_SESSION['Email']) && isset($_SESSION['Dob']) && isset($_SESSION['Password'])) {

        $name = $_SESSION['Name'];
        $email = $_SESSION['Email'];
        $dob = $_SESSION['Dob'];
        $password = $_SESSION['Password'];
	
	print "<h2> Hello $name, looking to create or find a new event?</h2>";
	print "<p> Using the navigation bar above you can find or create what you are looking for</p>";	
	print "<p> Use the Home page to delete and update your account</p>";
        print "<p> Warning: Delete Account is instant and will remove all of your created events</p>";

	print'<img src="images/20210710_163154.jpg" alt="AE86 and RX7" style="width:400px;height:400px;">';
}
else {
        print "<p>Please Sign in or Create an Account</p>\n";
}
?>

</body>
</html>
