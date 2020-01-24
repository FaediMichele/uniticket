<?php
require_once("bootstrap.php");

$templateParams["titolo"] = "UniTicket - Carrello";
$templateParams["nome"] = "cart.php";
$templateParams["sidebar"] = "sidebar.php";

$templateParams["cart"] = $dbh->getEventsInCart($_COOKIE["sessionId"]);

require("template/base.php");

$dbh->close();
?>