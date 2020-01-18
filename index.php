<?php
require_once("bootstrap.php");
require_once("db/database.php");

$templateParams["titolo"] = "UniTicket - Home";
$templateParams["utente"] = "Michele";
$templateParams["nome"] = "home.php";
$templateParams["sidebar"] = "sidebar.php";

$isUserAdmin = $dbh->getUserParam($_COOKIE["sessionId"]);
 if($isUserAdmin > 0){
 	$templateParams["advSidebar"] = "sidebarAdvanced.php";	//abilita la parte "avanzata" per gli organizzatori
 }

 $templateParams["articoli"] = $dbh->getUpcomingEvents($_COOKIE["sessionId"]);
 print_r($dbh->getUpcomingEvents($_COOKIE["sessionId"]));

require("template/base.php");
?>