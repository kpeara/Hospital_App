<?php
function validOHIP($ohip) {

    if (!preg_match('/^\d\d\d\d\d\d\d\d\d$/', $ohip)) return False; // if 9 digit number
    else return True;
}
?>
