
<!DOCTYPE html>
<html>
<head>
<title>HPDR</title>
<link rel="stylesheet" type="text/css" href="styles.css"/>
</head>
<body>
<?php include("templates/header.php"); ?>
<div class="content">

</div>

<?php

if ($_GET['firstname'] && $_GET['lastname']) {
    //echo $_GET['firstname'];
    //echo $_GET['lastname'];

    include("dbconnect.php");
}
/*
else show 403
*/

?>
