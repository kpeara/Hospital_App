<?php
// function that checks if date entered is of the valid format

function verifyDate($date, $add_doctor='') {

    // if date not in the format YYY-MM-DD
    if (!preg_match('/^\d\d\d\d-\d\d-\d\d$/', $date)) {
	echo "<p style='color: red;'>" . "<b>Error: Invalid Date</b>" . "</p>";
	return False;
    }

    // check if individual parts of date are valid
    $date_array = explode('-', $date);

    if (!empty($add_doctor)) { // if adding a doctor, check if their licence date is not above current year
        if ($date_array[0] > gmdate("Y")){
    	echo "<p style='color: red;'>" . "<b>Error: Invalid Date</b>" . "</p>";
    	return False;
        }
    }

    if ($date_array[1] > 12) return False; // if month is greater than 12, then invalid date
    if ($date_array[2] > 31) return False; // if date is greater than 31, invalid date
    return True;
}
?>
