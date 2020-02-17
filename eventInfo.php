<?php
$forGuest = true;
$templateParams["nome"] = "eventInfo.php";
require_once("bootstrap.php");

$templateParams["titolo"] = "UniTicket - Event info";


if(isset($_GET['ID']) && ($_GET['ID']!=null) /*&& $dbh->isEventPresent($_GET['ID'])*/ ){
	$templateParams["evento"] = $_GET['ID'];	
} else {
	header("Location: notFound.php");
}

require("template/base.php");

$dbh->close();
?>