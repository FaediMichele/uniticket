<?php
require_once("bootstrap.php");

$templateParams["titolo"] = "UniTicket - Agenda";
$templateParams["nome"] = "agenda.php";
$templateParams["sidebar"] = "sidebar.php";

//$templateParams["eventi"] = $dbh->getEvents();
//$templateParams["eventi"] = $dbh->getUpcomingEvents($_COOKIE["sessionId"]);
require("template/base.php");

$dbh->close();
?>

>