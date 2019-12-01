<!-- page where user can delete a doctor from a table of doctors by clicking the delete button beside their name -->
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

include("dbconnect.php"); // open connection

if (isset($_POST["delete_doctor"])) {
    $licence_no = $_POST["licenceno"];

    // checking if they are a head doctor
    $query = "SELECT Head_Licence_No FROM Hospital;"; 
    $result = mysqli_query($connection, $query);
    $is_head = False;

    while($row=mysqli_fetch_assoc($result)) {
       if ($row["Head_Licence_No"] == $licence_no) { // if head, don't allow deletion
           echo "<h5 style='color: red'> Unable to delete, this Doctor is the head of a hospital</h5>";
	   $is_head = True;
       }
    }

    if ($is_head == False) {
        $has_patients = False;

        // checking if they have patients
        $query = "SELECT Doctor_Licence_No FROM Treats WHERE Doctor_Licence_No = '$licence_no';";
        $result = mysqli_query($connection, $query);

        if(mysqli_num_rows($result) != 0) { // if not empty result (doctor has patients)
		$has_patients = True;
?>
                <h4 style="color: red;">This Doctor is treating patients, are you sure you want to delete them?</h4>

		<!-- confirm delete form -->
                <form action="delete_doctor.php" method="POST">
                <input type="hidden" name="licenceno" value="<?php echo $licence_no ?>">
            	<input type="submit" name="yes_delete" value="Yes">
            	<input type="submit" name="no_delete" value="No">
                </form>
		<br><br>
<?php 		 
        }
    }
}

// if doctor does not have patients or has patients and delete confirmed by user, proceed to delete doctor
if (isset($_POST["yes_delete"]) || (isset($has_patients) && $has_patients == False)) {

    $query = "DELETE FROM Doctor WHERE Licence_No = '$licence_no';";
    $result = mysqli_query($connection, $query);

    if ($result == True) echo "<p style='color: green;'><b>success</b></p>";
}

// generate table of current doctors to delete from
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
	    <th>
	    <form action="delete_doctor.php" method="POST">
            <input type="hidden" name="licenceno" value="<?php echo $row["Licence_No"] ?>">
	    <input type="submit" name="delete_doctor" value="delete">
	    </form>
	    </th>
	</tr>
<?php
    }
mysqli_free_result($result);
}

mysqli_close($connection); // close connection
?>
</table>
</body>
</html>
