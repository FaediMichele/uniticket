<?php
require_once("bootstrap.php");

$templateParams["titolo"] = "UniTicket - New event";
$templateParams["nome"] = "createEvent.php";
$templateParams["sidebar"] = "sidebar.php";

require_once("template/base.php");

$dbh->close();
?>