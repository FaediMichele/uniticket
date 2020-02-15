<?php
require_once("../db/database.php");
$dbh = new DatabaseHelper("localhost", "root", "", "UniTicket");

echo( $dbh->unlockUser($_COOKIE["sessionId"], $_POST["username"]));
$dbh->close();
?>