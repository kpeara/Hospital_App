<?php
// function that checks if licence has a size of 4 characters and are alphanumberic

function validLicenceNo($licence_no) {
    $licence_no = str_replace(' ', '', $licence_no);

    if (strlen($licence_no) != 4) { // if licence no is not proper length
	echo "<p style='color: red;'>" . "<b>Error: Licence No. must have a length of 4</b>" . "</p>";
	return False;
    }

    // use regex to check if alpha numeric of size 4
    if (!preg_match('/[a-zA-Z0-9][a-zA-Z0-9][a-zA-Z0-9][a-zA-Z0-9]/', $licence_no)) {
	echo "<p style='color: red;'>" . "<b>Error: Licence Number must have 4 alphanumerics</b>" . "</p>";
	return False;
    }
    return True;
}
?>
