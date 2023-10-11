<!DOCTYPE html>
<!--
Name: Tim Pasquel
Major: Information Technology
Creation Date: 10/24/2022
Due Date: 10/27/2022
Course: CSC242
Professor Name: Dr. Schwesinger
Assignment Number: Assignment 5
Filename: project5.php
Purpose: Take an input file, convert it to an html table that is sorted by count and alphabetical order with css accents
-->

<html lang="en">
<head>
  <title>Animals</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<h1>Zoo Information</h1>

<form action="project5.php" method="get">
  <select name="type">
    <option value="class">Class</option>
    <option value="status">Status</option>
  </select>
  <input type="text" name="term">
  <input type="submit" value="Search">
</form>

<?php
// TODO print table or error message

/////////////////////////////////////////////////////
//Function name: makeData
//Description: Takes a filename and creates a 2D array called data that consists of animals and their corresponding elements
//Parameters: $filename:string - name of the file to be used
//Return Value: $data:2D array - animals and their corresponding elements
/////////////////////////////////////////////////////
function makeData($filename) {
	$data = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
	foreach($data as &$element) {
        	$element = explode(",", $element);
	}
	return $data;
}

/////////////////////////////////////////////////////
//Function name: outputData
//Description: Takes a 2D array, checks to see if the user input is valid, if so prints the proper table based upon request, otherwise print error message
//Parameters: $out:array - an array of arrays for the animals and their elements
//Return Value: None - Webpage generation of either a sorted table if user input is correct, or error message if incorrect
/////////////////////////////////////////////////////
function outputData($data) {
	$column1 = $data[0][0];
	$column2 = $data[0][1];
	$column3 = $data[0][2];
	$column4 = $data[0][3];
	unset($data[0]);

	$valid_class = validClass($data);

	$valid_status = validStatus($data);

	if(isset($_GET['type']) && isset($_GET['term'])) {
        	if(($_GET['type'] === "class") && !in_array($_GET['term'], $valid_class)) {
        	print "<p>Error: NOT A VALID CLASS - VALID CLASS: </p>\n";
        	print "<ul>\n";
        	foreach($valid_class as $element) {
                	print "<li> $element </li>\n";
        	}
        	print "</ul>\n";
	}

	else if(($_GET['type'] === "status") && !in_array($_GET['term'], $valid_status)) {
        	print "<p>Error: NOT A VALID STATUS - VALID STATUS: </p>\n";
        	print "<ul>\n";
        	foreach($valid_status as $element) {
                	print "<li> $element </li>\n";
        	}
		print "</ul>\n";
	}

	else {
        	$out = array();
        	if ($_GET['type'] === "status") {
                	foreach($data as $element) {
                        	if($element[2] === $_GET['term']) {
                                	$out[] = $element;
                        	}
                	}
        	}

        	else if ($_GET['type'] === "class") {
                	foreach($data as $element) {
                        	if($element[1] === $_GET['term']) {
                                	$out[] = $element;
                        	}
                	}
        	}

		$out = sortAndAlphabetizeData($out);

		makeTable($out, $column1, $column2, $column3, $column4);

	} //else

} //isset if
} //function outData

/////////////////////////////////////////////////////
//Function name: makeTable
//Description: Takes an array of arrays and creates an html table out of this data
//Parameters: $data:array - an array of arrays for the animals and their elements, $column1:string - column1 of table, $column2:string - column2 of table,
//$column3:string - column3 of table, $column4:string - column4 of table  
//Return Value: None, prints out html table properties to be used for the site
/////////////////////////////////////////////////////
function makeTable($data, $column1, $column2, $column3, $column4) {
	print "<table>\n";
        print "<thead><tr>\n";
        print "<th>$column1</th>\n";
        print "<th>$column2</th>\n";
        print "<th>$column3</th>\n";
        print "<th>$column4</th>\n";
        print "</tr></thead>\n";
        print "<tbody>\n";

        foreach($data as $element) {
                print "<tr>\n";
                foreach($element as $item) {
                        print "<td>$item</td>\n";
                }
                print "</tr>\n";
         }
         print "</tbody>\n";
         print "</table>\n";
}

/////////////////////////////////////////////////////
//Function name: validClass
//Description: Takes the 2D array of data and creates an array consisting of the unique valid classes in data
//Parameters: $data:array - an array of arrays for the animals and their elements
//Return Value: array - an array of the unique valid classes in data
/////////////////////////////////////////////////////
function validClass($data) {
	$valid_class = array();
	foreach($data as $row) {
        	$valid_class[] = $row[1];
	}
	return array_unique($valid_class);
}

/////////////////////////////////////////////////////
//Function name: validStatus
//Description: Takes the 2D array of data and creates an array consisting of the unique valid statuses in data
//Parameters: $data:array - an array of arrays for the animals and their elements
//Return Value: array - an array of the unique valid statuses in data
/////////////////////////////////////////////////////
function validStatus($data) {
	$valid_status = array();
	foreach($data as $row) {
        	$valid_status[] = $row[2];
	}
	return array_unique($valid_status);
}

/////////////////////////////////////////////////////
//Function name: sortAndAlphabetizeData
//Description: Takes a 2D array and sorts it based on decending order of total, then by alphabetical order of name if two rows are the same value
//Parameters: $out:array - an array of arrays for the animals and their elements
//Return Value: $out:array - a sorted array of animals and their elements
/////////////////////////////////////////////////////
function sortAndAlphabetizeData($out) {
	/*
        Author: Rizier123
        Publication Date: 5/28/2015
        Title and Version: How to sort by word count and in alphabetical order?
        Source: https://stackoverflow.com/questions/30518279/how-to-sort-by-word-count-and-in-alphabetical-order
        Date Retrieved: 10/25/2022
        */
        usort($out, function($a, $b){
        	$countA = $a[3];
        	$countB = $b[3];

        	if($countA == $countB) {
        		return $a[0] > $b[0] ? 1 : -1;
        	}
        	else {
        		return $countA < $countB ? 1 : -1;
        	}
        });
	return $out;
}

/////////////////////////////////////////////////////
//Function name: main
//Description: Puts together the nessesary functions to create a webpage for zoo information
//Parameters: None
//Return Value: None - Webpage generation
/////////////////////////////////////////////////////
function main() {
$data = makeData("animals.csv");

outputData($data);

}

main();

?>

</body>
</html>
