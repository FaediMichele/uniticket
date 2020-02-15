<?php
require_once("../db/database.php");
$dbh = new DatabaseHelper("localhost", "root", "", "UniTicket");

echo  $dbh->blockUser($_COOKIE["sessionId"], $_POST["username"], $_POST["message"]);
$dbh->close();
?>