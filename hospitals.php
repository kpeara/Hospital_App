<!DOCTYPE html>
<html>
<head>
    <title>HPDR</title>
    <link rel="stylesheet" type="text/css" href="css/styles.css"/>
</head>
<body>
<?php include("templates/header.php"); ?>
<div class="content">
<h1>View Doctors</h1>
<table>
<?php

include("dbconnect.php");

$query = "SELECT * FROM Doctor;";
$result = mysqli_query($connection, $query);

if (!(mysqli_num_rows($result) == 0)) {
?>
    <tr style="background-color: lightblue;">
        <th>Licence No.</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Specialty</th>
        <th>Licence Date</th>
        <th>Hospital Code</th>
    </tr>
    
<?php
    while($row=mysqli_fetch_assoc($result)) {
?>
    <tr>
        <th><?php echo $row["Licence_No"] ?></th>
        <th><?php echo $row["First_Name"] ?></th>
        <th><?php echo $row["Last_Name"] ?></th>
        <th><?php echo $row["Specialty"] ?></th>
        <th><?php echo $row["Licence_Date"] ?></th>
        <th><?php echo $row["Hospital_Code"] ?></th>
    </tr>
<?php
    }
}
?>
</body>
</html>
