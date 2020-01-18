<?php
    require_once("../db/database.php");
    $dbh = new DatabaseHelper("localhost", "root", "", "UniTicket");
    print_r($dbh->getLocationsAndRoom($_COOKIE["sessionId"]));
?>