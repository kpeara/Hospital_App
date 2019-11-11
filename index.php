<?php
?>

<!DOCTYPE html>
<html>
<head>
    <title>HPDR</title>
    <link rel="stylesheet" type="text/css" href="styles.css"/>
</head>
<body>
<?php include("templates/header.php"); ?>
<div class="content">
<h1> DOCTORS </h1>
<table>
<tr style="background-color: lightblue;">
    <th>FirstName</th>
    <th>LastName</th>
</tr>
<?php

include("dbconnect.php");

$query = "SELECT First_Name, Last_Name FROM Doctor;";
$result = mysqli_query($connection, $query);

while($row=mysqli_fetch_assoc($result)) {
?>

<tr>
    <th><?php echo $row["First_Name"]; ?></th>
    <th><?php echo $row["Last_Name"]; ?></th>
</tr>

<?php
}

mysqli_free_result($result);
mysqli_close($connection);

?>
</table>

<?php
include("dbconnect.php");
?>
</div>
</body>
</html>
