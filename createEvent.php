<?php
$templateParams["nome"] = "createEvent.php";
$forManager = true;
require_once("bootstrap.php");

$templateParams["titolo"] = "UniTicket - New event";


require_once("template/base.php");

$dbh->close();
?>