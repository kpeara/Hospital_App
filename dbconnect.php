<!-- Connecting to the database. -->
<?php
$dbhost = "localhost";
$dbuser= "root";
$dbpass = "rua1ora0";
$dbname = "kperathassign2db";

$connection = @mysqli_connect($dbhost, $dbuser,$dbpass,$dbname);

// if connection fails
if (mysqli_connect_errno()) {
     die("database connection failed :" .
     mysqli_connect_error() .
     "(" . mysqli_connect_errno() . ")"
         );
    }
?>
