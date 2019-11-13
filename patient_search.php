<?php include("validOHIP.php"); ?>

<!DOCTYPE html>
<html>
<head>
    <title>HPDR</title>
    <link rel="stylesheet" type="text/css" href="css/styles.css"/>
</head>
<body>
<?php include("templates/header.php"); ?>
<div class="content">
<h1>Patient Search</h1>
<table>
<?php

include("dbconnect.php");

if (isset($_GET["search_doctor"]) && validOHIP($_GET["ohip"])) {

    $ohip = $_GET["ohip"];

    $query = "SELECT OHIP_No FROM Patient;";
    $result = mysqli_query($connection, $query);
    $ohip_exists = False;

    while ($row=mysqli_fetch_assoc($result)) {

    	if ($row["OHIP_No"] == $ohip) {
	    $ohip_exists = True;
	}
    }

    if ($ohip_exists == False) {
       echo "<p style='color: red;'>" . "<b>Error: OHIP Does Not Exist</b>" . "</p>";
    }

    if ($ohip_exists == True) {

        $query = "SELECT P.First_Name, P.Last_Name, D.First_Name AS Doctor_First_Name, D.Last_Name AS Doctor_Last_Name FROM Patient P, Doctor D, Treats T  WHERE P.OHIP_No = T.Patient_OHIP AND D.Licence_No = T.Doctor_Licence_No AND P.OHIP_No = $ohip;";
        $result = mysqli_query($connection, $query);
        
        if (!(mysqli_num_rows($result) == 0)) {
?>
            <tr style="background-color: lightblue;">
                <th>Patient First Name</th>
                <th>Patient Last Name</th>
                <th>Doctor First Name</th>
                <th>Doctor Last Name</th>
            </tr>
            
<?php
            while($row=mysqli_fetch_assoc($result)) {
?>
            <tr>
                <th><?php echo $row["First_Name"] ?></th>
                <th><?php echo $row["Last_Name"] ?></th>
                <th><?php echo $row["Doctor_First_Name"] ?></th>
                <th><?php echo $row["Doctor_Last_Name"] ?></th>
            </tr>
<?php
            }
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
