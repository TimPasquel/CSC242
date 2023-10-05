<?php
//Name:Tim Pasquel
//Major:Information Technology
//Creation Date: 9/15/2022
//Due Date: 9/22/2022
//Course:CSC242
//Professor Name:Dr. Schwesinger
//Assignment Number:Assignment 2
//Filename:project2.php
//Purpose: To determine if an arbitrary account number is vaild through doubling every other number
//starting at the last number, summing the digits together, and then taking the modula 10 and seeing if the
//remainder is 0 

/////////////////////////////////////////////////////
//Function name: toDigits
//Description: Takes an integer as input and returns an array of digits
//Parameters: int - an account number
//Return Value: array - the array of digits in the account number
/////////////////////////////////////////////////////

//https://www.php.net/manual/en/function.str-split.php
//str_split() : splits the string into individual elements to be used in an array 

function toDigits($number) {
	$array = str_split($number);
	return $array;
}

/////////////////////////////////////////////////////
//Function name: doubleEveryOther
//Description: Takes an array and starting from the last element, doubles every other number
//Parameters: array - values of the account number
//Return Value: array - changed values of the account number
/////////////////////////////////////////////////////

function doubleEveryOther($array) {
	$new_array = array_reverse($array);
	
	foreach($new_array as $key => &$value) {
		if(!($key % 2 === 0)) {
			$value = $value * 2;
			}
		}
	return array_reverse($new_array);
	}

/////////////////////////////////////////////////////
//Function name: sumDigits
//Description: Goes through every element in the array and adds each element to sum to sum up all the elements
//Parameters: An array of integers
//Return Value: int - the sum of all values in the array
/////////////////////////////////////////////////////

//https://www.php.net/manual/en/function.array-sum.php
//array_sum() - takes the array and sums all the values in it 

function sumDigits($new_array) {
	$sum = 0;
	foreach($new_array as $element) {
		$sum += array_sum(toDigits($element)); //if double digits splits it to 2 elements and sums that array
	}
	return $sum;
}

/////////////////////////////////////////////////////
//Function name: validate
//Description: takes an account number and returns true if the account number
//meets the critiria of a valid account number
//Parameters: int - an account number
//Return Value: bool - whether the account number is valid (true) or invalid (false)
/////////////////////////////////////////////////////

function validate($account_number) {
	$validation = false;
	
	$array_account = toDigits($account_number);                             //converts to array of digits
	
	$array_account_double = doubleEveryOther($array_account);               //converts org. array to an array that doubles every other
	
	if(sumDigits($array_account_double) % 10 === 0) {                        //Checks to see if the array is % 10
		$validation = true;
	}
	else {
		$validation = false;
	}

	return $validation;
}

function main() {
    $input = readline("Enter an account number: ");
    $acct_num = filter_var($input, FILTER_VALIDATE_INT);

    if ($acct_num) {
        print validate($acct_num) ? "Valid\n" : "Invalid\n";
    }
    else {
        print "ERROR: input is not an integer\n";
    }
}

main();

?>
