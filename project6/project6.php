<?php
//Name:Tim Pasquel
//Major:Information Technology
//Creation Date: 10/31/2022
//Due Date: 11/4/2022
//Course:CSC242
//Professor Name:Dr. Schwesinger
//Assignment Number:Assignment 6
//Filename:project6.php
//Purpose:Take a file of information on students and process it into proper slq table and insert statements

/////////////////////////////////////////////////////
//Function name: makeData
//Description: Takes the contents from a file and puts them in an array separated into groups of 8 for each student
//Parameters: string - the file name
//Return Value: 2D array - the array of each students characteristics
/////////////////////////////////////////////////////
function makeData($filename) {
        $data = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
	$data = array_chunk($data,8);
	return $data;
}

/////////////////////////////////////////////////////
//Function name: writeFile
//Description: writes the desired table for a student, then writes the formated sql insert statement for each student
//Parameters: $data:2D array - an array of every student and their characteristics, $filename:string - the name of the file
//Return Value: None - writes a file
/////////////////////////////////////////////////////
function writeFile($data, $filename) {
        $fout = fopen($filename, "w");
	
	fwrite($fout, "CREATE TABLE grade_report (\n");
	fwrite($fout, "student_id TEXT,\n");
	fwrite($fout, "last_name TEXT,\n");
	fwrite($fout, "first_name TEXT,\n");
	fwrite($fout, "course TEXT,\n");
	fwrite($fout, "section TEXT,\n");
	fwrite($fout, "category TEXT,\n");
	fwrite($fout, "grade_item INTEGER,\n");
	fwrite($fout, "grade REAL\n");
	fwrite($fout, ");\n");	

	foreach ($data as $element) {	
                fwrite($fout, "INSERT INTO grade_report VALUES ('$element[0]', '$element[1]', '$element[2]', '$element[3]', '$element[4]', '$element[5]', $element[6], $element[7]);\n");
	}
        fclose($fout);
}

/////////////////////////////////////////////////////
//Function name: main
//Description: calls all of the functions to read data from a file, process it, and then write it to another file
//Parameters: None
//Return Value: None - writes a file
/////////////////////////////////////////////////////
function main() {
$data = makeData("grade_report.dat");

writeFile($data, "grade_report.sql");
}

main();

?>
