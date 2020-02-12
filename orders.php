<?php
require_once("bootstrap.php");

$templateParams["titolo"] = "UniTicket - Orders";
$templateParams["nome"] = "orders.php";
$templateParams["sidebar"] = "sidebar.php";

$templateParams["orders"] = $dbh->getAccountOrders($_COOKIE["sessionId"]);

require_once("template/base.php");

$dbh->close();
?>