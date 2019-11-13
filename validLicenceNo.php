<?php
function validLicenceNo($licenceno) {

    echo $licence_no;
    echo strlen($licence_no);
    if (strlen($licence_no) == 4) { // if licence no is not proper length
	echo "<p style='color: red;'>" . "<b>Error: Licence No. must have a length of 4</b>" . "</p>";
	return False;
    }
    if (!preg_match('/[a-zA-Z0-9][a-zA-Z0-9][a-zA-Z0-9][a-zA-Z0-9]/', $licenceno)) {
	echo "<p style='color: red;'>" . "<b>Error: Licence Number must have 4 alphanumerics</b>" . "</p>";
	return False;
    }
    return True;
}
?>
