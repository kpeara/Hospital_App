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

if (isset($_POST["add_doctor"]) && !empty($_POST["licenceno"]) && !empty($_POST["firstname"]) && !empty($_POST["lastname"]) && !empty($_POST["specialty"]) && !empty($_POST["licencedate"])) {
// check if licence number is already in database

    $query = "SELECT Licence_No FROM Doctor;";
    $result = mysqli_query($connection, $query);

    $licence_no = str_replace(' ', '', $_POST["licenceno"]); // removes spaces

    $unique_licence_no = True;
    while($row=mysqli_fetch_assoc($result)) {
        if ($row["Licence_No"] == $licence_no) {
	    $unique_licence_no = False;
	    break;
	}
    }

    if ($unique_licence_no == True) {
// if function() is false do this:
    /*
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
    */

    }
}
mysqli_close($connection);
?>
<form action="add_doctor.php" method="POST">
    <div>
	Licence Number:<input type="text" name="licenceno"><br>
	First Name:<input type="text" name="firstname"><br>
	Last Name:<input type="text" name="lastname"><br>
	Specialty:<input type="text" name="specialty"><br>
	Licence Date:<input type="text" name="licencedate"><br>
	Hospital Code:<select name="hospitalname">
	<?php

	include("dbconnect.php");

	$query = "SELECT Hospital_Code FROM Hospital;";
	$result = mysqli_query($connection, $query);

        while($row=mysqli_fetch_assoc($result)) {
	    echo "<option value='" . $row["Hospital_Code"] . "'>" . $row["Hospital_Code"] . "</option>";
	}
	mysqli_close($connection);

	?>
	</select>
	<input type="submit" name="add_doctor">
    </div>
</form>
</body>
</html>
