
<!DOCTYPE html>
<html>
<head>
    <title>HPDR</title>
    <link rel="stylesheet" type="text/css" href="css/styles.css"/>
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

    echo "<h1>Dr. " . $firstname . " " . $lastname . "</h1>";

    $query = "SELECT Licence_No, First_Name, Last_Name, Specialty, Licence_Date, Hospital_Name, Doctor.Hospital_Code FROM Doctor, Hospital WHERE First_Name='$firstname' AND Last_Name='$lastname' AND Doctor.Hospital_Code = Hospital.Hospital_Code;";
    // if query failed condition

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
            <th>Hospital Name</th>
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
            <th><?php echo $row["Hospital_Name"] ?></th>
        </tr>

<?php 
        }
    mysqli_free_result($result);

    }
    else {
	echo "<p style='color: red;'>" . "<b>Error: Doctor Not Found</b>" . "</p>";
    }

}

mysqli_close($connection);
?>
</table>
</div>
</body>
</html>
