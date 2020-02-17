<?php
$templateParams["nome"] = "blockUnlockUser.php";
$forManager = true;
$forAdmin = true;
require_once("bootstrap.php");

$templateParams["titolo"] = "UniTicket - Blocca o sblocca un utente";


//$templateParams["eventi"] = $dbh->getEvents();
require("template/base.php");

$dbh->close();
?>