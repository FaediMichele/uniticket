<?php
require_once("bootstrap.php");

$templateParams["titolo"] = "UniTicket - Notification";
$templateParams["nome"] = "notice.php";

require("template/base.php");

$dbh->close();
?>