<?php
$templateParams["nome"] = "createLocation.php";
$forManager = true;
require_once("bootstrap.php");

$templateParams["titolo"] = "UniTicket - Nuovo locale";


//$templateParams["eventi"] = $dbh->getEvents();
require("template/base.php");

$dbh->close();
?>