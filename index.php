<!-- page where user can see current doctors in a table which they can order by first or last name in ascending or decending order -->
<!DOCTYPE html>
<html>
<head>
    <title>HPDR</title>
    <link rel="stylesheet" type="text/css" href="css/styles.css"/>
</head>
<body>
<?php include("templates/header.php"); ?>
<div class="content">
<h1> View Current Doctors </h1>
<table>
<?php

include("dbconnect.php"); // start connection

if (isset($_POST["define_order"]) && !empty($_POST["col_order"])) {
    // if form submitted and radio buttons not empty
    $name = $_POST["col_order"];
    $order = $_POST["row_order"];

    $query = "SELECT First_Name, Last_Name FROM Doctor ORDER BY $name $order";
    $result = mysqli_query($connection, $query);

?>

<!-- generate table -->
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
   // if form submitted but no radio buttons selected
   echo "<p style='color: red;'>" . "<b>Error: No Options Selected</b>" . "</p>";
}
else if (isset($_POST["define_order"]) && empty($_POST["col_order"])){
   // if order (ascending/descending) not selected
   echo "<p style='color: red;'>" . "<b>Error: Select Column to Order By</b>" . "</p>";
}

mysqli_close($connection); // close connection

?>
</table>
<br>

<!-- Form to order the table by the doctors first name or last name in ascending or descending order -->
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
