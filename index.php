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
<h3> View Current Doctors </h3>
<table>
<tr style="background-color: lightblue;">
    <th>First Name</th>
    <th>Last Name</th>
</tr>
<?php

include("dbconnect.php");

if (isset($_POST['change_order'])) {

    $query = "SELECT First_Name, Last_Name FROM Doctor";
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
}

?>
</table>
<br>
<form action="index.php" method="POST">
    <div>
        <input type="radio" name="col_order"> Order By First Name
        <br>
        <input type="radio" name="col_order"> Order By Last Name
        <br>
        <input type="radio" name="row_order"> Ascending
        <br>
        <input type="radio" name="row_order"> Descending
        <br>
        <input type="submit" name="define_order">
    </div>
</form>

<?php
include("dbconnect.php");
?>
</div>
</body>
</html>
