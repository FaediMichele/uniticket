<?php
require_once("bootstrap.php");

$templateParams["titolo"] = "UniTicket - Event info";
$templateParams["nome"] = "eventInfo.php";
$templateParams["sidebar"] = "sidebar.php";

if(isset($_GET['ID']) && ($_GET['ID']!=null) /*&& $dbh->isEventPresent($_GET['ID'])*/ ){
	$templateParams["evento"] = $_GET['ID'];	
} else {
	header("Location: notFound.php");
}

require("template/base.php");

$dbh->close();
?>