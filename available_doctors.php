<!DOCTYPE html>
<html>
<head>
    <title>HPDR</title>
    <link rel="stylesheet" type="text/css" href="css/styles.css"/>
</head>
<body>
<?php include("templates/header.php"); ?>
<div class="content">
<h1>Available Doctors</h1>
<table>
<?php

include("dbconnect.php");

$query = "SELECT D.First_Name, D.Last_Name FROM Doctor D LEFT JOIN Treats T ON D.Licence_No = T.Doctor_Licence_No WHERE T.Doctor_Licence_No IS NULL;";
$result = mysqli_query($connection, $query);

if (!(mysqli_num_rows($result) == 0)) {
?>
    <tr style="background-color: lightblue;">
        <th>First Name</th>
        <th>Last Name</th>
    </tr>
<?php
    while($row=mysqli_fetch_assoc($result)) {
?>
	<tr>
	    <th><?php echo $row["First_Name"] ?></th>
	    <th><?php echo $row["Last_Name"] ?></th>
	    </th>
	</tr>
<?php
    }
    mysqli_free_result($result);
}
mysqli_close($connection);

?>
</table>
<h4>These Doctors currently have no patients</h4>
</body>
</html>
