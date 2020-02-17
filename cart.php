<?php
$templateParams["nome"] = "cart.php";
require_once("bootstrap.php");

$templateParams["titolo"] = "UniTicket - Carrello";


$templateParams["cart"] = $dbh->getEventsInCart($_COOKIE["sessionId"]);

require("template/base.php");

$dbh->close();
?>