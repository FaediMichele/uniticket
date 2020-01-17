<?php
require_once("bootstrap.php");

$templateParams["titolo"] = "UniTicket - Carrello";
$templateParams["utente"] = "Michele";
$templateParams["nome"] = "cart.php";
$templateParams["sidebar"] = "sidebarOrganizer.php";
//$templateParams["eventi"] = $dbh->getRandomPosts(2);

require("template/base.php");
?>