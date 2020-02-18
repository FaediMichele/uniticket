<?php
require_once("db/database.php");
$dbh = new DatabaseHelper("localhost", "root", "", "UniTicket");


if (array_key_exists("sessionId", $_COOKIE)
&& isset($_COOKIE["sessionId"])
&& $_COOKIE["sessionId"] != ''){
    $dbh.logOut($_COOKIE["sessionId"]);
}
?>