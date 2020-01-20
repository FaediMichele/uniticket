<?php
require_once("bootstrap.php");

$templateParams["titolo"] = "UniTicket - Notification";
$templateParams["nome"] = "notice.php";
$templateParams["sidebar"] = "sidebar.php";

require("template/base.php");

$dbh->close();
?>