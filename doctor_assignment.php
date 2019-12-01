<!-- include functions that check if licence number and ohip number follow proper format -->
<?php
include("validLicenceNo.php");
include("validOHIP.php");
?>

<!-- page that allows the user to assign a doctor to treat a patient or stop a doctor from treating a patient -->
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

include("dbconnect.php"); // start connection

// if user pushes stop treatment button beside a treatment in a table
if (isset($_POST["stop_treatment"])) {
    $licence_no = $_POST["licenceno"];
    $ohip = $_POST["ohip"];

    // stop the treatment
    $query = "DELETE FROM Treats WHERE Doctor_Licence_No = '$licence_no' AND Patient_OHIP = '$ohip';";
    $result = mysqli_query($connection, $query);

    if ($result == True) echo "<p style='color: green;'><b>treatment stopped</b></p>";
}

// check if patient and doctor exist
// dont forget to alert user if they are entering in a duplicate (patient doctor pair that already exists)
else if (isset($_POST["start_treatment"]) && validOHIP($_POST["ohip"]) && validLicenceNo($_POST["licenceno"])) {
    $licence_no = $_POST["licenceno"];
    $ohip = $_POST["ohip"];

    // check if doctor licence number exists
    $query = "SELECT Licence_No FROM Doctor WHERE Licence_No = '$licence_no';";
    $result = mysqli_query($connection, $query);
    if (mysqli_num_rows($result) == 0) {
    	echo "<p style='color: red;'>" . "<b>Error: Licence Number does not exist</b>" . "</p>";
	die();
    }

    // check if ohip exists
    $query = "SELECT OHIP_No FROM Patient WHERE OHIP_No = $ohip;";
    $result = mysqli_query($connection, $query);
    if (mysqli_num_rows($result) == 0) {
    	echo "<p style='color: red;'>" . "<b>Error: OHIP does not exist</b>" . "</p>";
	die();
    }

    // start treatment
    $query = "INSERT INTO Treats VALUES ('$licence_no', $ohip)";
    $result = mysqli_query($connection, $query);

    if ($result == True) echo "<p style='color: green;'><b>treatment started</b></p>";
}

// generate table of patients and doctors that treat said patients with a button that allows the treatment to be stopped
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
<!-- form that allows user to start a treatment for a patient with a given doctor -->
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
