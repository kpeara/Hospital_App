<?php
function verifyDate($date) {

    if (!preg_match('/^\d\d\d\d-\d\d-\d\d$/', $date)) return False;

    $date_array = explode('-', $date);

    if ($date_array[1] > 12) return False;
    if ($date_array[2] > 31) return False;
    return True;
}
?>
