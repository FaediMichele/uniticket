<?php
require_once("db/database.php");
$dbh = new DatabaseHelper("localhost", "root", "", "UniTicket");

echo $dbh.logIn($_POST["username"], $_POST["password"]);
?>