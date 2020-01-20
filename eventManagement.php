<?php
require_once("bootstrap.php");

$templateParams["titolo"] = "UniTicket - Events";
$templateParams["nome"] = "eventManagement.php";
$templateParams["sidebar"] = "sidebar.php";
$templateParams["advSidebar"] = "sidebarAdvanced.php";	//abilita la parte "avanzata" per gli organizzatori

require("template/base.php");
$dbh->close();
?>