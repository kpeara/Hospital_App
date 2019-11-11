
<!DOCTYPE html>
<html>
<head>
<title>HPDR</title>
<link rel="stylesheet" type="text/css" href="styles.css"/>
</head>
<body>
<?php include("templates/header.php"); ?>
<div class="content">
<table>
<?php

include("dbconnect.php");

if (isset($_GET['firstname']) && isset($_GET['lastname'])) {
    $firstname =  $_GET['firstname'];
    $lastname =  $_GET['lastname'];
    echo $firstname;
    echo $lastname;

    $query = "SELECT * FROM Doctor WHERE First_Name=$firstname AND Last_Name=$lastname;";

    $result = mysqli_query($connection, $query);
    echo mysqli_fetch_assoc($result);

    /*while($row=mysqli_fetch_assoc($result)) {
//    	echo $result;
    }*/

}
/*
else show 403
*/

?>
</table>
</div>
