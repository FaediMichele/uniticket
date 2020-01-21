<?php
    require_once("../db/database.php");
    $dbh = new DatabaseHelper("localhost", "root", "", "UniTicket");

    if ( $_COOKIE["sessionId"] != ''){
        $dbh->logOut($_COOKIE["sessionId"]);
    }
    $dbh->close();
?>