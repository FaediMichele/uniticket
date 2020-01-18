<?php
require_once("bootstrap.php");

$templateParams["titolo"] = "UniTicket - New event";
$templateParams["nome"] = "createEvent.php";
$templateParams["sidebar"] = "sidebar.php";
$templateParams["advSidebar"] = "sidebarAdvanced.php";	//abilita la parte "avanzata" per gli organizzatori

require_once("template/base.php");