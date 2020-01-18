<?php
require_once("bootstrap.php");
require_once("db/database.php");

$templateParams["titolo"] = "UniTicket - Home";
$templateParams["utente"] = "Michele";
$templateParams["nome"] = "home.php";
$templateParams["sidebar"] = "sidebar.php";

//$dbh = new DatabaseHelper("localhost", "root", "root", "uniticket");
$userParam = $dbh->getUserParam($_COOKIE["sessionId"]);

 if($userParam > 0){
 	$templateParams["advSidebar"] = "sidebarAdvanced.php";	//abilita la parte "avanzata" per gli organizzatori
 }

require("template/base.php");
?>