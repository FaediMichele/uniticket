<?php
$forManager = true;
$templateParams["nome"] = "createNotice.php";
require_once("bootstrap.php");

$templateParams["titolo"] = "UniTicket - Pubblica notifica";

$templateParams["events"] = $dbh->getManagedEvent($_COOKIE["sessionId"]);

require("template/base.php");

$dbh->close();
?>