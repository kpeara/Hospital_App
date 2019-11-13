<?php
include("verifyDate.php");
include("validLicenceNo.php");
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
<h1>Add Doctor</h1>
<?php

include("dbconnect.php");

if (isset($_POST["add_doctor"]) && !empty($_POST["licenceno"]) && !empty($_POST["firstname"]) && !empty($_POST["lastname"]) && !empty($_POST["specialty"]) && !empty($_POST["licencedate"]) && verifyDate($_POST["licencedate"], $_POST["add_doctor"]) && validLicenceNo($_POST["licenceno"])) {
// check if licence number is already in database

    $query = "SELECT Licence_No FROM Doctor;";
    $result = mysqli_query($connection, $query);

    $licence_no = str_replace(' ', '', $_POST["licenceno"]); // removes spaces
    //echo $licence_no;
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $specialty = $_POST["specialty"];
    $licence_date = $_POST["licencedate"];
    $hospital_code = $_POST["hospitalcode"];

    $unique_licence_no = True;
    //$duplicate = False;
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

    // might add to function
    if (strlen($licence_no) < 4) { // if licence no is not proper length
    	$unique_licence_no = False;
	echo "<p style='color: red;'>" . "<b>Error: Licence No. length too short</b>" . "</p>";
    }

    if ($unique_licence_no == True) { // if unique licence number
        $query = "INSERT INTO Doctor VALUES ('$licence_no', '$firstname', '$lastname', '$specialty', '$licence_date', '$hospital_code');";
        $result = mysqli_query($connection, $query);
    }

    if ($result == True) echo "query successful";
    //echo $result;
    //mysqli_free_result($result);

}
mysqli_close($connection);
?>
<form action="add_doctor.php" method="POST">
    <div>
	Licence Number:<input type="text" name="licenceno"><br>
	First Name:<input type="text" name="firstname"><br>
	Last Name:<input type="text" name="lastname"><br>
	Specialty:<input type="text" name="specialty"><br>
	Licence Date:<input type="text" name="licencedate"> (yyyy-mm-dd)<br>
	Hospital:<select name="hospitalcode">
	<?php

	include("dbconnect.php");

	$query = "SELECT * FROM Hospital;";
	$result = mysqli_query($connection, $query);

        while($row=mysqli_fetch_assoc($result)) {
	    echo "<option value='" . $row["Hospital_Code"] . "'>" . $row["Hospital_Name"] . ", " . $row["City"] . " " . $row["Province"] . " (" . $row["Hospital_Code"] . ")" . "</option>";
	}
	mysqli_close($connection);

	?>
	</select>
	<input type="submit" name="add_doctor">
    </div>
</form>
</body>
</html>
