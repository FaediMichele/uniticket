<?php
$forManager = true;
$templateParams["nome"] = "eventManagement.php";
require_once("bootstrap.php");

$templateParams["titolo"] = "UniTicket - Events";

$templateParams["events"] = $dbh->getManagedEvent($_COOKIE["sessionId"]);

require("template/base.php");

$dbh->close();
?>