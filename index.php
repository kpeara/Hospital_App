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
<table>
<?php

include("dbconnect.php");

$query = "SELECT First_Name, Last_Name FROM Doctor;";
$result = mysqli_query($connection, $query);

while($row=mysqli_fetch_assoc($result)) {
	echo "<tr>";
	echo "<th>" . $row["First_Name"] . " " . $row["Last_Name"] . "</th>";
	echo "</tr>";
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
