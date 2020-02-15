<?php
require_once("bootstrap.php");

$templateParams["titolo"] = "UniTicket - Pagamento";
$templateParams["nome"] = "pay.php";


require("template/base.php");

$dbh->close();
?>