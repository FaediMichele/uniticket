<?php
require_once("bootstrap.php");

$templateParams["titolo"] = "UniTicket - Home";
$templateParams["utente"] = "Michele";
//$templateParams["nome"] = "home.php";
//$templateParams["eventi"] = $dbh->getRandomPosts(2);

require("template/base.php");
?>