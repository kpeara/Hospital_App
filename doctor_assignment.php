<?php
include("validLicenceNo.php");
include("validOHIP.php");
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
<h1>Doctors Assigned to Patients</h1>
<table>
<?php

include("dbconnect.php");

if (isset($_POST["stop_treatment"])) {
    $licence_no = $_POST["licenceno"];
    $ohip = $_POST["ohip"];

    echo $licence_no . $ohip;
    $query = "DELETE FROM Treats WHERE Doctor_Licence_No = '$licence_no' AND Patient_OHIP = '$ohip';";
    $result = mysqli_query($connection, $query);
}

// check if patient and doctor exist
// dont forget to alert user if they are entering in a duplicate (patient doctor pair that already exists)
else if (isset($_POST["start_treatment"]) && validOHIP($_POST["ohip"]) && validLicenceNo($_POST["licenceno"])) {
    echo "start treatment";
}

$query = "SELECT D.First_Name, D.Last_Name FROM Doctor D LEFT JOIN Treats T ON D.Licence_No = T.Doctor_Licence_No WHERE T.Doctor_Licence_No IS NULL;";
$query = "SELECT Doctor_Licence_No, Doctor.First_Name AS Doctor_First_Name, Doctor.Last_Name AS Doctor_Last_Name, Patient_OHIP, Patient.First_Name AS Patient_First_Name, Patient.Last_Name AS Patient_Last_Name FROM Treats JOIN Patient ON Patient_OHIP = OHIP_No JOIN Doctor ON Licence_No = Doctor_Licence_No;";
$result = mysqli_query($connection, $query);

if (!(mysqli_num_rows($result) == 0)) {
?>
    <tr style="background-color: lightblue;">
        <th>Doctor Licence No.</th>
        <th>Doctor First Name</th>
        <th>Doctor Last Name</th>
        <th>Patient OHIP</th>
        <th>Patient Last Name</th>
        <th>Patient Last Name</th>
        <th>Stop Treatment</th>
    </tr>
<?php
    while($row=mysqli_fetch_assoc($result)) {
?>
	<tr>
	    <th><?php echo $row["Doctor_Licence_No"] ?></th>
	    <th><?php echo $row["Doctor_First_Name"] ?></th>
	    <th><?php echo $row["Doctor_Last_Name"] ?></th>
	    <th><?php echo $row["Patient_OHIP"] ?></th>
	    <th><?php echo $row["Patient_First_Name"] ?></th>
	    <th><?php echo $row["Patient_Last_Name"] ?></th>
	    <th>
	    <form action="doctor_assignment.php" method="POST">
	        <input type="hidden" name="licenceno" value="<?php echo $row["Doctor_Licence_No"] ?>">
	        <input type="hidden" name="ohip" value="<?php echo $row["Patient_OHIP"] ?>">
	        <input type="submit" name="stop_treatment" value="stop">
	    </form>
	    </th>
	</tr>
<?php
    }
    mysqli_free_result($result);
}
mysqli_close($connection);

?>
</table>

<br>
<h4>Assign a Doctor to Treat a Patient</h4>
<table>
<tr>
<th>
<form action="doctor_assignment.php" method="POST">
    Doctor Licence_No: <input type="text" name="licenceno">
    &nbsp;&nbsp;&nbsp;Patient OHIP: <input type="text" name="ohip">
    &nbsp;&nbsp;&nbsp;<input type="submit" name="start_treatment" value="start treatment">
</form>
</th>
</tr>
</table>
</body>
</html>
