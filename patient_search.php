<?php
function validOHIP($ohip) {

    if (!preg_match('/^\d\d\d\d\d\d\d\d\d$/', $ohip)) return False; // if 9 digit number
    else return True;
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

if (isset($_GET["search_doctor"]) && validOHIP($_GET["ohip"])) {

    $ohip = $_GET["ohip"];

    $query = "SELECT * FROM Patient;";
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
else if (isset($_GET["ohip"])) {
   echo "<p style='color: red;'>" . "<b>Error: Invalid OHIP</b>" . "</p>";
}

mysqli_close($connection);
?>

</table>
<br>
<form action="patient_search.php" method="GET">
    <div>
        <h4>Search Patient by OHIP Number:</h4>
	<input type="text" name="ohip">
	<input type="submit" name="search_doctor" value="search">
    </div>
</form>
</body>
</html>
