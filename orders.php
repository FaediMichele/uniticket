<?php
require_once("bootstrap.php");

$templateParams["titolo"] = "UniTicket - Orders";
$templateParams["nome"] = "orders.php";
$templateParams["sidebar"] = "sidebar.php";

require_once("template/base.php");
$dbh->close();
?>