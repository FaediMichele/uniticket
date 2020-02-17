<?php
$templateParams["nome"] = "notice.php";
require_once("bootstrap.php");

$templateParams["titolo"] = "UniTicket - Notification";


require("template/base.php");

$dbh->close();
?>