<?php
$templateParams["nome"] = "agenda.php";
require_once("bootstrap.php");

$templateParams["titolo"] = "UniTicket - Agenda";


//$templateParams["eventi"] = $dbh->getEvents();
$templateParams["agenda"] = $dbh->getAgenda($_COOKIE["sessionId"]);
require("template/base.php");

$dbh->close();
?>