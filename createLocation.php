<?php
require_once("bootstrap.php");

$templateParams["titolo"] = "UniTicket - Nuovo locale";
$templateParams["nome"] = "createLocation.php";
$templateParams["sidebar"] = "sidebar.php";

//$templateParams["eventi"] = $dbh->getEvents();
require("template/base.php");

$dbh->close();
?>