<?php
//Name:Tim Pasquel
//Major:Information Technology
//Creation Date: 9/24/2022
//Due Date: 9/29/2022
//Course:CSC242
//Professor Name:Dr. Schwesinger
//Assignment Number:Assignment 3
//Filename:project3.php
//Purpose: To take an input file, convert the file into the desire contents, output the file to a different file

/////////////////////////////////////////////////////
//Function name: FiletoArray
//Description: Takes a file name, gets the file contents, takes each line and makes it an element in the array
//Parameters: string - the file name
//Return Value: array - the array of each line in the file
/////////////////////////////////////////////////////

//https://stackoverflow.com/questions/591094/how-do-you-reindex-an-array-in-php-but-with-indexes-starting-from-1
//array_combine((range(1, count($data)), array_values($data)) : converts the array index to start with 1

function FiletoArray($fname) {
	$contents = file_get_contents($fname);
	$data = explode("\n", $contents);
	$out = array_pop($data);
	$data = array_combine(range(1, count($data)), array_values($data));
	return $data;	
}

/////////////////////////////////////////////////////
//Function name: countAnimals
//Description: Takes an array, using every 4 values, adds up these digits at this placement
//Parameters: array - the lines of the file
//Return Value: array - the lines of the file with every 4th value summed up
/////////////////////////////////////////////////////

function countAnimals($contents) {
	for($i = 4; $i <= count($contents); $i+=4) {
		$contents[$i] = explode(" ", $contents[$i]);
		$contents[$i] = array_sum($contents[$i]);
		}
	return $contents;
}

/////////////////////////////////////////////////////
//Function name:sorting
//Description: Takes an array, finds the difference between the elements and uses this to sort the outer array
//Parameters: array $a - one of the animal arrays, array $b one of the animal arrays
//Return Value: The difference of the two array differences
/////////////////////////////////////////////////////

//https://stackoverflow.com/questions/2699086/how-to-sort-a-multi-dimensional-array-by-value
//The difference from these two arrays helps sort the outer array

function sorting($a, $b) {
    return $a[3] - $b[3];
}

/////////////////////////////////////////////////////
//Function name: sortAnimals
//Description: Takes and array with the file contents, every 4 elements the outer array is appended with this array
//of 4 elements/characteristics
//Parameters: array - the lines of the file
//Return Value: 2D array - An array of arrays in which the arrays are each individual characteristics of each animal
/////////////////////////////////////////////////////

function sortAnimals($contents) {
	$line = array();
	$big_data = array();

	for($i = 1; $i <= count($contents); $i++) {
		$line[] = $contents[$i];

		if($i % 4 === 0) {
                        $big_data[] = $line;
                       	$line = array();
                	}
	}
	usort($big_data, "sorting");		//sorts the 2D array using the function defined earlier
	return array_reverse($big_data);
}

/////////////////////////////////////////////////////
//Function name: writeFile
//Description: Takes a 2D array, loops through it, prints out each individual arrays contents on a formated line
//Parameters: 2D array $big_data - An array of arrays in which the arrays are each individual characteristics of
//each animal, string $filename - the name of the file to be written
//Return Value: None, file is writen
/////////////////////////////////////////////////////

function writeFile($big_data, $filename) {
	$fout = fopen($filename, "w");
	
	fwrite($fout, "Animal,Class,Status,Total\n");
	for($i = 0; $i < count($big_data); $i++) {
		fwrite($fout, ($big_data[$i][0] . ", " . $big_data[$i][1] . ", " . $big_data[$i][2] . ", " . $big_data[$i][3] . "\n"));
	}
	
	fclose($fout);
}

function main() {
    $fin = readline("Enter input filename: ");
    $fout = readline("Enter output filename: ");
    if (file_exists($fin)) {
	$contents = FiletoArray($fin);		//Puts the file contents into an array to work with
	
	$contents = countAnimals($contents);	//Counts and totals the number of animals
	
	$big_data = sortAnimals($contents);	//sorts the array into a 2d array with each sub array being an animal

	writeFile($big_data, $fout);		//Writes the contents to desired file

        print "SUCCESS: file $fout written\n";
    }
    else {
        print "ERROR: file does not exist\n";
    }
}

main();

?>
