<?php
function verifyDate($date) {

    if (!preg_match('/^\d\d\d\d-\d\d-\d\d$/', $date)) return False;

    $date_array = explode('-', $date);

    if ($date_array[0] > gmdate("Y")) return False;

    if ($date_array[1] > 12) return False;
    if ($date_array[2] > 31) return False;
    return True;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>HPDR</title>
    <link rel="stylesheet" type="text/css" href="css/styles.css"/>
</head>
<body>
<?php include("templates/header.php"); ?>
<div class="content">
<h1>Doctor Search</h1>
<table>
<?php

include("dbconnect.php");

if (isset($_GET["search_doctor"]) && verifyDate($_GET["date"])) {

    $date = $_GET["date"];

    $query = "SELECT * FROM Doctor WHERE Licence_Date > '$date'";
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
    mysqli_free_result($result);
}
else if (isset($_GET["date"])) {
   echo "<p style='color: red;'>" . "<b>Error: Invalid Date</b>" . "</p>";
}

mysqli_close($connection);
?>

</table>
<br>
<form action="doctor_search.php" method="GET">
    <div>
        <h4>Search by Doctors who were licenced before a given date:</h4>
	[yyyy-mm-dd]
	<input type="text" name="date">
	<input type="submit" name="search_doctor">
    </div>
</form>
</body>
</html>