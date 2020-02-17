<?php
require_once("db/database.php");

if(!isset($dbh)) {
    $dbh = new DatabaseHelper("localhost", "root", "", "UniTicket");
}
$forGuest = true;
$templateParams["nome"] = "message.php";
require_once("bootstrap.php");
$templateParams["titolo"] = "UniTicket - " . $_GET["name"];


require("template/baseLogin.php");
?>