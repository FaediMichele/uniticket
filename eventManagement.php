<?php
require_once("bootstrap.php");

$templateParams["titolo"] = "UniTicket - Events";
$templateParams["nome"] = "eventManagement.php";
$templateParams["sidebar"] = "sidebar.php";
$templateParams["events"] = $dbh->getManagedEvent($_COOKIE["sessionId"]);

require("template/base.php");

$dbh->close();
?>