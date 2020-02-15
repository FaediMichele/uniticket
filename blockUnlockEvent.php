<?php
require_once("bootstrap.php");

$templateParams["titolo"] = "UniTicket - Blocca o sblocca un evento";
$templateParams["nome"] = "blockUnlockEvent.php";
$templateParams["sidebar"] = "sidebar.php";

//$templateParams["eventi"] = $dbh->getEvents();
require("template/base.php");

$dbh->close();
?>