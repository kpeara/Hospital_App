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

include("dbconnect.php");

if (isset($_POST["yes_delete"]) || (!isset($_POST["yes_delete"]) && isset($_GET["delete_doctor"]))) {
    echo "deleted";
}

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
	<th><a style="color: red;" href="delete_doctor.php?delete_doctor=<?php echo $row["Licence_No"]; ?>">X</a></th>
	</tr>
<?php
    }
mysqli_free_result($result);
}

mysqli_close($connection);
?>
</table>
<h4>To delete a doctor, click on the X beside their respective rows</h4>

<?php

include("dbconnect.php");

if (isset($_GET["delete_doctor"])) {

    $licence_no = $_GET["delete_doctor"];
    //echo $licence_no;

    // checking if they are head
    $query = "SELECT Head_Licence_No FROM Hospital;"; 
    $result = mysqli_query($connection, $query);
    while($row=mysqli_fetch_assoc($result)) {
       if ($row["Head_Licence_No"] == $licence_no) {
           echo "<h5 style='color: red'> Unable to delete, this Doctor is the head of a hospital</h5>";
	   die();
	   // ensure that doctor cannot be deleted....
       }
    }

    // checking if they have patients
    $query = "SELECT Doctor_Licence_No FROM Treats;";
    $result = mysqli_query($connection, $query);

    while($row=mysqli_fetch_assoc($result)) {

        if ($row["Doctor_Licence_No"] == $licence_no) {
	    // do prompt
	    //echo "\nThis Doctor has patients";
?>
	    <h5 style="color: red;">This Doctor is treating patients, are you sure you want to delete them?</h5>
	    <form action="delete_doctor.php" method="POST">
	        <input type="hidden" name="licenceno" value="<?php echo $licence_no ?>">
		<input type="submit" name="yes_delete" value="Yes">
		<input type="submit" name="no_delete" value="No">
	    </form>
<?php
        }
    }
}

?>

</body>
</html>
