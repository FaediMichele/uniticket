<?php
    require_once("../db/database.php");
    $dbh = new DatabaseHelper("localhost", "root", "", "UniTicket");
    var_dump( $dbh->getLocationsAndRoom($_COOKIE["sessionId"]));
    /*$myJSON = json_encode($dbh->getLocationsAndRoom($_COOKIE["sessionId"]));
    echo $myJSON;*/
?>