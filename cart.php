<?php
require_once("bootstrap.php");

$templateParams["titolo"] = "UniTicket - Carrello";
$templateParams["nome"] = "cart.php";
$templateParams["sidebar"] = "sidebar.php";

require("template/base.php");

$dbh->close();
?>