<?php
$forGuest = true;
$templateParams["nome"] = "notFound.php";
require_once("bootstrap.php");

$templateParams["titolo"] = "UniTicket - Not found";


require_once("template/base.php");

$dbh->close();
?>