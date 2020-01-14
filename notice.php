<?php
require_once("bootstrap.php");

$templateParams["titolo"] = "UniTicket - Notification";
$templateParams["utente"] = "Michele";
$templateParams["nome"] = "notice.php";
//$templateParams["eventi"] = $dbh->getRandomPosts(2);

require("template/base.php");
?>