<?php
// function that checks if the character length for attributes that cannot have a character length over 20 or if the case where the user is entering the specialty of a doctor which cannot be over 30 characters

function validCharLength($string, $isspecialty=0) {
    if ($isspecialty == 1) {
	if (strlen($string) > 30) {
	    echo "<p style='color: red;'>" . "<b>Error: Length of specialty must be less that or equal to 30 characters</b>" . "</p>";
	    return False;
	}
    }
    if (strlen($string) > 20) {
	echo "<p style='color: red;'>" . "<b>Error: Length of names must be less that or equal to 20 characters</b>" . "</p>";
	return False;
    }
    return True;
}

?>
