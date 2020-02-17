<?php
$templateParams["nome"] = "blockUnlockEvent.php";
$forManager = true;
require_once("bootstrap.php");

$templateParams["titolo"] = "UniTicket - Blocca o sblocca un evento";


//$templateParams["eventi"] = $dbh->getEvents();
require("template/base.php");

$dbh->close();
?>