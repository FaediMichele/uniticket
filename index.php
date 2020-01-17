<?php
require_once("bootstrap.php");

$templateParams["titolo"] = "UniTicket - Home";
$templateParams["utente"] = "Michele";
$templateParams["nome"] = "home.php";

$dbh = new DatabaseHelper("localhost", "root", "", "uniticket");
//$userParam = $dbh->getUserParam($sessionId);

if(true /*$userParam[5] == 1 il parametro che indica se è manager*/){
	$templateParams["sidebar"] = "sidebarOrganizer.php";
}else{
	$templateParams["sidebar"] = "sidebarStandard.php";
}
//$templateParams["eventi"] = $dbh->getRandomPosts(2);

require("template/base.php");
?>