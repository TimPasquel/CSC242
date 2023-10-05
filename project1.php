<?php 
//Name:Tim Pasquel
//Major:Information Technology
//Creation Date: 9/8/2022
//Due Date: 9/15/2022
//Course:CSC242
//Professor Name:Dr. Schwesinger
//Assignment Number:Assignment 1
//Filename:project1.php
//Purpose:To take a users input of a donor and recipients blood types
//and see if they are compatible with one another

$donor = readline("Please Enter the Donors Blood Type: \n");
$rec = readline("Please Enter the Recipients Blood Type: \n");

$output = "";
$error1 = "";
$error2 = "";

//Input Check
//Checks to see if the user inputed value characters for both the doner and the recipient.
//If incorrect a flag will be thrown and an error message will be displayed
if($donor === "O-" || $donor === "O+" || $donor === "B-" || $donor === "B+" || $donor === "A-" || $donor === "A+" ||
$donor === "AB-" || $donor === "AB+")
{
        $error1 = "";
}
else
{
	$error1 = "ERROR: invalid donor blood type\n";
}

if($rec === "O-" || $rec === "O+" || $rec === "B-" || $rec === "B+" || $rec === "A-" || $rec === "A+" ||
$rec === "AB-" || $rec === "AB+")
{
	$error2 = "";
}
else
{
        $error2 = "ERROR: invalid recipient blood type\n";
}

if($error1 !== "")
{
	$output = $error1;
}
if($error2 !== "")
{
	$output = $error2;
}
//Input Check

//Blood Check
//If no errors are thrown, the doner is compared to the recipient blood type and if compatible,
//Will output compatible, if not incompatible
if($error1 === "" && $error2 === "")
{
if ($donor === "O-" && ($rec === "AB-" || $rec === "AB+" || $rec === "O-" || $rec === "B-"
|| $rec === "A-" || $rec === "O+" || $rec === "B+" || $rec === "A+"))
{
	$output = "Compatible\n";
}
else if($donor === "O+" && ($rec === "AB+" || $rec === "A+" || $rec === "B+" || $rec === "O+"))
{
	$output = "Compatible\n";
}
else if($donor === "B-" && ($rec === "AB+" || $rec === "AB-" || $rec === "B+" || $rec === "B-"))
{
	$output = "Compatible\n";
}
else if($donor === "B+" && ($rec === "AB+" || $rec === "B+"))
{
	$output = "Compatible\n";
}
else if($donor === "A-" && ($rec === "AB+" || $rec === "AB-" || $rec === "A+" || $rec === "A-"))
{
	$output = "Compatible\n";
}
else if($donor === "A+" && ($rec === "AB+" || $rec === "A+"))
{
	$output = "Compatible\n";
}
else if($donor === "AB-" && ($rec === "AB+" || $rec === "AB-"))
{
	$output = "Compatible\n";
}
else if($donor === "AB+" && ($rec === "AB+"))
{
	$output = "Compatible\n";
}
else
{
	$output = "Incompatible\n";
}
}
//Blood Check

//Output
//Prints the output
print "$output";
//Output
?>
