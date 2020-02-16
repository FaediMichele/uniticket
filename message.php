<?php
require_once("db/database.php");

if(!isset($dbh)) {
    $dbh = new DatabaseHelper("localhost", "root", "", "UniTicket");
}
require_once("bootstrap.php");
$templateParams["titolo"] = "UniTicket - " . $_GET["name"];
$templateParams["nome"] = "message.php";

require("template/baseLogin.php");
?>