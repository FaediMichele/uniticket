<?php
require_once("bootstrap.php");

$templateParams["titolo"] = "UniTicket - ####";
$templateParams["nome"] = "eventInfo.php";
$templateParams["sidebar"] = "sidebar.php";

$templateParams["evento"] = 4;//$_GET['ID'];

require("template/base.php");

$dbh->close();
?>