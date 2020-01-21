<?php
$manager = (int) isset($_POST["manager"]);


require_once("../db/database.php");
$dbh = new DatabaseHelper("localhost", "root", "", "UniTicket");

$dbh->createUser($_POST["username"], $_POST["password"], $_POST["email"], $manager);
$dbh->close();

header("Location: ../login.php");
?>