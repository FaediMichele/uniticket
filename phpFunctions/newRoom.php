<?php
require_once("../db/database.php");
$dbh = new DatabaseHelper("localhost", "root", "", "UniTicket");
$res = $dbh->addRoom($_COOKIE["sessionId"], $_POST["name"], $_POST["capacity"], $_POST["roomName"]);
var_dump($res);
header("location: ../index.php");
?>