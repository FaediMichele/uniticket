<?php
$templateParams["nome"] = "orders.php";
require_once("bootstrap.php");

$templateParams["titolo"] = "UniTicket - Orders";


$templateParams["orders"] = $dbh->getUserOrders($_COOKIE["sessionId"]);
//var_dump($templateParams["orders"]);

require_once("template/base.php");

$dbh->close();
?>