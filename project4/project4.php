<!DOCTYPE html>
<!--
STUDENT: Tim Pasquel
CSC 242, Fall 2022, Assignment 4
-->

<!--
TODO:
* Add any required HTML elements that are missing
* Attach the style.css file
-->
<html>
	<head>
	<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	<body>
		<?php

			/////////////////////////////////////////////////////
			//Function name: getData
			//Description: Takes the contents from a file and puts them in an array
			//Parameters: string - the file name
			//Return Value: array - the array of each line in the file
			/////////////////////////////////////////////////////
			function getData($filename) {
				$data = array();
				$data = file_get_contents($filename);
				$data = explode("\n", $data);
				$out = array_pop($data);
				return $data;
			}
				
			/////////////////////////////////////////////////////
                        //Function name: cleanData
                        //Description: Takes an array of lines from the file and seperates each element into
			//individual elements
                        //Parameters: array - an array of the file contents
                        //Return Value: array - an array of the file contents, with each element separated
                        /////////////////////////////////////////////////////
			function cleanData($old_data) {
				foreach($old_data as &$element) {
					$element = explode(",", $element);
				}
				return $old_data;
			}
			
			/////////////////////////////////////////////////////
                        //Function name: makeTable
                        //Description: Takes an array of arrays and creates an html table out of this data
                        //Parameters: array - an array of arrays for the animals and their elements
                        //Return Value: None, prints out html table properties to be used for the site 
                        /////////////////////////////////////////////////////
			function makeTable($data) {
				$column1 = $data[0][0];
                        	$column2 = $data[0][1];
                        	$column3 = $data[0][2];
                        	$column4 = $data[0][3];

                        	unset($data[0]);
	
				print "<table>\n";
                        	print "<tr>\n";
                        	print "<th>$column1</th>\n";
                	        print "<th>$column2</th>\n";
        	                print "<th>$column3</th>\n";
	                        print "<th>$column4</th>\n";
                        	print "</tr>\n";

				foreach($data as $key => $element) {
                              		print "<tr>\n";
                              		foreach($element as $item) {
                                      		print "<td>$item</td>\n";
                              		}
                              	print "</tr>\n";
                        	}
				
				print "</table>\n";	
			}
			
			/////////////////////////////////////////////////////
                        //Function name: main
                        //Description: Executes every function to complete the assignment
                        //Parameters: None
                        //Return Value: None, prints out html table properties to be used for the site
                        /////////////////////////////////////////////////////	
			function main() {
				$data = getData("animals.csv");
                        	$data = cleanData($data);
	                        makeTable($data);
			}

			main();

			/* TODO: PHP code to generate an HTML table from the file "animals.csv" */
		?>
	</body>
</html>
