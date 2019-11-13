<?php

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
