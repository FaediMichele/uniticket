<?php
require_once("bootstrap.php");

$templateParams["titolo"] = "UniTicket - Home";
$templateParams["utente"] = "Michele";
$templateParams["nome"] = "home.php";
$templateParams["sidebar"] = "sidebar.php";

$dbh = new DatabaseHelper("localhost", "root", "", "uniticket");
//$userParam = $dbh->getUserParam($sessionId);
if(true /*$userParam[5] == 1 il parametro che indica se è manager*/){
	$templateParams["advSidebar"] = "sidebarAdvanced.php";	//abilita la parte "avanzata" per gli organizzatori
}

require("template/base.php");
?>