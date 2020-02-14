<?php

require_once("../db/database.php");
$dbh = new DatabaseHelper("localhost", "root", "", "UniTicket");
var_dump($dbh->readNotice($_COOKIE["sessionId"], $_POST["idEvent"]));
$dbh->close();

?>