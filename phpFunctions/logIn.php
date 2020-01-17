<?php
require_once("../db/database.php");
$dbh = new DatabaseHelper("localhost", "root", "", "UniTicket");

print_r(array_keys($dbh->logIn($_POST["username"], $_POST["password"])));
?>