<?php
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
<h2> View Current Doctors </h2>
<table>
<?php

include("dbconnect.php");

if (isset($_POST["define_order"]) && !empty($_POST["col_order"])) {
    $name = $_POST["col_order"];
    $order = $_POST["row_order"];

    $query = "SELECT First_Name, Last_Name FROM Doctor ORDER BY $name $order";
    $result = mysqli_query($connection, $query);

?>

<tr style="background-color: lightblue;">
    <th>First Name</th>
    <th>Last Name</th>
</tr>

<?php
    while($row=mysqli_fetch_assoc($result)) {
?>
    
    <tr>
        <th><a href="details.php?firstname=<?php echo $row["First_Name"] ?>&lastname=<?php echo $row["Last_Name"] ?>"><?php echo $row["First_Name"]; ?></a></th>
        <th><a href="details.php?firstname=<?php echo $row["First_Name"] ?>&lastname=<?php echo $row["Last_Name"] ?>"><?php echo $row["Last_Name"]; ?></a></th>
    </tr>
    
    <?php
    }
    
    mysqli_free_result($result);
}
else if (isset($_POST["define_order"]) && empty($_POST["col_order"]) && empty($_POST["row_order"])){
   // case where no radio buttons selected
   echo "<p style='color: red;'>" . "<b>Error: No Options Selected</b>" . "</p>";
}
else if (isset($_POST["define_order"]) && empty($_POST["col_order"])){
   echo "<p style='color: red;'>" . "<b>Error: Select Column to Order By</b>" . "</p>";
}

mysqli_close($connection);

?>
</table>
<br>
<form action="index.php" method="POST">
    <div>
        <h4>Order Columns By:</h4>
        <input type="radio" name="col_order" value="First_Name"> Order By First Name
        <br>
        <input type="radio" name="col_order" value="Last_Name"> Order By Last Name
        <br>

        <h4>Order Rows By:</h4>
        <input type="radio" name="row_order" value="ASC"> Ascending
        <br>
        <input type="radio" name="row_order" value="DESC"> Descending
        <br>
        <input type="submit" name="define_order">
    </div>
</form>
</div>
</body>
</html>
