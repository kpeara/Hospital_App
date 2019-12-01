<?php
// function that checks if OHIP is a 9 digit number

function validOHIP($ohip) {

    // use regex to check if all input is numeric and of length 9
    if (!preg_match('/^\d\d\d\d\d\d\d\d\d$/', $ohip)) {
    	echo "<p style='color: red;'>" . "<b>Error: OHIP Must be a 9 digit Integer</b>" . "</p>";
        return False; // if 9 digit number
    }
    else return True;
}
?>
