<?php
// Dr. Schwesinger Functions, CSC 242, Fall 2022, 9

/* Function Name: insertUserRecord
 * Description: insert user information into the database
 * Parameters: (string) $name: the user's name
 *             (string) $email: the user's email
 *             (string) $dob: the user's date of birth
 *             (string) $password: the user's password
 * Return Value: (boolean) TRUE if the information was successfully inserted,
 *               otherwise FALSE
 */
function insertUserRecord($name, $email, $dob, $password) {

    // try to insert into the database
    // if an error occurs return FALSE
    try {
        $db =  new PDO("sqlite:user.db");
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO user VALUES (?, ?, ?, ?)";
        $stmt = $db->prepare($sql);
        $stmt->execute([$name, $email, $dob, $password]);
	$db = null;
        return TRUE;
    }
    catch (Exception $e) {
        //print "<p>$e</p>";
        return FALSE;
    }
}

/* Function Name: getUserRecord
 * Description: get user information from the database
 * Parameters: (string) $email: the user's email
 *             (string) $password: the user's password
 * Return Value: (array) The user's record if it exists, otherwise an empty
 *               array
 */
function getUserRecord($email, $password) {

    // try to insert into the database
    // if an error occurs return FALSE
    try {
        $db =  new PDO("sqlite:user.db");
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM user WHERE Email=? and Password=?";
        $stmt = $db->prepare($sql);
        $stmt->execute([$email, $password]);
        // there should only be a single record
	$db = null;
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    catch (Exception $e) {
        //print "<p>$e</p>";
        return array();
    }
}
/* Function Name: printTable
 * Description: prints a table based on the data that is inputed 
 * Parameters: (Array) $data: an array of sql data objects
 * Return Value: NA - HTML output of a table
 */
function printTable($data) {
    if (count($data) === 0) {
        return;
    }
    $header = array_keys($data[0]);
    print "<table>\n";
    print "<tr>";
    foreach ($header as $h) {
        print "<th>$h</th>";
    }
    print "</tr>\n";
    foreach ($data as $record) {
        $values = array_values($record);
        print "<tr>";
        foreach ($values as $v) {
            print "<td>$v</td>";
        }
        print "</tr>\n";
    }
    print "</table>";
}
/* Function Name: printFormTable
 * Description: prints a table with check boxes based on the data that is inputed
 * Parameters: (Array) $data: an array of sql data objects
 * Return Value: NA - HTML output of a checkable table
 */
function printFormTable($data) {
    if (count($data) === 0) {
        return;
    }
    $header = array_keys($data[0]);
    print "<table>\n";
    print "<tr>";
    print "<th>Select</th>";
    foreach ($header as $h) {
        print "<th>$h</th>";
    }
    print "</tr>\n";
    foreach ($data as $record) {
        $values = array_values($record);
        $form_value = implode(',', $values);
        print "<tr>";
        print "<td><input type=\"checkbox\" name=\"rows[]\" value=\"$form_value\"></td>";
        foreach ($values as $v) {
            print "<td>$v</td>";
        }
        print "</tr>\n";
    }
    print "</table>";
}
//------------------------------------------------------------------------------//
//Tim Pasquel Functions 

/* Function Name: insertEvent
 * Description: inserts a users event into the events database
 * Parameters: (string) $title: title of the event
 *             (string) $location: location of the event
	       (string) $host: host of the event
	       (string) $date: date of the event
	       (string) $time: time of the event
	       (string) $poster: name of the person who posted the event
	       (string) $id: Id tag user created for the event they want
 * Return Value: (Bool) True if inserting the event was successful, false otherwise
 */
function insertEvent($title, $location, $host, $date, $time, $poster, $id) {	
    // try to insert into the database
    // if an error occurs return FALSE
    try {
        $db =  new PDO("sqlite:local_events.db");
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO events VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $db->prepare($sql);
        $stmt->execute([$title, $location, $host, $date, $time, $poster, $id]);
	$db = null;
        return TRUE;
    }
    catch (Exception $e) {
        //print "<p>$e</p>";
        return FALSE;
    }	
}
/* Function Name: deleteUser
 * Description: takes the paramaters and deletes the user from the user database if they exsist
 * Parameters: (string) $name: Name of the user
 *             (string) $email: Email of the user
 *             (string) $dob: Date of birth of the user
 *             (string) $password: Password of the user
 * Return Value: (Bool) True if deleting the user was successful, false otherwise
 */
function deleteUser($name, $email, $dob, $password) {
    try {
        $db =  new PDO("sqlite:user.db");
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "DELETE FROM user WHERE Name = ? and Email = ? and Dob = ? and Password = ?";
        $stmt = $db->prepare($sql);
        $stmt->execute([$name, $email, $dob, $password]);
	$db = null;
        return TRUE;
    }
    catch (Exception $e) {
        //print "<p>$e</p>";
        return FALSE;
    }
}
/* Function Name: editPassword
 * Description: Searches the user database using the name paramater and changes their password to the new 
 * password in the password parameter 
 * Parameters: (string) $name: Name of the user
 *             (string) $password: New password for the user
 * Return Value: (Bool) True if editing the users password was successful, false otherwise
 */
function editPassword($name, $password) {
	try {
		$db =  new PDO("sqlite:user.db");
         	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        	$sql = "UPDATE user SET Password = ? WHERE Name = ?";
        	$stmt = $db->prepare($sql);
        	$stmt->execute([$password, $name]);
		$db = null;
         	return TRUE;
	}
	catch (Exception $e) {
        	//print "<p>$e</p>";
         	return FALSE;
     	}	
}
/* Function Name: deleteAllUserEvents
 * Description: deletes all of the events that a user has in the local events database
 * Parameters: (string) $name: Name of the user
 * Return Value: (Bool) True if deleting all user events was successful, false otherwise
 */
function deleteAllUserEvents($email) {
        try {
                $db =  new PDO("sqlite:local_events.db");
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql = "DELETE FROM events WHERE Poster = ?";
                $stmt = $db->prepare($sql);
                $stmt->execute([$email]);
		$db = null;
                return TRUE;
        }
        catch (Exception $e) {
                //print "<p>$e</p>";
                return FALSE;
        }
}
/* Function Name: deleteEvents
 * Description: deletes all of the events that are in the array of arrays from the local events data base
 * Parameters: (Array) $items: An array of arrays that holds the event information
 * Return Value: (Bool) True if deleting events was successful, false otherwise
 */
function deleteEvents($items) {
	try {
		$db =  new PDO("sqlite:local_events.db");
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		foreach($items as $element) {
                	$Title = $element[0];
                	$Location = $element[1];
                	$Host = $element[2];
                	$Date = $element[3];
                	$Time = $element[4];
                	$Poster = $element[5];
			$Id = $element[6];

                	$sql = "DELETE FROM events WHERE Title = :title and Location = :location and Host = :host and Date = :date and Time = :time and Poster = :poster and Id = :id";
                	$stmt = $db->prepare($sql);
                	$stmt ->execute([
                        	':title' => $Title,
                        	':location' => $Location,
                        	':host' => $Host,
                        	':date' => $Date,
                        	':time' => $Time,
                        	':poster' => $Poster,
				':id' => $Id]);
       	        }
		$db = null;
		return TRUE;
	}
	catch (Exception $e) {
		//print "<p>$e</p>";
		return FALSE;
	}
}
/* Function Name: changeTime
 * Description: changes the time of the events that are in the array of arrays of the items variable
 * Parameters: (Array) $items: An array of arrays that holds the event information
	       (String) $Time: The new time of the selected events
 * Return Value: (Bool) True if changing event times was successful, false otherwise
 */
function changeTime($items, $Time) {
        try {
                $db =  new PDO("sqlite:local_events.db");
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                foreach($items as $element) {
                        $Title = $element[0];
                        $Location = $element[1];
                        $Host = $element[2];
                        $Date = $element[3];
                        $Poster = $element[5];
			$Id = $element[6];

                        $sql = "UPDATE events SET Time = :time WHERE Title = :title and Location = :location and Host = :host and Date = :date and Poster = :poster and Id = :id";
                        $stmt = $db->prepare($sql);
                        $stmt ->execute([
                                ':title' => $Title,
                                ':location' => $Location,
                                ':host' => $Host,
                                ':date' => $Date,
                                ':time' => $Time,
                                ':poster' => $Poster,
				':id' => $Id]);
                }
                $db = null;
                return TRUE;
        }
        catch (Exception $e) {
                //print "<p>$e</p>";
                return FALSE;
        }
}
/* Function Name: searchEvents
 * Description: Takes a category and a term and searches for the desired events based on these parameters
 * Parameters: (String) $category: A string of the desired category
               (String) $term: A string of the desired term
 * Return Value: (Bool) True if seaching events was successful, false otherwise
 */
function searchEvents($category, $term) {
	try {
		$db = new PDO("sqlite:local_events.db");
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        	if($category === "Title") {
                	$Title = $term;
                	$sql = "SELECT * FROM events WHERE Title = :title order by Poster asc";
                	$stmt = $db->prepare($sql);
                	$stmt ->execute([
                        	':title' => $Title]);
        	}
        	else if($category === "Location") {
                	$Location = $term;
                	$sql = "SELECT * FROM events WHERE Location = :location order by Poster asc";
                	$stmt = $db->prepare($sql);
                	$stmt ->execute([
                        	':location' => $Location]);
        	}
        	else if($category === "Host") {
                	$Host = $term;
                	$sql = "SELECT * FROM events WHERE Host = :host order by Poster asc";
                	$stmt = $db->prepare($sql);
                	$stmt ->execute([
                        	':host' => $Host]);
        	}
        	else if($category === "Date") {
                	$Date = $term;
                	$sql = "SELECT * FROM events WHERE Date = :date order by Poster asc";
                	$stmt = $db->prepare($sql);
                	$stmt ->execute([
                        	':date' => $Date]);
        	}
        	else if($category === "Time") {
                	$Time = $term;
                	$sql = "SELECT * FROM events WHERE Time = :time order by Poster asc";
                	$stmt = $db->prepare($sql);
                	$stmt ->execute([
                        	':time' => $Time]);
        	}
        	else if($category === "Poster") {
                	$Poster = $term;
                	$sql = "SELECT * FROM events WHERE Poster = :poster order by Poster asc";
                	$stmt = $db->prepare($sql);
                	$stmt ->execute([
                        	':poster' => $Poster]);
        	}
		else if($category === "Id") {
                        $Id = $term;
                        $sql = "SELECT * FROM events WHERE Id = :id order by Poster asc";
                        $stmt = $db->prepare($sql);
                        $stmt ->execute([
                                ':id' => $Id]);
		}
        	print "<h2>Events where $category = $term</h2>";
        	$records = $stmt->fetchall(PDO::FETCH_ASSOC);
        	printTable($records);
		$db = null;
		return True;		
	}
	catch (Exception $e) {
                //print "<p>$e</p>";
                return FALSE;
        }
}
?>
