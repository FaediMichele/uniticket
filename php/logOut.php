<?php
require_once("db/database.php");
$dbh = new DatabaseHelper("localhost", "root", "", "UniTicket");

$dbh.logOut($_COOKIE["sessionId"]);
?>