<?php
require_once("bootstrap.php");

$templateParams["titolo"] = "UniTicket - Pagamento";
$templateParams["nome"] = "pay.php";
$templateParams["sidebar"] = "sidebar.php";


require("template/base.php");

$dbh->close();
?>