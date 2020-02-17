<?php
$templateParams["nome"] = "createRoom.php";
$forManager = true;
require_once("bootstrap.php");

$templateParams["titolo"] = "UniTicket - Creazione sala";


//$templateParams["eventi"] = $dbh->getEvents();
require("template/base.php");

$dbh->close();
?>