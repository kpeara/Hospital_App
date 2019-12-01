<!-- include functions to verify date, check if licence number is valid and check if character length input fits the database specifications -->
<?php
include("verifyDate.php");
include("validLicenceNo.php");
include("validCharLength.php");
?>

<!-- page where user can add doctor to system -->
<!DOCTYPE html>
<html>
<head>
    <title>HPDR</title>
    <link rel="stylesheet" type="text/css" href="css/styles.css"/>
</head>
<body>
<?php include("templates/header.php"); ?>
<div class="content">
<h1>Add Doctor</h1>
<?php

include("dbconnect.php"); // start connection

if (isset($_POST["add_doctor"]) && !empty($_POST["licenceno"]) && !empty($_POST["firstname"]) && !empty($_POST["lastname"]) && !empty($_POST["specialty"]) && !empty($_POST["licencedate"]) && verifyDate($_POST["licencedate"], $_POST["add_doctor"]) && validLicenceNo($_POST["licenceno"])) {
// check if licence number is already in database

    $query = "SELECT Licence_No FROM Doctor;";
    $result = mysqli_query($connection, $query);

    $licence_no = str_replace(' ', '', $_POST["licenceno"]); // removes spaces
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $specialty = $_POST["specialty"];
    $licence_date = $_POST["licencedate"];
    $hospital_code = $_POST["hospitalcode"];

    $unique_licence_no = True;
    while($row=mysqli_fetch_assoc($result)) {
        if ($row["Licence_No"] == $licence_no) {
	    $unique_licence_no = False;
	    echo "<p style='color: red;'>" . "<b>Error: Licence No. Already exists in system</b>" . "</p>";
	    $duplicate = True;
	    die();
	    break;
	}
    }
    mysqli_free_result($result);

    if (strlen($licence_no) < 4) { // if licence number is not proper length
    	$unique_licence_no = False;
	echo "<p style='color: red;'>" . "<b>Error: Licence No. length too short</b>" . "</p>";
    }

    if ($unique_licence_no == True) { // if unique licence number

	if (validCharLength($firstname) && validCharLength($lastname) && validCharLength($specialty, 1)) {
	    // if first name, last name and specialty are the valid character lengths
	    // then insert doctor into system
            $query = "INSERT INTO Doctor VALUES ('$licence_no', '$firstname', '$lastname', '$specialty', '$licence_date', '$hospital_code');";
            $result = mysqli_query($connection, $query);
	}
    }

    if ($result == True) echo "<p style='color: green;'><b>success</b></p>"; // print success message to screen

}
mysqli_close($connection); // close connection
?>
<!-- submit form that adds doctor to system-->
<form action="add_doctor.php" method="POST">
    <div>
	Licence Number:<input type="text" name="licenceno"><br>
	First Name:<input type="text" name="firstname"><br>
	Last Name:<input type="text" name="lastname"><br>
	Specialty:<input type="text" name="specialty"><br>
	Licence Date:<input type="text" name="licencedate"> (yyyy-mm-dd)<br>
	Hospital:<select name="hospitalcode">
	<?php

	include("dbconnect.php"); // start connection

	// make doctor select one of the hospitals by including a drop down menu to select from
	$query = "SELECT * FROM Hospital;";
	$result = mysqli_query($connection, $query);

        while($row=mysqli_fetch_assoc($result)) {
	    echo "<option value='" . $row["Hospital_Code"] . "'>" . $row["Hospital_Name"] . ", " . $row["City"] . " " . $row["Province"] . " (" . $row["Hospital_Code"] . ")" . "</option>";
	}
	mysqli_close($connection); // close connection

	?>
	</select>
	<input type="submit" name="add_doctor">
    </div>
</form>
</body>
</html>
