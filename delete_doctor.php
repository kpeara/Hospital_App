<!DOCTYPE html>
<html>
<head>
    <title>HPDR</title>
    <link rel="stylesheet" type="text/css" href="css/styles.css"/>
</head>
<body>
<?php include("templates/header.php"); ?>
<div class="content">
<h1>Delete Doctor</h1>
<table>
<?php

include("dbconnect.php");

if (isset($_GET["delete_doctor"])) {

    $licence_no = $_GET["delete_doctor"];
    echo $licence_no;

    // check if they have patients
    // check if they are head

    /*
    $query = "SELECT * FROM Doctor;";
    $result = mysqli_query($connection, $query);
    */
}

$query = "SELECT Licence_No, First_Name, Last_Name FROM Doctor;";
$result = mysqli_query($connection, $query);
    
if (!(mysqli_num_rows($result) == 0)) {
?>
    <tr style="background-color: lightblue;">
        <th>Licence No.</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Delete</th>
    </tr>
<?php
    while($row=mysqli_fetch_assoc($result)) {
?>
	<tr>
	<th><?php echo $row["Licence_No"] ?></th>
	<th><?php echo $row["First_Name"] ?></th>
	<th><?php echo $row["Last_Name"] ?></th>
	<th><a style="color: red;" href="delete_doctor.php?delete_doctor=<?php echo $row["Licence_No"]; ?>">X</a></th>
	</tr>
<?php
    }
mysqli_free_result($result);
}

mysqli_close($connection);
?>
</table>
<h4>To delete a doctor, click on the X beside their respective rows</h4>
</body>
</html>
