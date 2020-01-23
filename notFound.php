<?php
$forGuest = true;
require_once("bootstrap.php");

$templateParams["titolo"] = "UniTicket - Not found";
$templateParams["nome"] = "notFound.php";
$templateParams["sidebar"] = "sidebar.php";

require_once("template/base.php");

$dbh->close();
?>