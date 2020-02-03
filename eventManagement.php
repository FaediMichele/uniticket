<?php
require_once("bootstrap.php");

$templateParams["titolo"] = "UniTicket - Events";
$templateParams["nome"] = "eventManagement.php";
$templateParams["sidebar"] = "sidebar.php";


require("template/base.php");

$dbh->close();
?>