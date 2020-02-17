<?php
$templateParams["nome"] = "pay.php";
require_once("bootstrap.php");

$templateParams["titolo"] = "UniTicket - Pagamento";



require("template/base.php");

$dbh->close();
?>