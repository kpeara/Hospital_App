<?php
function verifyDate($date, $add_doctor='') {

    if (!preg_match('/^\d\d\d\d-\d\d-\d\d$/', $date)) {
	echo "<p style='color: red;'>" . "<b>Error: Invalid Date</b>" . "</p>";
	return False;
    }

    $date_array = explode('-', $date);

    if (!empty($add_doctor)) { // if adding a doctor check their licence date is not above current year
        if ($date_array[0] > gmdate("Y")){
    	echo "<p style='color: red;'>" . "<b>Error: Invalid Date</b>" . "</p>";
    	return False;
        }
    }

    if ($date_array[1] > 12) return False;
    if ($date_array[2] > 31) return False;
    return True;
}
?>
