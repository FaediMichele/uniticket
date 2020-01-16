<?php
require_once("bootstrap.php");

$templateParams["titolo"] = "UniTicket - Home";
$templateParams["utente"] = "Michele";
$templateParams["nome"] = "home.php";

if(true){
	$templateParams["sidebar"] = "sidebarStandard.php";
}else{
	$templateParams["sidebar"] = "sidebarOrganizer.php";
}
//$templateParams["eventi"] = $dbh->getRandomPosts(2);

require("template/base.php");
?>