<?php

require_once("../db/database.php");
$dbh = new DatabaseHelper("localhost", "root", "", "UniTicket");
print_r($dbh->createEvent($_COOKIE["sessionId"], $_POST["name"], $_POST["description"],
    $_POST["artist"], $_POST["price"], $_POST["date"], $_POST["idRoom"]));

?>