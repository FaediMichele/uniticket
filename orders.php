<?php
require_once("bootstrap.php");

$templateParams["titolo"] = "UniTicket - Orders";
$templateParams["nome"] = "orders.php";

$templateParams["orders"] = $dbh->getUserOrders($_COOKIE["sessionId"]);
//var_dump($templateParams["orders"]);

require_once("template/base.php");

$dbh->close();
?>