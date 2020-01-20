<?php
require_once("bootstrap.php");

$templateParams["titolo"] = "UniTicket - Home";
$templateParams["nome"] = "home.php";
$templateParams["sidebar"] = "sidebar.php";

//$templateParams["eventi"] = $dbh->getEvents();
$templateParams["eventi"] = $dbh->getUpcomingEvents($_COOKIE["sessionId"]);
require("template/base.php");

$dbh->close();
?>