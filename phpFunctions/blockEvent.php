<?php
require_once("../db/database.php");
$dbh = new DatabaseHelper("localhost", "root", "", "UniTicket");

echo $dbh->blockEvent($_COOKIE["sessionId"], $_POST["idEvent"], $_POST["message"]);
$dbh->close();
?>