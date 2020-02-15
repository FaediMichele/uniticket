<?php
$forGuest = true;
require_once("bootstrap.php");

$templateParams["titolo"] = "UniTicket - Not found";
$templateParams["nome"] = "notFound.php";

require_once("template/base.php");

$dbh->close();
?>