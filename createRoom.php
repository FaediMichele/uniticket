<?php
require_once("bootstrap.php");

$templateParams["titolo"] = "UniTicket - Creazione sala";
$templateParams["nome"] = "createRoom.php";
$templateParams["sidebar"] = "sidebar.php";

//$templateParams["eventi"] = $dbh->getEvents();
require("template/base.php");

$dbh->close();
?>