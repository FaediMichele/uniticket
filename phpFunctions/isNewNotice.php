<?php
 require_once("../db/database.php");
    $dbh = new DatabaseHelper("localhost", "root", "", "UniTicket");

    echo $dbh->isNewNotice($_COOKIE["sessionId"])[0]["NotifiNotViewed"];
?>